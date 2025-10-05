<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
// Assume you have an ApiKey Model that links to users table
use App\Models\ApiKey;

class ResellerController extends Controller
{
    /**
     * Display the API credentials management page for the authenticated user.
     * * @return \Illuminate\View\View
     */
    public function manageApiKeys()
    {
        // 1. Get the authenticated user's ID
        $userId = Auth::id();
        
        // 2. Attempt to find the existing API Key for this user
        // We use first() here, assuming one user has one primary API Key document.
        $apiKey = ApiKey::where('user_id', $userId)->first();
        
        // 3. If no key exists, we pass null to the view to prompt generation.
        $currentKey = $apiKey ? $apiKey->key : null;

        // Pass the key (or null) and the user ID to the Blade view
        return view('reseller.api-credentials', compact('currentKey', 'userId'));
    }

    /**
     * Generates a new API Key for the authenticated user and saves it.
     * * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function generateNewApiKey(Request $request)
    {
        // Check if the user is authenticated
        if (!Auth::check()) {
            return back()->withErrors(['error' => 'Authentication required.']);
        }
        
        $userId = Auth::id();
        $newKey = Str::random(32); // Generate a secure, 32-character random string (or whatever length you need)

        // 1. Find or create the ApiKey record
        $apiKeyRecord = ApiKey::firstOrNew(['user_id' => $userId]);

        // 2. Update the key and save (this effectively 'revokes' the old key)
        $apiKeyRecord->key = $newKey;
        $apiKeyRecord->is_active = true; // Ensure it's marked as active
        $apiKeyRecord->save();

        // Optional: Log the key change event for security auditing

        Session(['alert' => 'success', 'msg' => 'A new API Key has been generated and is now active.']);
        return redirect()->route('reseller.api_keys.index');
    }
}

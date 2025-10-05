<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{DB, Log, Auth};
use Illuminate\Validation\Rule;
use App\Models\{User, UnitPurchase};
use Carbon\Carbon;

/**
 * Handles administrative actions related to SMS, such as manual refunds.
 */
class AdminSmsController extends Controller
{
    /**
     * Refunds units to a specific user by creating a new UnitPurchase record.
     * This method is intended for platform administrators only.
     * * POST /api/admin/sms/refund
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function refund(Request $request)
    {
        // 1. Authorization (Ensure only admins can access this route)
        // You MUST uncomment and update this to match your admin authorization logic
        // if (!Auth::user()->isAdmin()) {
        //     return response()->json(['status' => 'error', 'message' => 'Unauthorized access.'], 403);
        // }

        // 2. Validation
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'units' => 'required|integer|min:1',
            'reason' => 'required|string|max:255',
            'reference' => 'nullable|string|max:255', // e.g., Batch ID from the failed Message record
        ]);

        $user = User::findOrFail($request->user_id);
        $unitsToRefund = (int) $request->units;
        $reason = $request->reason;
        $reference = $request->reference;
        
        DB::beginTransaction();
        try {
            // Create a new UnitPurchase record to credit the units back to the user
            UnitPurchase::create([
                'user_id' => $user->id,
                'units' => $unitsToRefund,
                'available_units' => $unitsToRefund, // Full amount is available
                'description' => "MANUAL REFUND: {$reason}",
                'reference' => $reference, // Optional reference for the transaction
                'purchase_date' => Carbon::now(),
                // Store the admin ID who performed the action
                'admin_id' => Auth::id() 
            ]);

            DB::commit();
            
            Log::info("Admin Refund: User {$user->id} credited {$unitsToRefund} units. Reason: {$reason}. Admin: " . Auth::id());

            return response()->json([
                'status' => 'success',
                'message' => "Successfully credited {$unitsToRefund} units to user {$user->id}.",
                'new_balance' => $user->fresh()->available_units,
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("Admin Refund Failed: User {$user->id}. Units: {$unitsToRefund}. Error: " . $e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to process refund. Database transaction error.',
            ], 500);
        }
    }
}

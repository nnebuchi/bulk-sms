<?php

namespace App\Auth;

use Illuminate\Auth\GuardHelpers;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Http\Request;
use App\Models\ApiKey; // Import the new model

class ApiKeyGuard implements Guard
{
    use GuardHelpers;

    /**
     * The request instance.
     *
     * @var \Illuminate\Http\Request
     */
    protected $request;

    /**
     * The provider to retrieve users.
     *
     * @var \Illuminate\Contracts\Auth\UserProvider
     */
    protected $provider;

    /**
     * Create a new authentication guard.
     *
     * @param  \Illuminate\Contracts\Auth\UserProvider  $provider
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    public function __construct(UserProvider $provider, Request $request)
    {
        $this->request = $request;
        $this->provider = $provider;
    }

    /**
     * Get the currently authenticated user.
     *
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function user()
    {
        // If the user has already been retrieved, we'll just return it.
        if (! is_null($this->user)) {
            return $this->user;
        }

        $apiKey = $this->getApiKeyFromRequest();

        if ($apiKey) {
            // Find the active API key
            $keyModel = ApiKey::where('key', $apiKey)
                ->where('is_active', true)
                ->first();

            if ($keyModel) {
                // Update last used timestamp
                $keyModel->update(['last_used_at' => now()]);

                // Set the user based on the key's user_id
                return $this->user = $keyModel->user;
            }
        }

        return null;
    }

    /**
     * Get the API key from the request.
     *
     * @return string|null
     */
    protected function getApiKeyFromRequest()
    {
        // Check for 'X-Api-Key' header
        $key = $this->request->header('X-Api-Key');

        if ($key) {
            return $key;
        }

        // Check for 'api_key' query parameter (less secure, but common)
        $key = $this->request->query('api_key');

        if ($key) {
            return $key;
        }

        // Check for 'Authorization: Bearer <key>' header
        if ($this->request->bearerToken()) {
            return $this->request->bearerToken();
        }

        return null;
    }

    /**
     * Validate a user's credentials. (Not strictly needed for stateless API key, but required by interface)
     *
     * @param  array  $credentials
     * @return bool
     */
    public function validate(array $credentials = [])
    {
        // API key validation is handled in the user() method
        return false;
    }
}

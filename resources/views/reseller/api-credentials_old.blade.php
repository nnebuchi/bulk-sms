@extends('layouts.dashboard.rebirth.app')
@section('title', 'dashboard')
@section('content')
<div class="mx-auto">
    
    <!-- Status Message Display -->
    @if (session('status'))
        <div class="mb-6 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-lg shadow-lg" role="alert">
            <p class="font-bold">Success!</p>
            <p>{{ session('status') }}</p>
        </div>
    @endif
    
    <!-- Header Section -->
    <div class="mb-6 bg-white shadow-lg rounded-xl p-4 tabletmd:p-8 sm:p-6">
        <h1 class="text-3xl font-extrabold text-gray-900">API Credentials</h1>
        <p class="text-sm text-gray-500 mt-1 flex items-center space-x-2">
            <span class="font-normal text-gray-700">Dashboard</span>
            <span>/</span>
            <span class="text-[#FFCB00] rounded-full text-sm font-medium">API Credentials</span>
        </p>
    </div>

    <!-- Main Key Management Section -->
    <div class="bg-white shadow-lg rounded-xl p-4 tabletmd:p-8 sm:p-6">
        <div class="mb-6">
            <h2 class="text-2xl font-bold text-gray-900">API Key Management</h2>
            <p class="text-gray-500 text-sm mt-1">
                Your API Key is used to authenticate all requests to the Reseller SMS API. Keep it confidential. 
            </p>
        </div>

        <div class="space-y-6 mb-8">
            <!-- API Key Display -->
            <div class="relative max-w-xl w-full api-key-container">
                <div class="flex items-center justify-between">
                    <label for="api-key-input" class="block text-gray-600 font-normal mb-2">Reseller API Key</label>
                    
                    <div class="flex items-center space-x-4">
                        <!-- Visibility Toggle Button -->
                        <button type="button" id="visibility-toggle" title="Toggle Visibility" class="text-gray-500 hover:text-gray-800 transition-colors focus:outline-none">
                            <i id="eye-icon" class="fas fa-eye"></i>
                        </button>
                        <!-- Copy Button -->
                        <button type="button" id="copy-key-button" title="Copy Key" class="text-gray-500 hover:text-gray-800 transition-colors focus:outline-none">
                            <i class="fas fa-copy"></i>
                        </button>
                    </div>
                </div>

                <input
                    type="password"
                    id="api-key-input"
                    placeholder="{{ $currentKey ? '********************************' : 'Click "Generate New Key" to create your credential.' }}"
                    value="{{ $currentKey ?? '' }}"
                    readonly
                    class="w-full border border-gray-300 rounded-lg p-3 pr-4 text-sm font-mono bg-gray-50 focus:ring-blue-500 focus:border-blue-500 outline-none transition-colors"
                />
                
                @unless ($currentKey)
                    <p class="mt-2 text-sm text-yellow-600">No API key found. Please generate one to begin using the SMS API.</p>
                @endunless
            </div>
            
            <!-- Key Actions and Status -->
            <div class="flex flex-col sm:flex-row sm:items-center space-y-4 sm:space-y-0 sm:space-x-4">
                
                <!-- Form to handle API Key Generation -->
                <form id="generate-key-form" method="POST" action="{{ route('reseller.api_keys.generate') }}">
                    @csrf
                    <button type="button" id="generate-key-button" class="bg-red-600 hover:bg-red-700 text-white font-semibold py-3 px-6 rounded-lg transition duration-150 shadow-lg text-sm disabled:opacity-50">
                        <i class="fas fa-redo mr-2"></i>Generate New Key
                    </button>
                </form>

                <div id="status-message" class="text-sm pt-2 sm:pt-0 text-gray-500 font-medium">
                    @if ($currentKey)
                        Your current key is active.
                    @else
                        Ready to generate API Key.
                    @endif
                </div>
            </div>

            <!-- Guidance Note -->
            <div class="p-4 mt-6 bg-yellow-50 border-l-4 border-yellow-500 rounded-lg max-w-xl">
                <p class="text-sm text-yellow-800">
                    <strong>Warning:</strong> Generating a new key will instantly **invalidate your old key**. Update your applications immediately to avoid service interruption.
                </p>
            </div>
        </div>
    </div>
</div>

<script>
    // --- Frontend JavaScript Logic (Visibility and Copy) ---

    const apiKeyInput = document.getElementById('api-key-input');
    const visibilityToggle = document.getElementById('visibility-toggle');
    const eyeIcon = document.getElementById('eye-icon');
    const copyKeyButton = document.getElementById('copy-key-button');
    const generateKeyButton = document.getElementById('generate-key-button');
    const generateKeyForm = document.getElementById('generate-key-form');
    const statusMessage = document.getElementById('status-message');

    /**
     * Toggles the visibility of the API key input field.
     */
    visibilityToggle.addEventListener('click', () => {
        if (apiKeyInput.value === '') return;
        
        if (apiKeyInput.type === 'password') {
            apiKeyInput.type = 'text';
            eyeIcon.classList.remove('fa-eye');
            eyeIcon.classList.add('fa-eye-slash');
        } else {
            apiKeyInput.type = 'password';
            eyeIcon.classList.remove('fa-eye-slash');
            eyeIcon.classList.add('fa-eye');
        }
    });

    /**
     * Copies the API key to the clipboard.
     */
    copyKeyButton.addEventListener('click', () => {
        if (apiKeyInput.value === '') return;

        // Create a temporary text area to hold the key
        const textToCopy = apiKeyInput.value;
        navigator.clipboard.writeText(textToCopy).then(() => {
            // Provide visual feedback
            copyKeyButton.innerHTML = '<i class="fas fa-check ml-2"></i>';
            setTimeout(() => {
                copyKeyButton.innerHTML = '<i class="fas fa-copy ml-2"></i>';
            }, 1000);
        }).catch(err => {
            console.error('Could not copy text: ', err);
            statusMessage.textContent = 'Failed to copy key. Please copy manually.';
            statusMessage.classList.add('text-red-600');
        });
    });

    /**
     * Handles the confirmation modal before submitting the key generation form.
     */
    generateKeyButton.addEventListener('click', (e) => {
        e.preventDefault(); // Prevent form submission initially
        
        // Custom Modal Implementation (to avoid window.confirm)
        const modalHtml = `
            <div id="confirm-modal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
                <div class="bg-white rounded-xl shadow-2xl p-6 w-11/12 max-w-sm">
                    <h3 class="text-xl font-bold text-red-600 mb-3">Confirm Key Generation</h3>
                    <p class="text-gray-700 mb-6">
                        Are you sure you want to generate a new key? This action will immediately **invalidate your current key** and cannot be undone.
                    </p>
                    <div class="flex justify-end space-x-3">
                        <button id="modal-cancel" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300 transition">Cancel</button>
                        <button id="modal-confirm" class="px-4 py-2 bg-red-600 text-white font-semibold rounded-lg hover:bg-red-700 transition">Generate New Key</button>
                    </div>
                </div>
            </div>
        `;

        document.body.insertAdjacentHTML('beforeend', modalHtml);
        const modal = document.getElementById('confirm-modal');
        const confirmBtn = document.getElementById('modal-confirm');
        const cancelBtn = document.getElementById('modal-cancel');

        const cleanup = (submit) => {
            modal.remove();
            if (submit) {
                generateKeyForm.submit();
            }
        };

        confirmBtn.onclick = () => cleanup(true);
        cancelBtn.onclick = () => cleanup(false);
    });

</script>
@endsection
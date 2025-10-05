<!-- Chosen Palette: Minimalist Blue-Gray (Base: White/Gray-50, Accent: Blue-600) -->
<!-- Application Structure Plan: A classic two-column dashboard/documentation layout. A sticky navigation sidebar (w-1/5 on desktop, full-width header on mobile) provides instant access to Authentication and the three main API endpoints. The main content area (w-4/5 on desktop) presents the details, tables, and code blocks for each section. This structure was chosen for usability because API documentation users typically jump directly to specific endpoints, making quick access via the sticky navigation paramount. -->
<!-- Visualization & Content Choices: Summary: Text/Tables -> Goal: Inform -> Viz/Presentation Method: Styled HTML Tables and Dark Code Blocks -> Interaction: Copy to Clipboard & Smooth Scroll Navigation -> Justification: Tables clearly present parameters; code blocks offer runnable examples; copy functionality improves developer workflow. Library/Method: Vanilla JS (No Chart/Plotly needed for documentation). -->
<!-- CONFIRMATION: NO SVG graphics used. NO Mermaid JS used. -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reseller SMS API Documentation</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap');
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f9fafb; /* gray-50 */
        }
        .header-content-wrapper {
            display: flex;
            min-height: 100vh;
        }
        .code-block {
            /* Custom dark theme for code blocks */
            background-color: #1f2937; /* gray-800 */
        }
        .main-content {
            scroll-behavior: smooth;
        }
        /* Style for smooth scrolling on anchor links */
        html {
            scroll-behavior: smooth;
        }
        /* Mobile navigation toggle */
        @media (max-width: 1023px) {
            #sidebar-nav {
                transform: translateX(-100%);
                transition: transform 0.3s ease-in-out;
            }
            #sidebar-nav.open {
                transform: translateX(0);
            }
        }
    </style>
</head>
<body>

    <!-- Mobile Header -->
    <header class="lg:hidden fixed top-0 left-0 w-full bg-white border-b border-gray-200 z-50 p-4 flex justify-between items-center shadow-md">
        <h1 class="text-xl font-bold text-gray-800">API Docs</h1>
        <button id="menu-button" class="text-gray-800 focus:outline-none p-2 rounded-lg hover:bg-gray-100">
            &#9776;
        </button>
    </header>

    <div class="header-content-wrapper">

        <!-- Sticky Sidebar Navigation (lg+) -->
        <nav id="sidebar-nav" class="fixed top-0 left-0 h-full w-64 bg-white border-r border-gray-200 p-6 z-40 hidden lg:block">
            <a href="{{route('welcome')}}">
                <img src="{{asset('rebirth/assets/images/skezzole_black.png')}}" alt="Skezzole Logo" class="h-6 mobilelg:w-fit w-2/3 logo-full object-contain mb-3" />
            </a>
            <hr/>
            {{-- <h2 class="text-2xl font-extrabold text-yellow-500 mb-8 mt-2"><a href="#">Back to APP</a></h2> --}}
            <ul class="space-y-4 mt-4">
                <li><a onclick="smoothScroll('auth-section')" href="#auth-section" class="nav-link block p-2 rounded-lg text-gray-700 hover:bg-yellow-50 hover:text-yellow-400 transition duration-150">Authentication</a></li>
                <li><a onclick="smoothScroll('send-sms-section')" href="#send-sms-section" class="nav-link block p-2 rounded-lg text-gray-700 hover:bg-yellow-50 hover:text-yellow-400 transition duration-150">1. Send SMS Message</a></li>
                <li><a onclick="smoothScroll('balance-section')" href="#balance-section" class="nav-link block p-2 rounded-lg text-gray-700 hover:bg-yellow-50 hover:text-yellow-400 transition duration-150">2. Check Unit Balance</a></li>
                <li><a onclick="smoothScroll('status-section')" href="#status-section" class="nav-link block p-2 rounded-lg text-gray-700 hover:bg-yellow-50 hover:text-yellow-400 transition duration-150">3. Check Message Status</a></li>
            </ul>
        </nav>

        <!-- Sidebar Overlay for Mobile -->
        <div id="sidebar-overlay" class="fixed inset-0 bg-black opacity-0 z-30 transition-opacity duration-300 pointer-events-none lg:hidden"></div>

        <!-- Main Content Area -->
        <main class="main-content flex-grow lg:ml-64 pt-20 lg:pt-8 p-6 sm:p-10">
            <h1 class="hidden lg:block text-4xl font-extrabold text-gray-900 mb-10">{{env('APP_NAME')}} SMS API Documentation</h1>
            <p class="text-lg text-gray-600 mb-12 max-w-3xl">This documentation provides all the necessary details to integrate your platform with our SMS system, allowing you to send bulk messages and manage your unit balance programmatically using your unique API key.</p>

            <!-- Authentication Section -->
            <section id="auth-section" class="mb-16 pt-4">
                <h2 class="text-3xl font-bold text-gray-800 mb-6 border-b pb-2">Authentication</h2>
                <p class="text-gray-600 mb-6">All requests to the API must be authenticated. You must include your unique API Key in every request, either in the custom **`X-Api-Key`** header (preferred) or as a query parameter.</p>

                <div class="bg-yellow-50 p-4 rounded-lg mb-6 border-l-4 border-blue-500 flex justify-between items-center">
                    <span id="api-key-value" class="font-mono text-blue-800 select-all">@auth {{ optional(auth()->user()->apiKeys()->where('is_active', 1)->latest()->first())->key }} @else YOUR_API_KEY_HERE @endauth</span>
                    <button onclick="copyToClipboard('api-key-value')" class="ml-4 bg-blue-600 text-white px-3 py-1 text-sm rounded-md hover:bg-blue-700 transition duration-150">
                        Copy
                    </button>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 rounded-lg shadow-sm">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Method</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Header/Parameter</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Value</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap font-semibold">Header</td>
                                <td class="px-6 py-4 whitespace-nowrap font-mono">X-Api-Key</td>
                                <td class="px-6 py-4 whitespace-nowrap text-gray-600">`YOUR_API_KEY_HERE` (Preferred method)</td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap font-semibold">Query</td>
                                <td class="px-6 py-4 whitespace-nowrap font-mono">api_key</td>
                                <td class="px-6 py-4 whitespace-nowrap text-gray-600">`YOUR_API_KEY_HERE` (Alternative)</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <p class="mt-4 text-sm text-red-500">Note: If the API key is missing or invalid, a `401 Unauthorized` response will be returned.</p>
            </section>

            <!-- Send SMS Message Section -->
            <section id="send-sms-section" class="mb-16 pt-4">
                <h2 class="text-3xl font-bold text-gray-800 mb-6 border-b pb-2">1. Send SMS Message</h2>
                <p class="text-gray-600 mb-6">This is the primary endpoint for sending one or more messages. The system handles unit calculation and deduction automatically. Ensure you have sufficient units before submitting.</p>

                <div class="text-sm mb-4">
                    <span class="font-semibold mr-2">Endpoint:</span> <code class="bg-green-100 text-green-800 px-2 py-1 rounded-md font-mono">POST /api/sms/send</code>
                    <span class="font-semibold ml-4 mr-2">Content Type:</span> <code class="bg-gray-200 text-gray-800 px-2 py-1 rounded-md font-mono">application/json</code>
                </div>

                <h3 class="text-xl font-semibold text-gray-700 mb-4 mt-6">Request Body Parameters</h3>
                <div class="overflow-x-auto mb-8">
                    <table class="min-w-full divide-y divide-gray-200 rounded-lg shadow-sm">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Parameter</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Required</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap font-mono">to</td>
                                <td class="px-6 py-4 whitespace-nowrap">string</td>
                                <td class="px-6 py-4 whitespace-nowrap text-green-600 font-bold">Yes</td>
                                <td class="px-6 py-4">Comma-separated list of recipient phone numbers (e.g., `+1234567890,2345678901`). Numbers must be 7 to 15 digits.</td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap font-mono">content</td>
                                <td class="px-6 py-4 whitespace-nowrap">string</td>
                                <td class="px-6 py-4 whitespace-nowrap text-green-600 font-bold">Yes</td>
                                <td class="px-6 py-4">The message content (Max 1000 characters).</td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap font-mono">from</td>
                                <td class="px-6 py-4 whitespace-nowrap">string</td>
                                <td class="px-6 py-4 whitespace-nowrap">No</td>
                                <td class="px-6 py-4">The custom Sender ID/Name (Max 11 characters, optional). Uses a default if not provided.</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <h3 class="text-xl font-semibold text-gray-700 mb-4">Example Request</h3>

                <!-- Tab Navigation -->
                <div class="flex space-x-2 border-b border-gray-300 mb-4">
                    <button onclick="switchTab('send', 'curl')" data-section="send" data-lang="curl" class="tab-button p-2 text-sm font-medium rounded-t-lg bg-blue-600 text-white transition duration-150">cURL</button>
                    <button onclick="switchTab('send', 'node')" data-section="send" data-lang="node" class="tab-button p-2 text-sm font-medium rounded-t-lg text-gray-700 hover:bg-gray-100 transition duration-150">Node.js (Fetch)</button>
                    <button onclick="switchTab('send', 'php')" data-section="send" data-lang="php" class="tab-button p-2 text-sm font-medium rounded-t-lg text-gray-700 hover:bg-gray-100 transition duration-150">PHP (cURL)</button>
                </div>

                <!-- cURL Example -->
                <div id="send-curl" data-section="send" class="tab-content code-block p-4 rounded-lg text-white mb-6 relative">
                    <pre id="curl-send-request" class="overflow-x-auto text-sm font-mono whitespace-pre-wrap">$ curl -X POST "{{ url('/') }}/api/sms/send" \
      -H "Content-Type: application/json" \
      -H "X-Api-Key: YOUR_API_KEY_HERE" \
      -d '{
          "to": "2348012345678,2348098765432",
          "content": "This is a test message from my reseller account!",
          "from": "MyCompany"
      }'</pre>
                    <button onclick="copyToClipboard('curl-send-request')" class="absolute top-2 right-2 bg-gray-600 text-white p-1 text-xs rounded-md hover:bg-gray-500 transition duration-150">Copy</button>
                </div>

                <!-- Node.js Example -->
                <div id="send-node" data-section="send" class="tab-content hidden code-block p-4 rounded-lg text-white mb-6 relative">
                    <pre id="node-send-request" class="overflow-x-auto text-sm font-mono whitespace-pre-wrap">const API_KEY = 'YOUR_API_KEY_HERE';
const API_URL = '{{ url('/') }}/api/sms/send';

const data = {
    to: '2348012345678,2348098765432',
    content: 'This is a test message from my reseller account!',
    from: 'MyCompany'
};

fetch(API_URL, {
    method: 'POST',
    headers: {
        'Content-Type': 'application/json',
        'X-Api-Key': API_KEY
    },
    body: JSON.stringify(data)
})
.then(response => response.json())
.then(result => console.log(result))
.catch(error => console.error('Error:', error));</pre>
                    <button onclick="copyToClipboard('node-send-request')" class="absolute top-2 right-2 bg-gray-600 text-white p-1 text-xs rounded-md hover:bg-gray-500 transition duration-150">Copy</button>
                </div>

                <!-- PHP Example -->
                <div id="send-php" data-section="send" class="tab-content hidden code-block p-4 rounded-lg text-white mb-6 relative">
                    <pre id="php-send-request" class="overflow-x-auto text-sm font-mono whitespace-pre-wrap">&lt;?php
$apiKey = 'YOUR_API_KEY_HERE';
$apiUrl = '{{ url('/') }}/api/sms/send';

$payload = json_encode([
    'to' => '2348012345678,2348098765432',
    'content' => 'This is a test message from my reseller account!',
    'from' => 'MyCompany'
]);

$ch = curl_init($apiUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Content-Type: application/json',
    'X-Api-Key: ' . $apiKey
]);

$response = curl_exec($ch);
curl_close($ch);

print_r(json_decode($response, true));
?&gt;</pre>
                    <button onclick="copyToClipboard('php-send-request')" class="absolute top-2 right-2 bg-gray-600 text-white p-1 text-xs rounded-md hover:bg-gray-500 transition duration-150">Copy</button>
                </div>


                <h3 class="text-xl font-semibold text-gray-700 mb-4">Example Success Response (HTTP 200)</h3>
                <div class="code-block p-4 rounded-lg text-white mb-6 relative">
                    <pre id="json-send-success" class="overflow-x-auto text-sm font-mono whitespace-pre-wrap">{
    "status": "success",
    "message": "SMS request processed.",
    "total_recipients": 2,
    "units_deducted": 2,
    "messages_sent": 2,
    "failed_recipients": [],
    "new_balance": 198.00,
    "request_id": 145
}</pre>
                    <button onclick="copyToClipboard('json-send-success')" class="absolute top-2 right-2 bg-gray-600 text-white p-1 text-xs rounded-md hover:bg-gray-500 transition duration-150">Copy</button>
                </div>

                <h3 class="text-xl font-semibold text-gray-700 mb-4">Example Error Response (HTTP 403)</h3>
                <p class="text-gray-600 mb-2">Returned when the API key is valid, but the user has **Insufficient Units**.</p>
                <div class="code-block p-4 rounded-lg text-white mb-6 relative">
                    <pre id="json-send-error" class="overflow-x-auto text-sm font-mono whitespace-pre-wrap">{
    "status": "error",
    "message": "Insufficient SMS units.",
    "available_units": 10.00,
    "required_units": 12
}</pre>
                    <button onclick="copyToClipboard('json-send-error')" class="absolute top-2 right-2 bg-gray-600 text-white p-1 text-xs rounded-md hover:bg-gray-500 transition duration-150">Copy</button>
                </div>
            </section>

            <!-- Check Unit Balance Section -->
            <section id="balance-section" class="mb-16 pt-4">
                <h2 class="text-3xl font-bold text-gray-800 mb-6 border-b pb-2">2. Check Unit Balance</h2>
                <p class="text-gray-600 mb-6">Use this simple GET endpoint to quickly retrieve your current available SMS unit balance before initiating a large send.</p>

                <div class="text-sm mb-4">
                    <span class="font-semibold mr-2">Endpoint:</span> <code class="bg-blue-100 text-blue-800 px-2 py-1 rounded-md font-mono">GET /api/user/balance</code>
                </div>

                <h3 class="text-xl font-semibold text-gray-700 mb-4">Example Request</h3>

                <!-- Tab Navigation -->
                <div class="flex space-x-2 border-b border-gray-300 mb-4">
                    <button onclick="switchTab('balance', 'curl')" data-section="balance" data-lang="curl" class="tab-button p-2 text-sm font-medium rounded-t-lg bg-blue-600 text-white transition duration-150">cURL</button>
                    <button onclick="switchTab('balance', 'node')" data-section="balance" data-lang="node" class="tab-button p-2 text-sm font-medium rounded-t-lg text-gray-700 hover:bg-gray-100 transition duration-150">Node.js (Fetch)</button>
                    <button onclick="switchTab('balance', 'php')" data-section="balance" data-lang="php" class="tab-button p-2 text-sm font-medium rounded-t-lg text-gray-700 hover:bg-gray-100 transition duration-150">PHP (cURL)</button>
                </div>

                <!-- cURL Example -->
                <div id="balance-curl" data-section="balance" class="tab-content code-block p-4 rounded-lg text-white mb-6 relative">
                    <pre id="curl-balance-request" class="overflow-x-auto text-sm font-mono whitespace-pre-wrap">$ curl -X GET "{{ url('/') }}/api/user/balance" \
      -H "X-Api-Key: YOUR_API_KEY_HERE"</pre>
                    <button onclick="copyToClipboard('curl-balance-request')" class="absolute top-2 right-2 bg-gray-600 text-white p-1 text-xs rounded-md hover:bg-gray-500 transition duration-150">Copy</button>
                </div>

                <!-- Node.js Example -->
                <div id="balance-node" data-section="balance" class="tab-content hidden code-block p-4 rounded-lg text-white mb-6 relative">
                    <pre id="node-balance-request" class="overflow-x-auto text-sm font-mono whitespace-pre-wrap">const API_KEY = 'YOUR_API_KEY_HERE';
const API_URL = '{{ url('/') }}/api/user/balance';

fetch(API_URL, {
    method: 'GET',
    headers: {
        'X-Api-Key': API_KEY
    }
})
.then(response => response.json())
.then(result => console.log(result))
.catch(error => console.error('Error:', error));</pre>
                    <button onclick="copyToClipboard('node-balance-request')" class="absolute top-2 right-2 bg-gray-600 text-white p-1 text-xs rounded-md hover:bg-gray-500 transition duration-150">Copy</button>
                </div>

                <!-- PHP Example -->
                <div id="balance-php" data-section="balance" class="tab-content hidden code-block p-4 rounded-lg text-white mb-6 relative">
                    <pre id="php-balance-request" class="overflow-x-auto text-sm font-mono whitespace-pre-wrap">&lt;?php
$apiKey = 'YOUR_API_KEY_HERE';
$apiUrl = '{{ url('/') }}/api/user/balance';

$ch = curl_init($apiUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'X-Api-Key: ' . $apiKey
]);

$response = curl_exec($ch);
curl_close($ch);

print_r(json_decode($response, true));
?&gt;</pre>
                    <button onclick="copyToClipboard('php-balance-request')" class="absolute top-2 right-2 bg-gray-600 text-white p-1 text-xs rounded-md hover:bg-gray-500 transition duration-150">Copy</button>
                </div>

                <h3 class="text-xl font-semibold text-gray-700 mb-4">Example Success Response (HTTP 200)</h3>
                <div class="code-block p-4 rounded-lg text-white mb-6 relative">
                    <pre id="json-balance-success" class="overflow-x-auto text-sm font-mono whitespace-pre-wrap">{
    "status": "success",
    "message": "Current SMS unit balance.",
    "available_units": 198.00
}</pre>
                    <button onclick="copyToClipboard('json-balance-success')" class="absolute top-2 right-2 bg-gray-600 text-white p-1 text-xs rounded-md hover:bg-gray-500 transition duration-150">Copy</button>
                </div>
            </section>

            <!-- Check Message Status Section -->
            <section id="status-section" class="mb-16 pt-4">
                <h2 class="text-3xl font-bold text-gray-800 mb-6 border-b pb-2">3. Check Message Status</h2>
                <p class="text-gray-600 mb-6">After sending a message, use the returned **`request_id`** to poll this endpoint for the delivery status of the entire batch and individual recipients.</p>

                <div class="text-sm mb-4">
                    <span class="font-semibold mr-2">Endpoint:</span> <code class="bg-blue-100 text-blue-800 px-2 py-1 rounded-md font-mono">GET /api/sms/status/{request_id}</code>
                </div>

                <h3 class="text-xl font-semibold text-gray-700 mb-4 mt-6">URL Parameters</h3>
                <div class="overflow-x-auto mb-8">
                    <table class="min-w-full divide-y divide-gray-200 rounded-lg shadow-sm">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Parameter</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Required</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap font-mono">request_id</td>
                                <td class="px-6 py-4 whitespace-nowrap">integer</td>
                                <td class="px-6 py-4 whitespace-nowrap text-green-600 font-bold">Yes</td>
                                <td class="px-6 py-4">The unique ID returned from a successful `POST /api/sms/send` request.</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <h3 class="text-xl font-semibold text-gray-700 mb-4">Example Request</h3>

                <!-- Tab Navigation -->
                <div class="flex space-x-2 border-b border-gray-300 mb-4">
                    <button onclick="switchTab('status', 'curl')" data-section="status" data-lang="curl" class="tab-button p-2 text-sm font-medium rounded-t-lg bg-blue-600 text-white transition duration-150">cURL</button>
                    <button onclick="switchTab('status', 'node')" data-section="status" data-lang="node" class="tab-button p-2 text-sm font-medium rounded-t-lg text-gray-700 hover:bg-gray-100 transition duration-150">Node.js (Fetch)</button>
                    <button onclick="switchTab('status', 'php')" data-section="status" data-lang="php" class="tab-button p-2 text-sm font-medium rounded-t-lg text-gray-700 hover:bg-gray-100 transition duration-150">PHP (cURL)</button>
                </div>

                <!-- cURL Example -->
                <div id="status-curl" data-section="status" class="tab-content code-block p-4 rounded-lg text-white mb-6 relative">
                    <pre id="curl-status-request" class="overflow-x-auto text-sm font-mono whitespace-pre-wrap">$ curl -X GET "{{ url('/') }}/api/sms/status/145" \
      -H "X-Api-Key: YOUR_API_KEY_HERE"</pre>
                    <button onclick="copyToClipboard('curl-status-request')" class="absolute top-2 right-2 bg-gray-600 text-white p-1 text-xs rounded-md hover:bg-gray-500 transition duration-150">Copy</button>
                </div>

                <!-- Node.js Example -->
                <div id="status-node" data-section="status" class="tab-content hidden code-block p-4 rounded-lg text-white mb-6 relative">
                    <pre id="node-status-request" class="overflow-x-auto text-sm font-mono whitespace-pre-wrap">const API_KEY = 'YOUR_API_KEY_HERE';
const REQUEST_ID = '145';
const API_URL = `{{ url('/') }}/api/sms/status/${REQUEST_ID}`;

fetch(API_URL, {
    method: 'GET',
    headers: {
        'X-Api-Key': API_KEY
    }
})
.then(response => response.json())
.then(result => console.log(result))
.catch(error => console.error('Error:', error));</pre>
                    <button onclick="copyToClipboard('node-status-request')" class="absolute top-2 right-2 bg-gray-600 text-white p-1 text-xs rounded-md hover:bg-gray-500 transition duration-150">Copy</button>
                </div>

                <!-- PHP Example -->
                <div id="status-php" data-section="status" class="tab-content hidden code-block p-4 rounded-lg text-white mb-6 relative">
                    <pre id="php-status-request" class="overflow-x-auto text-sm font-mono whitespace-pre-wrap">&lt;?php
$apiKey = 'YOUR_API_KEY_HERE';
$requestId = '145';
$apiUrl = '{{ url('/') }}/api/sms/status/' . $requestId;

$ch = curl_init($apiUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'X-Api-Key: ' . $apiKey
]);

$response = curl_exec($ch);
curl_close($ch);

print_r(json_decode($response, true));
?&gt;</pre>
                    <button onclick="copyToClipboard('php-status-request')" class="absolute top-2 right-2 bg-gray-600 text-white p-1 text-xs rounded-md hover:bg-gray-500 transition duration-150">Copy</button>
                </div>

                <h3 class="text-xl font-semibold text-gray-700 mb-4">Example Success Response (HTTP 200)</h3>
                <div class="code-block p-4 rounded-lg text-white mb-6 relative">
                    <pre id="json-status-success" class="overflow-x-auto text-sm font-mono whitespace-pre-wrap">{
    "status": "success",
    "message": "Message status retrieved.",
    "request_id": 145,
    "submitted_at": "2025-10-02T19:51:00Z",
    "content": "This is a test message from my reseller account!",
    "summary": {
        "total_recipients": 2,
        "sent": 2,
        "delivered": 1,
        "failed": 1
    },
    "recipients": [
        {
            "number": "2348012345678",
            "status": "Delivered",
            "gateway_ref": "ref_abc123"
        },
        {
            "number": "2348098765432",
            "status": "Failed",
            "gateway_ref": "ref_def456"
        }
    ]
}</pre>
                    <button onclick="copyToClipboard('json-status-success')" class="absolute top-2 right-2 bg-gray-600 text-white p-1 text-xs rounded-md hover:bg-gray-500 transition duration-150">Copy</button>
                </div>

                <h3 class="text-xl font-semibold text-gray-700 mb-4">Error Responses</h3>
                <ul class="list-disc list-inside space-y-2 text-gray-600">
                    <li>**HTTP 404 Not Found:** Returned if the `request_id` does not exist in the database.</li>
                    <li>**HTTP 403 Forbidden:** Returned if the authenticated user (via API Key) attempts to view a message that they did not submit.</li>
                </ul>
            </section>

            <footer class="text-center py-10 text-gray-500 border-t mt-16">
                &copy; 2024 Reseller SMS API. All rights reserved.
            </footer>
        </main>
    </div>

    <!-- JavaScript for Interactivity -->
    <script>
        // Toggles the mobile menu
        const menuButton = document.getElementById('menu-button');
        const sidebarNav = document.getElementById('sidebar-nav');
        const sidebarOverlay = document.getElementById('sidebar-overlay');
        const navLinks = document.querySelectorAll('.nav-link');

        function toggleMenu() {
            const isMenuOpen = sidebarNav.classList.toggle('open');
            sidebarOverlay.classList.toggle('opacity-0', !isMenuOpen);
            sidebarOverlay.classList.toggle('pointer-events-none', !isMenuOpen);
            document.body.classList.toggle('overflow-hidden', isMenuOpen);
            // On large screens, ensure the menu is visible and fixed
            if (window.innerWidth >= 1024) {
                sidebarNav.classList.remove('open');
                sidebarOverlay.classList.add('opacity-0', 'pointer-events-none');
                document.body.classList.remove('overflow-hidden');
            }
        }

        menuButton.addEventListener('click', toggleMenu);
        sidebarOverlay.addEventListener('click', toggleMenu);
        navLinks.forEach(link => {
            link.addEventListener('click', () => {
                if (window.innerWidth < 1024) {
                    toggleMenu(); // Close menu after clicking a link on mobile
                }
            });
        });

        /**
         * Switches the active code example tab for a given section.
         * @param {string} sectionPrefix - The prefix used in IDs (e.g., 'send', 'balance').
         * @param {string} lang - The language to switch to (e.g., 'curl', 'node', 'php').
         */
        function switchTab(sectionPrefix, lang) {
            // 1. Hide all content for this section
            document.querySelectorAll(`.tab-content[data-section="${sectionPrefix}"]`).forEach(el => {
                el.classList.add('hidden');
            });

            // 2. De-activate all tab buttons for this section
            document.querySelectorAll(`.tab-button[data-section="${sectionPrefix}"]`).forEach(btn => {
                btn.classList.remove('bg-blue-600', 'text-white');
                btn.classList.add('text-gray-700', 'hover:bg-gray-100');
            });

            // 3. Show the requested content
            const content = document.getElementById(`${sectionPrefix}-${lang}`);
            if (content) {
                content.classList.remove('hidden');
            }

            // 4. Activate the requested tab button
            const button = document.querySelector(`.tab-button[data-section="${sectionPrefix}"][data-lang="${lang}"]`);
            if (button) {
                button.classList.add('bg-blue-600', 'text-white');
                button.classList.remove('text-gray-700', 'hover:bg-gray-100');
            }
        }

        // Makes the navigation work like smooth scroll
        function smoothScroll(id) {
            const element = document.getElementById(id);
            if (element) {
                // Determine offset (e.g., to account for sticky header on mobile)
                const offset = window.innerWidth < 1024 ? 80 : 0;
                const bodyRect = document.body.getBoundingClientRect().top;
                const elementRect = element.getBoundingClientRect().top;
                const elementPosition = elementRect - bodyRect;
                const offsetPosition = elementPosition - offset;

                window.scrollTo({
                    top: offsetPosition,
                    behavior: 'smooth'
                });
            }
        }

        // Copy to Clipboard functionality
        function copyToClipboard(elementId) {
            const element = document.getElementById(elementId);
            const textToCopy = element.innerText || element.textContent;

            const tempInput = document.createElement('textarea');
            tempInput.value = textToCopy.trim();
            document.body.appendChild(tempInput);
            tempInput.select();
            document.execCommand('copy');
            document.body.removeChild(tempInput);

            // Simple visual feedback
            const originalText = element.textContent;
            element.textContent = 'Copied!';
            setTimeout(() => {
                element.textContent = originalText;
            }, 1000);
        }

        // Attach functions to window object so they can be called from onclick attributes
        window.copyToClipboard = copyToClipboard;
        window.smoothScroll = smoothScroll;
        window.switchTab = switchTab;

    </script>
</body>
</html>

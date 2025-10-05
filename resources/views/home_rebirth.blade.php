@extends('layouts.dashboard.rebirth.app')
@section('title', 'dashboard')
@section('content')
<section class="grid grid-cols-1 mobilemd:grid-cols-2 lg:grid-cols-4 laptopmd:gap-6 lg:gap-3 tabletlg:gap-8 gap-6 mb-6">
    <div
    class="bg-white laptopmd:p-4 lg:p-2 p-4 rounded-lg shadow-sm space-y-2">
    <div class="flex flex-col justify-between">
        <div
        class="bg-[#F5F5F5] rounded-md h-8 w-8 flex items-center justify-center">
        <svg
            width="20"
            height="20"
            viewBox="0 0 24 24"
            fill="none"
            xmlns="http://www.w3.org/2000/svg">
            <path
            d="M16 21V19C16 17.9391 15.5786 16.9217 14.8284 16.1716C14.0783 15.4214 13.0609 15 12 15H6C4.93913 15 3.92172 15.4214 3.17157 16.1716C2.42143 16.9217 2 17.9391 2 19V21M16 3.128C16.8578 3.35037 17.6174 3.85126 18.1597 4.55206C18.702 5.25286 18.9962 6.11389 18.9962 7C18.9962 7.88611 18.702 8.74714 18.1597 9.44794C17.6174 10.1487 16.8578 10.6496 16 10.872M22 21V19C21.9993 18.1137 21.7044 17.2528 21.1614 16.5523C20.6184 15.8519 19.8581 15.3516 19 15.13M13 7C13 9.20914 11.2091 11 9 11C6.79086 11 5 9.20914 5 7C5 4.79086 6.79086 3 9 3C11.2091 3 13 4.79086 13 7Z"
            stroke="#263238"
            stroke-width="2"
            stroke-linecap="round"
            stroke-linejoin="round" />
        </svg>
        </div>
        <h2 class="laptopmd:text-lg text-base text-gray-500">
        Total Contact
        </h2>
    </div>
    <div class="flex items-center justify-between">
        <p
        class="laptopmd:text-2xl/tight text-xl font-bold text-[#263238]">
        {{ number_format(Auth::user()->contacts->count()) }}
        </p>
        {{-- <span
        class="flex items-center justify-center h-6 w-fit laptopmd:px-2 px-1 bg-[#DDFFF5] rounded-lg">
        <span class="text-xs text-green-500 font-semibold">+1.89%</span>
        </span> --}}
    </div>
    </div>
    <div
    class="bg-white laptopmd:p-4 lg:p-2 p-4 rounded-lg shadow-sm space-y-2">
    <div class="flex flex-col justify-between">
        <div
        class="bg-[#F5F5F5] rounded-md h-8 w-8 flex items-center justify-center">
        <svg
            width="20"
            height="20"
            viewBox="0 0 24 24"
            fill="none"
            xmlns="http://www.w3.org/2000/svg">
            <path
            d="M3 12H3.01M3 18H3.01M3 6H3.01M8 12H21M8 18H21M8 6H21"
            stroke="#263238"
            stroke-width="2"
            stroke-linecap="round"
            stroke-linejoin="round" />
        </svg>
        </div>
        <h2 class="laptopmd:text-lg text-base text-gray-500">
        Available Units
        </h2>
    </div>
    <div class="flex items-center justify-between">
        <p class="laptopmd:text-2xl/tight text-xl font-bold text-[#263238]">
            {{ number_format(Auth::user()->units->sum('available_units')) }}
        </p>
        {{-- <span
        class="flex items-center justify-center h-6 w-fit laptopmd:px-2 px-1 bg-[#DDFFF5] rounded-lg">
        <span class="text-xs text-green-500 font-semibold">+1.89%</span>
        </span> --}}
    </div>
    </div>
    <div
    class="bg-white laptopmd:p-4 lg:p-2 p-4 rounded-lg shadow-sm space-y-2">
    <div class="flex flex-col justify-between">
        <div
        class="bg-[#F5F5F5] rounded-md h-8 w-8 flex items-center justify-center">
        <svg
            width="20"
            height="20"
            viewBox="0 0 24 24"
            fill="none"
            xmlns="http://www.w3.org/2000/svg">
            <path
            d="M10.9136 13.0853C10.7225 12.8945 10.4947 12.7444 10.2441 12.6441L2.31405 9.46406C2.21937 9.42606 2.13857 9.36002 2.08251 9.27478C2.02644 9.18955 1.9978 9.0892 2.00041 8.98722C2.00302 8.88523 2.03677 8.78648 2.09712 8.70423C2.15747 8.62197 2.24155 8.56015 2.33805 8.52706L21.338 2.02706C21.4267 1.99505 21.5225 1.98894 21.6145 2.00945C21.7064 2.02995 21.7907 2.07622 21.8573 2.14283C21.9239 2.20945 21.9702 2.29366 21.9907 2.38561C22.0112 2.47756 22.0051 2.57345 21.973 2.66206L15.473 21.6621C15.44 21.7586 15.3781 21.8426 15.2959 21.903C15.2136 21.9633 15.1149 21.9971 15.0129 21.9997C14.9109 22.0023 14.8106 21.9737 14.7253 21.9176C14.6401 21.8615 14.574 21.7807 14.536 21.6861L11.356 13.7541C11.2552 13.5036 11.1047 13.2761 10.9136 13.0853ZM10.9136 13.0853L21.854 2.14706"
            stroke="#263238"
            stroke-width="2"
            stroke-linecap="round"
            stroke-linejoin="round" />
        </svg>
        </div>
        <h2 class="laptopmd:text-lg text-base text-gray-500">
        Total Messages Sent
        </h2>
    </div>
    <div class="flex items-center justify-between">
        <p
        class="laptopmd:text-2xl/tight text-xl font-bold text-[#263238]">
        {{ number_format(Auth::user()->messages()->where('status', '1')->count()) }}
        </p>
        <span
        class="flex items-center justify-center h-6 w-fit laptopmd:px-2 px-1 bg-[#DDFFF5] rounded-lg">
        <span class="text-xs text-green-500 font-semibold">+1.89%</span>
        </span>
    </div>
    </div>
    <div
    class="bg-white laptopmd:p-4 lg:p-2 p-4 rounded-lg shadow-sm space-y-2">
    <div class="flex flex-col justify-between">
        <div
        class="bg-[#F5F5F5] rounded-md h-8 w-8 flex items-center justify-center">
        <svg
            width="20"
            height="20"
            viewBox="0 0 24 24"
            fill="none"
            xmlns="http://www.w3.org/2000/svg">
            <path
            d="M8 2V6M16 2V6M3 10H21M8 14H8.01M12 14H12.01M16 14H16.01M8 18H8.01M12 18H12.01M16 18H16.01M5 4H19C20.1046 4 21 4.89543 21 6V20C21 21.1046 20.1046 22 19 22H5C3.89543 22 3 21.1046 3 20V6C3 4.89543 3.89543 4 5 4Z"
            stroke="#263238"
            stroke-width="2"
            stroke-linecap="round"
            stroke-linejoin="round" />
        </svg>
        </div>
        <h2 class="laptopmd:text-lg text-base text-gray-500">
        Pending Schedules
        </h2>
    </div>
    <div class="flex items-center justify-between">
        <p
        class="laptopmd:text-2xl/tight text-xl font-bold text-[#263238]">
        0
        </p>
        {{-- <span class="flex items-center justify-center h-6 w-fit laptopmd:px-2 px-1 bg-red-200 rounded-lg">
            <span class="text-xs text-red-500 font-semibold">+1.89%</span>
        </span> --}}
    </div>
    </div>
</section>
<section class="bg-white mobilelg:p-6 p-4 rounded-lg shadow-sm">
    <div
    class="flex flex-col sm:flex-row sm:items-center justify-between mb-4">
    <div class="mb-4 sm:mb-0">
        <h2 class="text-xl font-semibold">Analytics</h2>
        <p class="text-gray-500 text-sm">
        Visitor analytics of last 30 days
        </p>
    </div>
    <div class="flex space-x-2">
        <button
        class="px-4 py-2 text-sm rounded-lg bg-blue-500 text-white">
        Monthly
        </button>
        <button
        class="px-4 py-2 text-sm text-gray-600 hover:bg-[#FFCB00] rounded-lg">
        Quarterly
        </button>
        <button
        class="px-4 py-2 text-sm text-gray-600 hover:bg-[#FFCB00] rounded-lg">
        Annually
        </button>
    </div>
    </div>
    <div
    class="h-80 w-full bg-gray-50 flex items-center justify-center rounded-lg">
    <p class="text-gray-400">
        Chart will be rendered here by a JS library like Chart.js
    </p>
    </div>
</section>
@endsection
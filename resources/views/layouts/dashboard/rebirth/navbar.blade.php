<header
        class="bg-white shadow-md p-4 flex items-center justify-between z-10 w-full sticky top-0 latopmd:pe-10">
        <div
          class="flex items-center space-x-4 laptopmd:w-5/12 tabletlg:w-6/12">
          <button
            id="sidebar-toggle"
            class="p-2 hover:bg-[#FFCB00] rounded-lg transition-colors tabletsm:block hidden">
            <span
              class="fa fa-bars text-xl ring-1 ring-[#7A7A7A] p-2 rounded-md text-[#7A7A7A]"></span>
          </button>
          <button
            id="toggleMobileNav"
            class="p-2 hover:bg-[#FFCB00] rounded-lg transition-colors tabletsm:hidden block">
            <span
              class="fa fa-bars text-xl ring-1 ring-[#7A7A7A] p-2 rounded-md text-[#7A7A7A]"></span>
          </button>
          <div class="relative w-full tabletlg:block hidden">
            <input
              type="search"
              placeholder="Search or type command"
              class="w-full pl-10 pr-4 h-10 ring-1 rounded-lg focus:outline-none focus:ring-2 focus:ring-black ring-[#7D7D7D]placeholder:text-[#7A7A7A] placeholder:text-sm focus:bg-gray-50" />
            <svg
              class="h-5 w-5 text-gray-400 absolute left-3 top-1/2 -translate-y-1/2"
              fill="currentColor"
              viewBox="0 0 24 24">
              <path
                d="M15.5 14h-.79l-.28-.27A6.471 6.471 0 0016 9.5 6.5 6.5 0 109.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zM9.5 14C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z" />
            </svg>
          </div>
        </div>

        <div
          class="flex items-center justify-end space-x-4 laptopmd:w-4/12 tabletlg:w-5/12 tabletmd:w-7/12">
          <button class="text-gray-500 hover:text-gray-700 block">
            <span
              class="text-xl ring-1 ring-[#7A7A7A] rounded-full h-8 w-8 flex items-center justify-center">
              <i class="fa fa-moon"></i
            ></span>
          </button>
          <button class="text-gray-500 hover:text-gray-700 block relative">
            <span
              class="text-xl ring-1 ring-[#7A7A7A] rounded-full h-8 w-8 flex items-center justify-center">
              <i class="fa fa-bell"></i
            ></span>
            <span class="absolute top-0 right-0 flex size-2">
              <span
                class="absolute inline-flex h-full w-full animate-ping rounded-full bg-[#FFCB00] opacity-75"></span>
              <span
                class="relative inline-flex size-2 rounded-full bg-[#FFCB00]"></span>
            </span>
          </button>
          <div
            class="flex space-x-2 cursor-pointer relative"
            dropdown-toggle="profile-toggle"
            id="profile-toggle"
            role="button">
            <img
              class="h-10 w-10 rounded-full object-cover"
              src="https://images.unsplash.com/photo-1535713875002-d1d0cf377fde?q=80&w=2960&auto=format&fit=crop"
              alt="User Avatar" />
            <span
              class="font-semibold sm:items-center items-end sm:space-x-2 flex">
              <span class="hidden sm:block">{{ Auth::user()->username }}</span>
              <span class="absolute left-3" role="icon">
                <svg
                  class="h-4 w-4 transform transition-transform chevron"
                  fill="none"
                  viewBox="0 0 24 24"
                  stroke="white">
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M19 9l-7 7-7-7" /></svg></span
            ></span>
          </div>
        </div>
        <div
          class="z-50 hidden absolute top-15 right-5 my-4 text-base list-none bg-white divide-y divide-gray-100 rounded-b-lg shadow-lg ring-1 ring-gray-50 w-fit border-t-2 border-gray-600"
          id="dropdown-user">
          <div class="px-4 py-3" role="none">
            <p class="text-sm font-medium" role="none">{{ Auth::user()->username }}</p>
            <p class="text-sm text-[#263238] truncate" role="none">
              {{ Auth::user()->email }}
            </p>
          </div>
          <ul class="py-1" role="none">
            <li>
              <a
                href="#"
                class="block px-4 py-2 text-sm text-gray-700 hover:bg-[#FFCB00] rounded-lg"
                role="menuitem"
                ><span class="fa fa-user-cog pr-2"></span> Edit Profile</a
              >
            </li>
            <li>
              <a
                href="#"
                class="block px-4 py-2 text-sm text-gray-700 hover:bg-[#FFCB00] rounded-lg"
                role="menuitem"
                ><span class="fa fa-cog pr-2"></span>Account Settings</a
              >
            </li>
            <li>
              <a
                href="#"
                class="block px-4 py-2 text-sm text-gray-700 hover:bg-[#FFCB00] rounded-lg"
                role="menuitem"
                ><span class="fa fa-info-circle pr-2"></span>Support</a
              >
            </li>
            <li>
              <a
                href="#"
                class="block px-4 py-2 text-sm text-gray-700 hover:bg-[#FFCB00] rounded-lg"
                role="menuitem"
                onclick="event.preventDefault();document.getElementById('logout-form').submit();"
                >
                <span class="fa fa-sign-out pr-2"></span>Sign out</a
              >
              <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                    @csrf
                </form>
            </li>
          </ul>
        </div>
      </header>
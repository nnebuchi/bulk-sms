<header class="relative">
    <nav class="bg-white fixed top-0 w-full z-20">
      <div
        class="flex flex-wrap items-center justify-between max-w-screen-xl mx-auto py-4 laptopmd:px-12 mobilelg:px-8 px-4">
        <a
          href="{{route('welcome')}}"
          class="flex items-center space-x-3 rtl:space-x-reverse tabletmd:w-40 mobilemd:w-32 mobilesm:w-28 w-12">
          <img
            src="{{asset('rebirth/assets/images/skezzole_black.png')}}"
            class="w-full h-auto mobilesm:flex hidden block"
            alt="Skezzole Logo" 
          />

          <img
            src="{{asset('rebirth/assets/icons/skezzole_icon_black.png')}}"
            class="h-fit w-50 mobilesm:hidden flex"
            alt="Skezzole Logo" />
        </a>
        <div
          class="flex items-center md:order-2 space-x-2 mobilelg:space-x-4 rtl:space-x-reverse">
          @auth
              <a
            href="{{route('home')}}"
            class="btn-primary mobilesm:flex hidden"
            role="button"
            >Dashboard</a
          >
          @else
          <a
            href="{{route('login')}}"
            class="btn-primary mobilesm:flex hidden"
            role="button"
            >Login</a
          >
          <a href="{{route('register')}}" class="btn-ghost" role="button"
            >Sign up</a
          >
          @endauth

          <button
            id="menu-trigger"
            data-collapse-toggle="mega-menu"
            type="button"
            class="inline-flex items-center p-2 w-10 h-10 bg-gray-200 justify-center text-sm text-skzdark-00 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200"
            aria-controls="mega-menu"
            aria-expanded="false">
            <span class="sr-only">Open main menu</span>
            <svg
              class="w-16 h-16 text-skzdark-200"
              aria-hidden="true"
              xmlns="http://www.w3.org/2000/svg"
              fill="none"
              viewBox="0 0 17 14">
              <path
                stroke="currentColor"
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M1 1h15M1 7h15M1 13h15" />
            </svg>
          </button>
        </div>
        <div
          id="menu"
          class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1">
          <ul
            class="flex flex-col mt-4 font-medium md:flex-row md:mt-0 md:space-x-8 rtl:space-x-reverse">
            <li>
              <a href="{{route('welcome').'#features'}}" class="navlink">Features</a>
            </li>
            <li>
              <a href="{{route('welcome').'#pricing'}}" class="navlink">Pricing</a>
            </li>
            <li>
              <a href="{{route('docs')}}" target="_blank" class="navlink">API Docs</a>
            </li>
          </ul>
        </div>

        <!-- Mobile Menu -->

        <div
          id="mobile-menu"
          class="flex-col absolute hidden slide-up h-screen w-full top-0 right-0 bg-white z-10 pt-10 gap-y-20">
          <span
            class="absolute top-5 right-4 font-bold text-2xl cursor-pointer"
            id="close-menu"
            ><svg
              class="w-6 h-6 text-gray-800"
              aria-hidden="true"
              xmlns="http://www.w3.org/2000/svg"
              width="24"
              height="24"
              fill="none"
              viewBox="0 0 24 24">
              <path
                stroke="currentColor"
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M6 18 17.94 6M18 18 6.06 6" />
            </svg>
          </span>
          <a
            href="/pages/index.html"
            class="flex items-center space-x-3 rtl:space-x-reverse tabletmd:w-40 w-32 self-center">
            <img
              src="{{asset('rebirth/assets/images/skezzole_black.png')}}"
              class="h-fit w-full"
              alt="Skezzole Logo" />
          </a>
          <div class="min-h-screen flex items-start">
            <ul class="flex flex-col w-full justify-center">
              <li
                class="hover:bg-skzyellow-700 w-full border-b border-gray-400 h-16 ps-10 flex items-center">
                <a href="{{route('welcome').'#features'}}" class="font-medium text-base mobile-nav-link">Features</a>
              </li>
              <li
                class="hover:bg-skzyellow-700 w-full border-b border-gray-400 h-16 ps-10 flex items-center">
                <a href="{{route('welcome').'#pricing'}}" class="font-medium text-base mobile-nav-link">Pricing</a>
              </li>
              <li
                class="hover:bg-skzyellow-700 w-full border-b border-gray-400 h-16 ps-10 flex items-center">
                <a href="#" class="font-medium text-base mobile-nav-link">API Docs</a>
              </li>

              <!-- <a
                href="#"
                class="btn-primary mobilesm:hidden block w-50 mt-8 ms-10"
                role="button"
                >Login</a
              > -->
            </ul>
          </div>
        </div>
      </div>
    </nav>
  </header>
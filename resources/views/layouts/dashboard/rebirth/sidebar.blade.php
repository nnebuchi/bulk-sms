<aside
      id="sidebar"
      class="tabletsm:relative fixed hidden tabletsm:flex flex-col bg-white shadow-lg pb-4 mobilelg:ps-4 ps-4 mobilelg:pe-4 pe-2 pt-7 min-h-fit h-screen transition-all duration-300 w-64 z-50">
      <button
        class="tabletsm:hidden absolute top-7 right-4"
        id="mobileNavClose">
        <span class="fa fa-close text-2xl"></span>
      </button>
      <div class="flex items-center space-x-2 pb-4">
        <img
          src="{{asset('rebirth/assets/images/skezzole_black.png')}}"
          alt="Skezzole Logo"
          class="h-6 mobilelg:w-fit w-1/3 logo-full object-contain" />
        <img
          src="{{asset('rebirth/assets/icons/skezzole_icon_black.png')}}"
          alt="Skezzole Logo"
          class="h-6 w-fit logo-icon hidden" />
      </div>
      <nav
        class="mobilelg:space-y-2 space-y-1 flex-1 mobilelg:mt-4 mt-2 overflow-y-auto">
        <p
          class="text-gray-500 text-sm uppercase font-semibold text-label px-3">
          Menu
        </p>

        <a
          href="{{ route('welcome') }}"
          class="flex items-center space-x-2 mobilelg:p-3 p-2 text-gray-700 hover:bg-[#FFCB00] rounded-lg transition-colors icon-adjust">
          <svg
            width="24"
            height="24"
            viewBox="0 0 24 24"
            fill="none"
            xmlns="http://www.w3.org/2000/svg">
            <path
              d="M15 21V13C15 12.7348 14.8946 12.4804 14.7071 12.2929C14.5196 12.1053 14.2652 12 14 12H10C9.73478 12 9.48043 12.1053 9.29289 12.2929C9.10536 12.4804 9 12.7348 9 13V21M3 9.99997C2.99993 9.70904 3.06333 9.42159 3.18579 9.15768C3.30824 8.89378 3.4868 8.65976 3.709 8.47197L10.709 2.47297C11.07 2.16788 11.5274 2.00049 12 2.00049C12.4726 2.00049 12.93 2.16788 13.291 2.47297L20.291 8.47197C20.5132 8.65976 20.6918 8.89378 20.8142 9.15768C20.9367 9.42159 21.0001 9.70904 21 9.99997V19C21 19.5304 20.7893 20.0391 20.4142 20.4142C20.0391 20.7893 19.5304 21 19 21H5C4.46957 21 3.96086 20.7893 3.58579 20.4142C3.21071 20.0391 3 19.5304 3 19V9.99997Z"
              stroke="#263238"
              stroke-width="1.5"
              stroke-linecap="round"
              stroke-linejoin="round" />
          </svg>
          <span class="nav-text">Home</span>
        </a>

        <a
          href="{{ route('home') }}"
          class="flex items-center space-x-2 mobilelg:p-3 p-2 text-gray-700 hover:bg-[#FFCB00] rounded-lg transition-colors icon-adjust">
           <svg
                width="24"
                height="24"
                viewBox="0 0 24 24"
                fill="none"
                xmlns="http://www.w3.org/2000/svg">
                <path
                  d="M9 3H4C3.44772 3 3 3.44772 3 4V11C3 11.5523 3.44772 12 4 12H9C9.55228 12 10 11.5523 10 11V4C10 3.44772 9.55228 3 9 3Z"
                  stroke="#263238"
                  stroke-width="1.5"
                  stroke-linecap="round"
                  stroke-linejoin="round" />
                <path
                  d="M20 3H15C14.4477 3 14 3.44772 14 4V7C14 7.55228 14.4477 8 15 8H20C20.5523 8 21 7.55228 21 7V4C21 3.44772 20.5523 3 20 3Z"
                  stroke="#263238"
                  stroke-width="1.5"
                  stroke-linecap="round"
                  stroke-linejoin="round" />
                <path
                  d="M20 12H15C14.4477 12 14 12.4477 14 13V20C14 20.5523 14.4477 21 15 21H20C20.5523 21 21 20.5523 21 20V13C21 12.4477 20.5523 12 20 12Z"
                  stroke="#263238"
                  stroke-width="1.5"
                  stroke-linecap="round"
                  stroke-linejoin="round" />
                <path
                  d="M9 16H4C3.44772 16 3 16.4477 3 17V20C3 20.5523 3.44772 21 4 21H9C9.55228 21 10 20.5523 10 20V17C10 16.4477 9.55228 16 9 16Z"
                  stroke="#263238"
                  stroke-width="1.5"
                  stroke-linecap="round"
                  stroke-linejoin="round" />
              </svg>
          <span class="nav-text">Dashboard</span>
        </a>

        <div class="space-y-2 relative group">
          <button
            class="flex items-center justify-between w-full mobilelg:p-3 p-2 rounded-lg text-gray-700 hover:bg-[#FFCB00] transition-colors"
            data-dropdown-toggle="sms-menu">
            <div class="flex items-center space-x-2">
              <svg
                width="24"
                height="24"
                viewBox="0 0 24 24"
                fill="none"
                xmlns="http://www.w3.org/2000/svg">
                <path
                  d="M22 13V6C22 5.46957 21.7893 4.96086 21.4142 4.58579C21.0391 4.21071 20.5304 4 20 4H4C3.46957 4 2.96086 4.21071 2.58579 4.58579C2.21071 4.96086 2 5.46957 2 6V18C2 19.1 2.9 20 4 20H12M22 7L13.03 12.7C12.7213 12.8934 12.3643 12.996 12 12.996C11.6357 12.996 11.2787 12.8934 10.97 12.7L2 7M19 16V22M16 19H22"
                  stroke="#263238"
                  stroke-width="1.5"
                  stroke-linecap="round"
                  stroke-linejoin="round" />
              </svg>

              <span class="nav-text">SMS</span>
            </div>
            <svg
              class="h-4 w-4 transform transition-transform chevron"
              fill="none"
              viewBox="0 0 24 24"
              stroke="currentColor">
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M19 9l-7 7-7-7" />
            </svg>
          </button>
          <div id="sms-menu" class="hidden pl-6 mobilelg:space-y-2 space-y-0">
            <a
              href="{{route('compose-sms')}}"
              class="block p-2 rounded-lg text-gray-600 hover:bg-[#FFCB00] transition-colors"
              >Compose</a
            >
            <a
              href="sent.html"
              class="block p-2 rounded-lg text-gray-600 hover:bg-[#FFCB00] transition-colors"
              >Sent</a
            >
            <a
              href="drafts.html"
              class="block p-2 rounded-lg text-gray-600 hover:bg-[#FFCB00] transition-colors"
              >Drafts</a
            >
            <a
              href="schedule.html"
              class="block p-2 rounded-lg text-gray-600 hover:bg-[#FFCB00] transition-colors"
              >Scheduled</a
            >
          </div>
        </div>

        <div class="space-y-2 relative group">
          <button
            class="flex items-center justify-between w-full mobilelg:p-3 p-2 rounded-lg text-gray-700 hover:bg-[#FFCB00] transition-colors"
            data-dropdown-toggle="contact-menu">
            <div class="flex items-center space-x-2">
              <svg
                width="24"
                height="24"
                viewBox="0 0 24 24"
                fill="none"
                xmlns="http://www.w3.org/2000/svg">
                <path
                  d="M16 2V4M7 22V20C7 19.4696 7.21071 18.9609 7.58579 18.5858C7.96086 18.2107 8.46957 18 9 18H15C15.5304 18 16.0391 18.2107 16.4142 18.5858C16.7893 18.9609 17 19.4696 17 20V22M8 2V4M15 11C15 12.6569 13.6569 14 12 14C10.3431 14 9 12.6569 9 11C9 9.34315 10.3431 8 12 8C13.6569 8 15 9.34315 15 11ZM5 4H19C20.1046 4 21 4.89543 21 6V20C21 21.1046 20.1046 22 19 22H5C3.89543 22 3 21.1046 3 20V6C3 4.89543 3.89543 4 5 4Z"
                  stroke="#263238"
                  stroke-width="1.5"
                  stroke-linecap="round"
                  stroke-linejoin="round" />
              </svg>

              <span class="nav-text">Contact</span>
            </div>
            <svg
              class="h-4 w-4 transform transition-transform chevron"
              fill="none"
              viewBox="0 0 24 24"
              stroke="currentColor">
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M19 9l-7 7-7-7" />
            </svg>
          </button>
          <div
            id="contact-menu"
            class="hidden pl-6 mobilelg:space-y-2 space-y-0">
            <a
              href="add-contact.html"
              class="block p-2 rounded-lg text-gray-600 hover:bg-[#FFCB00] transition-colors"
              >Add Contact</a
            >
            <a
              href="manage-contact.html"
              class="block p-2 rounded-lg text-gray-600 hover:bg-[#FFCB00] transition-colors"
              >Manage Contact</a
            >
          </div>
        </div>
        <div class="space-y-2 relative group">
          <button
            class="flex items-center justify-between w-full mobilelg:p-3 p-2 rounded-lg text-gray-700 hover:bg-[#FFCB00] transition-colors"
            data-dropdown-toggle="unit-menu">
            <div class="flex items-center space-x-2">
              <svg
                width="24"
                height="24"
                viewBox="0 0 24 24"
                fill="none"
                xmlns="http://www.w3.org/2000/svg">
                <path
                  d="M6 12H6.01M18 12H18.01M4 6H20C21.1046 6 22 6.89543 22 8V16C22 17.1046 21.1046 18 20 18H4C2.89543 18 2 17.1046 2 16V8C2 6.89543 2.89543 6 4 6ZM14 12C14 13.1046 13.1046 14 12 14C10.8954 14 10 13.1046 10 12C10 10.8954 10.8954 10 12 10C13.1046 10 14 10.8954 14 12Z"
                  stroke="#263238"
                  stroke-width="1.5"
                  stroke-linecap="round"
                  stroke-linejoin="round" />
              </svg>

              <span class="nav-text">Units/Credits</span>
            </div>
            <svg
              class="h-4 w-4 transform transition-transform chevron"
              fill="none"
              viewBox="0 0 24 24"
              stroke="currentColor">
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M19 9l-7 7-7-7" />
            </svg>
          </button>
          <div id="unit-menu" class="hidden pl-6 mobilelg:space-y-2 space-y-0">
            <a
              href="{{route('buy-unit')}}"
              class="block p-2 rounded-lg text-gray-600 hover:bg-[#FFCB00] transition-colors"
              >Buy Unit</a
            >
            <a
              href="purchase-history.html"
              class="block p-2 rounded-lg text-gray-600 hover:bg-[#FFCB00] transition-colors"
              >Purchase History</a
            >
          </div>
        </div>
        <div class="space-y-2 relative group">
          <button
            class="flex items-center justify-between w-full mobilelg:p-3 p-2 rounded-lg text-gray-700 hover:bg-[#FFCB00] transition-colors"
            data-dropdown-toggle="api-menu">
            <div class="flex items-center space-x-2">
              <svg
                width="24"
                height="24"
                viewBox="0 0 24 24"
                fill="none"
                xmlns="http://www.w3.org/2000/svg">
                <path
                  d="M8 2V6M16 2V6M3 10H21M8 14H8.01M12 14H12.01M16 14H16.01M8 18H8.01M12 18H12.01M16 18H16.01M5 4H19C20.1046 4 21 4.89543 21 6V20C21 21.1046 20.1046 22 19 22H5C3.89543 22 3 21.1046 3 20V6C3 4.89543 3.89543 4 5 4Z"
                  stroke="#263238"
                  stroke-width="1.5"
                  stroke-linecap="round"
                  stroke-linejoin="round" />
              </svg>
              <span class="nav-text">API</span>
            </div>
            <svg
              class="h-4 w-4 transform transition-transform chevron"
              fill="none"
              viewBox="0 0 24 24"
              stroke="currentColor">
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M19 9l-7 7-7-7" />
            </svg>
          </button>
          <div id="api-menu" class="hidden pl-6 mobilelg:space-y-2 space-y-0">
            <a
              href="#"
              class="block p-2 rounded-lg text-gray-600 hover:bg-[#FFCB00] transition-colors"
              >API Credentials</a
            >
            <a
              href="#"
              class="block p-2 rounded-lg text-gray-600 hover:bg-[#FFCB00] transition-colors"
              >API Documentation</a
            >
          </div>
        </div>

        <p
          class="text-gray-500 text-sm uppercase font-semibold text-label mt-6 px-3">
          System
        </p>
        <a
          href="#"
          class="flex items-center space-x-2 mobilelg:p-3 p-2 rounded-lg text-gray-700 hover:bg-[#FFCB00] transition-colors icon-adjust">
          <svg
            width="24"
            height="24"
            viewBox="0 0 24 24"
            fill="none"
            xmlns="http://www.w3.org/2000/svg">
            <path
              d="M11.9999 16.0001V12.0001M11.9999 8.0001H12.0099M3.84995 8.6201C3.70399 7.96262 3.7264 7.27894 3.91511 6.63244C4.10381 5.98593 4.4527 5.39754 4.92942 4.92182C5.40614 4.4461 5.99526 4.09844 6.64216 3.91109C7.28905 3.72374 7.97278 3.70276 8.62995 3.8501C8.99166 3.2844 9.48995 2.81886 10.0789 2.49638C10.6678 2.17391 11.3285 2.00488 11.9999 2.00488C12.6714 2.00488 13.332 2.17391 13.921 2.49638C14.5099 2.81886 15.0082 3.2844 15.3699 3.8501C16.0281 3.70212 16.713 3.72301 17.3609 3.91081C18.0089 4.09862 18.5988 4.44724 19.0758 4.92425C19.5528 5.40126 19.9014 5.99117 20.0892 6.6391C20.277 7.28703 20.2979 7.97193 20.1499 8.6301C20.7156 8.99181 21.1812 9.4901 21.5037 10.079C21.8261 10.668 21.9952 11.3286 21.9952 12.0001C21.9952 12.6715 21.8261 13.3322 21.5037 13.9211C21.1812 14.5101 20.7156 15.0084 20.1499 15.3701C20.2973 16.0273 20.2763 16.711 20.089 17.3579C19.9016 18.0048 19.554 18.5939 19.0782 19.0706C18.6025 19.5473 18.0141 19.8962 17.3676 20.0849C16.7211 20.2736 16.0374 20.2961 15.3799 20.1501C15.0187 20.718 14.52 21.1855 13.9301 21.5094C13.3401 21.8333 12.678 22.0032 12.0049 22.0032C11.3319 22.0032 10.6698 21.8333 10.0798 21.5094C9.48987 21.1855 8.99119 20.718 8.62995 20.1501C7.97278 20.2974 7.28905 20.2765 6.64216 20.0891C5.99526 19.9018 5.40614 19.5541 4.92942 19.0784C4.4527 18.6027 4.10381 18.0143 3.91511 17.3678C3.7264 16.7213 3.70399 16.0376 3.84995 15.3801C3.27991 15.0193 2.81036 14.5203 2.485 13.9293C2.15963 13.3384 1.98901 12.6747 1.98901 12.0001C1.98901 11.3255 2.15963 10.6618 2.485 10.0709C2.81036 9.47992 3.27991 8.98085 3.84995 8.6201Z"
              stroke="#263238"
              stroke-width="1.5"
              stroke-linecap="round"
              stroke-linejoin="round" />
          </svg>

          <span class="nav-text">Help Center</span>
        </a>
        <a
          href="#"
          class="flex items-center space-x-2 mobilelg:p-3 p-2 rounded-lg text-gray-700 hover:bg-[#FFCB00] transition-colors icon-adjust">
          <svg
            width="24"
            height="24"
            viewBox="0 0 24 24"
            fill="none"
            xmlns="http://www.w3.org/2000/svg">
            <path
              d="M9.67106 4.13615C9.72616 3.55649 9.99539 3.0182 10.4262 2.62643C10.8569 2.23467 11.4183 2.01758 12.0006 2.01758C12.5828 2.01758 13.1442 2.23467 13.575 2.62643C14.0057 3.0182 14.275 3.55649 14.3301 4.13615C14.3632 4.51061 14.486 4.87157 14.6882 5.18849C14.8904 5.50541 15.1659 5.76896 15.4915 5.95683C15.8171 6.1447 16.1832 6.25135 16.5588 6.26777C16.9343 6.28419 17.3083 6.20989 17.6491 6.05115C18.1782 5.81093 18.7777 5.77617 19.3311 5.95364C19.8844 6.1311 20.3519 6.5081 20.6426 7.01126C20.9333 7.51441 21.0263 8.10772 20.9037 8.67572C20.7811 9.24372 20.4515 9.74577 19.9791 10.0842C19.6714 10.3 19.4203 10.5868 19.247 10.9202C19.0736 11.2536 18.9831 11.6239 18.9831 11.9997C18.9831 12.3754 19.0736 12.7457 19.247 13.0791C19.4203 13.4125 19.6714 13.6993 19.9791 13.9152C20.4515 14.2535 20.7811 14.7556 20.9037 15.3236C21.0263 15.8916 20.9333 16.4849 20.6426 16.988C20.3519 17.4912 19.8844 17.8682 19.3311 18.0457C18.7777 18.2231 18.1782 18.1884 17.6491 17.9482C17.3083 17.7894 16.9343 17.7151 16.5588 17.7315C16.1832 17.7479 15.8171 17.8546 15.4915 18.0425C15.1659 18.2303 14.8904 18.4939 14.6882 18.8108C14.486 19.1277 14.3632 19.4887 14.3301 19.8632C14.275 20.4428 14.0057 20.9811 13.575 21.3729C13.1442 21.7646 12.5828 21.9817 12.0006 21.9817C11.4183 21.9817 10.8569 21.7646 10.4262 21.3729C9.99539 20.9811 9.72616 20.4428 9.67106 19.8632C9.638 19.4886 9.51516 19.1275 9.31293 18.8104C9.11069 18.4934 8.83503 18.2298 8.50929 18.0419C8.18355 17.854 7.81733 17.7474 7.44164 17.7311C7.06595 17.7147 6.69186 17.7892 6.35106 17.9482C5.82195 18.1884 5.22239 18.2231 4.66906 18.0457C4.11573 17.8682 3.64823 17.4912 3.35754 16.988C3.06685 16.4849 2.97377 15.8916 3.09642 15.3236C3.21907 14.7556 3.54866 14.2535 4.02106 13.9152C4.32868 13.6993 4.57979 13.4125 4.75315 13.0791C4.92651 12.7457 5.01701 12.3754 5.01701 11.9997C5.01701 11.6239 4.92651 11.2536 4.75315 10.9202C4.57979 10.5868 4.32868 10.3 4.02106 10.0842C3.54932 9.7456 3.22031 9.24375 3.09796 8.67613C2.97561 8.10852 3.06867 7.51569 3.35904 7.01286C3.64942 6.51004 4.11637 6.13313 4.66915 5.95539C5.22193 5.77766 5.82104 5.81179 6.35006 6.05115C6.69082 6.20989 7.0648 6.28419 7.44036 6.26777C7.81592 6.25135 8.18199 6.1447 8.5076 5.95683C8.8332 5.76896 9.10875 5.50541 9.31093 5.18849C9.5131 4.87157 9.63594 4.51061 9.66906 4.13615M15.0001 12.0002C15.0001 13.657 13.6569 15.0002 12.0001 15.0002C10.3432 15.0002 9.00006 13.657 9.00006 12.0002C9.00006 10.3433 10.3432 9.00015 12.0001 9.00015C13.6569 9.00015 15.0001 10.3433 15.0001 12.0002Z"
              stroke="#263238"
              stroke-width="1.5"
              stroke-linecap="round"
              stroke-linejoin="round" />
          </svg>

          <span class="nav-text">Settings</span>
        </a>
        <a
          href="#"
          class="flex items-center space-x-2 mobilelg:p-3 p-2 rounded-lg text-red-500 hover:bg-red-50 transition-colors">
          <span class="text-xl fa fa-sign-out"></span>
          <span class="nav-text">Log Out</span>
        </a>
      </nav>
    </aside>
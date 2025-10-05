<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link rel="icon" type="image/svg+xml" href="{{asset('rebirth/assets/icons/favicon.png')}}" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap"
      rel="stylesheet" />
    <link rel="stylesheet" href="{{asset('rebirth/src/output.css')}}" />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link rel="stylesheet" href="{{asset('rebirth/assets/aos-master/dist/aos.css')}}" />
    <script src="{{asset('rebirth/assets/aos-master/dist/aos.js')}}"></script>
    
    <script src="{{asset('rebirth/src/script.js')}}"></script>
    <title>@yield('title')</title>
  </head>
    @include('layouts.shared.rebirth.header')
  <body>
    
    <main>
        @include('layouts.shared.rebirth.alert')
        @yield('content')
    </main>
  </body>
  <footer class="bg-skzdark-200 min-h-[400px] tabletsm:py-16 py-8">
    <div class="laptopmd:px-12 tabletsm:px-8 px-4 max-w-screen-xl mx-auto">
      <div class="flex justify-between mobilelg:flex-nowrap flex-wrap gap-y-8">
        <div class="space-y-4 mobilelg:w-6/12 w-full">
          <img
            src="{{asset('rebirth/assets/images/skezzole_yellow.png')}}"
            alt=""
            class="w-4/12" />
          <p
            class="text-base/relaxed text-white font-light tabletlg:w-7/12 w-10/12">
            Reach your entire customer base with a single click. Upload
            contacts, compose your message, and send to thousands
            simultaneously.
          </p>
          <div class="space-x-4 flex items-center">
            <a href="#" aria-label="x"
              ><img src="{{asset('rebirth/assets/icons/line-md_twitter-x.svg')}}" alt="twitter"
            /></a>
            <a href="#" arial-label="instagram">
              <span class="sr-only">instagram icon</span>
              <img src="{{asset('rebirth/assets/icons/lucide_instagram.svg')}}" alt="instagram" />
            </a>
            <a href="#" aria-label="linkedin"
              ><img src="{{asset('rebirth/assets/icons/mdi_linkedin.svg')}}" alt="linkedin"
            /></a>
          </div>
          <div class="space-y-2 font-light">
            <div class="flex items-center text-white">
              <span class=""
                >Email:
                <a href="mailto:z9hMl@example.com"
                  >support@skezzole.com.ng</a
                ></span
              >
            </div>
            <div class="flex items-center space-x-2 text-white">
              <span
                >Phone: <a href="tel:2348123456789">+234 706 4084567</a></span
              >
            </div>
            {{-- <div class="flex items-center space-x-2 text-white">
              <span
                >Address:
                <a href="address">No. 1, Ikorodu, Lagos, Nigeria</a></span
              >
            </div> --}}
          </div>
        </div>
        <div class="mobilelg:w-3/12 w-full">
          <h1 class="text-skzyellow-700 text-lg mb-4">Products</h1>
          <ul class="space-y-2">
            <li>
              <a
                href="#"
                class="text-white font-light transition-all ease-in-out 500 hover:font-medium"
                >Features</a
              >
            </li>
            <li>
              <a
                href="#"
                class="text-white font-light transition-all ease-in-out 500 hover:font-medium"
                >Pricing</a
              >
            </li>
            <li>
              <a
                href="#"
                class="text-white font-light transition-all ease-in-out 500 hover:font-medium"
                >API Documentation</a
              >
            </li>
          </ul>
        </div>
        <div class="mobilelg:w-3/12 w-full">
          <h1 class="text-skzyellow-700 text-lg mb-4">Company</h1>
          <ul class="space-y-2">
            <li>
              <a href="{{route('terms').'#privacy'}}"
                class="text-white font-light transition-all ease-in-out 500 hover:font-medium underline"
                >Privacy Policy</a
              >
            </li>
            <li>
              <a
                href="{{route('terms')}}"
                class="text-white font-light transition-all ease-in-out 500 hover:font-medium underline"
                >Terms of Service</a
              >
            </li>
          </ul>
        </div>
      </div>
      <hr class="border-white border-b border-t-0 border-s-0 border-e-0 py-4" />

      <p class="text-white font-light pt-4 text-sm">
        &copy; <span id="year"></span> Skezzole. All Rights Reserved
      </p>
      <script>
        document.getElementById("year").textContent = new Date().getFullYear(); // Get the current year and display it in the footer.All Rights Reserved
      </script>
      <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
      <script>
        const swiper = new Swiper(".swiper", {
          // Optional parameters
          // effect: "coverflow",
          direction: "horizontal",
          loop: true,
          // centeredSlides: true,
          centerInsufficientSlides: true,
          grabCursor: true,
          slidesPerView: 1.2,
          spaceBetween: 20,
          grabCursor: true,
          breakpoints: {
            480: {
              slidesPerView: 1.2,
              spaceBetween: 30,
            },
            640: {
              slidesPerView: 1.5,
              spaceBetween: 30,
            },
            767: {
              slidesPerView: 1.2,
              spaceBetween: 20,
            },
            992: {
              slidesPerView: 1.2,
              spaceBetween: 20,
            },
            1024: {
              slidesPerView: 2,
              spaceBetween: 20,
            },
          },
          autoplay: {
            delay: 2500,
            disableOnInteraction: true,
          },

          // If we need pagination
          // pagination: {
          //   el: ".swiper-pagination",
          //   clickable: true,
          // },

          // Navigation arrows
          // navigation: {
          //   nextEl: ".swiper-button-next",
          //   prevEl: ".swiper-button-prev",
          // },

          // And if we need scrollbar
          // scrollbar: {
          //   el: ".swiper-scrollbar",
          // },
        });
      </script>

      <script>
        AOS.init();
      </script>
      ;
    </div>
  </footer>
</html>
@extends('layouts.rebirth')
@section('title', env('APP_NAME'))
@section('content')
  <section class="bg-skzgrey-100 tabletmd:min-h-screen min-h-[500px] pt-24 relative isolate flex flex-col justify-between">
    <img src="{{asset('rebirth/assets/images/hero-circle.png')}}" class="absolute left-0 tabletsm:bottom-0 bottom-0 z-0 isolate" alt="" />
    <div
      class="max-w-screen-xl tabletlg:px-12 mobilemd:px-8 px-4 py-8 mx-auto flex tabletsm:justify-between justify-center items-start tabletsm:flex-nowrap gap-y-8 flex-wrap relative z-10">
      <div data-aos="fade-up" data-aos-delay="0" data-aos-duration="1500" data-aos-easing="ease-in-out" data-aos-mirror="true" data-aos-once="true" class="laptopmd:w-5/12 tabletsm:w-6/12 mobilelg:w-10/12 w-full flex-col flex tabletsm:items-start items-center">
        <h1 class="hero-heading">
          Send Bulk SMS to Thousands of Customers Instantly
        </h1>
        <p class="max-w-2xl mb-6 body text-center tabletsm:text-start">
          Reach your audience with reliable delivery, AI-powered messaging,
          and simple API integration.
        </p>
        <a href="{{route('compose-sms')}}" class="inline-flex btn-secondary w-6/12" role="button">
          Get started
          <svg
            class="w-5 h-5 ml-2 -mr-1"
            fill="currentColor"
            viewBox="0 0 20 20"
            xmlns="http://www.w3.org/2000/svg">
            <path
              fill-rule="evenodd"
              d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
              clip-rule="evenodd"></path>
          </svg>
        </a>
      </div>
      <div class="tabletsm:w-5/12 mobilelg:w-10/12 w-full" data-aos="zoom-in" data-aos-delay="0" data-aos-duration="1500" data-aos-easing="ease-in-out" data-aos-mirror="true" data-aos-once="true">
        <img
          src="{{asset('rebirth/assets/images/hero-img.png')}}"
          alt="hero-image"
          class="hover:scale-90 transition-all duration-500 ease-in-out" />
      </div>
    </div>
    <div
      class="h-28 w-full flex justify-evenly bg-skzyellow-700 items-center relative z-10">
      <div class="flex flex-col items-center">
        <h5
          class="font-semibold mobilelg:text-4xl/snug mobilemd:text-3xl/snug text-2xl">
          50,000
        </h5>
        <span class="mobilemd:text-base text-sm font-medium"
          >Messages sent Monthly</span
        >
      </div>
      <div class="flex flex-col items-center">
        <h5
          class="font-semibold mobilelg:text-4xl/snug mobilemd:text-3xl/snug text-2xl">
          100+
        </h5>
        <span class="mobilemd:text-base text-sm font-medium"
          >Businesses trust us</span
        >
      </div>
      <div class="flex flex-col items-center">
        <h5
          class="font-semibold mobilelg:text-4xl/snug mobilemd:text-3xl/snug text-2xl">
          99.9%
        </h5>
        <span class="mobilemd:text-base text-sm font-medium">Uptime</span>
      </div>
    </div>
  </section>
  <section class="bg-white">
    <div
      class="max-w-screen-xl tabletlg:px-12 mobilemd:px-8 px-4 tabletsm:py-20 py-12 mx-auto flex flex-col items-center space-y-8">
      <div class="text-center flex flex-col items-center w-full" data-aos="fade-up" data-aos-delay="0" data-aos-duration="1500" data-aos-easing="ease-in-out" data-aos-mirror="true" data-aos-once="true">
        <h2 class="heading-1">What our Clients say about us</h2>
        <p class="body tabletsm:w-7/12 mobilelg:w-10/12 w-full">
          Our mission is to drive progress and enhance the lives of our
          customers by delivering superior products and services that exceed
          expectations.
        </p>
      </div>
      <div
        class="flex tabletsm:flex-row flex-col-reverse tabletsm:justify-between justify-center tabletsm:flex-nowrap flex-wrap items-center w-full gap-y-8">
        <div
          class="laptopmd:w-5/12 tabletmd:w-6/12 tabletsm:w-7/12 w-full space-y-2 flex flex-col tabletsm:items-start items-center" data-aos="fade-up" data-aos-delay="0" data-aos-duration="1500" data-aos-easing="ease-in-out" data-aos-mirror="true" data-aos-once="true">
          <div
            class="space-x-2 flex justify-start tabletsm:items-center items-start w-full">
            <img
              src="{{asset('rebirth/assets/icons/square-check-big.svg')}}"
              class=""
              alt="features-icon" />
            <p class="body-sm">
              99.9% delivery rate across all Nigerian networks
            </p>
          </div>
          <div class="space-x-2 flex justify-start items-center w-full">
            <img
              src="{{asset('rebirth/assets/icons/square-check-big.svg')}}"
              class=""
              alt="features-icon" />
            <p class="body-sm">
              AI-powered SMS composition and optimization
            </p>
          </div>
          <div class="space-x-2 flex justify-start items-center w-full">
            <img
              src="{{asset('rebirth/assets/icons/square-check-big.svg')}}"
              class=""
              alt="features-icon" />
            <p class="body-sm">
              Developer-friendly API with comprehensive documentation
            </p>
          </div>
          <div class="space-x-2 flex justify-start items-center w-full">
            <img
              src="{{asset('rebirth/assets/icons/square-check-big.svg')}}"
              class=""
              alt="features-icon" />
            <p class="body-sm">Transparent pricing with no hidden fees</p>
          </div>
          <div class="flex space-x-4 items-center mt-8">
            <a href="{{route('compose-sms')}}" role="button" class="btn-primary">Start Sending SMS</a>
            <a href="#pricing" role="button" class="btn-ghost">View Pricing</a>
          </div>
        </div>
        <div class="laptopmd:w-7/12 tabletsm:w-5/12 w-full flex justify-between gap-4" data-aos="fade-up" data-aos-delay="0" data-aos-duration="1500" data-aos-easing="ease-in-out" data-aos-mirror="true" data-aos-once="true">
          <div class="swiper">
            <div class="swiper-wrapper">
              <div class="swiper-slide">
                <div class="laptopdmd:w-1/2 w-full">
                  <div
                    class="w-full mb-8 border border-gray-200 rounded-lg min-h-80 md:mb-12 bg-skzdark-100 shadow-md">
                    <figure
                      class="flex flex-col items-center justify-center p-8 text-center rounded-t-lg md:rounded-t-none md:rounded-ss-lg md:border-e">
                      <img src="{{asset('rebirth/assets/icons/quote.svg')}}" alt="" />
                      <blockquote
                        class="max-w-2xl mx-auto mb-4 text-white lg:mb-8">
                        <h3 class="text-lg font-semibold text-white">
                          Super easy to use.
                        </h3>
                        <p class="my-4">
                          Skezzole made it super easy for us to reach all our customers at once. The scheduling feature is a lifesaver"
                        </p>
                      </blockquote>
                      <figcaption
                        class="flex items-center justify-center flex-col">
                        <img
                          class="rounded-full w-12 h-12"
                          src="{{asset('rebirth/assets/images/cynthia-okeke.png')}}"
                          alt="profile picture" />

                        <div class="text-sm mt-4 font-medium text-white">
                          Digital Marketer  at <a href="https://zamella.net" target="_blank" rel="Easycoop">Zamella</a>
                        </div>
                      </figcaption>
                    </figure>
                  </div>
                </div>
              </div>
              <div class="swiper-slide">
                <div class="laptopdmd:w-1/2 w-full">
                  <div
                    class="w-full mb-8 border border-gray-200 rounded-lg min-h-80 md:mb-12 bg-skzdark-100 shadow-md">
                    <figure
                      class="flex flex-col items-center justify-center p-8 text-center rounded-t-lg md:rounded-t-none md:rounded-ss-lg md:border-e">
                      <img src="{{asset('rebirth/assets/icons/quote.svg')}}" alt="" />
                      <blockquote
                        class="max-w-2xl mx-auto mb-4 text-white lg:mb-8">
                        <h3 class="text-lg font-semibold text-white">
                          Very easy this was to integrate
                        </h3>
                        <p class="my-4">
                          Their API is straightforward and reliable — we integrated it into our Fintech Solution."
                        </p>
                      </blockquote>
                      <figcaption
                        class="flex items-center justify-center flex-col">
                        <img
                          class="rounded-full w-12 h-12"
                          src="{{asset('rebirth/assets/images/emmanuel-ebere.png')}}"
                          alt="profile picture" />

                        <div class="text-sm mt-4 font-medium text-white">
                          Developer at <a href="https://easycoopng.com" target="_blank" rel="Easycoop">Easycoop</a>
                        </div>
                      </figcaption>
                    </figure>
                  </div>
                </div>
              </div>
              <div class="swiper-slide">
                <div class="laptopdmd:w-1/2 w-full">
                  <div
                    class="w-full mb-8 border border-gray-200 rounded-lg min-h-80 md:mb-12 bg-skzdark-100 shadow-md">
                    <figure
                      class="flex flex-col items-center justify-center p-8 text-center rounded-t-lg md:rounded-t-none md:rounded-ss-lg md:border-e">
                      <img src="{{asset('rebirth/assets/icons/quote.svg')}}" alt="" />
                      <blockquote
                        class="max-w-2xl mx-auto mb-4 text-white lg:mb-8">
                        <h3 class="text-lg font-semibold text-white">
                          Awesome AI feature
                        </h3>
                        <p class="my-4">
                          I love the AI feature! I just type in what I need and it composes a beautiful message for my clients"
                        </p>
                      </blockquote>
                      <figcaption
                        class="flex items-center justify-center flex-col">
                        <img
                          class="rounded-full w-12 h-12"
                          src="{{asset('rebirth/assets/images/tolu-ojo.png')}}"
                          alt="profile picture" />

                        <div class="text-sm mt-4 font-medium text-white">
                          Event Planner at <a href="https://easycoopng.com" target="_blank" rel="Easycoop">Easycoop</a>
                        </div>
                      </figcaption>
                    </figure>
                  </div>
                </div>
              </div>
            </div>
            <!-- <div class="swiper-pagination"></div> -->

            <!-- If we need navigation buttons -->
            <!-- <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div> -->
          </div>
        </div>
      </div>
    </div>
  </section>
  <section class="">
    <div class="max-w-screen-xl tabletlg:px-12 mobilemd:px-8 px-4 tabletsm:py-16 py-12 mx-auto flex flex-col items-center space-y-8 min-h-[400px]" data-aos="fade-up" data-aos-delay="0" data-aos-duration="1500" data-aos-easing="ease-in-out" data-aos-mirror="true" data-aos-once="true">
      <div class="text-center flex flex-col items-center w-full">
        <h2 class="heading-1">Get Started in 3 Simple Steps</h2>
        <p class="body tabletsm:w-7/12 mobilelg:w-10/12 w-full">
          Our mission is to drive progress and enhance the lives of our
          customers by delivering superior products and services that exceed
          expectations.
        </p>
      </div>
      <div
        class="w-full tabletsm:inline-block flex flex-row-reverse justify-end relative">
        <img
          src="{{asset('rebirth/assets/images/steps.svg')}}"
          alt=""
          class="xl:w-fit tabletsm:w-9/12 tabletsm:flex hidden tabletsm:rotate-0 mx-auto h-fit" />
        <img
          src="{{asset('rebirth/assets/images/steps.svg')}}"
          alt=""
          class="tabletsm:hidden flex absolute rotate-90 top-5/12 mobilelg:left-60 left-45 mobilemd:w-9/12 w-10/12" />
        <div
          class="flex justify-between items-center tabletsm:w-full laptopmd:space-x-0 space-x-4 tabletsm:flex-nowrap flex-wrap mobilemd:w-9/12 w-11/12 mobilelg:gap-y-8 gap-y-6">
          <div
            class="laptopmd:w-3/12 tabletsm:w-4/12 w-full tabletlg:min-h-48 mobilelg:mb-2 mb-0">
            <h4 class="text-lg/relaxed font-semibold mb-2">
              Sign Up & Fund Account
            </h4>
            <p class="body-1">
              Create your account in minutes. Add SMS units to your balance
              using bank transfer, card payment, or mobile money.
            </p>
          </div>
          <div
            class="laptopmd:w-3/12 tabletsm:w-4/12 w-full tabletlg:min-h-48 mobilelg:mb-2 mb-0">
            <h4 class="text-lg/relaxed font-semibold mb-2">
              Import Contacts
            </h4>
            <p class="body-1">
              Upload your contact list from CSV/Excel or add contacts
              manually. Organize them into groups for targeted messaging.
            </p>
          </div>
          <div
            class="laptopmd:w-3/12 tabletsm:w-4/12 w-full tabletlg:min-h-48 mobilelg:mb-2 mb-0">
            <h4 class="text-lg/relaxed font-semibold mb-2">Send SMS</h4>
            <p class="body-1">
              Compose your message (or let AI help), select recipients, and
              send instantly or schedule for later delivery.
            </p>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section class="bg-white" id="features">
    <div
      class="max-w-screen-xl px-4 tabletsm:pt-20 pt-12 mx-auto flex flex-col items-center space-y-8">
      <div class="text-center flex flex-col items-center w-full" data-aos="fade-up" data-aos-delay="0" data-aos-duration="1500" data-aos-easing="ease-in-out" data-aos-mirror="true" data-aos-once="true">
        <h2
          class="heading-1 tabletlg:w-full tabletsm:w-9/12 mobilemd:w-9/12 w-full">
          Everything You Need to Scale Your SMS Marketing
        </h2>
        <p class="body tabletsm:w-7/12 mobilelg:w-10/12 w-full">
          Our mission is to drive progress and enhance the lives of our
          customers by delivering superior products and services that exceed
          expectations.
        </p>
      </div>
      <div class="justify-center items-center w-full gap-4 flex-wrap flex ">
        <div class="skz-card" data-aos="zoom-in" data-aos-delay="0" data-aos-duration="1500" data-aos-easing="ease-in-out" data-aos-mirror="true" data-aos-once="true">
          <div class="w-10 mb-2">
            <img src="{{asset('rebirth/assets/icons/send.svg')}}" alt="" class="w-full" />
          </div>
          <h4 class="text-lg/relaxed font-semibold mb-2">
            Send to Thousands Instantly
          </h4>
          <p class="body-sm">
            Reach your entire customer base with a single click. Upload
            contacts, compose your message, and send to thousands
            simultaneously.
          </p>
        </div>
        <div class="skz-card" data-aos="zoom-in" data-aos-delay="50" data-aos-duration="1500" data-aos-easing="ease-in-out" data-aos-mirror="true" data-aos-once="true">
          <div class="w-10 mb-2">
            <img src="{{asset('rebirth/assets/icons/API.svg')}}" alt="" class="w-full" />
          </div>
          <h4 class="text-lg/relaxed font-semibold mb-2">
            AI-Powered SMS Creation
          </h4>
          <p class="body-sm">
            Let our AI assistant help you craft compelling messages. Just
            describe what you want to say, and get professional SMS content
            instantly.
          </p>
        </div>
        <div class="skz-card" data-aos="zoom-in" data-aos-delay="50" data-aos-duration="1500" data-aos-easing="ease-in-out" data-aos-mirror="true" data-aos-once="true">
          <div class="w-10 mb-2">
            <img src="{{asset('rebirth/assets/icons/smart.svg')}}" alt="" class="w-full" />
          </div>
          <h4 class="text-lg/relaxed font-semibold mb-2">
            Powerful API Integration
          </h4>
          <p class="body-sm">
            Integrate SMS functionality into your applications with our
            RESTful API. Complete documentation and code examples included.
          </p>
        </div>
        <div class="skz-card" data-aos="zoom-in" data-aos-delay="50" data-aos-duration="1500" data-aos-easing="ease-in-out" data-aos-mirror="true" data-aos-once="true">
          <div class="w-10 mb-2">
            <img
              src="{{asset('rebirth/assets/icons/contact-man.svg')}}"
              alt=""
              class="w-full" />
          </div>
          <h4 class="text-lg/relaxed font-semibold mb-2">
            Smart Contact Management
          </h4>
          <p class="body-sm">
            Import, organize, and manage your contacts with ease. Support
            for CSV, Excel, and group management features.
          </p>
        </div>
        <div class="skz-card" data-aos="zoom-in" data-aos-delay="50" data-aos-duration="1500" data-aos-easing="ease-in-out" data-aos-mirror="true" data-aos-once="true">
          <div class="w-10 mb-2">
            <img src="{{asset('rebirth/assets/icons/real.svg')}}" alt="" class="w-full" />
          </div>
          <h4 class="text-lg/relaxed font-semibold mb-2">
            Real-Time Delivery Reports
          </h4>
          <p class="body-sm">
            Track every message in real-time. Get detailed delivery reports
            with timestamps, delivery status, and recipient feedback.
          </p>
        </div>
        <div class="skz-card" data-aos="zoom-in" data-aos-delay="50" data-aos-duration="1500" data-aos-easing="ease-in-out" data-aos-mirror="true" data-aos-once="true">
          <div class="w-10 mb-2">
            <img
              src="{{asset('rebirth/assets/icons/campaigns.svg')}}"
              alt=""
              class="w-full" />
          </div>
          <h4 class="text-lg/relaxed font-semibold mb-2">
            Schedule Your Campaigns
          </h4>
          <p class="body-sm">
            Plan your marketing campaigns ahead of time. Schedule SMS
            messages for optimal delivery times and never miss important
            dates.
          </p>
        </div>
      </div>
      {{-- <div class="tabletsm:hidden flex" data-aos="fade-in" data-aos-delay="0" data-aos-duration="1000" data-aos-easing="ease-in-out" data-aos-mirror="true" data-aos-once="true">
        <div class="swiper">
          <div class="swiper-wrapper w-full flex">
            <div class="swiper-slide">
              <div class="skz-card">
                <div class="w-10 mb-2">
                  <img
                    src="{{asset('rebirth/assets/icons/send.svg')}}"
                    alt=""
                    class="w-full" />
                </div>
                <h4 class="text-lg/relaxed font-semibold mb-2">
                  Send to Thousands Instantly
                </h4>
                <p class="body-sm">
                  Reach your entire customer base with a single click.
                  Upload contacts, compose your message, and send to
                  thousands simultaneously.
                </p>
              </div>
            </div>
            <div class="swiper-slide">
              <div class="skz-card">
                <div class="w-10 mb-2">
                  <img
                    src="{{asset('rebirth/assets/icons/API.svg')}}"
                    alt=""
                    class="w-full" />
                </div>
                <h4 class="text-lg/relaxed font-semibold mb-2">
                  AI-Powered SMS Creation
                </h4>
                <p class="body-sm">
                  Let our AI assistant help you craft compelling messages.
                  Just describe what you want to say, and get professional
                  SMS content instantly.
                </p>
              </div>
            </div>
            <div class="swiper-slide">
              <div class="skz-card">
                <div class="w-10 mb-2">
                  <img
                    src="{{asset('rebirth/assets/icons/smart.svg')}}"
                    alt=""
                    class="w-full" />
                </div>
                <h4 class="text-lg/relaxed font-semibold mb-2">
                  Powerful API Integration
                </h4>
                <p class="body-sm">
                  Integrate SMS functionality into your applications with
                  our RESTful API. Complete documentation and code examples
                  included.
                </p>
              </div>
            </div>
            <div class="swiper-slide">
              <div class="skz-card">
                <div class="w-10 mb-2">
                  <img
                    src="{{asset('rebirth/assets/icons/contact-man.svg')}}"
                    alt=""
                    class="w-full" />
                </div>
                <h4 class="text-lg/relaxed font-semibold mb-2">
                  Smart Contact Management
                </h4>
                <p class="body-sm">
                  Import, organize, and manage your contacts with ease.
                  Support for CSV, Excel, and group management features.
                </p>
              </div>
            </div>
            <div class="swiper-slide">
              <div class="skz-card">
                <div class="w-10 mb-2">
                  <img
                    src="{{asset('rebirth/assets/icons/real.svg')}}"
                    alt=""
                    class="w-full" />
                </div>
                <h4 class="text-lg/relaxed font-semibold mb-2">
                  Real-Time Delivery Reports
                </h4>
                <p class="body-sm">
                  Track every message in real-time. Get detailed delivery
                  reports with timestamps, delivery status, and recipient
                  feedback.
                </p>
              </div>
            </div>
            <div class="swiper-slide">
              <div class="skz-card">
                <div class="w-10 mb-2">
                  <img
                    src="{{asset('rebirth/assets/icons/campaigns.svg')}}"
                    alt=""
                    class="w-full" />
                </div>
                <h4 class="text-lg/relaxed font-semibold mb-2">
                  Schedule Your Campaigns
                </h4>
                <p class="body-sm">
                  Plan your marketing campaigns ahead of time. Schedule SMS
                  messages for optimal delivery times and never miss
                  important dates.
                </p>
              </div>
            </div>
          </div>
        </div>
      </div> --}}
    </div>
  </section>
  <section class="w-full" id="pricing">
    <div class="text-center flex flex-col items-center bg-white pt-12 pb-4 tabletsm:px-12 mobilelg:px-8 px-4" data-aos="fade-in" data-aos-delay="50" data-aos-duration="1500" data-aos-easing="ease-in-out" data-aos-mirror="true" data-aos-once="true">
      <h2 class="heading-1">Simple, Transparent Pricing</h2>
      <p class="body mobilelg:w-7/12 w-10/12">
        Pay only for what you use. No monthly fees, no hidden charges.
      </p>
    </div>

    <div class="py-8 bg-skzdark-200 min-h-80 w-full" data-aos="fade-up" data-aos-delay="50" data-aos-duration="1500" data-aos-easing="ease-in-out" data-aos-mirror="true" data-aos-once="true">
      <div
        class="max-w-screen-xl tabletsm:px-12 mobilelg:px-8 px-4 flex tabletlg:justify-between justify-center lg:items-center items-end mx-auto tabletlg:flex-nowrap flex-wrap gap-y-8">
        <div class="laptopmd:w-1/2 tabletlg:w-6/12 tabletsm:w-8/12 mobilelg:w-10/12 w-full" data-aos="fade-in" data-aos-delay="1000" data-aos-duration="1500" data-aos-easing="ease-in-out" data-aos-mirror="true" data-aos-once="true">
          <div class="mobilelg:text-start text-center">
            <h1
              class="mb-4 text-2xl/relaxed font-bold tracking-tight leading-none mobilemd:text-[1.5rem]/normal tabletsm:text-[2rem]/snug text-skzyellow-700 tabletmd:w-10/12 w-full">
              ₦4 per SMS unit - No tiers, no complexity, no hidden fees
            </h1>
            <p
              class="mobilelg:text-lg text-base text-white mb-4 xl:w-11/12 w-full">
              Whether you're sending 10 messages or 10 million, every SMS
              costs exactly ₦4 per page. Start with any amount, scale without
              surprises.
            </p>
          </div>
          <div
            class="border border-white rounded-md p-2 laptopmd:w-9/12 w-full relative">
            <label for="amount" class="font-medium text-white"
              >Enter number of SMS units to buy</label
            >
            <span
              class="absolute right-2 top-16 transform -translate-y-1/2 h-16 w-20 text-center bg-skzyellow-400 flex items-center justify-center text-white font-medium rounded-e-sm">
              SMS
            </span>
            <input
              type="number"
              placeholder="5,000"
              class="h-16 rounded-sm w-full bg-white text-skzdark-100 font-medium text-2xl placeholder:text-2xl font-secondary outline-none focus:bg-gray-200 ps-2"
              aria-label="Enter Amount"
              id="amount"
              name="amount" />
          </div>
          <div class="mt-8 xl:w-10/12 w-full tabletlg:inline-block hidden">
            <h1 class="text-white font-semibold text-lg/loose mb-2">
              Key Benefits
            </h1>
            <div class="flex items-center w-full flex-wrap space-y-2">
              <div
                class="laptopmd:space-x-4 space-x-2 flex justify-start items-center mobilelg:w-1/2 w-full">
                <img
                  src="{{asset('rebirth/assets/icons/square-check-big.svg')}}"
                  class=""
                  alt="features-icon" />
                <p class="text-base text-white">Basic delivery reports</p>
              </div>
              <div
                class="laptopmd:space-x-4 space-x-2 flex justify-start items-center mobilelg:w-1/2 w-full">
                <img
                  src="{{asset('rebirth/assets/icons/square-check-big.svg')}}"
                  class=""
                  alt="features-icon" />
                <p class="text-base text-white">Priority support</p>
              </div>
              <div
                class="laptopmd:space-x-4 space-x-2 flex justify-start items-center mobilelg:w-1/2 w-full">
                <img
                  src="{{asset('rebirth/assets/icons/square-check-big.svg')}}"
                  class=""
                  alt="features-icon" />
                <p class="text-base text-white">Web portal access</p>
              </div>
              <div
                class="laptopmd:space-x-4 space-x-2 flex justify-start items-center mobilelg:w-1/2 w-full">
                <img
                  src="{{asset('rebirth/assets/icons/square-check-big.svg')}}"
                  class=""
                  alt="features-icon" />
                <p class="text-base text-white">
                  Dedicated account manager
                </p>
              </div>
              <div
                class="laptopmd:space-x-4 space-x-2 flex justify-start items-center mobilelg:w-1/2 w-full">
                <img
                  src="{{asset('rebirth/assets/icons/square-check-big.svg')}}"
                  class=""
                  alt="features-icon" />
                <p class="text-base text-white">API access</p>
              </div>
              <div
                class="laptopmd:space-x-4 space-x-2 flex justify-start items-center mobilelg:w-1/2 w-full">
                <img
                  src="{{asset('rebirth/assets/icons/square-check-big.svg')}}"
                  class=""
                  alt="features-icon" />
                <p class="text-base text-white">Custom integrations</p>
              </div>
            </div>
          </div>
        </div>
        <div class="tabletlg:w-5/12 tabletsm:w-8/12 mobilelg:w-10/12 w-full p-8 rounded-md bg-white" data-aos="fade-in" data-aos-delay="1000" data-aos-duration="1500" data-aos-easing="ease-in-out" data-aos-mirror="true" data-aos-once="true">
          <h1 class="heading-1">Standard</h1>
          <div class="flex flex-col gap-0 items-center">
            <table class="w-full my-4 text-start">
              <tbody class="">
                <tr>
                  <td class="text-base text-left">SMS Unit Quantity</td>
                  <td class="text-base text-left" id="quantity">000.00</td>
                </tr>
                <tr>
                  <td class="text-base text-left">Cost Per SMS</td>
                  <td class="text-base text-left" id="unit-cost">₦ 4</td>
                </tr>
                <tr class="">
                  <th class="text-base text-left">Total Price</th>
                  <th class="text-base text-left" id="total">₦00.00</th>
                </tr>
              </tbody>
            </table>
            <div
              class="space-x-2 flex flex-row-reverse justify-center items-center w-full mt-4">
              <img
                src="{{asset('rebirth/assets/icons/paystack-logo.png')}}"
                class="w-28 h-auto block"
                alt="features-icon" />
              <p class="text-base text-skzdark-200 w-fit">Powered by</p>
            </div>
            <a href="{{route('buy-unit')}}" class="btn-primary mt-8 w-8/12 py-8">Buy Now</a>
          </div>
        </div>
        <div
          class="mobilelg:mt-8 mt-0 tabletlg:w-10/12 tabletsm:w-8/12 mobilelg:w-10/12 w-full tabletlg:hidden block">
          <h1 class="text-white font-semibold text-lg/loose mb-2">
            Key Benefits
          </h1>
          <div class="flex items-center w-full flex-wrap space-y-2">
            <div
              class="laptopmd:space-x-4 space-x-2 flex justify-start items-center mobilelg:w-1/2 w-full">
              <img
                src="{{asset('rebirth/assets/icons/square-check-big.svg')}}"
                class=""
                alt="features-icon" />
              <p class="text-base text-white">Basic delivery reports</p>
            </div>
            <div
              class="laptopmd:space-x-4 space-x-2 flex justify-start items-center mobilelg:w-1/2 w-full">
              <img
                src="{{asset('rebirth/assets/icons/square-check-big.svg')}}"
                class=""
                alt="features-icon" />
              <p class="text-base text-white">Priority support</p>
            </div>
            <div
              class="laptopmd:space-x-4 space-x-2 flex justify-start items-center mobilelg:w-1/2 w-full">
              <img
                src="{{asset('rebirth/assets/icons/square-check-big.svg')}}"
                class=""
                alt="features-icon" />
              <p class="text-base text-white">Web portal access</p>
            </div>
            <div
              class="laptopmd:space-x-4 space-x-2 flex justify-start items-center mobilelg:w-1/2 w-full">
              <img
                src="{{asset('rebirth/assets/icons/square-check-big.svg')}}"
                class=""
                alt="features-icon" />
              <p class="text-base text-white">Dedicated account manager</p>
            </div>
            <div
              class="laptopmd:space-x-4 space-x-2 flex justify-start items-center mobilelg:w-1/2 w-full">
              <img
                src="{{asset('rebirth/assets/icons/square-check-big.svg')}}"
                class=""
                alt="features-icon" />
              <p class="text-base text-white">API access</p>
            </div>
            <div
              class="laptopmd:space-x-4 space-x-2 flex justify-start items-center mobilelg:w-1/2 w-full">
              <img
                src="{{asset('rebirth/assets/icons/square-check-big.svg')}}"
                class=""
                alt="features-icon" />
              <p class="text-base text-white">Custom integrations</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section class="bg-white">
    <div class="max-w-screen-xl tabletlg:px-12 mobilelg:px-8 px-4 tabletsm:py-20 py-12 mx-auto flex flex-col items-center space-y-8" data-aos="fade-in" data-aos-delay="300" data-aos-duration="1500" data-aos-easing="ease-in-out" data-aos-mirror="true" data-aos-once="true">
      <div class="text-center flex flex-col items-center w-full">
        <h2 class="heading-1">Frequently Asked Questions</h2>
        <p class="body mobilelg:w-7/12 w-full">
          Everything you need to know
        </p>
      </div>
      <div
        id="accordion-container "
        class="space-y-4 mx-auto laptopmd:w-7/12 tabletlg:w-8/12 mobilelg:w-10/12 w-full">
        <div class="accordion-item">
          <h2>
            <button type="button" class="accordion-header">
              <span class="mobilemd:text-base text-sm font-semibold"
                >How quickly are messages delivered?</span
              >
              <span class="accordion-icon">+</span>
            </button>
          </h2>
          <div class="accordion-content" style="max-height: 0px">
            <div class="p-6 pt-2">
              <p class="body-sm">
                Messages are typically delivered within seconds. Our
                platform is optimized for high-speed delivery to ensure your
                communications are timely and effective.
              </p>
            </div>
          </div>
        </div>

        <div class="accordion-item">
          <h2>
            <button type="button" class="accordion-header">
              <span class="mobilemd:text-base text-sm font-semibold"
                >What payment methods do you accept?</span
              >
              <span class="accordion-icon">+</span>
            </button>
          </h2>
          <div class="accordion-content" style="max-height: 0px">
            <div class="p-6 pt-2">
              <p class="body-sm">
                We accept all major credit cards, including Visa,
                MasterCard, and American Express. We also support payments
                via PayPal and bank transfers for annual plans.
              </p>
            </div>
          </div>
        </div>

        <div class="accordion-item">
          <h2>
            <button type="button" class="accordion-header">
              <span class="mobilemd:text-base text-sm font-semibold"
                >Can I get a refund for unused SMS units?</span
              >
              <span class="accordion-icon">+</span>
            </button>
          </h2>
          <div class="accordion-content" style="max-height: 0px">
            <div class="p-6 pt-2">
              <p class="body-sm">
                No, we do not offer refunds for unused SMS units. Credits
                are purchased in bundles and do not expire, so you can use
                them whenever you need them.
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
    
@endsection
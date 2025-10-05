@extends('layouts.rebirth')
@section('content')
    {{-- <div
        id="alert-1"
        class="absolute top-0 right-0 left-0 z-50 flex items-center px-4 py-2 mb-4 min-h-16 rounded-lg bg-green-100 text-green-400 w-7/12 mx-auto"
        role="alert"
    >
        <svg
            class="shrink-0 w-4 h-4"
            aria-hidden="true"
            xmlns="http://www.w3.org/2000/svg"
            fill="currentColor"
            viewBox="0 0 20 20">
            <path
            d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
        </svg>
        <span class="sr-only">Info</span>
        <div class="ms-3 text-sm font-normal">
            A simple info alert with an example link Give it a click if you like.
        </div>
        <button
            type="button"
            class="ms-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex items-center justify-center h-8 w-8"
            data-dismiss-target="#alert-3"
            aria-label="Close">
            <span class="sr-only">Close</span>
            <svg
            class="w-3 h-3"
            aria-hidden="true"
            xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 14 14">
            <path
                stroke="currentColor"
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
            </svg>
        </button>
    </div>
    
      <div
        id="alert-2"
        class="absolute top-10 right-0 left-0 z-50 flex items-center px-4 py-2 mb-4 min-h-16 rounded-lg bg-red-100 text-red-400 w-7/12 mx-auto"
        role="alert">
        <svg
          class="shrink-0 w-4 h-4"
          aria-hidden="true"
          xmlns="http://www.w3.org/2000/svg"
          fill="currentColor"
          viewBox="0 0 20 20">
          <path
            d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
        </svg>
        <span class="sr-only">Info</span>
        <div class="ms-3 text-sm font-normal">
          A simple info alert with an example link Give it a click if you like.
        </div>
        <button
          type="button"
          class="ms-auto -mx-1.5 -my-1.5 bg-red-50 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex items-center justify-center h-8 w-8"
          data-dismiss-target="#alert-3"
          aria-label="Close">
          <span class="sr-only">Close</span>
          <svg
            class="w-3 h-3"
            aria-hidden="true"
            xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 14 14">
            <path
              stroke="currentColor"
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
          </svg>
        </button>
      </div>
      <div
        id="alert-3"
        class="absolute top-20 right-0 left-0 z-50 flex items-center px-4 py-2 mb-4 min-h-16 rounded-lg bg-blue-100 text-blue-400 w-7/12 mx-auto"
        role="alert">
        <svg
          class="shrink-0 w-4 h-4"
          aria-hidden="true"
          xmlns="http://www.w3.org/2000/svg"
          fill="currentColor"
          viewBox="0 0 20 20">
          <path
            d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
        </svg>
        <span class="sr-only">Info</span>
        <div class="ms-3 text-sm font-normal">
          A simple info alert with an example link Give it a click if you like.
        </div>
        <button
          type="button"
          class="ms-auto -mx-1.5 -my-1.5 bg-blue-50 text-blue-500 rounded-lg focus:ring-2 focus:ring-blue-400 p-1.5 hover:bg-blue-200 inline-flex items-center justify-center h-8 w-8"
          data-dismiss-target="#alert-3"
          aria-label="Close">
          <span class="sr-only">Close</span>
          <svg
            class="w-3 h-3"
            aria-hidden="true"
            xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 14 14">
            <path
              stroke="currentColor"
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
          </svg>
        </button>
      </div>
      <div
        id="alert-4"
        class="absolute top-30 right-0 left-0 z-50 flex items-center px-4 py-2 mb-4 min-h-16 rounded-lg bg-yellow-100 text-yellow-600 w-7/12 mx-auto"
        role="alert">
        <svg
          class="shrink-0 w-4 h-4"
          aria-hidden="true"
          xmlns="http://www.w3.org/2000/svg"
          fill="currentColor"
          viewBox="0 0 20 20">
          <path
            d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
        </svg>
        <span class="sr-only">Info</span>
        <div class="ms-3 text-sm font-normal">
          A simple info alert with an example link Give it a click if you like.
        </div>
        <button
          type="button"
          class="ms-auto -mx-1.5 -my-1.5 bg-yellow-50 text-yellow-600 rounded-lg focus:ring-2 focus:ring-yellow-400 p-1.5 hover:bg-yellow-200 inline-flex items-center justify-center h-8 w-8"
          data-dismiss-target="#alert-3"
          aria-label="Close">
          <span class="sr-only">Close</span>
          <svg
            class="w-3 h-3"
            aria-hidden="true"
            xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 14 14">
            <path
              stroke="currentColor"
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
          </svg>
        </button>
      </div> --}}

    <section class="bg-gray-50 w-full pt-20">
        <div class="flex justify-between w-full">
            <div class="flex flex-col items-center justify-center mobilemd:px-6 px-4 py-8 mx-auto md:min-h-screen lg:py-0 laptopmd:w-5/12 tabletsm:w-6/12 sm:w-8/12 mobilelg:w-10/12 w-full">
                <div
                    class="w-full bg-white rounded-lg shadow md:mt-0 tabletsm:p-6 mobilemd:p-12 p-4 tabletmd:p-8">
                    <div class="text-center mb-4">
                    <h1
                        class="laptopmd:text-5xl md:text-4xl text-3xl text-skzdark-200 font-semibold mb-2">
                        Welcome Back
                    </h1>
                    <p class="tabletsm:body body-sm">
                        Enter your email and password to access your account
                    </p>
                    </div>
                    <form class="space-y-4 md:space-y-4" action="{{route('login')}}" method="post">
                        @csrf
                        <div>
                            <label for="email" class="body-sm">Your email</label>
                            <input
                            type="email"
                            name="email"
                            id="email"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-skzyellow-700 focus:border-skzyellow-700 block w-full p-2.5 focus:outline-0"
                            placeholder="Enter your email"
                            required="" />
                            @error('email')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                        </div>
                        <div class="relative">
                            <span class="absolute inset-y-1/2 right-5">
                                <span class="fa fa-eye-slash" id="password-visibility"></span>
                            </span>
                            <label for="password" class="body-sm">Password</label>
                            <input
                            type="password"
                            name="password"
                            id="password"
                            placeholder="Enter your password"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-skzyellow-700 focus:border-skzyellow-700 block w-full p-2.5 focus:outline-0"
                            required="" />
                            @error('password')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="flex justify-between items-center">
                            <div class="flex items-start">
                                <div class="flex items-center h-5">
                                    <input
                                    id="remember"
                                    name="remember"
                                    aria-describedby="remember"
                                    type="checkbox"
                                    class="w-4 h-4 border border-skzdark-100 rounded bg-skzyellow-700"
                                    required="" 
                                     {{ old('remember') ? 'checked' : '' }}
                                    />
                                </div>
                                <div class="ml-3 text-sm flex justify-between">
                                    <label for="remember" class="font-normal text-skzdark-200"
                                    >Remember me
                                    </label>
                                </div>
                            </div>
                            <a href="{{route('forgot-password')}}" class="text-skzyellow-700 hover:underline font-medium">Forgot password?</a>
                        </div>
                        <button type="submit" class="w-full btn-primary">Login</button>
                        <p class="text-base font-normal text-skzdark-100">
                            Don't have an account?
                            <a
                            href="{{route('register')}}"
                            class="text-skzyellow-700 hover:underline font-semibold"
                            >Signup</a
                            >
                        </p>
                    </form>
                </div>
            </div>
            <div class="w-1/2 min-h-screen tabletsm:inline-flex hidden">
                <img src="{{asset('rebirth/assets/images/onboarding.jpg')}}" alt="" class="w-full h-full object-cover object-center" />
            </div>
        </div>
    </section>
@endsection
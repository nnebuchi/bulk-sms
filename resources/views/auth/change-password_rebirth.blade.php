@extends('layouts.rebirth')
@section('content')
     <section class="bg-gray-50 w-full pt-20">
        <div class="flex justify-between w-full">
          <div
            class="flex flex-col items-center justify-center mobilemd:px-6 px-4 py-8 mx-auto md:min-h-screen lg:py-0 laptopmd:w-5/12 tabletsm:w-6/12 sm:w-8/12 mobilelg:w-10/12 w-full">
            <div
              class="w-full bg-white rounded-lg shadow md:mt-0 tabletsm:p-6 mobilemd:p-12 p-4 tabletmd:p-8">
              <div class="text-center mb-4">
                <h1
                  class="laptopmd:text-5xl md:text-4xl text-3xl text-skzdark-200 font-semibold mb-2">
                  We've got you covered
                </h1>
                <p class="tabletsm:body body-sm">
                  Enter your email associated with the account you want to reset
                </p>
              </div>
              <form class="space-y-4 md:space-y-4" method="post" action="{{ route('change-password') }}">
                @csrf
                
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
                <div class="relative">
                    <span class="absolute inset-y-1/2 right-5">
                        <span class="fa fa-eye-slash" id="password-visibility"></span>
                    </span>
                    <label for="password" class="body-sm">Confirm Password</label>
                    <input
                        type="password"
                        name="password_confirmation"
                        id="password_confirmation"
                        placeholder="Enter your password"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-skzyellow-700 focus:border-skzyellow-700 block w-full p-2.5 focus:outline-0"
                        required="" 
                    />
                    @error('password_confirmation')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <button type="submit" class="w-full btn-primary">
                  Proceed
                </button>
                
              </form>
            </div>
          </div>
          <div class="w-1/2 min-h-screen tabletsm:inline-flex hidden">
            <img src="{{asset('rebirth/assets/images/onboarding.jpg')}}" alt="" class="w-full h-full object-cover object-center" />
          </div>
        </div>
      </section>
@endsection
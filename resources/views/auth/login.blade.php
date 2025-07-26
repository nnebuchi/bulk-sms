@extends('layouts.rebirth')
@section('content')
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
                            <span class="text-skz-danger">{{ $message }}</span>
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
                            <span class="text-skz-danger">{{ $message }}</span>
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
                            <a href="#" class="text-skzyellow-700 hover:underline font-medium">Forgot password?</a>
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
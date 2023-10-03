<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $settings->company_name }}</title>
    @notifyCss
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tailwindcss/ui@latest/dist/tailwind-ui.min.css">
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
</head>

<body>
    <div class="min-h-screen bg-gray-50 flex flex-col justify-center py-12 sm:px-6 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-md">
            <img class="mx-auto h-20 w-auto rounded-full" src="{{ $settings->logo }}" alt="logo" />
            <h2 class="mt-6 text-center text-3xl leading-3 font-bold text-gray-900">
                Sign up
            </h2>
        </div>

        <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
            <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
                <form action="{{ route('restaurant.registration.post') }}" method="POST">
                    @csrf
                    <div>
                        <label for="email" class="block text-sm font-medium leading-5 text-gray-700">
                            User Name <span class="text-red-800"> *</span>
                        </label>
                        <div class="mt-1 rounded-md shadow-sm">
                            <input placeholder="Enter your username" id="username" name="username" type="text"
                                value="{{ old('username') }}" required
                                class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                        </div>
                        @error('username')
                            <span class="text-red-600 text-sm ml-1 mt-1">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mt-6">
                        <label for="email" class="block text-sm font-medium leading-5 text-gray-700">
                            Email address <span class="text-red-800"> *</span>
                        </label>
                        <div class="mt-1 rounded-md shadow-sm">
                            <input placeholder="Enter your email" id="email" name="email" type="email"
                                value="{{ old('email') }}" required
                                class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                        </div>
                        @error('email')
                            <span class="text-red-600 text-sm ml-1 mt-1">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mt-6">
                        <label for="password" class="block text-sm font-medium leading-5 text-gray-700">
                            Password<span class="text-red-800"> *</span>
                        </label>
                        <div class="mt-1 rounded-md shadow-sm">
                            <input placeholder="Enter your password" id="password" name="password" type="password"
                                required
                                class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                        </div>
                        @error('password')
                            <span class="text-red-600 text-sm ml-1 mt-1">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mt-6">
                        <label for="restaurant_name" class="block text-sm font-medium leading-5 text-gray-700">
                            Restaurant Name<span class="text-red-800"> *</span>
                        </label>
                        <div class="mt-1 rounded-md shadow-sm">
                            <input placeholder="Enter your restaurant_name" id="restaurant_name" name="restaurant_name"
                                type="text" required
                                class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                        </div>
                        @error('restaurant_name')
                            <span class="text-red-600 text-sm ml-1 mt-1">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mt-6">
                        <label for="address" class="block text-sm font-medium leading-5 text-gray-700">
                            Restaurant Address<span class="text-red-800"> *</span>
                        </label>
                        <div class="mt-1 rounded-md shadow-sm">
                            <input placeholder="Enter your address" id="address" name="address" type="text"
                                required
                                class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                        </div>
                        @error('address')
                            <span class="text-red-600 text-sm ml-1 mt-1">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="flex gap-2">
                        <div class="mt-6">
                            <label for="city" class="block text-sm font-medium leading-5 text-gray-700">
                                City
                            </label>
                            <div class="mt-1 rounded-md shadow-sm">
                                <input placeholder="Enter your city" id="city" name="city" type="text"
                                    class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                            </div>
                            @error('city')
                                <span class="text-red-600 text-sm ml-1 mt-1">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mt-6">
                            <label for="zip_code" class="block text-sm font-medium leading-5 text-gray-700">
                                Zip Code
                            </label>
                            <div class="mt-1 rounded-md shadow-sm">
                                <input placeholder="Enter your zip_code" id="zip_code" name="zip_code" type="text"
                                    class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition
                                    duration-150 ease-in-out sm:text-sm sm:leading-5" />
                            </div>
                            @error('zip_code')
                                <span class="text-red-600 text-sm ml-1 mt-1">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="mt-6 flex items-center justify-between">
                        <div class="text-sm leading-5">
                            <a href="{{ route('restaurant.registration') }}"
                                class="font-medium text-indigo-600 hover:text-indigo-500 focus:outline-none focus:underline transition ease-in-out duration-150">
                                already have an account? Sign In
                            </a>
                        </div>
                    </div>

                    <div class="mt-6">
                        <span class="block w-full rounded-md shadow-sm">
                            <button type="submit"
                                class="w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 transition duration-150 ease-in-out">
                                Sign Up
                            </button>
                        </span>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <x:notify-messages />
    @notifyJs
</body>

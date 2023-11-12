<div class="hidden md:flex md:flex-shrink-0">
    <div class="flex flex-col w-64 bg-white">
        <div class="h-0 flex-1 flex flex-col pt-5 pb-4 overflow-y-auto">
            <a href="{{ route('admin.dashboard') }}">
                <div class="flex items-center flex-shrink-0 px-4">
                    <img class="h-8 ml-8 w-auto rounded-full" src="{{ $settings->logo }}" alt="logo" />

                    {{-- <span class="text-black font-semibold ml-3 inline-block">{{$settings->company_name}}</span>
                    --}}
                </div>
            </a>
            <!-- Sidebar component, swap this element with another sidebar if you like -->
            <nav class="mt-5 flex-1 px-2 bg-white">
                <a href="{{ auth('web')->user() ? route('admin.dashboard') : route('restaurant.dashboard') }}"
                    class=" group flex items-center px-2 py-2 text-sm leading-5 hover:bg-gray-100 font-medium text-gray-600 rounded-md focus:outline-none  transition ease-in-out duration-150">
                    <svg class="mr-3 h-6 w-6 text-gray-600 group-hover:text-gray-800 group-focus:text-gray-100 transition ease-in-out duration-150"
                        stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 12l9-9 9 9M5 10v10a1 1 0 001 1h3a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1h3a1 1 0 001-1V10M9 21h6" />
                    </svg>
                    Dashboard
                </a>
                @if (auth('web')->user())
                    <a href="{{ route('restaurant.list') }}"
                        class=" group flex items-center px-2 py-2 text-sm leading-5 hover:bg-gray-100 font-medium text-gray-600 rounded-md focus:outline-none  transition ease-in-out duration-150">
                        <svg class="mr-3 h-6 w-6 text-gray-600 group-hover:text-gray-800 group-focus:text-gray-100 transition ease-in-out duration-150"
                            stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 12l9-9 9 9M5 10v10a1 1 0 001 1h3a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1h3a1 1 0 001-1V10M9 21h6" />
                        </svg>
                        Restaurant List
                    </a>
                @endif

                @if (auth('restaurants')->user() && auth('restaurants')->user()->status == 'approved')
                    <div
                        class="sub-btn px-2 py-2 text-sm leading-5 hover:bg-gray-100 font-medium text-gray-600 rounded-md focus:outline-none transition ease-in-out duration-150 cursor-pointer">
                        <span class="pl-4">
                            Category
                        </span>
                        <ul class="pl-8 bg-gray-100 text-sm subMenu hidden">
                            <li><a href="{{ route('restaurant.categories.index') }}" class="block py-2 ml-3">Category
                                    List</a></li>
                            <li><a href="{{ route('restaurant.categories.create') }}" class="block py-2 ml-3">Add
                                    Category</a></li>
                        </ul>
                    </div>
                    <div
                        class="sub-btn px-2 py-2 text-sm leading-5 hover:bg-gray-100 font-medium text-gray-600 rounded-md focus:outline-none transition ease-in-out duration-150 cursor-pointer">
                        <span class="pl-4">
                            Food
                        </span>
                        <ul class="pl-8 bg-gray-100 text-sm subMenu hidden">
                            <li><a href="{{ route('restaurant.foods.index') }}" class="block py-2 ml-3">Foods
                                    List</a></li>
                            <li><a href="{{ route('restaurant.foods.create') }}" class="block py-2 ml-3">Add
                                    Food</a></li>
                        </ul>
                    </div>
                    <div
                        class="sub-btn px-2 py-2 text-sm leading-5 hover:bg-gray-100 font-medium text-gray-600 rounded-md focus:outline-none transition ease-in-out duration-150 cursor-pointer">
                        <li class="list-none"><a href="{{ route('restaurant.orders') }}" class="block py-2 ml-3">Orders
                                List</a></li>
                    </div>
                    <div
                        class="sub-btn px-2 py-2 text-sm leading-5 hover:bg-gray-100 font-medium text-gray-600 rounded-md focus:outline-none transition ease-in-out duration-150 cursor-pointer">
                        <li class="list-none"><a href="{{ route('restaurant.profile') }}"
                                class="block py-2 ml-3">Profile</a></li>
                    </div>
                @endif
                <div class="relative">
                    <li
                        class=" mt-1 group flex items-center justify-between px-2 py-2 text-sm leading-5 font-medium text-gray-600 rounded-md hover:text-gray-800 hover:bg-gray-100 focus:outline-none  transition ease-in-out duration-150">
                        <div class="flex items-center">
                            <svg cla xmlns="http://www.w3.org/2000/svg"
                                class="mr-3 h-6 w-6 text-gray-600 group-hover:text-gray-800  transition ease-in-out duration-150"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            Settings
                        </div>
                    </li>
                </div>
            </nav>
        </div>

        <div class="flex-shrink-0 flex bg-gray-100 p-4">
            <a href="{{ auth('web')->user() ? route('logout') : route('restaurant.logout') }}"
                class="flex-shrink-0 w-full group block" title="logout">
                <div class="flex items-center space-x-2">
                    <div class="ml-3 ">

                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 26 26" width="22" height="22">
                            <path fill="none" d="M0 0h24v24H0z" />
                            <path
                                d="M6.265 3.807l1.147 1.639a8 8 0 1 0 9.176 0l1.147-1.639A9.988 9.988 0 0 1 22 12c0 5.523-4.477 10-10 10S2 17.523 2 12a9.988 9.988 0 0 1 4.265-8.193zM11 12V2h2v10h-2z" />
                        </svg>

                    </div>
                    <div class="mb-1">
                        <p
                            class="text-lg leading-4 font-medium text-gray-600 group-hover:text-gray-800 transition ease-in-out duration-150">
                            Logout
                        </p>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>

@push('js')
    <script type="text/javascript">
        $('.sub-btn').click(function() {
            $(this).toggleClass('bg-gray-100');
            $(this).children('.subMenu').toggleClass('hidden');
        });
    </script>
@endpush

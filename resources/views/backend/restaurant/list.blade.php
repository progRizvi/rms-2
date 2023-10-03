@extends('backend.layout.app')
@section('title', 'Restaurant List')
@section('main')

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg my-16 mx-10">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Restaurant Name
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Address
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Phone
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Status
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Description
                    </th>
                    <th scope="col" class="px-6 py-3">
                        <span class="sr-only">Action</span>
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($restaurants as $restaurant)
                    <tr
                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $restaurant->restaurant_name }}
                        </th>
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $restaurant->address }}
                        </td>
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $restaurant->phone }}
                        </td>
                        <td class="px-6 py-4">
                            @if ($restaurant->status == 'rejected')
                                <span
                                    class="px-2 py-1 font-semibold leading-tight text-red-700 bg-red-100 rounded-full dark:bg-red-700 dark:text-red-100">
                                    Rejected
                                </span>
                            @elseif($restaurant->status == 'inactive')
                                <span
                                    class="px-2 py-1 font-semibold leading-tight text-yellow-700 bg-yellow-100 rounded-full dark:bg-yellow-700 dark:text-yellow-100">
                                    Inactive
                                </span>
                            @else
                                <span
                                    class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">
                                    Approved
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            {{-- take 10 words --}}
                            {{ Str::limit($restaurant->description, 10) }}
                        </td>
                        <td class="px-6 py-4 text-right">
                            @if ($restaurant->status == 'rejected' || $restaurant->status == 'inactive')
                                <a href="{{ route('restaurant.approve', $restaurant->id) }}"
                                    class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Approved</a>
                            @endif
                            @if ($restaurant->status == 'approved' || $restaurant->status == 'inactive')
                                <a href="{{ route('restaurant.reject', $restaurant->id) }}"
                                    class="font-medium text-red-600 dark:text-blue-500 hover:underline">Rejected</a>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="my-4 px-6">
            {{ $restaurants->links('pagination::custom') }}
        </div>
    </div>

@endsection

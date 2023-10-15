@extends('backend.layout.app')
@section('title', 'Food List')
@section('main')
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg my-16 mx-10">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Food Name
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Category
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Image
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Price
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Discount
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Featured
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Status
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($foods as $food)
                    <tr
                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $food->title }}
                        </th>
                        <td class="px-6 py-4">
                            {{ $food->category->name }}
                        </td>
                        <td class="px-6 py-4">
                            <img src="{{ asset('uploads/food/' . $food->image) }}" alt="{{ $food->title }}"
                                class="w-20 h-20 object-cover">
                        </td>
                        <td class="px-6 py-4">
                            BDT {{ $food->price }}
                        </td>
                        <td class="px-6 py-4">
                            BDT {{ $food->discount }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $food->featured }}
                        </td>
                        <td class="px-6 py-4">
                            @if ($food->status == 'Inactive')
                                <span
                                    class="px-2 py-1 font-semibold leading-tight text-red-700 bg-red-100 rounded-full dark:bg-red-700 dark:text-red-100">
                                    Inactive
                                </span>
                            @else
                                <span
                                    class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">
                                    Active
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-right">
                            <a href="{{ route('restaurant.foods.edit', $food->id) }}"
                                class="font-medium text-blue-600 dark:text-blue-500 hover:underline"><i
                                    class="fas fa-edit"></i></a>
                            <a class="font-medium text-red-600 dark:text-red-400 hover:underline"
                                href="{{ route('restaurant.foods.delete', $food->id) }}"><i class="fas fa-trash"></i></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="my-4 px-6">
            {{ $foods->links('pagination::custom') }}
        </div>
    </div>

@endsection

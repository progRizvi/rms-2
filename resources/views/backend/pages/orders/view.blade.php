@extends('backend.layout.app')

@section('title', 'Order Details List')
@section('main')

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg my-16 mx-10">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        sl
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Food Name
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Quantity
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                    {{-- @dd($order) --}}
                    <tr
                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $orders->firstItem() + $loop->index }}
                        </th>
                        <td class="px-6 py-4">
                            {{ $order->food->title }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $order->quantity }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="my-4 px-6">
            {{ $orders->links('pagination::custom') }}
        </div>
    </div>

@endsection

@extends('backend.layout.app')

@section('title', 'Orders List')
@section('main')

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg my-16 mx-10">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        sl
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Order Id
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Customer Name
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Customer Phone
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Customer Address
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Payment Status
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Order Status
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Order Date
                    </th>
                    <th scope="col" class="px-6 py-3">
                        <span class="sr-only">Edit</span>
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
                            {{ $order->transaction_id }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $order->name }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $order->phone }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $order->delivery_address }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $order->payment_status }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $order->order_status }}
                        </td>
                        <td class="px-6 py-4">
                            {{ \Carbon\Carbon::parse($order->created_at)->format('d M Y') }}
                        </td>

                        <td class="px-6 py-4 text-right">
                            <a href="{{ route('restaurant.order.show', $order->id) }}"
                                class="text-indigo-600 hover:text-indigo-900">View</a>
                            @if ($order->order_status == 'pending')
                                <a href="{{ route('restaurant.order.delivered', $order->id) }}"
                                    class="text-green-600 hover:text-greeen-900">Delivered</a>
                            @endif
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

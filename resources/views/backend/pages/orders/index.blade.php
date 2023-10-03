@extends('backend.layout.app')

@section('title', 'Post List')
@section('main')

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg my-16 mx-10">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        OrderId
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
                    <tr
                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $order->id }}
                        </th>
                        <td class="px-6 py-4">
                            Customer Name
                        </td>
                        <td class="px-6 py-4">
                            Customer Phone
                        </td>
                        <td class="px-6 py-4">
                            {{ $order->address }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $order->status }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $order->created_at }}
                        </td>

                        <td class="px-6 py-4 text-right">
                            <a href="{{ route('posts.edit', $post->id) }}"
                                class="font-medium text-blue-600 dark:text-blue-500 hover:underline mr-4">Edit</a>
                            <form action="{{ route('posts.destroy', $post->id) }}" method="POST" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="font-medium text-red-600 dark:text-red-500 hover:underline">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="my-4 px-6">
            {{ $posts->links('pagination::custom') }}
        </div>
    </div>

@endsection

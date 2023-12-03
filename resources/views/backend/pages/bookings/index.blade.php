@extends('backend.layout.app')

@section('title', 'Bookings List')
@section('main')

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg my-16 mx-10">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        sl
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Customer Name
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Customer Phone
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Persons
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Booking Status
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Table No
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Booking Date & Time
                    </th>
                    <th scope="col" class="px-6 py-3">
                        <span class="sr-only">Action</span>
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($bookings as $booking)
                    <tr
                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $bookings->firstItem() + $loop->index }}
                        </th>
                        <td class="px-6 py-4">
                            {{ $booking->name }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $booking->phone }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $booking->persons }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $booking->status }}
                        </td>
                        <td class="px-6 py-4 table_no" data-id="{{ $booking->id }}">
                            {{ $booking->table_no }}
                        </td>
                        <td class="px-6 py-4">
                            {{ \Carbon\Carbon::parse($booking->date_time)->format('H:i, d M Y') }}
                        </td>

                        <td class="px-6 py-4 text-right">

                            @if ($booking->status != 'complete')
                                <a href="{{ route('restaurant.bookings.status', $booking->id) }}"
                                    class="text-green-600 hover:text-greeen-900">
                                    {{ ($booking->status == 'pending')?'Confirm':'Complete' }}
                                </a>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="my-4 px-6">
            {{ $bookings->links('pagination::custom') }}
        </div>
    </div>

@endsection

@push("js")
    <script>
        $(document).ready(function() {
            $('.table_no').click(function() {
                $input = `<input type="text" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring table_no_input" style="width: 50px;">`;
                $(this).html($input);
                $('.table_no_input').focus();
            });
            $(".table_no_input").blur(function(){
                $table_no = $(this).val();
                $booking_id = $(this).data('id');
                $this = $(this);
                $.ajax({
                    url: "{{ route('restaurant.bookings.table_no') }}",
                    method: "POST",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "table_no": $table_no,
                        "booking_id": $booking_id
                    },
                    success: function(data) {
                        $this.parent().html($table_no);
                    }
                });
            })
        });
    </script>
@endpush

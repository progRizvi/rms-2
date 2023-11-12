@extends('frontend.pages.user_panel.layout')
@section('title', 'Bookings')
@section('user_panel_content')
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="white_card card_height_100 mb_30">
                <div class="white_card_header">
                    <div class="box_header m-0">
                        <div class="main-title">
                            <h3 class="m-0">Bookings</h3>
                        </div>
                    </div>
                </div>
                <div class="white_card_body">
                    <div class="QA_section">
                        <div class="white_box_tittle list_header">
                            <h4></h4>
                            <div class="box_right d-flex lms_block">
                                {{-- <div class="serach_field_2">
                                    <div class="search_inner">
                                        <form Active="#">
                                            <div class="search_field">
                                                <input type="text" placeholder="Search content here...">
                                            </div>
                                            <button type="submit"> <i class="ti-search"></i> </button>
                                        </form>
                                    </div> --}}
                            </div>
                        </div>
                    </div>
                    <div class="QA_table mb_30">
                        <table class="table lms_table_active " id="booking_bookings">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Check In Date</th>
                                    <th>Check Out Date</th>
                                    <th>Days</th>
                                    <th>Paid</th>
                                    <th>Due</th>
                                    <th>Room Number</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($bookings as $key => $booking)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ isset($booking->booking_details[0]) ? $booking->booking_details[0]?->check_in_date : '' }}
                                        </td>
                                        <td>{{ isset($booking->booking_details[0]) ? $booking->booking_details[count($booking->booking_details) - 1]->check_in_date : '' }}
                                        </td>
                                        <td>{{ count($booking->booking_details) }}</td>
                                        <td>BDT {{ $booking->advance }}</td>
                                        <td>BDT {{ $booking->total_due }}</td>
                                        <td>{{ $booking->room->room_number }}</td>
                                        <td>{{ $booking->status }}</td>
                                        <td>
                                            @if (!($booking->status == 'cancel' || $booking->status == 'confirm'))
                                                <a href="{{ route('user.cancel.booking', $booking->id) }}"
                                                    class="btn btn-sm btn-danger">
                                                    Cancel
                                                </a>
                                            @endif

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12">
    </div>
    </div>
@endsection

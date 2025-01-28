<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index(){
        return view('Booking.index');
    }

    public function appointment(){
        return view('Booking.appointments');
    }

    public function upcoming_appointment(){
        return view('Booking.upcomimg');
    }

    public function records(){
        return view('Booking.record');
    }
}

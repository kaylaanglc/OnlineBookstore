<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderHistoryController extends Controller
{
    public function index()
    {
        // Fetch orders from the database and pass them to the view
        $orders = auth()->user()->orders; // Assuming you have a relationship set up

        return view('order-history', compact('orders'));
    }
}

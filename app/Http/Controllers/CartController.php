<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    public function list()
{
    // Your logic for displaying the cart items goes here
    return view('cart.list');
}
}

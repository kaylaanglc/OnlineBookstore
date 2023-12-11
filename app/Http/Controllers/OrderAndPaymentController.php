<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Http\Controllers\CartController;
use Illuminate\Http\Request;

class OrderAndPaymentController extends Controller
{
    public function showOrderForm()
    {
        // Assuming you have the CartController implemented
        $totalPrice = app(CartController::class)->list()['totalPrice'];
        return view('orderAndPayment.order', compact('totalPrice'));
    }

    public function continueToPayment(Request $request)
    {
        // Validate the form data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:255',
        ]);

        $user = auth()->user();
        $cartController = app(CartController::class);
        $currentOrder = $cartController->getCurrentOrder($user);

        // $existingOrder = $currentOrder->items()->where('book_id', $request->input('book_id'))->first();

        if (!$currentOrder) {
            // Handle the case where the current order is not found
            return back()->with('error', 'Error creating order. Please try again.');
        }

        // Update the existing order with additional information
        $updateResult = $currentOrder->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'address' => $request->input('address'),
        ]);


        if (!$updateResult) {
            // Log the error or provide additional information for debugging
            \Log::error('Error updating order information', ['order_id' => $currentOrder->id]);
            return back()->with('error', 'Error updating order information. Please try again.');
        }

        // Redirect to the payment gateway or order summary page
        return redirect()->route('payment')->with('success', 'Order information updated successfully.');
    }

    public function payment()
    {
        // Assuming you have the CartController implemented
        $totalPrice = app(CartController::class)->list()['totalPrice'];
        return view('orderAndPayment.payment', compact('totalPrice'));
    }

}

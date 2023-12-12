<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Payment;
use App\Models\PaymentMethod;
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

        $user = auth()->user();
        $cartController = app(CartController::class);
        $currentOrder = $cartController->getCurrentOrder($user);

        $paymentMethods = PaymentMethod::all();

        return view('orderAndPayment.payment', compact('totalPrice', 'currentOrder', 'paymentMethods'));
    }

    public function processPayment(Request $request)
    {
        // Validate the request data as needed

        $user = auth()->user();
        $cartController = app(CartController::class);
        $currentOrder = $cartController->getCurrentOrder($user);

        $totalPrice = app(CartController::class)->list()['totalPrice'];

        $payment = Payment::create([
            'amount' => $totalPrice,
            'payment_date' => now(),
            'payment_method_id' => $request->input('paymentMethod'),
        ]);

        // Update the current order with the payment id
        $updateResult = $currentOrder->update([
            'payment_id' => $payment->id
        ]);

        // Clear the current order
        $currentOrder->items()->delete();

        // Create a new order for the user
        $newOrder = Order::create([
            'user_id' => $user->id,
        ]);

        // Add any additional logic or redirects as needed

        return redirect('/dashboard')->with('success', 'Payment successful!');
    }


}

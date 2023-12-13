<?php

namespace App\Http\Controllers;

use App\Models\OrderItem;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Order;

class CartController extends Controller
{
    public function getCurrentOrder(User $user)
    {
        // Get the latest order for the user
        $latestOrder = $user->orders()->latest()->first();

        // If there's no order, create a new one
        if (!$latestOrder) {
            $latestOrder = Order::create([
                'user_id' => $user->id,
                // 'payment_id' => null
            ]);
        }

        return $latestOrder;
    }

    public function list()
    {
        $user = auth()->user();

        // Check if there are any orders for the user
        if ($user->orders()->exists()) {
            // Fetch the items in the current order
            $cartItems = $this->getCurrentOrder($user)->items;

            // Calculate total price
            $totalPrice = $cartItems->sum(function ($item) {
                return $item->quantity * $item->book->price;
            });

            return view('cart.list', compact('cartItems', 'totalPrice'));
        } else {
            // If there are no orders, the cart is empty
            $cartItems = [];
            $totalPrice = 0;

            return view('cart.list', compact('cartItems', 'totalPrice'));
        }
    }

    public function addToCart(Request $request)
    {
        $request->validate([
            'book_id' => 'required|exists:books,id',
        ]);

        $user = auth()->user();
        $currentOrder = $this->getCurrentOrder($user);

        // Check if the book is already in the cart
        $existingItem = $currentOrder->items()->where('book_id', $request->input('book_id'))->first();

        if ($existingItem) {
            // If the book is already in the cart, increment the quantity
            $existingItem->update([
                'quantity' => $existingItem->quantity + 1,
            ]);
        } else {
            // If the book is not in the cart, create a new OrderItem
            OrderItem::create([
                'book_id' => $request->input('book_id'),
                'quantity' => 1, // You can modify this based on your requirements.
                'order_id' => $currentOrder->id,
            ]);
        }

        return redirect()->route('dashboard')->with('success', 'Book added to the cart successfully.');
    }

    public function addToCartSearch(Request $request)
    {
        $request->validate([
            'book_id' => 'required|exists:books,id',
        ]);

        $user = auth()->user();
        $currentOrder = $this->getCurrentOrder($user);

        // Check if the book is already in the cart
        $existingItem = $currentOrder->items()->where('book_id', $request->input('book_id'))->first();

        if ($existingItem) {
            // If the book is already in the cart, increment the quantity
            $existingItem->update([
                'quantity' => $existingItem->quantity + 1,
            ]);
        } else {
            // If the book is not in the cart, create a new OrderItem
            OrderItem::create([
                'book_id' => $request->input('book_id'),
                'quantity' => 1, // You can modify this based on your requirements.
                'order_id' => $currentOrder->id,
            ]);
        }

        return back()->with('success', 'Book added to the cart successfully.');
    }

    public function removeFromCart(OrderItem $orderItem)
    {
        $orderItem->delete();

        return back()->with('success', 'Book removed from the cart successfully.');
    }
}

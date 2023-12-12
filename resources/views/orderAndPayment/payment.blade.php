<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Payment Form</title>
    <!-- Add your stylesheets and scripts if needed -->
</head>
<body>
        <div class="container">
            <h1>Payment</h1>

            <form action="{{ route('process.payment') }}" method="post">
                @csrf

                <div>
                    <label for="name">Name: {{ $currentOrder->name }}</label>
                </div>

                <div>
                    <label for="totalPrice">Total Price: ${{ $totalPrice }}</label>
                </div>

                {{-- <div>
                    <label for="amount">Amount:</label>
                    <input type="text" name="amount" value="{{ $totalPrice }}" readonly>
                </div> --}}

                <div>
                    <label for="paymentMethod">Payment Method:</label>
                    <select name="paymentMethod" id="paymentMethod">
                        @foreach($paymentMethods as $method)
                            <option value="{{ $method->id }}">{{ $method->name }}</option>
                        @endforeach
                    </select>
                </div>

                <button type="submit">Submit Payment</button>
            </form>
        </div>
</body>
</html>

<!DOCTYPE html>
<html>
<head>
    <title>Checkout</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100">

<div class="max-w-6xl mx-auto py-10 px-5">

    <h1 class="text-3xl font-bold text-purple-700 mb-8">
        Checkout
    </h1>


    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">


        <!-- Shipping Information -->
        <div class="lg:col-span-2 bg-white rounded-xl shadow p-8">

            <h2 class="text-xl font-semibold mb-6">
                Shipping Information
            </h2>


            <form action="{{ route('checkout.store') }}" method="POST">
                @csrf


                <div class="mb-5">
                    <label class="block font-medium mb-2">
                        Name
                    </label>

                    <input 
                        type="text"
                        name="name"
                        value="{{ Auth::user()->name }}"
                        class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-purple-500"
                        required>
                </div>


                <div class="mb-5">
                    <label class="block font-medium mb-2">
                        Email
                    </label>

                    <input 
                        type="email"
                        value="{{ Auth::user()->email }}"
                        class="w-full border rounded-lg px-4 py-3 bg-gray-100"
                        readonly>
                </div>


                <div class="mb-5">
                    <label class="block font-medium mb-2">
                        Phone Number
                    </label>

                    <input 
                        type="text"
                        name="phone"
                        class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-purple-500"
                        required>
                </div>


                <div class="mb-5">
                    <label class="block font-medium mb-2">
                        Shipping Address
                    </label>

                    <textarea
                        name="address"
                        rows="4"
                        class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-purple-500"
                        required></textarea>
                </div>


                <div class="mb-6">

                    <label class="block font-medium mb-2">
                        Payment Method
                    </label>


                    <div class="border rounded-lg p-4 bg-gray-50">

                        <label class="flex items-center gap-3">

                            <input 
                                type="radio"
                                checked
                                class="text-purple-600">

                            <span>
                                Cash on Delivery
                            </span>

                        </label>

                    </div>

                </div>


                <button
                    type="submit"
                    class="w-full bg-purple-600 hover:bg-purple-700 text-white py-3 rounded-lg font-semibold">

                    Place Order

                </button>


            </form>

        </div>




        <!-- Order Summary -->

        <div class="bg-white rounded-xl shadow p-8 h-fit">


            <h2 class="text-xl font-semibold mb-6">
                Order Summary
            </h2>



            <div class="space-y-4">


                @foreach($cartItems as $item)

                <div class="border-b pb-4">


                    <div class="flex justify-between">

                        <span class="font-medium">
                            {{ $item->product->name }}
                        </span>


                    </div>


                    <div class="flex justify-between text-gray-600 mt-2">

                        <span>
                            Rs. {{ number_format($item->product->price,2) }}
                        </span>


                        <span>
                            Qty: {{ $item->quantity }}
                        </span>


                    </div>


                    <div class="text-right font-semibold mt-2">

                        Rs. {{ number_format($item->product->price * $item->quantity,2) }}

                    </div>


                </div>


                @endforeach



            </div>



            <div class="border-t mt-6 pt-5 flex justify-between text-lg font-bold">


                <span>
                    Grand Total:
                </span>


                <span class="text-purple-700">

                    Rs. {{ number_format($total,2) }}

                </span>


            </div>



        </div>



    </div>


</div>


</body>
</html>
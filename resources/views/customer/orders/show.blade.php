<!DOCTYPE html>
<html>
<head>
    <title>Order Details</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

<div class="max-w-6xl mx-auto p-6">

    <!-- Back Button -->
    <a href="{{ route('orders.index') }}"
       class="inline-flex items-center text-purple-600 hover:text-purple-800 mb-6">
        ← Back to My Orders
    </a>


    <div class="bg-white rounded-xl shadow-lg p-6">

        <h1 class="text-3xl font-bold text-gray-800 mb-6">
            Order Details
        </h1>


        <!-- Customer Information -->
        <div class="grid md:grid-cols-2 gap-6 mb-8">

            <div class="border rounded-lg p-5">

                <h2 class="text-xl font-semibold text-gray-700 mb-4">
                    Customer Information
                </h2>

                <div class="space-y-3 text-gray-600">

                    <p>
                        <span class="font-semibold text-gray-800">
                            Name:
                        </span>
                        {{ $order->customer_name }}
                    </p>


                    <p>
                        <span class="font-semibold text-gray-800">
                            Email:
                        </span>
                        {{ $order->email }}
                    </p>


                    <p>
                        <span class="font-semibold text-gray-800">
                            Phone:
                        </span>
                        {{ $order->phone }}
                    </p>


                    <p>
                        <span class="font-semibold text-gray-800">
                            Shipping Address:
                        </span>
                        {{ $order->shipping_address }}
                    </p>

                </div>

            </div>



            <!-- Order Information -->
            <div class="border rounded-lg p-5">

                <h2 class="text-xl font-semibold text-gray-700 mb-4">
                    Order Information
                </h2>


                <div class="space-y-3 text-gray-600">


                    <p>
                        <span class="font-semibold text-gray-800">
                            Order ID:
                        </span>

                        #{{ $order->id }}
                    </p>


                    <p>
                        <span class="font-semibold text-gray-800">
                            Status:
                        </span>


                        <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-sm">
                            {{ $order->status }}
                        </span>

                    </p>



                    <p>
                        <span class="font-semibold text-gray-800">
                            Payment:
                        </span>

                        {{ $order->payment_method }}

                    </p>



                    <p>
                        <span class="font-semibold text-gray-800">
                            Date:
                        </span>

                        {{ $order->created_at->format('d M Y h:i A') }}

                    </p>


                </div>


            </div>


        </div>




        <!-- Ordered Products -->

        <div class="border rounded-lg overflow-hidden">


            <div class="bg-purple-600 text-white px-5 py-4">

                <h2 class="text-xl font-semibold">
                    Ordered Products
                </h2>

            </div>



            <table class="w-full text-left">

                <thead class="bg-gray-100">

                    <tr>

                        <th class="p-4">
                            Product
                        </th>

                        <th class="p-4">
                            Price
                        </th>

                        <th class="p-4">
                            Quantity
                        </th>

                        <th class="p-4">
                            Subtotal
                        </th>


                    </tr>

                </thead>



                <tbody>


                @foreach($order->items as $item)

                    <tr class="border-t">


                        <td class="p-4 font-medium text-gray-800">

                            {{ $item->product->name }}

                        </td>



                        <td class="p-4">

                            Rs. {{ number_format($item->price,2) }}

                        </td>



                        <td class="p-4">

                            {{ $item->quantity }}

                        </td>



                        <td class="p-4 font-semibold">

                            Rs. {{ number_format($item->price * $item->quantity,2) }}

                        </td>


                    </tr>


                @endforeach


                </tbody>


            </table>


        </div>





        <!-- Grand Total -->

        <div class="mt-6 flex justify-end">


            <div class="bg-gray-100 rounded-lg px-6 py-4">


                <span class="text-lg font-semibold text-gray-700">

                    Grand Total:

                </span>


                <span class="text-xl font-bold text-purple-600">

                    Rs. {{ number_format($order->total_amount,2) }}

                </span>


            </div>


        </div>



    </div>


</div>


</body>
</html>
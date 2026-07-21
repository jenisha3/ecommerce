<!DOCTYPE html>
<html>

<head>

    <meta charset="UTF-8">

    <title>Order Status Updated</title>

</head>

<body style="background:#f4f6f9;font-family:Arial,Helvetica,sans-serif;padding:40px;">

<div style="max-width:700px;margin:auto;background:#ffffff;border-radius:10px;overflow:hidden;box-shadow:0 0 10px rgba(0,0,0,.08);">

    <!-- Header -->

    <div style="background:#1e3a8a;padding:25px;text-align:center;">

        <h1 style="color:white;margin:0;">
            Gadget Store
        </h1>

        <p style="color:#dbeafe;margin-top:8px;">
            Order Status Update
        </p>

    </div>

    <!-- Body -->

    <div style="padding:30px;">

        <h2 style="margin-top:0;color:#111827;">

            Hello {{ $order->customer_name }},

        </h2>

        <p style="font-size:16px;color:#4b5563;">

            Your order status has been updated successfully.

        </p>

        <!-- Customer Information -->

        <h3 style="color:#2563eb;margin-top:35px;">
            Customer Information
        </h3>

        <table width="100%" cellpadding="10" style="border-collapse:collapse;">

            <tr style="background:#f9fafb;">

                <td width="35%"><strong>Customer Name</strong></td>

                <td>{{ $order->customer_name }}</td>

            </tr>

            <tr>

                <td><strong>Email</strong></td>

                <td>{{ $order->email }}</td>

            </tr>

            <tr style="background:#f9fafb;">

                <td><strong>Phone</strong></td>

                <td>{{ $order->phone }}</td>

            </tr>

            <tr>

                <td><strong>Shipping Address</strong></td>

                <td>{{ $order->shipping_address }}</td>

            </tr>

        </table>

        <!-- Order Information -->

        <h3 style="color:#2563eb;margin-top:35px;">
            Order Information
        </h3>

        <table width="100%" cellpadding="10" style="border-collapse:collapse;">

            <tr style="background:#f9fafb;">

                <td width="35%"><strong>Order ID</strong></td>

                <td>#{{ $order->id }}</td>

            </tr>

            <tr>

                <td><strong>Status</strong></td>

                <td>

                    <strong style="color:#2563eb;">

                        {{ $order->status }}

                    </strong>

                </td>

            </tr>

            <tr style="background:#f9fafb;">

                <td><strong>Payment Method</strong></td>

                <td>{{ $order->payment_method }}</td>

            </tr>

            <tr>

                <td><strong>Order Date</strong></td>

                <td>{{ $order->created_at->format('d M Y h:i A') }}</td>

            </tr>

            <tr style="background:#f9fafb;">

                <td><strong>Total Amount</strong></td>

                <td>

                    <strong>

                        Rs. {{ number_format($order->total_amount,2) }}

                    </strong>

                </td>

            </tr>

        </table>

        <p style="margin-top:40px;font-size:16px;color:#374151;">

            Thank you for shopping with
            <strong>Gadget Store</strong>.

        </p>

        <p style="color:#6b7280;">

            We appreciate your trust and hope to serve you again soon.

        </p>

    </div>

    <!-- Footer -->

    <div style="background:#111827;color:white;text-align:center;padding:18px;">

        © {{ date('Y') }} Gadget Store. All Rights Reserved.

    </div>

</div>

</body>

</html>
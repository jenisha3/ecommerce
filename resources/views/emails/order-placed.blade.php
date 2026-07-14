<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Order Confirmation</title>
</head>
<body style="font-family:Arial,sans-serif;background:#f5f5f5;padding:30px;">

<div style="max-width:600px;margin:auto;background:#ffffff;padding:30px;border-radius:8px;">

    <h2 style="color:#2563eb;">
        Thank You for Your Order!
    </h2>

    <p>Hello <strong>{{ $order->name }}</strong>,</p>

    <p>Your order has been placed successfully.</p>

    <hr>

    <h3>Order Details</h3>

    <p><strong>Order ID:</strong> #{{ $order->id }}</p>

    <p><strong>Total Amount:</strong>
        Rs. {{ number_format($order->total_amount,2) }}
    </p>

    <p><strong>Payment Method:</strong>
        {{ $order->payment_method }}
    </p>

    <p><strong>Status:</strong>
        {{ $order->status }}
    </p>

    <p><strong>Shipping Address:</strong><br>
        {{ $order->shipping_address }}
    </p>

    <hr>

    <p>
        We will notify you once your order has been shipped.
    </p>

    <br>

    <p>
        Regards,<br>
        <strong>Gadget Store</strong>
    </p>

</div>

</body>
</html>
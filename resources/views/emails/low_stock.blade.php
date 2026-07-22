<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Low Stock Alert</title>

    <style>
        body{
            margin:0;
            padding:30px;
            background:#f4f7fb;
            font-family:Arial, Helvetica, sans-serif;
        }

        .container{
            max-width:700px;
            margin:auto;
            background:#ffffff;
            border-radius:12px;
            overflow:hidden;
            box-shadow:0 10px 30px rgba(0,0,0,.08);
        }

        .header{
            background:#dc3545;
            color:#fff;
            padding:25px;
            text-align:center;
        }

        .header h1{
            margin:0;
            font-size:28px;
        }

        .content{
            padding:30px;
        }

        .alert-box{
            background:#fff3cd;
            border-left:5px solid #ffc107;
            color:#856404;
            padding:15px;
            border-radius:8px;
            margin-bottom:25px;
        }

        table{
            width:100%;
            border-collapse:collapse;
        }

        table thead{
            background:#343a40;
            color:#fff;
        }

        table th,
        table td{
            padding:14px;
            text-align:left;
            border-bottom:1px solid #e5e5e5;
        }

        tbody tr:nth-child(even){
            background:#f8f9fa;
        }

        .low-stock{
            color:#dc3545;
            font-weight:bold;
        }

        .footer{
            background:#f8f9fa;
            text-align:center;
            padding:18px;
            font-size:13px;
            color:#666;
        }

        .footer strong{
            color:#dc3545;
        }
    </style>
</head>

<body>

<div class="container">

    <div class="header">
        <h1>⚠ Low Stock Notification</h1>
    </div>

    <div class="content">

        <div class="alert-box">
            Some products are running low in stock. Please restock them as soon as possible.
        </div>

        <table>

            <thead>
                <tr>
                    <th>Product</th>
                    <th>Remaining Stock</th>
                </tr>
            </thead>

            <tbody>

            @foreach($products as $product)

                <tr>
                    <td>{{ $product->name }}</td>

                    <td class="low-stock">
                        {{ $product->stock }}
                    </td>
                </tr>

            @endforeach

            </tbody>

        </table>

    </div>

    <div class="footer">
        This is an automated notification from <strong>Your Ecommerce Store</strong>.<br>
        Please review your inventory and replenish low-stock products.
    </div>

</div>

</body>
</html>
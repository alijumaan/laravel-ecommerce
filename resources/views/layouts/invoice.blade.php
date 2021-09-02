<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Invoice {{ $ref_id }}</title>
    <style>
        body {
            font-family: 'almarai', sans-serif;
        }

        .invoice-box {
            max-width: 800px;
            margin: auto;
            padding: 30px;
            font-size: 16px;
            line-height: 24px;
            font-family: 'almarai', sans-serif;
            color: #555;
        }

        .invoice-box table {
            width: 100%;
            line-height: inherit;
            text-align: left;
        }

        .invoice-box table td {
            padding: 5px;
            vertical-align: top;
        }

        .invoice-box table tr td:nth-child(2),
        .invoice-box table tr td:nth-child(3) {
            text-align: right;
        }

        .invoice-box table tr.top table td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.top table td.title {
            font-size: 45px;
            line-height: 45px;
            color: #333;
        }

        .invoice-box table tr.information table td {
            padding-bottom: 40px;
        }

        .invoice-box table tr.heading td {
            background: #eee;
            border-bottom: 1px solid #ddd;
            font-weight: bold;
        }

        .invoice-box table tr.details td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.item td {
            border-bottom: 1px solid #eee;
        }

        .invoice-box table tr.item.last td {
            border-bottom: none;
        }

        .invoice-box table tr.total td:nth-child(2),
        .invoice-box table tr.total td:nth-child(3) {
            border-top: 2px solid #eee;
            font-weight: bold;
        }

        @media only screen and (max-width: 600px) {
            .invoice-box table tr.top table td {
                width: 100%;
                display: block;
                text-align: center;
            }

            .invoice-box table tr.information table td {
                width: 100%;
                display: block;
                text-align: center;
            }
        }

        /** RTL **/
        .invoice-box.rtl {
            direction: rtl;
            font-family: 'almarai', sans-serif;
        }

        .invoice-box.rtl table {
            text-align: right;
        }

        .invoice-box.rtl table tr td:nth-child(2),
        .invoice-box.rtl table tr td:nth-child(3) {
            text-align: left;
        }

        @page {
            header: page-header;
            footer: page-footer;
        }
    </style>
</head>
<body>
<div class="invoice-box">
    <table cellpadding="0" cellspacing="0">
        <tr class="top">
            <td colspan="3">
                <table>
                    <tr>
                        <td class="title">
                            <img src="{{ base_path('public/frontend/img/logo.png') }}" style="width: 100%; max-width: 100px" />
                        </td>
                        <td></td>
                        <td>
                            Invoice #: {{ $ref_id }}<br />
                            Created: {{ \Carbon\Carbon::parse($created_at)->format('M d, Y') }}<br />
                            Due: {{ \Carbon\Carbon::parse($created_at)->format('M d, Y') }}
                        </td>
                    </tr>
                </table>
            </td>
        </tr>

        <tr class="information">
            <td colspan="3">
                <table>
                    <tr>
                        <td>
                            Ali's Company<br />
                            12345 Jeddah<br />
                            Jeddah, SA 12345
                        </td>
                        <td></td>
                        <td>
                            {{ $user['full_name'] }}<br />
                            {{ $user['phone'] }}<br />
                            {{ $user['email'] }}
                        </td>
                    </tr>
                </table>
            </td>
        </tr>

        <tr class="heading">
            <td>Payment Method</td>
            <td></td>
            <td>Check #</td>
        </tr>

        <tr class="details">
            <td>{{ $payment_method['name'] }}</td>
            <td></td>
            <td>{{ $currency_symbol . number_format($total, 2) }}</td>
        </tr>

        <tr class="heading">
            <td>Item</td>
            <td>Quantity</td>
            <td>Price</td>
        </tr>

        @foreach($products as $product)
        <tr class="item">
            <td>{{ $product['name'] }}</td>
            <td>{{ $product['pivot']['quantity'] }}</td>
            <td>{{ $currency_symbol . number_format($product['price'] * $product['pivot']['quantity'], 2) }}</td>
        </tr>
        @endforeach

        <tr class="total">
            <td></td>
            <td>Subtotal:</td>
            <td>{{ $currency_symbol . number_format($subtotal, 2) }}</td>
        </tr>
        <tr class="total">
            <td></td>
            <td>Discount:</td>
            <td>{{ $currency_symbol . number_format($discount, 2) }}</td>
        </tr>
        <tr class="total">
            <td></td>
            <td>Tax:</td>
            <td>{{ $currency_symbol . number_format($tax, 2) }}</td>
        </tr>
        <tr class="total">
            <td></td>
            <td>Shipping:</td>
            <td>{{ $currency_symbol . number_format($shipping, 2) }}</td>
        </tr>
        <tr class="total">
            <td></td>
            <td>Total:</td>
            <td>{{ $currency_symbol . number_format($total, 2) }}</td>
        </tr>
    </table>
</div>
</body>
</html>

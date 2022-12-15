<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <h1 style="font-family: DejaVu Sans;">Mã đơn hàng: {{ $order->order_code }}</h1>
    <h1>{{ $order->name }}</h1>
    <h1 style="font-family: DejaVu Sans;">Địa chỉ: {{ $order->address }}</h1>
</body>

</html>

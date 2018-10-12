<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Test</title>

    </head>
    <body>
        @foreach($orders1 as $order1)
            <p>order number: {{ $order1->order_number }} | Products count: {{ $order1->products_count }}</p>
        @endforeach

        <br>
        @foreach($orders2 as $order2)
            <div>order number that has more than 10 products: {{ $order1->order_number }}
                <ul>
                    @foreach ($order2->products as $product)
                        <li>{{ $product->title }}</li>
                    @endforeach
                </ul>
            </div>

        @endforeach



    </body>
</html>

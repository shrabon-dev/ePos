<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Barcode pdf</title>
</head>
<body>
             <div style="display: flex;">
                @php
                $arr = array();
                foreach ($selectProducts as $key => $product) {
                    array_push($arr, $product->realtionWithProduct->barcode);
                };
                @endphp
                @foreach ($selectProducts as $product)
                @for ($i = 0; $i < $product->quantity; $i++)
                <div style="border:1px dotted black;width:300px;display:inline-block;text-align:center;margin:6px;padding:10px;margin-top:0">
                    <p>Product: {{ $product->realtionWithProduct->name }} </p>
                    <p>Code: {{ $product->realtionWithProduct->code }} </p>
                    <span style="font-size: 10px !important">
                        {!! DNS1D::getBarcodeHTML($arr[$loop->index], 'C39+') !!}
                    </span>
                </div>
                @endfor
                @endforeach
            </div>
</body>
</html>

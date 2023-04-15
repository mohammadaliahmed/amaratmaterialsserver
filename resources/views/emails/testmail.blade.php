<html>
<head>

</head>
<body>

<div  style="background-color: #ececec;width: 400px;padding: 10px;margin: 20px;border-radius: 20px">

    <center><h3>Order Confirmation</h3>


        Dear <strong>{{$sale->customer->name}}</strong>,

        Thank you for your order!<br><br>

        We have received your order and we will contact you as soon.<br>
        You can find your purchase information below
        <hr>

        <h3>Order Summary</h3>
    </center>

    @foreach($sale->items as $item)

            <div  style="background-color: #ffffff;width: 350px;margin: 20px">
                <div style=" display: flex;">
                    <img style="margin: 5px" src="{{url('/')}}/storage/{{$item->product->image}}" width="100" height="100"/>
                    <div style="margin: 10px">
                        <strong>{{$item->product->name}}</strong>
                        <br>
                        <strong> Rs {{$item->product->sale_price}}</strong>
                        <br>
                        <strong>Qty: {{$item->quantity}}</strong>
                    </div>
                </div>
            </div>


    @endforeach

    <center>
        <hr>

        <h3>Order Total: Rs {{$sale->getTotal()}}</h3>

        <hr>

        <h3>Shipping address</h3>
        {{$sale->customer->name}}<br>
        {{$sale->customer->phone_number}}<br>
        H#{{$sale->site->house}}, St#{{$sale->site->street}}, Sec#{{$sale->site->sector}}<br>
    </center>

</div>

</body>
</html>

@extends('layouts.app')

@section('page-title', __('Vendors'))

@section('title')
    <div class="d-inline-block">
        <h5 class="h4 d-inline-block font-weight-400 mb-0">{{ __('Vendors') }}</h5>
    </div>
@endsection


@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('Home') }}</a></li>
    <li class="breadcrumb-item">{{ __('Assigned Orders') }}</li>
@endsection

@section('content')
    <div class="card m-3 p-3">
        <h3>Select Vendor</h3>


        {{ Form::select('vendors', $vendors, null, ['class' => 'form-control', 'data-toggle' => 'select','id' => 'vendors']) }}

    </div>
    @if(isset($orders) )

        <div class="card m-3 p-3">

            <div class="m-2 badge  bg-primary">
                <h3>{{$vendor->name}}</h3>
                <p>
                    {{$vendor->phone_number}}
                </p>
            </div>

            <hr>
            @if(sizeof($orders)>0)
                <h3>Assigned Orders</h3>
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Image</th>
                        <th scope="col">Product</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Date</th>
                        <th scope="col">Action</th>
                        <th scope="col">Purchase Invoice</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($orders as $key=> $order)
                        <tr>
                            <th scope="row">{{$key + 1}}</th>
                            <td><img src="{{url('').'/storage/'.$order->product->image}}" width="70" height="70"></td>
                            <td>{{$order->product->name}}</td>
                            <td>{{$order->quantity}}</td>
                            <td>{{$order->created_at}}</td>
                            <td>
                                @php
                                    $orderStatus=($order->order_status == 1 ? __('Acknowledged') : (($order->order_status == 2 ? __('Received') : __('Sent'))));
                                    $order_class = Utility::convertStringToSlug(($order->order_status == 1 ? 'Partially Paid' : (($order->order_status == 2 ? 'Paid' : 'Unpaid'))));

                                @endphp

                                <li class="nav-item dropdown display-payment" data-li-id="{{$order->id}}">
                                    <span data-bs-toggle="dropdown"
                                          class="badge payment-label badge-lg p-2  {{$order_class}}">{{$orderStatus}}</span>
                                    <div class="dropdown-menu dropdown-list payment-status dropdown-menu-right">
                                        <div class="dropdown-list-content payment-actions" data-id="{{$order->id}}"
                                             data-url="{{route('update.vendor.order.status',['vendorId'=>$vendor->id,'orderId'=>$order->id])}}"
                                        >
                                            <a href="#" data-status="0" data-class="unpaid"
                                               class="dropdown-item payment-action">Sent
                                            </a>
                                            <a href="#" data-status="1" data-class="partially-paid"
                                               class="dropdown-item payment-action ">
                                                Acknowledged
                                            </a>
                                            <a href="#" data-status="2" data-class="paid"
                                               class="dropdown-item payment-action">
                                                Received
                                            </a>
                                        </div>
                                    </div>
                                </li>
                            </td>
                            <td>
{{--                                {{$order->purchase}}--}}
                                @isset($order->purchase)
                                    <div class="action-btn btn-dark ms-2">
                                        <a href="{{ route('get.purchased.invoice',Crypt::encrypt($order->purchase->invoice_id)) }}" target="_blank" class="mx-3 btn btn-sm d-inline-flex align-items-center " data-bs-toggle="tooltip"  data-title="Download"    title="Download Purchase Invoice"><i class="ti ti-arrow-bar-to-down text-white"></i></a>
                                    </div>
                                @endisset

                            </td>

                        </tr>
                    @endforeach

                    </tbody>
                </table>
            @else
                <div class="card m-3 p-3">
                    <h3>No Orders</h3>
                </div>
            @endif
        </div>

    @endif

@endsection


@push('scripts')
    <script>
        $("#vendors").change(function () {
            //selection changed
            // var url = $(location).attr('href');
            //
            // window.location.href = url + "/" + this.value;
            var url = "{{route('vendor.orders.view', '')}}" + "/" + this.value;


            window.location.href = url;


        });


        $(document).on('click', '.payment-action', function (e) {
            e.stopPropagation();
            e.preventDefault();

            var ele = $(this);

            var id = ele.parent().attr('data-id');
            var url = ele.parent().attr('data-url');
            var status = ele.attr('data-status');

            $.ajax({
                url: url,
                method: 'PATCH',
                data: {
                    status: status
                },
                success: function (response) {

                    if (response) {
                        // location.reload();

                        $('[data-li-id="' + id + '"] .payment-action').removeClass('selected');

                        if (ele.hasClass('selected')) {

                            ele.removeClass('selected');

                        } else {
                            ele.addClass('selected');
                        }

                        var payment = $('[data-li-id="' + id + '"] .payment-actions').find('.selected')
                            .text().trim();

                        var payment_class = $('[data-li-id="' + id + '"] .payment-actions').find(
                            '.selected').attr('data-class');
                        $('[data-li-id="' + id + '"] .payment-label').removeClass(
                            'unpaid partially-paid paid').addClass(payment_class).text(payment);
                    }
                },
                error: function (data) {
                    data = data.responseJSON;
                    show_toastr('{{ __('Error') }}', data.error, 'error');
                }
            });
        });

    </script>

@endpush

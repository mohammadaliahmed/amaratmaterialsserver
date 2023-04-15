@extends('layouts.app')


@section('page-title', __('Assign Sale'))

@section('title')
    <div class="d-inline-block">
        <h5 class="h4 d-inline-block font-weight-400 mb-0">{{ __('Assign Sale') }}</h5>
    </div>
@endsection


@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('Home') }}</a></li>
    <li class="breadcrumb-item"><a href="{{ route('reports.sales') }}">{{ __('Sale List') }}</a></li>
    <li class="breadcrumb-item">{{ __('Assign Sale') }}</li>
@endsection



@section('content')
    <div class="card m-3 p-3">
        <h3>Assign order</h3>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Image</th>
                <th scope="col">Product Name</th>
                <th scope="col">Product Price</th>
                <th scope="col">Quantity</th>
                <th scope="col">Assign</th>
                <th scope="col">Action</th>

            </tr>
            </thead>
            <tbody>
            @foreach($sale->items as $item)
                <tr>

                    <input type="hidden" name="quantity" value="{{$item->quantity}}">
                    <input type="hidden" name="productId" value="{{$item->product->id}}">
                    <th scope="row">1</th>
                    <td><img src="{{\Illuminate\Support\Facades\Storage::url('').$item->product->image}}" width="100"
                             height="100"></td>
                    <td>{{$item->product->name}}</td>
                    <td>{{$item->product->sale_price}}</td>
                    <td>{{$item->quantity}}</td>
                    <td><a class="btn btn-primary btn-sm m-2" href="{{route('sale.assign', $sale->id)}}">
                            Assign order
                        </a>
                    </td>
                    <td>
                        @php
                            $statusClass="unpaid";
                            $statusText="In-Bound";
                             if($item->status=='1'){
                                 $statusClass="partially-paid";
                                 $statusText="Ready for delivery";

                            }else if($item->status=='2'){
                               $statusClass="paid";
                               $statusText="Delivered";
                            }
                        @endphp
                        <li class="nav-item dropdown display-payment" data-li-id="{{$sale->id}}">
                            <span data-bs-toggle="dropdown"
                                  class="badge payment-label badge-lg p-2  {{$statusClass}}">{{$statusText}}</span>
                            <div class="dropdown-menu dropdown-list payment-status dropdown-menu-right">
                                <div class="dropdown-list-content payment-actions" data-id="{{$item->id}}"
                                     data-url="{{route('update.product.status', ['id' => $item->id])}}">
                                    <a href="#" data-status="0" data-class="unpaid"
                                       class="dropdown-item payment-action ' . ($invoice->status == 0 ? 'selected' : '') . '">In-Bound
                                    </a>
                                    <a href="#" data-status="1" data-class="partially-paid"
                                       class="dropdown-item payment-action ' . ($invoice->status == 1 ? 'selected' : '') . '">Ready for delivery
                                    </a>
                                    <a href="#" data-status="2" data-class="paid"
                                       class="dropdown-item payment-action ' . ($invoice->status == 2 ? 'selected' : '') . '">Delivered
                                    </a>
                                </div>
                            </div>
                        </li>
                    </td>

                </tr>

            @endforeach

            </tbody>
        </table>
    </div>
@endsection
@push('scripts')
    <script>
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
                    console.log(response)
                    if (response) {

                        location.reload();

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

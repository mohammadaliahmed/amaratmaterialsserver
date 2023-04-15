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
                <th scope="col">Quantity</th>
                <th scope="col">Vendors</th>
                <th scope="col">Status</th>

            </tr>
            </thead>
            <tbody>
            @foreach($sale->items as $item)
                <tr>
                    <form method="post">
                        @csrf
                        <input type="hidden" name="quantity" value="{{$item->quantity}}">
                        <input type="hidden" name="productId" value="{{$item->product->id}}">
                        <th scope="row">1</th>
                        <td><img src="{{\Illuminate\Support\Facades\Storage::url('').$item->product->image}}"
                                 width="100" height="100"></td>
                        <td>{{$item->product->name}}</td>
                        <td>{{$item->quantity}}</td>
                        <td>

                            @if(isset(($item->assigendTo)))
                                @foreach($item->product->vendors as $vendor)
                                    <label>{{$vendor->vendor->name}}</label><br>
                                @endforeach
                            @else
                                @foreach($item->product->vendors as $vendor)
                                    <label><input class="m-2" type="radio" name="vendorId"
                                                  value="{{$vendor->vendor->id}}">{{$vendor->vendor->name}}</label><br>
                                @endforeach
                                <button class="btn btn-primary btn-sm">Assign order</button>

                            @endif
                        </td>
                        <td>

                            @if(isset(($item->assigendTo)))
                                <span class="badge bg-success">Assigned<br>To: {{$item->assigendTo->name}}</span>
                            @else
                                <span class="badge bg-danger">Not Assigned</span>
                            @endif
                        </td>
                    </form>
                </tr>

            @endforeach

            </tbody>
        </table>
    </div>
@endsection

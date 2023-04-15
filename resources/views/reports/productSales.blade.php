@extends('layouts.app')


@section('page-title', __('Products sale report'))

@section('title')
    <div class="d-inline-block">
        <h5 class="h4 d-inline-block font-weight-400 mb-0">{{ __('Product Sale') }}</h5>
    </div>
@endsection

@push('old-datatable-css')

    <link rel="stylesheet" href="{{ asset('assets/css/plugins/flatpickr.min.css') }}">
@endpush


@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('Home') }}</a></li>
    <li class="breadcrumb-item"><a href="{{ route('reports.sales') }}">{{ __('Sale List') }}</a></li>
    <li class="breadcrumb-item">{{ __('Product Sale') }}</li>
@endsection
@push('scripts')
    <script src="{{ asset('assets/js/plugins/flatpickr.min.js') }}"></script>
    <script>
        // minimum setup
        document.querySelector("#pc-daterangepicker-1").flatpickr({
            mode: "range",
            onChange: function (selectedDates, dateStr, instance) {
                var dates = dateStr.split(" to ");
                var start = moment(dates[0]).format('YYYY-MM-DD');
                var end = moment(dates[0]).format('YYYY-MM-DD');
                $('#start_date1').val(start);
                $('end_date1').val(end);
                if (dates.length == 1) {
                    var end = moment(dates[1]).format('YYYY-MM-DD');
                    $('end_date1').val(end);
                    if (typeof ajax_invoice_filter == 'function') {
                        ajax_invoice_filter();
                    }
                }
            }
        });
    </script>
@endpush


@section('content')
    <form method="post">
        @csrf
        <div class="row mt-5">


            <div class="form-group col-lg-5  col-sm-12 ">

                {{ Form::label('duration1', __('Date Duration'), ['class' => 'form-control-label']) }}
                <div class="input-group">
                    <input type='text' name="date" class="form-control" id="pc-daterangepicker-1"
                           placeholder="Select time" type="text"/>
                </div>

            </div>
            <div class="form-group col-lg-5  col-sm-12">

                {{ Form::label('sell_to', __('Pick Product'), ['class' => 'form-control-label']) }}
                <div class="input-group">
                    {{ Form::select('productId', $products, null, ['class' => 'form-control', 'id' => 'id', 'data-toggle' => 'select']) }}
                </div>

            </div>
            <div class="col-lg-2 col-sm-12">
                <button class="btn btn-primary justify-content-center">
                    Search
                </button>
            </div>

        </div>

    </form>
    <div class="card m-3 p-3">
        <h3>Product Sale Report {{$start_date}} - {{$end_date}}</h3>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Image</th>
                <th scope="col">Product Name</th>
                <th scope="col">Product Unit</th>
                <th scope="col">Quantity</th>

                <th scope="col">Product Price</th>
                <th scope="col">Subtotal</th>

            </tr>
            </thead>
            <tbody>

            @foreach($soldItems as    $key=>   $item)
                <tr>
                    <th scope="row">{{$key + 1}}</th>

                    <td><img src="{{url('/').'/storage/'.$item->product->image}}" width="100" height="100"/>
                    </td>
                    <td>{{$item->product->name}}</td>

                    <td>@isset($item->product->unit)
                            {{$item->product->unit_value.' '.$item->product->unit->shortname}}
                        @endisset
                    </td>
                    <td>{{$item->total_quantity}}</td>
                    <td>Rs {{$item->price}}</td>
                    <td>Rs {{$item->total_quantity*$item->price}}</td>

                </tr>
            @endforeach


            </tbody>
        </table>
    </div>
@endsection
@push('scripts')
    <script>
    </script>
@endpush

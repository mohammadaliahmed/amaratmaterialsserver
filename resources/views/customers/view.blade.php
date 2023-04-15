@extends('layouts.app')

@section('page-title', __('Customers'))

@section('title')
    <div class="d-inline-block">
        <h5 class="h4 d-inline-block font-weight-400 mb-0">{{ __('Customers') }}</h5>
    </div>
@endsection

@section('action-btn')



@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('Home') }}</a></li>
    <li class="breadcrumb-item">{{ __('Customer') }}</li>
@endsection

@section('content')
    <div class="card m-3 p-3">
        <H2>Customer: {{$customer->name}}</H2>
        <h4>CNIC: {{$customer->cnic}}</h4>
        <h4>Near: {{$customer->famous}}</h4>

    </div>

    <div class="card m-3 p-3">
        <div class="d-flex justify-content-between">
            <H2>Sites</H2>
{{--            <a href="#" data-ajax-popup="true" data-size="lg" data-bs-toggle="tooltip"--}}
{{--               data-title="{{ __('Add New Customer Site') }}" title="{{ __(' New Customer Site') }}"--}}
{{--               data-url="{{ route('customer.createSite',$customer->id) }}" class="btn btn-sm btn-primary btn-icon m-1">--}}
{{--                <span class=""><i class="ti ti-plus text-white"></i></span>--}}
{{--            </a>--}}
        </div>
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header card-body table-border-style">

                        <div class="table-responsive">
                            <table class="table dataTable" id="pc-dt-simple">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{ __('House') }}</th>
                                    <th>{{ __('Street') }}</th>
                                    <th>{{ __('Sector') }}</th>
                                    <th>{{ __('Near') }}</th>
                                    <th>{{ __('Address') }}</th>
                                    <th>{{ __('Date/Time Added') }} </th>
{{--                                    <th width="200px">{{ __('Action') }}</th>--}}
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($customer->sites as $key => $site)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $site->house }}</td>
                                        <td>{{ $site->street }}</td>
                                        <td>{{ $site->sector }}</td>
                                        <td>{{ $site->near }}</td>
                                        <td>{{ $site->address }}</td>
                                        <td>{{ Auth::user()->datetimeFormat($site->created_at) }}</td>
{{--                                        <td class="Action">--}}
{{--                                            <div class="action-btn btn-info ms-2">--}}
{{--                                                <a href="#"--}}
{{--                                                   class="mx-3 btn btn-sm d-inline-flex align-items-center"--}}
{{--                                                   data-ajax-popup="true" title="{{ __('Edit Site') }}"--}}
{{--                                                   data-title="{{ __('Edit Site') }}" data-size="lg"--}}
{{--                                                   data-url="{{ route('sites.edit', $site->id) }}"--}}
{{--                                                   data-bs-toggle="tooltip" title="{{ __('Edit Site') }}">--}}
{{--                                                    <i class="ti ti-pencil text-white"></i>--}}

{{--                                                </a>--}}
{{--                                            </div>--}}
{{--                                            <div class="action-btn bg-danger ms-2">--}}
{{--                                                <a href="#"--}}
{{--                                                   class="bs-pass-para mx-3 btn btn-sm d-inline-flex align-items-center"--}}
{{--                                                   data-toggle="sweet-alert" data-bs-toggle="tooltip"--}}
{{--                                                   data-confirm="{{ __('Are You Sure?') }}"--}}
{{--                                                   data-text="{{ __('This action can not be undone. Do you want to continue?') }}"--}}
{{--                                                   data-confirm-yes="delete-form-{{ $site->id }}"--}}
{{--                                                   title="{{ __('Delete') }}">--}}
{{--                                                    <i class="ti ti-trash text-white"></i>--}}
{{--                                                </a>--}}
{{--                                            </div>--}}
{{--                                            {!! Form::open(['method' => 'DELETE', 'route' => ['sites.destroy', $site->id], 'id' => 'delete-form-' . $site->id]) !!}--}}
{{--                                            {!! Form::close() !!}--}}
{{--                                        </td>--}}
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>

@endsection

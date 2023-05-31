@extends('layouts.app')

@section('page-title', __('Vendor Ledger'))

@section('title')
    <div class="d-inline-block">
        <h5 class="h4 d-inline-block font-weight-400 mb-0">{{ __('Vendor Ledger') }}</h5>
    </div>
@endsection

@section('action-btn')

    <a href="{{ route('customer.export') }}" class="btn btn-sm btn-primary btn-icon m-1" data-bs-toggle="tooltip"
       title="{{ __('Export') }}">
        <i class="ti ti-file-export text-white"></i>
    </a>

@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('Home') }}</a></li>
    <li class="breadcrumb-item">{{ __('Vendor Ledger') }}</li>
@endsection

@section('content')
    @can('Manage Customer')
        <style>
            .credit {
                color: green;
            }

            .debit {
                color: red;
            }
        </style>
        <div class="row mt-3">
            <div class="col-xl-12">
                <div class="card p-3">
                    <h3>Add Ledger</h3>
                    <h4 class="mt-4">Vendor: {{ $vendor->name }}</h4>
                    <form method="post">
                        @csrf
                        <div class="row">
                            <div class="col-4">
                                <label>Date</label>
                                <input autocomplete="off" type="text" name="date" required class="form-control" id="datepicker">
                            </div>
                            <div class="col-4">

                                <label for="type">Type:</label>
                                <select class="form-control" name="type" id="type">
                                    <option value="debit">Debit</option>
                                    <option value="credit">Credit</option>
                                </select>

                            </div>
                            <div class="col-4">
                                <label>Amount</label>
                                <input type="number" name="amount" class="form-control" id="amount" step="10"
                                       required>
                            </div>
                            <div class="row">
                                <div class="d-flex justify-content-center">
                                    <button class="btn btn-success w-25 m-3">Add</button>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header card-body table-border-style">

                        <div class="table-responsive">
                            <table class="table dataTable" id="pc-dt-simple">
                                <thead>
                                <tr>
                                    <th>Sr #</th>
                                    <th>{{ __('Date') }}</th>
                                    <th>{{ __('Credit') }}</th>
                                    <th>{{ __('Debit') }}</th>
                                    <th>{{ __('Balance') }} </th>
                                </tr>

                                </thead>
                                <tbody>
                                @php
                                    $balance = $startingBalance;
                                @endphp
                                @foreach ($ledgerEntries as $key=>$entry)
                                    @php
                                    $key++;
                                    @endphp
                                    <tr>
                                        <td>{{$key}}</td>
                                        <td>{{ $entry->date }}</td>
                                        @if ($entry->type === 'credit')
                                            <td class="credit">{{ $entry->amount }}</td>
                                            <td></td>
                                            @php
                                                $balance += $entry->amount;
                                            @endphp
                                        @else
                                            <td></td>
                                            <td class="debit">{{ $entry->amount }}</td>
                                            @php
                                                $balance -= $entry->amount;
                                            @endphp
                                        @endif
                                        <td>{{ $balance }}</td>
                                    </tr>
                                @endforeach
                                </tbody>


                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endcan
    @push('scripts')
        <script>
            $(function () {
                $("#datepicker").datepicker();
            });
        </script>
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    @endpush

@endsection

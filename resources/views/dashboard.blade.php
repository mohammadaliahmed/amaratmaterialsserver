@extends('layouts.app')

@section('title')
    <div class="d-inline-block">
        <h5 class="h4 d-inline-block font-weight-400 mb-0">{{ __('Dashboard') }}</h5>
    </div>
@endsection



@push('old-datatable-css')
    <link rel="stylesheet" href="{{ asset('custom/css/jquery.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('custom/css/customdatatable.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/plugins/flatpickr.min.css') }}">
@endpush

@push('stylesheets')
    <link rel="stylesheet" href="{{ asset('css/fullcalendar.min.css') }}">
@endpush

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
    <div class="row">
        @if (count($lowstockproducts) > 0)
            <div class="col-md-12">
                @foreach ($lowstockproducts as $product)
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <span class="alert-icon"><i class="ti ti-alert-triangle"></i></span>
                        <strong>{{ $product['name'] }}</strong><small>{{ __(' (Only ') . $product['quantity'] . __(' items left)') }}</small>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endforeach
            </div>
        @endif


        {{--        @if (isset($notifications) && !empty($notifications) && count($notifications) > 0)--}}
        {{--            <div class="col-md-12">--}}
        {{--                @foreach ($notifications as $notification)--}}
        {{--                    <div class="alert alert-{{ $notification->color }} alert-dismissible fade show" role="alert">--}}
        {{--                        <strong>{!! $notification->description !!}</strong>--}}
        {{--                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>--}}
        {{--                    </div>--}}
        {{--                @endforeach--}}
        {{--            </div>--}}
        {{--        @endif--}}
    </div>

    @if ($branches == 0 || $cashregisters == 0 || $productscount == 0 || $customers == 0 || $vendors == 0)
        <div class="row mt-4">
            <div class="col-md-12">
                    <?php
                    $alerts = [];

                    $alerts[] = $branches == 0 ? __('Please add some Branches!') : '';

                    $alerts[] = $cashregisters == 0 ? __('Please add some Cash Registers!') : '';

                    $alerts[] = $productscount == 0 ? __('Please add some Products!') : '';

                    $alerts[] = $customers == 0 ? __('Please add some Customers!') : '';

                    $alerts[] = $vendors == 0 ? __('Please add some Vendors!') : '';

                    $result = array_filter($alerts);
                    ?>
                @if (isset($result) && !empty($result) && count($result) > 0)
                    @foreach ($result as $alert)
                        <div class="alert alert-warning alert-dismissible fade show  mt-1" role="alert">
                            <span class="alert-icon"><i class="ti ti-alert-triangle"></i></span>
                            <strong>{{ $alert }}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    @endif

    <div class="row">

        <div class="col-sm-12">
            <div class="row">
                <div class="">
                    <div class="row">
                        <div class="col-lg-3 col-6">
                            <div class="card" style="min-height: 225px;">
                                <div class="card-body">
                                    <div class="theme-avtar bg-primary">
                                        <i class="ti ti-hand-finger"></i>
                                    </div>
                                    <p class="text-muted text-sm mt-4 mb-2">{{ __('Sales Of This Month') }}</p>
                                    <h6 class="mb-3"></h6>
                                    <h3 class="mb-0">{{ $monthlySelledAmount }}<span
                                            class="text-success text-sm"><i class=""></i> </span></h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-6">
                            <div class="card" style="min-height: 225px;">
                                <div class="card-body">
                                    <div class="theme-avtar bg-info">
                                        <i class="ti ti-chart-pie"></i>
                                    </div>
                                    <p class="text-muted text-sm mt-4 mb-2">{{ __('Total Sales Amount') }}</p>
                                    <h6 class="mb-3"></h6>
                                    <h3 class="mb-0">{{ $totalSelledAmount }}<span
                                            class="text-danger text-sm"><i class=""></i></span></h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-6">
                            <div class="card" style="min-height: 225px;">
                                <div class="card-body">
                                    <div class="theme-avtar bg-warning">
                                        <i class="ti ti-report-money"></i>
                                    </div>
                                    <p class="text-muted text-sm mt-4 mb-2">{{ __('Orders Of This Month') }}</p>
                                    <h6 class="mb-3"></h6>
                                    <h3 class="mb-0">{{ $monthlyOrders }}<span
                                            class="text-success text-sm"><i class=""></i> </span></h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-6">
                            <div class="card" style="min-height: 225px;">
                                <div class="card-body">
                                    <div class="theme-avtar bg-danger">
                                        <i class="ti ti-chart-bar"></i>
                                    </div>
                                    <p class="text-muted text-sm mt-4 mb-2">{{ __('Total Orders Count') }}</p>
                                    <h6 class="mb-3"></h6>
                                    <h3 class="mb-0">{{ $totalSalesCount }}<span
                                            class="text-danger text-sm"><i class=""></i> </span></h3>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>


        <div class="row ">
            <div class="col-12">
                <h3>Orders</h3>


                <div class="card table-card">
                    <div class="row p-4">
                        <label  class="col-4"><input type="radio" checked value="all" name="filterData">All Orders</label >
                        <label class="col-4"><input type="radio" value="today" name="filterData">Today </label>
                        <label class="col-4"><input type="radio" value="yesterday" name="filterData">Yesterday</label>
                    </div>
                    <input hidden id="start_date1" value="" type="text">
                    <input hidden id="end_date1" value="" type="text">
                    <div class="card-header card-body table-border-style">
                        {{-- <h5></h5> --}}
                        <div class="col-sm-12 table-responsive mt-3 table_over">
                            <table class="table dataTable table-sm" id="myTable" role="grid">
                                <thead class="thead-light">
                                <tr role="row">
                                    <th style="width: 277px;">{{ __('Invoice ID') }}</th>
                                    <th>{{ __('Date') }}</th>
                                    <th>{{ __('Sold To') }}</th>
                                    <th>{{ __('Site') }}</th>
                                    <th>{{ __('Items') }}</th>
                                    <th>{{ __('Total') }}</th>
                                    <th>{{ __('Payment Status') }}</th>
                                    <th>{{ __('Order Status') }}</th>
                                    <th style="width: 180px;">{{ __('Action') }}</th>
                                </tr>
                                </thead>
                                <tbody>

                                </tbody>
                                <tfoot>
                                <tr>
                                    <td rowspan="1" colspan="1">
                                        <h5 class="h6">{{ __('Grand Total') }}</h5>
                                    </td>
                                    <td rowspan="1" colspan="1"></td>
                                    <td rowspan="1" colspan="1"></td>
                                    <td rowspan="1" colspan="1"></td>
                                    <td rowspan="1" colspan="1">
                                        <h5 class="h6" id="totalitems"></h5>
                                    </td>
                                    <td rowspan="1" colspan="1">
                                        <h5 class="h6" id="totalcounts"></h5>
                                    </td>
                                    <td rowspan="1" colspan="1"></td>
                                    <td rowspan="1" colspan="1"></td>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        @endsection

        @push('old-datatable-js')

            <script src="{{ asset('custom/js/jquery.dataTables.min.js') }}"></script>
            <script>
                var dataTabelLang = {
                    paginate: {previous: "<i class='fas fa-angle-left'>", next: "<i class='fas fa-angle-right'>"},
                    lengthMenu: "{{__('Show')}} _MENU_ {{__('entries')}}",
                    zeroRecords: "{{__('No data available in table.')}}",
                    info: "{{__('Showing')}} _START_ {{__('to')}} _END_ {{__('of')}} _TOTAL_ {{__('entries')}}",
                    infoEmpty: "{{ __('Showing 0 to 0 of 0 entries') }}",
                    infoFiltered: "{{ __('(filtered from _MAX_ total entries)') }}",
                    search: "{{__('Search:')}}",
                    thousands: ",",
                    loadingRecords: "{{ __('Loading...') }}",
                    processing: "{{ __('Processing...') }}"
                };

                var site_currency_symbol_position = '{{ \App\Models\Utility::getValByName('site_currency_symbol_position') }}';
                var site_currency_symbol = '{{ \App\Models\Utility::getValByName('site_currency_symbol') }}';
            </script>

        @endpush

        @push('scripts')
            <script src="{{ asset('js/bootstrap-datepicker.min.js') }}"></script>

            <script>

                $(document).on('click', '.copy_link_sale', function (e) {
                    e.preventDefault();
                    var copyText = $(this).attr('href');

                    document.addEventListener('copy', function (e) {
                        e.clipboardData.setData('text/plain', copyText);
                        e.preventDefault();
                    }, true);

                    document.execCommand('copy');
                    show_toastr('Success', 'Url copied to clipboard', 'success');
                });
            </script>

            <script type="text/javascript">


                $(document).ready(function () {
                    ajax_invoice_filter();

                    var currentDate = <?php echo json_encode($currentDate) ?>;
                    var yesterdayDate = <?php echo json_encode($yesterdayDate) ?>;

                    var radios = document.getElementsByName('filterData');

                    for (var i = 0; i < radios.length; i++) {
                        radios[i].addEventListener('click', function () {
                            var selectedValue = this.value;

                            if (selectedValue === "all") {
                                document.getElementById("start_date1").value = ""
                                document.getElementById("end_date1").value = ""
                            } else if (selectedValue === "today") {
                                $('#start_date1').val(currentDate);
                                $('#end_date1').val(currentDate);


                            } else if (selectedValue === "yesterday") {
                                $('#start_date1').val(yesterdayDate);
                                $('#end_date1').val(yesterdayDate);
                            }
                            ajax_invoice_filter()
                        });
                    }

                    // $('input[type=radio]').click(function() {
                    //     var radioValue = $('input[name=all]:checked').val();
                    //     console.log('Selected radio value is: ' + radioValue);
                    //     document.getElementById("start_date1").value ="2023-04-12"
                    //     document.getElementById("end_date1").value ="2023-04-12"
                    //     ajax_invoice_filter()
                    // });
                });

                $(document).on('change', '#sell_to, #sell_by', function (e) {
                    ajax_invoice_filter();

                });

                function ajax_invoice_filter() {

                    var data = {
                        'url': '{{ route('invoice.filter') }}',
                        'start_date': $('#start_date1').val(),
                        'end_date': $('#end_date1').val(),
                        'customer_id': $('#sell_to').val(),
                        'user_id': $('#sell_by').val(),
                        'customers': 1,
                    }

                    $('#myTable').DataTable({
                        "processing": true,
                        "destroy": true,
                        "paging": true,
                        "pageLength": 10,
                        "ordering": false,
                        "language": dataTabelLang,
                        "ajax": {
                            "type": "GET",
                            "url": data.url,
                            "data": data,
                        },
                        "columns": [{
                            "data": "invoice_id"
                        },
                            {
                                "data": "created_at"
                            },

                            {
                                "data": "customername"
                            },
                            {
                                "data": "site"
                            },
                            {
                                "data": "itemscount"
                            },
                            {
                                "data": "itemstotal"
                            }
                            , {
                                "data": "paymentstatus"
                            },
                            {
                                "data": "order_status"
                            },

                            {
                                "data": "action"
                            }
                        ],
                    })
                        .on("xhr.dt", function (e, settings, json, xhr) {
                            $('#totalitems').text(json.totalItemsCount);
                            $('#totalcounts').text(json.totalCount);
                            setTimeout(function () {
                                loadConfirm();
                            }, 1000);
                        });
                }

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

                                location.reload();

                                // $('[data-li-id="' + id + '"] .payment-action').removeClass('selected');
                                //
                                // if (ele.hasClass('selected')) {
                                //
                                //     ele.removeClass('selected');
                                //
                                // } else {
                                //     ele.addClass('selected');
                                // }
                                //
                                // var payment = $('[data-li-id="' + id + '"] .payment-actions').find('.selected')
                                //     .text().trim();
                                //
                                // var payment_class = $('[data-li-id="' + id + '"] .payment-actions').find(
                                //     '.selected').attr('data-class');
                                // $('[data-li-id="' + id + '"] .payment-label').removeClass(
                                //     'unpaid partially-paid paid').addClass(payment_class).text(payment);
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


        @push('scripts')
            <script src="{{ asset('assets/js/plugins/apexcharts.min.js') }}"></script>
            <script src="{{ asset('js/moment.min.js') }}"></script>

            <script>
                (function () {
                    var options = {
                        chart: {
                            height: 325,
                            type: 'area',
                            toolbar: {
                                show: false,
                            },
                        },
                        dataLabels: {
                            enabled: false
                        },
                        stroke: {
                            width: 2,
                            curve: 'smooth'
                        },
                        series: [

                            {
                                name: '{{ __('Sales') }}',
                                data: {!! json_encode($salesArray['value']) !!}
                            },
                        ],
                        xaxis: {
                            categories: {!! json_encode($purchasesArray['label']) !!},
                            title: {
                                text: '{{ __('Days') }}'
                            }
                        },
                        colors: ['#6fd943'],

                        grid: {
                            strokeDashArray: 4,
                        },
                        legend: {
                            show: false,
                        },
                        // markers: {
                        //     size: 4,
                        //     colors: ['#ffa21d', '#FF3A6E'],
                        //     opacity: 0.9,
                        //     strokeWidth: 2,
                        //     hover: {
                        //         size: 7,
                        //     }
                        // },
                        yaxis: {
                            title: {
                                text: '{{ __('Amount') }}'
                            },
                        }
                    };
                    var chart = new ApexCharts(document.querySelector("#traffic-chart"), options);
                    chart.render();
                })();


                $(document).on('click', '.custom-checkbox .custom-control-input', function (e) {
                    $.ajax({
                        url: $(this).data('url'),
                        method: 'PATCH',
                        success: function (response) {
                        },
                        error: function (data) {
                            data = data.responseJSON;
                            show_toastr('{{ __('Error') }}', data.error, 'error')
                        }
                    });
                });
            </script>
        @endpush


        @push('scripts')
            <script src="{{ asset('assets/js/plugins/main.min.js') }}"></script>


            <script type="text/javascript">
                (function () {
                    var etitle;
                    var etype;
                    var etypeclass;
                    var calendar = new FullCalendar.Calendar(document.getElementById('calendar'), {
                        headerToolbar: {
                            left: 'prev,next today',
                            center: 'title',
                            right: 'dayGridMonth,timeGridWeek,timeGridDay'
                        },
                        buttonText: {
                            timeGridDay: "{{__('Day')}}",
                            timeGridWeek: "{{__('Week')}}",
                            dayGridMonth: "{{__('Month')}}"
                        },
                        themeSystem: 'bootstrap',

                        slotDuration: '00:10:00',
                        navLinks: true,
                        droppable: true,
                        selectable: true,
                        selectMirror: true,
                        editable: true,
                        dayMaxEvents: true,
                        handleWindowResize: true,
                        events: {!! $arrEvents !!},


                        eventClick: function (e) {
                            e.jsEvent.preventDefault();
                            var title = e.title;
                            var url = e.el.href;

                            if (typeof url != 'undefined') {
                                $("#commonModal .modal-title").html(e.event.title);
                                $("#commonModal .modal-dialog").addClass('modal-md');
                                $("#commonModal").modal('show');

                                $.get(url, {}, function (data) {
                                    console.log(data);
                                    $('#commonModal .body ').html(data);

                                    if ($(".d_week").length > 0) {
                                        $($(".d_week")).each(function (index, element) {
                                            var id = $(element).attr('id');

                                            (function () {
                                                const d_week = new Datepicker(document
                                                    .querySelector('#' + id), {
                                                    buttonClass: 'btn',
                                                    format: 'yyyy-mm-dd',
                                                });
                                            })();

                                        });
                                    }


                                });
                                return false;
                            }
                        }

                    });

                    calendar.render();
                })();
            </script>
    @endpush

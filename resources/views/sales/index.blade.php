@extends('layouts.app')

@push('stylesheets')
    <link rel="stylesheet" href="{{ asset('css/jquery-ui.css') }}">
@endpush


@section('title')
    <div class="d-inline-block">
        <h5 class="h4 d-inline-block font-weight-400 mb-0">{{ __('Add Sale') }}</h5>
    </div>
@endsection


@section('breadcrumb')
         <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('Home') }}</a></li>
        <li class="breadcrumb-item">{{ __('Add Sale') }}</li>
@endsection

@section('content')

    @can('Manage Sales')
    <div class="row mt-2">
        <?php $lastsegment = request()->segment(count(request()->segments())); ?>
        <div class="row d-none" id="display-bnc">
            <div class="col-12">
                <div class="card">
                    <div class="card-header py-3">
                        <nav>
                            <ol class="breadcrumb px-2 py-1 fs-14 bg-grey">
                                <li class="breadcrumb-item" id="display-branch"></li>
                                <li class="breadcrumb-item active" id="display-cash-register"></li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <div class="row min-vh-100">
            <div class="col-md-8 col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-12">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-search"></i></span>
                                    </div>
                                    <input id="searchproduct" type="text" data-url="{{ route('search.products') }}"
                                        placeholder="{{ __('Search Product') }}" class="form-control pr-4 rounded-right">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body bg-f5f7f9 b-bottom catgory-pad">
                        <div class="form-row " id="categories-listing">

                        </div>
                    </div>
                    <div class="card-body bg-f5f7f9 product-body-nop">
                        <div class="form-row" id="product-listing">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-lg-4 side-cart">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-12">
                                <div class="input-group search_vendor_merge_input">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i data-feather="user"></i></span>
                                    </div>
                                    {{ Form::text('searchcustomers', null, ['class' => 'form-control pr-4 rounded-right', 'id' => 'searchcustomers', 'placeholder' => __('Search Customer')]) }}
                                    <a href="#" id="clearinput">
                                        <div class="input-group-text">
                                            <i data-feather="x-square"></i>
                                        </div>
                                    </a>
                                    {{ Form::hidden('vc_name_hidden', '', ['id' => 'vc_name_hidden']) }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="card card-body carttable cart-product-list" id="carthtml"
                                style="margin-top: 5px;margin-bottom: 3px;">

                                @php $total = 0 @endphp
                                @if (session($lastsegment) && !empty(session($lastsegment)) && count(session($lastsegment)) > 0)
                                    @foreach (session($lastsegment) as $id => $details)
                                        @php
                                            $product = \App\Models\Product::find($details['id']);
                                            $total += $details['subtotal'];
                                        @endphp

                                        <div class="row mt-3 d-flex align-items-center" data-product-id="{{ $id }}"
                                            id="product-id-{{ $id }}">
                                            <div class="col-sm-2 cart-images">
                                                <img alt="Image placeholder" src="storage/{{$product->image}} "
                                                    class="card-image avatar rounded-circle-sale shadow hover-shadow-lg">
                                            </div>
                                            <div class="col-sm-10">
                                                <div class="row">
                                                    <div class="col-sm-7">
                                                        <span class="name">{{ $details['name'] }}</span>
                                                    </div>
                                                    <div class="col-sm-5">
                                                        <span
                                                            class="price">{{ Auth::user()->priceFormat($details['price']) }}</span>
                                                    </div>
                                                    <div class="col-sm-5 mt-2">
                                                        <span class="quantity buttons_added">
                                                            <input type="button" value="-" class="minus">
                                                            <input type="number" step="1" min="1" max="" name="quantity"
                                                                style="width: 50px" title="{{ __('Quantity') }}"
                                                                class="input-number" data-url="{{ url('update-cart/') }}"
                                                                data-id="{{ $id }}" size="4"
                                                                value="{{ $details['quantity'] }}">
                                                            <input type="button" value="+" class="plus">
                                                        </span>
                                                    </div>
                                                    <div class="col-sm-2 mt-2" style="margin-left: 19px;">
{{--                                                        <span class="tax">{{ $details['tax'] }}%</span>--}}
                                                    </div>
                                                    <div class="col-sm-3 mt-2" style="margin-left: -19px;">
                                                        <span
                                                            class="subtotal">{{ Auth::user()->priceFormat($details['subtotal']) }}</span>
                                                    </div>
                                                    <div class="col-sm-2 mt-2">
                                                        <a href="#" class="action-btn bg-danger bs-pass-para"
                                                            data-confirm="{{ __('Are You Sure?') }}"
                                                            data-text="{{ __('This action can not be undone. Do you want to continue?') }}"
                                                            data-confirm-yes="delete-form-{{ $id }}"
                                                            title="{{ __('Delete') }}" data-id="{{ $id }}">
                                                            <i class="ti ti-trash ti ti-trash text-white mx-3 btn btn-sm" title="{{ __('Delete') }}"></i>
                                                        </a>
                                                        {!! Form::open(['method' => 'delete', 'url' => ['remove-from-cart'], 'id' => 'delete-form-' . $id]) !!}
                                                        <input type="hidden" name="session_key" value="{{ $lastsegment }}">
                                                        <input type="hidden" name="id" value="{{ $id }}">
                                                        {!! Form::close() !!}
                                                    </div>



                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif

                            </div>
                            <div class="card carts card-body col" style="margin-top: 3px;">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <strong>{{ __('Total') }}</strong>
                                    </div>
                                    <div class="col-sm-6">
                                        <span id="displaytotal">{{ Auth::user()->priceFormat($total) }}</span>
                                    </div>
                                </div>
                                <div class="tab-content mt-2" id="btn-pur">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <button type="button" class="btn btn-primary rounded" style="width: 100%" data-ajax-popup="true" data-size="lg"
                                                data-align="centered" data-url="{{ route('sales.create') }}"
                                                data-title="{{ __('Sale Products') }}"
                                                @if (session($lastsegment) && !empty(session($lastsegment)) && count(session($lastsegment)) > 0) @else disabled="disabled" @endif>{{ __('PAY') }}</button>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="tab-content  btn-empty text-center">
                                                <a href="#" class="btn btn-danger bs-pass-para rounded" style="width: 100%" data-toggle="tooltip"
                                                    data-original-title="{{ __('Empty Cart') }}"
                                                    data-confirm="{{ __('Are You Sure?') }}" data-text="{{__('This action can not be undone. Do you want to continue?')}}"
                                                    data-confirm-yes="delete-form-emptycart">
                                                    {{ __('Empty Cart') }}
                                                </a>
                                                {!! Form::open(['method' => 'post', 'url' => ['empty-cart'], 'id' => 'delete-form-emptycart']) !!}
                                                <input type="hidden" name="session_key" value="{{ $lastsegment }}">
                                                {!! Form::close() !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="branchModal" class="modal fade" role="dialog" data-bs-backdrop="static" data-keyboard="false">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        <span
                            class="select-warning border border-warning">{{ __('Please select Branch and Cash Register.') }}</span>

                        <div class="d-none branch-warning warning alert alert-warning alert-dismissible fade show mt-3"
                            role="alert">
                            <span class="alert-icon"><i class="fa fa-exclamation-triangle"></i></span>
                            <span class="alert-text">
                                <strong> {{ __('Please add some') }} <a
                                        href="{{ route('branches.index') }}">{{ __('Branches') }}</a> {{ ' and ' }}
                                    <a href="{{ route('cashregisters.index') }}">{{ __('Cash Registers') }}</a></strong>
                            </span>
                        </div>
                        <div class="form-group">
                            {{ Form::label('branch_id', __('Branch'), ['class' => 'col-form-label']) }}
                            <div class="input-group">
                                {{ Form::select('branch_id', ['' => __('Select Branch Type')], null, ['class' => 'form-control']) }}
                            </div>
                        </div>
                        <div class="form-group">
                            {{ Form::label('cash_register_id', __('Cash Register'), ['class' => 'col-form-label']) }}
                            <div class="input-group">
                                {{ Form::select('cash_register_id', ['' => __('Select Cash Register')], null, ['class' => 'form-control']) }}
                            </div>
                        </div>
                        <a href="{{ route('home') }}" class="btn btn-primary float-end">{{ __('Go to Home') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endcan

@endsection

@push('scripts')
    <script src="{{ asset('js/jquery-ui.js') }}"></script>
    <script>
        $(function() {
            getProductCategories();
            if ($('#searchproduct').length > 0) {
                var url = $('#searchproduct').data('url');
                searchProducts(url, '', '');
            }

            $.ajax({
                url: '{{ route('user.type') }}',
                dataType: 'json',
                success: function(data) {
                    if (data) {
                        if (data[0].isOwner = 'false') {
                            $.ajax({
                                url: '{{ route('get.branches') }}',
                                dataType: 'json',
                                success: function(data) {

                                    if (data.length == 0) {

                                        $('#branchModal .branch-warning').removeClass(
                                            'd-none');
                                    } else {
                                        $('#branchModal ').modal('show');
                                        $.each(data, function(key, value) {
                                            $('#branch_id')
                                                .append($("<option></option>")
                                                    .attr("value", value.id)
                                                    .text(value.name));
                                        });
                                    }

                                    if ($('[data-toggle="select"]').length > 0) {
                                        $("select option[value='']").prop('disabled', !$(
                                            "select option[value='']").prop(
                                            'disabled'));
                                        $('[data-toggle="select"]').select2({});
                                    }
                                    $('#branchModal').modal({
                                        backdrop: 'static',
                                        keyboard: false
                                    })

                                },
                                error: function(data) {
                                    data = data.responseJSON;
                                    show_toastr('{{ __('Error') }}', data.message,
                                        'error');
                                }
                            });
                        } else if (data[0].isUser = 'false') {
                            $('#display-branch').text(data[0].branchname);
                            $('#display-cash-register').text(data[0].cashregistername);

                            $('#branch_id')
                                .append($("<option></option>")
                                    .attr("value", data[0].branch_id)
                                    .text(data[0].branchname));
                            $('#cash_register_id')
                                .append($("<option></option>")
                                    .attr("value", data[0].cash_register_id)
                                    .text(data[0].cashregistername));
                            $('#branch_id').val(data[0].branch_id);
                            $('#cash_register_id').val(data[0].cash_register_id);
                            $('#display-bnc').removeClass('d-none');
                            $('#display-bnc').show();
                        }
                    }
                },
                error: function(data) {
                    data = data.responseJSON;
                    show_toastr('{{ __('Error') }}', data.message, 'error');
                }
            });

            $(document).on('change', '#branch_id', function(e) {
                $.ajax({
                    url: '{{ route('get.cash.registers') }}',
                    dataType: 'json',
                    data: {
                        'branch_id': $(this).val()
                    },
                    success: function(data) {
                        $('#cash_register_id').find('option').not(':first').remove();
                        $.each(data, function(key, value) {
                            $('#cash_register_id')
                                .append($("<option></option>")
                                    .attr("value", value.id)
                                    .text(value.name));
                        });
                    },
                    error: function(data) {
                        data = data.responseJSON;
                        show_toastr('{{ __('Error') }}', data.message, 'error');
                    }
                });
            });

            $(document).on('change', '#cash_register_id', function(e) {
                if ($(this).val() != '') {
                    $('#display-branch').text($('#branch_id option:selected').text());
                    $('#display-cash-register').text($('#cash_register_id option:selected').text());
                    $('#display-bnc').removeClass('d-none');
                    $('#display-bnc').show();
                    $('#branchModal').modal('toggle');
                    var cat = $('.cat-active').children().data('cat-id');
                    searchProducts(url, '', cat);
                }
            });
            $("#searchcustomers").autocomplete({
                    minLength: 0,
                    source: function(request, response) {
                        $.getJSON("{{ route('search.customers') }}", {
                            search: request.term
                        }, response);
                    },
                    search: function() {
                        var term = this.value;
                        if (term.length == 0) {
                            $("#vc_name_hidden").val('');
                        }
                        if (term.length < 2) {
                            return false;
                        }
                    },
                    focus: function(event, ui) {
                        $("#searchcustomers, #vc_name_hidden").val(ui.item.label);
                        return false;
                    },
                    select: function(event, ui) {
                        $("#searchcustomers, #vc_name_hidden").val(ui.item.label);
                        return false;
                    }
                })
                .autocomplete("instance")._renderItem = function(ul, item) {

                    return $("<li>")
                        .append("<div>" + item.label + "<br>" + item.email + "</div>")
                        .appendTo(ul);
                };

            $(document).on('click', '#clearinput', function(e) {
                var IDs = [];
                $(this).closest('div').find("input").each(function() {
                    IDs.push('#' + this.id);
                });
                $(IDs.toString()).val('');
            });

            $(document).on('keyup', 'input#searchproduct', function() {
                var url = $(this).data('url');
                var value = this.value;
                var cat = $('.cat-active').children().data('cat-id');
                searchProducts(url, value, cat);
            });

            function searchProducts(url, value, cat_id) {
                $.ajax({
                    type: 'GET',
                    url: url,
                    data: {
                        'search': value,
                        'cat_id': cat_id,
                        'session_key': session_key
                    },
                    success: function(data) {
                        $('#product-listing').html(data);
                    }
                });
            }

            function getProductCategories() {
                $.ajax({
                    type: 'GET',
                    url: '{{ route('product.categories') }}',
                    success: function(data) {
                        $('#categories-listing').html(data);
                    }
                });
            }

            $(document).on('click', '.toacart', function() {
                var sum = 0;
                $.ajax({
                    url: $(this).data('url'),
                    success: function(data) {

                        if (data.code == '200') {

                            $('#displaytotal').text(addCommas(data.product.subtotal));

                            if ('carttotal' in data) {
                                $.each(data.carttotal, function(key, value) {
                                    $('#product-id-' + value.id + ' .subtotal').text(
                                        addCommas(value.subtotal));
                                    sum += value.subtotal;
                                });
                                $('#displaytotal').text(addCommas(sum));
                            }

                            $('#carthtml').append(data.carthtml);

                            $('.carttable #product-id-' + data.product.id +
                                ' input[name="quantity"]').val(data.product.quantity);
                            $('#btn-pur button').removeAttr('disabled');
                            $('.btn-empty button').addClass('btn-clear-cart');
                            loadConfirm();
                        }
                    },
                    error: function(data) {
                        data = data.responseJSON;
                        show_toastr('{{ __('Error') }}', data.error, 'error');
                    }
                });
            });

            $(document).on('change keyup', '#carthtml input[name="quantity"]', function(e) {
                e.preventDefault();
                var ele = $(this);
                var sum = 0;
                var quantity = ele.closest('span').find('input[name="quantity"]').val();

                $.ajax({
                    url: ele.data('url'),
                    method: "patch",
                    data: {
                        id: ele.attr("data-id"),
                        quantity: quantity,
                        session_key: session_key
                    },
                    success: function(data) {

                        if (data.code == '200') {

                            if (quantity == 0) {
                                ele.closest(".row").hide(250, function() {
                                    ele.closest(".row").remove();
                                });
                                if (ele.closest(".row").is(":last-child")) {
                                    $('#btn-pur button').attr('disabled', 'disabled');
                                    $('.btn-empty button').removeClass('btn-clear-cart');
                                }
                            }

                            $.each(data.product, function(key, value) {
                                sum += value.subtotal;
                                $('#product-id-' + value.id + ' .subtotal').text(
                                    addCommas(value.subtotal));
                            });

                            $('#displaytotal').text(addCommas(sum));
                        }
                    },
                    error: function(data) {
                        data = data.responseJSON;
                        show_toastr('{{ __('Error') }}', data.error, 'error');
                    }
                });
            });

            $(document).on('click', '.remove-from-cart', function(e) {
                e.preventDefault();

                var ele = $(this);
                var sum = 0;

                if (confirm('{{ __('Are you sure?') }}')) {
                    ele.closest(".row").hide(250, function() {
                        ele.closest(".row").parent().parent().remove();
                    });
                    if (ele.closest(".row").is(":last-child")) {
                        $('#btn-pur button').attr('disabled', 'disabled');
                        $('.btn-empty button').removeClass('btn-clear-cart');
                    }
                    $.ajax({
                        url: ele.data('url'),
                        method: "DELETE",
                        data: {
                            id: ele.attr("data-id"),
                            session_key: session_key
                        },
                        success: function(data) {
                            if (data.code == '200') {

                                $.each(data.product, function(key, value) {
                                    sum += value.subtotal;
                                    $('#product-id-' + value.id + ' .subtotal').text(
                                        addCommas(value.subtotal));
                                });

                                $('#displaytotal').text(addCommas(sum));

                                show_toastr('Success', data.success, 'success')
                            }
                        },
                        error: function(data) {
                            data = data.responseJSON;
                            show_toastr('{{ __('Error') }}', data.error, 'error');
                        }
                    });
                }
            });

            $(document).on('click', '.btn-clear-cart', function(e) {
                e.preventDefault();

                if (confirm('{{ __('Remove all items from cart?') }}')) {

                    $.ajax({
                        url: $(this).data('url'),
                        data: {
                            session_key: session_key
                        },
                        success: function(data) {
                            location.reload();
                        },
                        error: function(data) {
                            data = data.responseJSON;
                            show_toastr('{{ __('Error') }}', data.error, 'error');
                        }
                    });
                }
            });

            $(document).on('click', '.btn-done-payment', function(e) {
                e.preventDefault();

                var ele = $(this);

                $.ajax({
                    url: ele.data('url'),
                    method: 'POST',
                    data: {
                        vc_name: $('#vc_name_hidden').val(),
                        branch_id: $('#branch_id').val(),
                        cash_register_id: $('#cash_register_id').val(),
                    },
                    beforeSend: function() {
                        ele.remove();
                    },
                    success: function(data) {
                        if (data.code == 200) {
                            show_toastr('Success', data.success, 'success')
                        }
                        setTimeout(function() {
                            window.location.reload();
                        }, 1000);
                    },
                    error: function(data) {
                        data = data.responseJSON;
                        show_toastr('{{ __('Error') }}', data.error, 'error');
                    }
                });
            });

            $(document).on('click', '.category-select', function(e) {
                var cat = $(this).data('cat-id');
                var white = 'text-white';
                var dark = 'text-dark';
                $('.category-select').parent().removeClass('cat-active');
                $('.category-select').find('.card-title').removeClass('text-white').addClass('text-dark');
                $('.category-select').find('.card-title').parent().removeClass('text-white').addClass(
                    'text-dark');
                $(this).find('.card-title').removeClass('text-dark').addClass('text-white');
                $(this).find('.card-title').parent().removeClass('text-dark').addClass('text-white');
                $(this).parent().addClass('cat-active');
                var url = '{{ route('search.products') }}'
                searchProducts(url, '', cat);
            });

        });
    </script>
@endpush


@push('old-datatable-js')
    <script>
        var site_currency_symbol_position = '{{ \App\Models\Utility::getValByName('site_currency_symbol_position') }}';
        var site_currency_symbol = '{{ \App\Models\Utility::getValByName('site_currency_symbol') }}';
    </script>
@endpush

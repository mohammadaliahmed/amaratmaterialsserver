@php
    $user = Auth::user();
    if ($user) {
        $currantLang = $user->lang;
        $languages = \App\Models\Utility::languages();
    }

    $emailTemplate     = App\Models\EmailTemplate::first();

    // $logo = asset(Storage::url('logo'));
    $logo=\App\Models\Utility::get_file('uploads/logo/');

    $company_logo = App\Models\Utility::get_superadmin_logo();

    $cust_theme_bg = App\Models\Utility::getValByName('cust_theme_bg');
@endphp

@if ((isset($cust_theme_bg) && $cust_theme_bg == 'on'))
    <nav class="dash-sidebar light-sidebar transprent-bg">
        @else
            <nav class="dash-sidebar light-sidebar">
                @endif


                <div class="navbar-wrapper">
{{--                    <div class="m-header bg-primary">--}}
{{--                        <a href="{{ route('home') }}" class="b-brand">--}}
{{--                            <!-- ========   change your logo hear   ============ -->--}}
{{--                            <center>--}}
{{--                                <img height="150"--}}
{{--                                     src="{{ $logo . (isset($company_logo) && !empty($company_logo) ? $company_logo : 'logo-dark.png') }}"--}}
{{--                                     alt="{{ config('app.name', 'Posgo') }}">--}}
{{--                            </center>--}}

{{--                        </a>--}}
{{--                    </div>--}}
                    <br>


                    <div class="navbar-content">
                        <ul class="dash-navbar">
                            <li class="dash-item  {{ Request::segment(1) == '' ? 'active' : '' }}">
                                <a href="{{ route('home') }}" class="dash-link"><span class="dash-micon"><i
                                            class="ti ti-home"></i></span><span
                                        class="dash-mtext">{{ __('Dashboard') }}</span></a>
                            </li>

                            @can('Manage Sales')
                                <li class="dash-item">
                                    <a href="#" class="dash-link"><span class="dash-micon"><i
                                                class="ti ti-book"></i></span><span
                                            class="dash-mtext">{{ __('Sales') }}</span><span class="dash-arrow"><i
                                                data-feather="chevron-right"></i></span></a>


                                    <ul class="dash-submenu">

                                        @can('Manage Product')
                                            <li class="">
                                                <a class="dash-link" href="{{ route('sales.index') }}">Add Sale</a>
                                            </li>
                                        @endcan


                                    </ul>
                                </li>
                            @endcan

                            @can('Manage Customer')
                                <li class="dash-item ">
                                    <a href="{{ route('customers.index') }}"
                                       class="dash-link {{ Request::segment(1) == 'customers' ? 'active' : '' }}"><span
                                            class="dash-micon"><i class="ti ti-user"></i></span><span
                                            class="dash-mtext">{{ __('Customers') }}</span>
                                    </a>
                                </li>
                            @endcan


                            <li class="dash-item dash-hasmenu">
                                <a href="#" class="dash-link"><span class="dash-micon"><i
                                            class="ti ti-brand-producthunt"></i></span><span
                                        class="dash-mtext">Products</span><span class="dash-arrow"><svg
                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="feather feather-chevron-right"><polyline
                                                points="9 18 15 12 9 6"></polyline></svg></span></a>


                                <ul class="dash-submenu" style="display: none;">

                                    <li class="dash-item dash-hasmenu">
                                        <a class="dash-link" href="{{ route('products.index') }}">Products</a>
                                    </li>

                                    <li class="dash-item dash-hasmenu">
                                        <a class="dash-link"
                                           href="{{ route('categories.index') }}">Categories</a>
                                    </li>

                                    <li class="dash-item dash-hasmenu">
                                        <a class="dash-link" href="{{ route('brands.index') }}">Brands</a>
                                    </li>


                                    <li class="dash-item dash-hasmenu">
                                        <a class="dash-link" href="{{ route('units.index') }}">Unit</a>
                                    </li>

                                </ul>
                            </li>
                            <li class="dash-item dash-hasmenu">
                                <a href="#" class="dash-link"><span class="dash-micon"><i
                                            class="ti ti-user-plus"></i></span><span
                                        class="dash-mtext">Vendors</span><span class="dash-arrow"><svg
                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="feather feather-chevron-right"><polyline
                                                points="9 18 15 12 9 6"></polyline></svg></span></a>


                                <ul class="dash-submenu" style="display: none;">

                                    <li class="dash-item dash-hasmenu">
                                        <a class="dash-link" href="{{ route('vendors.index') }}">Vendors</a>
                                    </li>

                                    <li class="dash-item dash-hasmenu">
                                        <a class="dash-link" href="{{ route('vendors.orders') }}">Assigned
                                            Orders</a>
                                    </li>


                                </ul>
                            </li>

                            <li class="dash-item dash-hasmenu">
                                <a href="#" class="dash-link"><span class="dash-micon"><i
                                            class="ti ti-users"></i></span><span
                                        class="dash-mtext">Staff</span><span class="dash-arrow"><svg
                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="feather feather-chevron-right"><polyline
                                                points="9 18 15 12 9 6"></polyline></svg></span></a>


                                <ul class="dash-submenu" style="display: none;">

                                    <li class="dash-item dash-hasmenu">
                                        <a class="dash-link" href="{{ route('users.index') }}">Users</a>
                                    </li>


                                </ul>
                            </li>
                            <li class="dash-item dash-hasmenu">
                                <a href="#" class="dash-link"><span class="dash-micon"><i
                                            class="ti ti-report"></i></span><span
                                        class="dash-mtext">Reports</span><span class="dash-arrow"><svg
                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="feather feather-chevron-right"><polyline
                                                points="9 18 15 12 9 6"></polyline></svg></span></a>


                                <ul class="dash-submenu" style="display: none;">

                                    <li class="dash-item dash-hasmenu">
                                        <a class="dash-link"
                                           href="{{ route('customer.sales.analysis') }}">{{ __('Customer Report') }}</a>

                                    </li>
                                    <li class="dash-item dash-hasmenu">
                                        <a class="dash-link"
                                           href="{{ route('reports.sales') }}">{{ __('Sale Report') }}</a>

                                    </li>
                                    <li class="dash-item dash-hasmenu">
                                        <a class="dash-link"
                                           href="{{ route('reports.product') }}">{{ __('Product Report') }}</a></li>
                                    <li class="dash-item dash-hasmenu">
                                        <a class="dash-link"
                                           href="{{ route('reports.vendor') }}">{{ __('Vendor Report') }}</a>

                                    </li>


                                </ul>
                            </li>

                            <li class="dash-item dash-hasmenu">
                                <a href="#" class="dash-link"><span class="dash-micon"><i
                                            class="ti ti-list"></i></span><span
                                        class="dash-mtext">Ledger</span><span class="dash-arrow"><svg
                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="feather feather-chevron-right"><polyline
                                                points="9 18 15 12 9 6"></polyline></svg></span></a>


                                <ul class="dash-submenu" style="display: none;">

                                    <li class="dash-item dash-hasmenu">
                                        <a class="dash-link" href="{{ route('locations') }}">Vendor Ledger</a>
                                    </li>
                                    <li class="dash-item dash-hasmenu">
                                        <a class="dash-link" href="{{ route('locations') }}">Customer Ledger</a>
                                    </li>


                                </ul>
                            </li>
                            <li class="dash-item dash-hasmenu">
                                <a href="#" class="dash-link"><span class="dash-micon"><i
                                            class="ti ti-pin"></i></span><span
                                        class="dash-mtext">Locations</span><span class="dash-arrow"><svg
                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="feather feather-chevron-right"><polyline
                                                points="9 18 15 12 9 6"></polyline></svg></span></a>


                                <ul class="dash-submenu" style="display: none;">

                                    <li class="dash-item dash-hasmenu">
                                        <a class="dash-link" href="{{ route('locations') }}">Manage Locations</a>
                                    </li>


                                </ul>
                            </li>


                        </ul>
                    </div>


                </div>

            </nav>
    </nav>

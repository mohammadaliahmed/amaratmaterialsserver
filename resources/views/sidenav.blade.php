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
                    <div class="m-header bg-primary">
                        <a href="{{ route('home') }}" class="b-brand">
                            <!-- ========   change your logo hear   ============ -->
                            <center>
                                <img height="150"
                                     src="{{ $logo . (isset($company_logo) && !empty($company_logo) ? $company_logo : 'logo-dark.png') }}"
                                     alt="{{ config('app.name', 'Posgo') }}">
                            </center>

                        </a>
                    </div>
                    <br>

                    <div class="navbar-content">
                        <ul class="dash-navbar">
                            <li class="dash-item  {{ Request::segment(1) == '' ? 'active' : '' }}">
                                <a href="{{ route('home') }}" class="dash-link"><span class="dash-micon"><i
                                            class="ti ti-home"></i></span><span
                                        class="dash-mtext">{{ __('Dashboard') }}</span></a>
                            </li>


                            {{--                            <li class="dash-item">--}}
                            {{--                                <a href="{{ route('reports.sales') }}" class="dash-link"><span class="dash-micon"><i--}}
                            {{--                                            class="ti ti-book"></i></span><span--}}
                            {{--                                        class="dash-mtext">{{ __('Orders') }}</span><span class="dash-arrow"><i--}}
                            {{--                                            data-feather="chevron-right"></i></span></a>--}}

                            {{--                            </li>--}}
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


                            @can('Manage Vendor')

                                <li class="dash-item">
                                    <a href="#" class="dash-link"><span class="dash-micon"><i
                                                class="ti ti-brand-producthunt"></i></span><span
                                            class="dash-mtext">{{ __('Vendors') }}</span><span class="dash-arrow"><i
                                                data-feather="chevron-right"></i></span></a>
                                    <ul class="dash-submenu">


                                        <li class="">
                                            <a class="dash-link" href="{{ route('vendors.index') }}">Vendors</a>
                                        </li>
                                        <li class="">
                                            <a class="dash-link" href="{{ route('vendors.orders') }}">Assigned
                                                Orders</a>
                                        </li>
                                    </ul>
                                </li>
                            @endcan


                            @if (Gate::check('Manage Product') || Gate::check('Manage Category') || Gate::check('Manage Brand') || Gate::check('Manage Tax') || Gate::check('Manage Unit'))

                                <li class="dash-item">
                                    <a href="#" class="dash-link"><span class="dash-micon"><i
                                                class="ti ti-brand-producthunt"></i></span><span
                                            class="dash-mtext">{{ __('Products') }}</span><span class="dash-arrow"><i
                                                data-feather="chevron-right"></i></span></a>


                                    <ul class="dash-submenu">

                                        @can('Manage Product')
                                            <li class="">
                                                <a class="dash-link" href="{{ route('products.index') }}">Products</a>
                                            </li>
                                        @endcan

                                        @can('Manage Category')
                                            <li class="">
                                                <a class="dash-link"
                                                   href="{{ route('categories.index') }}">Categories</a>
                                            </li>
                                        @endcan

                                        @can('Manage Brand')
                                            <li class="">
                                                <a class="dash-link" href="{{ route('brands.index') }}">Brands</a>
                                            </li>
                                        @endcan

                                        {{--                                        @can('Manage Tax')--}}
                                        {{--                                            <li class="">--}}
                                        {{--                                                <a class="dash-link" href="{{ route('taxes.index') }}">Tax</a>--}}
                                        {{--                                            </li>--}}
                                        {{--                                        @endcan--}}

                                        @can('Manage Unit')
                                            <li class="">
                                                <a class="dash-link" href="{{ route('units.index') }}">Unit</a>
                                            </li>
                                        @endcan

                                    </ul>
                                </li>
                            @endif

                            {{--                            @can('Manage Purchases')--}}
                            {{--                                <li class="">--}}
                            {{--                                    <a href="#navbar-purchases"--}}
                            {{--                                       class="dash-link {{ Request::segment(1) == 'purchases' || Request::segment(1) . '/' . Request::segment(2) == 'reports/purchases' ? 'active' : '' }}"><span--}}
                            {{--                                            class="dash-micon"><i class="ti ti-shopping-cart"></i></span><span--}}
                            {{--                                            class="dash-mtext">{{ __('Purchases') }}</span><span class="dash-arrow"><i--}}
                            {{--                                                data-feather="chevron-right"></i></span></a>--}}


                            {{--                                    <ul class="dash-submenu">--}}

                            {{--                                        @can('Manage Product')--}}
                            {{--                                            <li class="">--}}
                            {{--                                                <a class="dash-link" href="{{ route('purchases.index') }}">Add--}}
                            {{--                                                    Purchase</a>--}}
                            {{--                                            </li>--}}
                            {{--                                        @endcan--}}

                            {{--                                        @can('Manage Category')--}}
                            {{--                                            <li class="">--}}
                            {{--                                                <a class="dash-link"--}}
                            {{--                                                   href="{{ route('reports.purchases') }}">Purchases</a>--}}
                            {{--                                            </li>--}}
                            {{--                                        @endcan--}}

                            {{--                                    </ul>--}}
                            {{--                                </li>--}}
                            {{--                            @endcan--}}



                            {{--            @can('Manage Returns')--}}

                            {{--                <li class="dash-item {{ \Request::route()->getName() == 'productsreturn.index' || \Request::route()->getName() == 'productsreturn.edit' || \Request::route()->getName() == 'productsreturn.create' ? ' active' : '' }}">--}}
                            {{--                    <a href="{{ !empty(\Auth::user()->getDefualtViewRouteByModule('productsreturn')) ? route(\Auth::user()->getDefualtViewRouteByModule('productsreturn')) : route('productsreturn.index') }}" class="dash-link ">--}}
                            {{--                        <span class="dash-micon"><i class="ti ti-receipt-refund"></i></span><span class="dash-mtext">{{ __('Returns') }}</span>--}}
                            {{--                    </a>--}}
                            {{--                </li>--}}
                            {{--            @endcan--}}

                            {{--                            @can('Manage Quotations')--}}
                            {{--                                <li class="dash-item {{ \Request::route()->getName() == 'quotations.index' || \Request::route()->getName() == 'quotations.edit' || \Request::route()->getName() == 'quotations.create' ? ' active' : '' }}">--}}
                            {{--                                    <a href="{{ !empty(\Auth::user()->getDefualtViewRouteByModule('quotations')) ? route(\Auth::user()->getDefualtViewRouteByModule('quotations')) : route('quotations.index') }}"--}}
                            {{--                                       class="dash-link ">--}}
                            {{--                                        <span class="dash-micon"><i class="ti ti-currency-pound"></i></span><span--}}
                            {{--                                            class="dash-mtext">{{ __('Quotations') }}</span>--}}
                            {{--                                    </a>--}}
                            {{--                                </li>--}}
                            {{--                                </li>--}}
                            {{--                            @endcan--}}

                            {{--            @if (Gate::check('Manage Expense') || Gate::check('Manage Expense Category'))--}}
                            {{--                <li class="">--}}
                            {{--                    <a href="#"--}}
                            {{--                        class="dash-link {{ Request::segment(1) == 'expenses' || Request::segment(1) == 'expensecategories' ? 'active' : '' }}"><span--}}
                            {{--                            class="dash-micon"><i class="ti ti-report-money"></i></span><span--}}
                            {{--                            class="dash-mtext">{{ __('Expenses') }}</span><span class="dash-arrow"><i--}}
                            {{--                                data-feather="chevron-right"></i></span></a>--}}


                            {{--                    <ul class="dash-submenu">--}}

                            {{--                        @can('Manage Expense')--}}
                            {{--                            <li class="">--}}
                            {{--                                <a class="dash-link" href="{{ route('expenses.index') }}">Expense List</a>--}}
                            {{--                            </li>--}}
                            {{--                        @endcan--}}

                            {{--                        @can('Manage Expense Category')--}}
                            {{--                            <li class="">--}}
                            {{--                                <a class="dash-link" href="{{ route('expensecategories.index') }}">Expense--}}
                            {{--                                    Category</a>--}}
                            {{--                            </li>--}}
                            {{--                        @endcan--}}

                            {{--                    </ul>--}}
                            {{--                </li>--}}
                            {{--            @endif--}}


                            {{--                            @can('Manage Calendar Event')--}}
                            {{--                                <li class="dash-item ">--}}
                            {{--                                    <a href="{{ route('calendars.index') }}"--}}
                            {{--                                       class="dash-link {{ Request::segment(1) == 'calendars' ? 'active' : '' }}"><span--}}
                            {{--                                            class="dash-micon"><i class="ti ti-calendar"></i></span><span--}}
                            {{--                                            class="dash-mtext">{{ __('Calendar') }}</span>--}}
                            {{--                                    </a>--}}
                            {{--                                </li>--}}
                            {{--                            @endcan--}}


                            {{--                            @can('Manage Notification')--}}
                            {{--                                <li class="dash-item ">--}}
                            {{--                                    <a href="{{ route('notifications.index') }}"--}}
                            {{--                                       class="dash-link {{ Request::segment(1) == 'notifications' ? 'active' : '' }}"><span--}}
                            {{--                                            class="dash-micon"><i class="ti ti-notification"></i></span><span--}}
                            {{--                                            class="dash-mtext">{{ __('Notifications') }}</span>--}}
                            {{--                                    </a>--}}
                            {{--                                </li>--}}
                            {{--                            @endcan--}}

                            {{--            @if (\Auth::user()->type == 'Owner')--}}
                            {{--                <li class="dash-item {{ (Request::route()->getName() == 'email_template.index' || Request::segment(1) == 'email_template_lang' || Request::route()->getName() == 'manageemail.lang') ? 'active' : '' }}">--}}
                            {{--                    <a href="{{ route('manage.email.language',[$emailTemplate ->id,\Auth::user()->lang]) }}" class="dash-link"><span--}}
                            {{--                            class="dash-micon"><i class="ti ti-template"></i></span><span--}}
                            {{--                            class="dash-mtext">{{ __('Email Template') }}</span></a>--}}
                            {{--                </li>--}}
                            {{--            @endif--}}


                            {{-- <!--
                                 @can('Create Language')
                                         <li class="">
                                        <a href="{{ route('manage.language', Auth::user()->lang) }}"
                                            class="dash-link {{ Request::segment(1) == 'manage-language' ? 'active' : '' }}"><span
                                                class="dash-micon"><i class="ti ti-language"></i></span><span
                                                class="dash-mtext">{{ __('Language') }}</span>
                                        </a>
                                    </li>
                            @endcan --> --}}

                            @if (Gate::check('Manage User') || Gate::check('Manage Role') || Gate::check('Manage Permission'))
                                <li class="">
                                    <a href="#!" class="dash-link"><span class="dash-micon"><i class="ti ti-users"></i></span><span
                                            class="dash-mtext">{{ __('Staff') }}</span><span class="dash-arrow"><i
                                                data-feather="chevron-right"></i></span></a>
                                    <ul class="dash-submenu">

                                        @can('Manage User')
                                            <li class="">
                                                <a class="dash-link" href="{{ route('users.index') }}">Users</a>
                                            </li>
                                        @endcan

                                        {{--                                        @can('Manage Role')--}}
                                        {{--                                            <li class="">--}}
                                        {{--                                                <a class="dash-link" href="{{ route('roles.index') }}">Roles</a>--}}
                                        {{--                                            </li>--}}
                                        {{--                                        @endcan--}}

                                    </ul>
                                </li>
                            @endif

                            @can('Manage Coupon')
                                <li class="">
                                    <a href="{{ route('coupons.index') }}"
                                       class="dash-link {{ Request::segment(1) == 'coupons' || \Request::route()->getName() == 'coupons.view' ? 'active' : '' }}"><span
                                            class="dash-micon"><i class="ti ti-gift"></i></span><span
                                            class="dash-mtext">{{ __('Coupons') }}</span>
                                    </a>
                                </li>
                            @endcan

                            @if (Gate::check('Manage Product') || Gate::check('Manage Category') || Gate::check('Manage Brand') || Gate::check('Manage Tax') || Gate::check('Manage Expense') || Gate::check('Manage Customer') || Gate::check('Manage Vendor') || Gate::check('Manage Purchases') || Gate::check('Manage Sales'))
                                <li
                                    class="  {{ Request::segment(1) == 'product-stock-analysis' ||
                                                Request::segment(1) == 'product-category-analysis' ||
                                                Request::segment(1) == 'product-brand-analysis' ||
                                                Request::segment(1) == 'product-tax-analysis' ||
                                                Request::segment(1) == 'expense-analysis' ||
                                                Request::segment(1) == 'customer-sales-analysis' ||
                                                Request::segment(1) == 'vendor-purchased-analysis' ||
                                                Request::segment(1) == 'purchased-daily-analysis' ||
                                                Request::segment(1) == 'purchased-monthly-analysis' ||
                                                Request::segment(1) == 'sold-daily-analysis' ||
                                                Request::segment(1) == 'sold-monthly-analysis'
                                                    ? 'active dash-trigger'
                                                    : '' }}">
                                    <a href="#" class="dash-link"><span class="dash-micon"><i
                                                class="ti ti-report"></i></span><span
                                            class="dash-mtext">{{ __('Reports') }}</span><span class="dash-arrow"><i
                                                data-feather="chevron-right"></i></span></a>

                                    <ul class="dash-submenu">


                                        {{--                                                    @can('Manage Product')--}}
                                        {{--                                                        <li class="">--}}
                                        {{--                                                            <a class="dash-link"--}}
                                        {{--                                                                href="{{ route('product.stock.analysis') }}">{{ __('Stock Analysis') }}</a>--}}
                                        {{--                                                        </li>--}}
                                        {{--                                                    @endcan--}}

                                        {{--                                                    @can('Manage Category')--}}
                                        {{--                                                        <li class="">--}}
                                        {{--                                                            <a class="dash-link"--}}
                                        {{--                                                                href="{{ route('product.category.analysis') }}">{{ __('Category Report') }}</a>--}}
                                        {{--                                                        </li>--}}
                                        {{--                                                    @endcan--}}

                                        {{--                                                    @can('Manage Brand')--}}
                                        {{--                                                        <li class="">--}}
                                        {{--                                                            <a class="dash-link"--}}
                                        {{--                                                                href="{{ route('product.brand.analysis') }}">{{ __('Brand Report') }}</a>--}}
                                        {{--                                                        </li>--}}
                                        {{--                                                    @endcan--}}

                                        {{--                                                    @can('Manage Tax')--}}
                                        {{--                                                        <li class="">--}}
                                        {{--                                                            <a class="dash-link"--}}
                                        {{--                                                                href="{{ route('product.tax.analysis') }}">{{ __('Tax Report') }}</a>--}}
                                        {{--                                                        </li>--}}
                                        {{--                                                    @endcan--}}

                                        {{--                                                    @can('Manage Expense')--}}
                                        {{--                                                        <li class="">--}}
                                        {{--                                                            <a class="dash-link"--}}
                                        {{--                                                                href="{{ route('expense.analysis') }}">{{ __('Expense Report') }}</a>--}}
                                        {{--                                                        </li>--}}
                                        {{--                                                    @endcan--}}

                                        @can('Manage Customer')
                                            <li class="">
                                                <a class="dash-link"
                                                   href="{{ route('customer.sales.analysis') }}">{{ __('Customer Report') }}</a>
                                            </li>
                                            <li class="">
                                                <a class="dash-link"
                                                   href="{{ route('reports.sales') }}">{{ __('Sale Report') }}</a>
                                            </li>
                                            <li class="">
                                                <a class="dash-link"
                                                   href="{{ route('reports.product') }}">{{ __('Product Report') }}</a>
                                            </li>

                                            <li class="">
                                                <a class="dash-link"
                                                   href="{{ route('reports.vendor') }}">{{ __('Vendor Report') }}</a>
                                            </li>
                                        @endcan

                                        {{--                                                    @can('Manage Vendor')--}}
                                        {{--                                                        <li class="">--}}
                                        {{--                                                            <a class="dash-link"--}}
                                        {{--                                                                href="{{ route('vendor.purchased.analysis') }}">{{ __('Vendor Report') }}</a>--}}
                                        {{--                                                        </li>--}}
                                        {{--                                                    @endcan--}}

                                        {{--                                                    @can('Manage Purchases')--}}
                                        {{--                                                        <li--}}
                                        {{--                                                            class=" {{ Request::segment(1) == 'purchased-daily-analysis' || Request::segment(1) == 'purchased-monthly-analysis' ? 'active' : '' }}">--}}
                                        {{--                                                            <a class="dash-link "--}}
                                        {{--                                                                href="{{ route('purchased.daily.analysis') }}">{{ __('Purchase Daily/Monthly Report') }}</a>--}}
                                        {{--                                                        </li>--}}
                                        {{--                                                    @endcan--}}

                                        {{--                                                    @can('Manage Sales')--}}
                                        {{--                                                        <li--}}
                                        {{--                                                            class=" {{ Request::segment(1) == 'sold-daily-analysis' || Request::segment(1) == 'sold-monthly-analysis' ? 'active' : '' }}">--}}
                                        {{--                                                            <a class="dash-link "--}}
                                        {{--                                                                href="{{ route('sold.daily.analysis') }}">{{ __('Sale Daily/Monthly Report') }}</a>--}}
                                        {{--                                                        </li>--}}
                                        {{--                                                    @endcan--}}
                                    </ul>
                                </li>
                            @endif



                            {{--                                                        @if (Gate::check('Store Settings') || Gate::check('Manage Branch') || Gate::check('Manage Cash Register') || Gate::check('Manage Branch Sales Target'))--}}
                            {{--                                                            <li class="">--}}
                            {{--                                                                <a href="#!" class="dash-link"><span class="dash-micon"><i--}}
                            {{--                                                                            class="ti ti-settings"></i></span><span--}}
                            {{--                                                                        class="dash-mtext">{{ __('Settings') }}</span><span class="dash-arrow"><i--}}
                            {{--                                                                            data-feather="chevron-right"></i></span></a>--}}
                            {{--                                                                <ul class="dash-submenu">--}}

                            {{--                                                                    @can('Store Settings')--}}
                            {{--                                                                        <li class="">--}}
                            {{--                                                                            <a class="dash-link"--}}
                            {{--                                                                               href="{{ route('systems.index') }}">{{ __('Store Settings') }}</a>--}}
                            {{--                                                                        </li>--}}
                            {{--                                                                    @endcan--}}

                            {{--                                                                    @can('Manage Branch')--}}
                            {{--                                                                        <li class="">--}}
                            {{--                                                                            <a class="dash-link"--}}
                            {{--                                                                               href="{{ route('branches.index') }}">{{ __('Branches') }}</a>--}}
                            {{--                                                                        </li>--}}
                            {{--                                                                    @endcan--}}

                            {{--                                                                    @can('Manage Cash Register')--}}
                            {{--                                                                        <li class="">--}}
                            {{--                                                                            <a class="dash-link"--}}
                            {{--                                                                               href="{{ route('cashregisters.index') }}">{{ __('Cash Registers') }}</a>--}}
                            {{--                                                                        </li>--}}
                            {{--                                                                    @endcan--}}

                            {{--                                                                                            @can('Manage Branch Sales Target')--}}
                            {{--                                                                                                <li class="">--}}
                            {{--                                                                                                    <a class="dash-link"--}}
                            {{--                                                                                                        href="{{ route('branchsalestargets.index') }}">{{ __('Branch Sales Target') }}</a>--}}
                            {{--                                                                                                </li>--}}
                            {{--                                                                                            @endcan--}}

                            {{--                                                                </ul>--}}
                            {{--                                                            </li>--}}
                            {{--                                                        @endif--}}
                            <li class="">
                                <a href="#!" class="dash-link"><span class="dash-micon"><i
                                            class="ti ti-users"></i></span><span
                                        class="dash-mtext">{{ __('Locations') }}</span><span class="dash-arrow"><i
                                            data-feather="chevron-right"></i></span></a>
                                <ul class="dash-submenu">


                                    <li class="">
                                        <a class="dash-link" href="{{ route('locations') }}">Manage Locations</a>
                                    </li>


                                </ul>
                            </li>

                        </ul>
                    </div>
                    </ul>

                </div>
                </div>
            </nav>

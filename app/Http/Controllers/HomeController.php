<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\BranchSalesTarget;
use App\Models\CashRegister;
use App\Models\Customer;
use App\Models\LandingPageSection;
use App\Models\Notification;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\Sale;
use App\Models\Todo;
use App\Models\Utility;
use App\Models\Vendor;
use App\Models\Calendar;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    function index()

    {
        if(\Auth::check())
        {
            $authuser = Auth::user();

            $user_id = $authuser->getCreatedBy();

            $low_stock = (int)Utility::settings()['low_product_stock_threshold'];

            $branches = Branch::select('id')->where('created_by', '=', $user_id)->count();

            $cashregisters = CashRegister::select('cash_registers.id')->leftjoin('branches', 'branches.id', '=', 'cash_registers.branch_id')->where('branches.created_by', '=', $user_id)->count();

            $productObj = Product::getallproducts();

            $productscount = $productObj->count();

            $lowstockproducts = [];

            if($productscount > 0)
            {

                foreach($productObj->get() as $key => $product)
                {

                    $productquantity = $product->getTotalProductQuantity();

                    if($productquantity <= $low_stock)
                    {
                        $lowstockproducts[] = [
                            'name' => $product->name,
                            'quantity' => $productquantity,
                        ];
                    }
                }
            }

             //   Dashboard calendar
             $events    = Calendar::where('created_by', '=', \Auth::user()->getCreatedBy())->get();
             $now = date('m');
             $current_month_event = Calendar::select('id', 'start', 'end', 'title', 'created_at', 'className')->whereRaw('MONTH(start)=' . $now)->get();

             $arrEvents = [];
             foreach ($events as $event) {

                 $arr['id']    = $event['id'];
                 $arr['title'] = $event['title'];
                 $arr['start'] = $event['start'];
                 $arr['end']   = $event['end'];
                 $arr['className'] = $event['className'];
                 $arr['url']             = route('calendars.show', $event['id']);

                 $arrEvents[] = $arr;
             }
             $arrEvents =  json_encode($arrEvents);
             //   Dashboard calendar

            $notifications = Notification::getAllNotifications();

            $customers = Customer::select('id')->where('created_by', '=', $user_id)->count();

            $vendors = Vendor::select('id')->where('created_by', '=', $user_id)->count();

            $monthlySelledAmount = Sale::totalSelledAmount(true);
            $monthlyOrders = Sale::MonthOrdersCount();
            $totalSelledAmount   = Sale::totalSelledAmount();

            $monthlyPurchasedAmount = Purchase::totalPurchasedAmount(true);
            $totalPurchasedAmount   = Purchase::totalPurchasedAmount();

            $purchasesArray = Purchase::getPurchaseReportChart();

            $salesArray = Sale::getSalesReportChart();

            $totalSalesCount=sizeof(Sale::all());

            $todos = Todo::where('created_by', '=', Auth::user()->id)->orderBy('id', 'DESC')->get();

            $saletarget = BranchSalesTarget::getBranchTargets(true);
            $currentDate = Carbon::now()->format('Y-m-d');
            $yesterdayDate = Carbon::yesterday()->format('Y-m-d');
//            dd($yesterdayDate);


            $homes = [
                'branches',
                'cashregisters',
                'productscount',
                'lowstockproducts',
                'notifications',
                'customers',
                'vendors',
                'monthlySelledAmount',
                'totalSelledAmount',
                'monthlyPurchasedAmount',
                'totalPurchasedAmount',
                'purchasesArray',
                'salesArray',
                'totalSalesCount',
                'monthlyOrders',
                'currentDate',
                'yesterdayDate'

            ];

            return view('dashboard', compact($homes,'arrEvents'));
        }
        else
        {
            if(!file_exists(storage_path() . "/installed"))
            {
                header('location:install');
                die;
            }
            else
            {
//                $settings = Utility::settings();
//                if($settings['display_landing_page'] == 'on')
//                {
//                    $get_section = LandingPageSection::orderBy('section_order', 'ASC')->get();
//
//                    return view('layouts.landing', compact('get_section'));
//                }
//                else
//                {
                    return redirect('login');
//                }
            }

        }
    }

    public function changeMode()
    {
        $usr = Auth::user();
        if($usr->mode == 'light')
        {
            $usr->mode = 'dark';
        }
        else
        {
            $usr->mode = 'light';
        }
        $usr->save();

        return redirect()->back();
    }

    public function privacy(){
        return view('privacy');
    }
}

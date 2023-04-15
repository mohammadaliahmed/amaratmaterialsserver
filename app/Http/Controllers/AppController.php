<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Customer;
use App\Models\CustomerOrderedProductTimeLine;
use App\Models\CustomerOrdersTimeline;
use App\Models\Locations;
use App\Models\Product;
use App\Models\Sale;
use App\Models\SelledItems;
use App\Models\Sites;
use App\Models\Unit;
use App\Models\Utility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Response;

class AppController extends Controller
{
    //
    public function Register(Request $request)
    {
        if (!empty($request->email)) {
            $customer_has_mail = Customer::Where('email', $request->email)->count();
            if ($customer_has_mail != 0) {
                return response()->json([
                    'code' => Response::HTTP_FORBIDDEN, 'message' => "Email already exists"
                ], Response::HTTP_FORBIDDEN);
            }
        }

        $customer = Customer::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password . 'z1x2c3',
            'phone_number' => $request->phone_number,
            'address' => $request->address,
            'city' => $request->city,
            'sub_location_id' => $request->sub_location_id,
            'is_active' => 1,
        ]);
        return response()->json([
            'code' => Response::HTTP_OK, 'message' => "Saved", 'error' => "", "customer" => $customer
        ], Response::HTTP_OK);

    }

    public function UpdateProfile(Request $request)
    {
        $customer = Customer::find($request->userId);
        $customer->phone_number = $request->phone;
        $customer->name = $request->name;
        $customer->cnic = $request->cnic;
        $customer->famous = $request->famous;
        $customer->update();
        return response()->json([
            'code' => Response::HTTP_OK, 'message' => "Saved", 'error' => "", "customer" => $customer
        ], Response::HTTP_OK);
    }

    public function Login(Request $request)
    {
        if (!empty($request->email)) {
            $customer_has_mail = Customer::Where('email', $request->email)->count();
            if ($customer_has_mail == 0) {
                return response()->json([
                    'code' => Response::HTTP_FORBIDDEN, 'message' => "Account does not exists. Please signup"
                ], Response::HTTP_FORBIDDEN);
            } else {
                $customer = Customer::where('email', $request->email)
                    ->where('password', $request->password . 'z1x2c3')->first();
                if (!isset($customer)) {
                    return response()->json([
                        'code' => Response::HTTP_FORBIDDEN, 'message' => "Wrong password"
                    ], Response::HTTP_FORBIDDEN);
                } else {
                    return response()->json([
                        'code' => Response::HTTP_OK, 'message' => "", 'customer' => $customer
                    ], Response::HTTP_OK);
                }

            }
        }

    }
    public function GeLocations(){
        $Locations=Locations::with('subLocations')->get();
        return response()->json([
            'code' => Response::HTTP_OK, 'message' => "", 'locations' => $Locations
        ], Response::HTTP_OK);
    }

    public function GetCustomer($id)
    {
        $customer = Customer::where('id', $id)->with('sites')->get();
        return response()->json([
            'code' => Response::HTTP_OK, 'message' => "", 'customer' => $customer
        ], Response::HTTP_OK);
    }

    public function ListProducts()
    {
        $products = Product::all();
        foreach ($products as $product) {
            $unit = Unit::where('id', $product->unit_id)->pluck('shortname');
            if (sizeof($unit) > 0) {
                $product->unit = $unit[0];
            } else {
                $product->unit = "";
            }

        }
        $categories = Category::all();
        return response()->json([
            'code' => Response::HTTP_OK, 'message' => "", 'products' => $products, 'categories' => $categories
        ], Response::HTTP_OK);
    }

    public function PlaceOrder(Request $request)
    {

        $latest = Sale::orderBy('created_at', 'desc')->first();
        $invoice_id = $latest ? $latest->invoice_id + 1 : 1;

        $sale = new Sale();
        $sale->customer_id = $request->userId;
        $sale->invoice_id = $invoice_id;
        $sale->branch_id = 0;
        $sale->cash_register_id = 0;
        $sale->status = 0;
        $sale->created_by = 1;
        $sale->site_id = $request->site_id;
        $sale->save();
        CustomerOrdersTimeline::create([
            'sale_id' => $sale->id,
            'order_status' => 0,
            'updated_by' =>  1,
        ]);
//
        foreach ($request->items as $key => $value) {
            $product = Product::find($key);
            $product_id = $key;
            $selleditems = new SelledItems();
            $selleditems->sell_id = $sale->id;
            $selleditems->product_id = $key;
            $selleditems->price = $product->sale_price;
            $selleditems->quantity = $value;
            $selleditems->tax_id = 0;
            $selleditems->tax = 0;

            $selleditems->save();
            CustomerOrderedProductTimeLine::create([
                'selled_item_id' => $selleditems->id,
                'status' => 0,
                'product_id' => $product_id,
                'updated_by' => 1,
            ]);
        }

        $subject = "Order Confirmation";
        $customer = Customer::find($request->userId);

        Mail::later(5,'emails.testmail', compact('sale'), function ($message) use (
            $customer, $sale, $subject
        ) {
            $message->from('info@amaratmaterials.com', 'Amarat Materials');
            $message->subject($subject);
            $message->to($customer->email);
        });
        return response()->json([
            'code' => Response::HTTP_OK, 'message' => "success", 'sale' => $sale
        ], Response::HTTP_OK);

    }

    public function MyOrders($id)
    {
        $sales = Sale::where('customer_id', $request->userId)
            ->where('created_at','>=',$request->start_date.' 00:00:00')
            ->where('created_at','<=',$request->end_date.' 00:00:00')
            ->orderBy('id', 'desc')->with('site')->with('items')
            ->with('customerOrdersTimeline')
            ->get();

        return response()->json([
            'code' => Response::HTTP_OK, 'message' => "success", 'sales' => $sales
        ], Response::HTTP_OK);
    }

    public function OrderItems($id)
    {
        $sellItems = SelledItems::where('sell_id', $id)->with('product')
            ->with('customerOrderedProductTimeLine')
            ->get();
        return response()->json([
            'code' => Response::HTTP_OK, 'message' => "success", 'sellItems' => $sellItems
        ], Response::HTTP_OK);
    }


    public function AddSite(Request $request)
    {

        Sites::create([
            'house' => $request->house,
            'address' => $request->address,
            'street' => $request->street,
            'sector' => $request->sector,
            'near' => $request->near,
            'customer_id' => $request->userId,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
        ]);
        return response()->json([
            'code' => Response::HTTP_OK, 'message' => "success",
        ], Response::HTTP_OK);


    }

    public function GetSites($id)
    {
        $sites = Sites::where('customer_id', $id)->get();
        return response()->json([
            'code' => Response::HTTP_OK, 'message' => "success", 'sites' => $sites
        ], Response::HTTP_OK);
    }

    public function EditSite(Request $request)
    {
        $site = Sites::find($request->siteId);
        $site->address = $request->address;
        $site->details = $request->details;
        $site->name = $request->name;
        $site->latitude = $request->latitude;
        $site->longitude = $request->longitude;

        return response()->json([
            'code' => Response::HTTP_OK, 'message' => "success",
        ], Response::HTTP_OK);
    }

    public function DeleteSite($id)
    {
        $site = Sites::find($id);
        $site->delete();

        return response()->json([
            'code' => Response::HTTP_OK, 'message' => "success",
        ], Response::HTTP_OK);
    }

    public function CategoryProducts($id)
    {
        $products = Product::where('category_id', $id)->get();
        foreach ($products as $product) {
            $unit = Unit::where('id', $product->unit_id)->pluck('shortname');
            if (sizeof($unit) > 0) {
                $product->unit = $unit[0];
            } else {
                $product->unit = "";
            }

        }
        return response()->json([
            'code' => Response::HTTP_OK, 'message' => "success", 'products' => $products
        ], Response::HTTP_OK);
    }


    public function Categories()
    {
        $categories = Category::all();
        return response()->json([
            'code' => Response::HTTP_OK, 'message' => "success", 'categories' => $categories
        ], Response::HTTP_OK);
    }


    public function SearchProduct(Request $request)
    {
        $products = Product::where('name', 'LIKE', '%' . $request->search . '%')
            ->where('description', 'LIKE', '%' . $request->search . '%')
            ->get();
        return response()->json([
            'code' => Response::HTTP_OK, 'message' => "success", 'products' => $products
        ], Response::HTTP_OK);
    }

    public function ForgotPassword(Request $request)
    {
        $email = $request->email;
//        $email = "m.aliahmed0@gmail.com";
        $customer = Customer::where('email', $email)->first();


//        return view('emails.forgotpassword', compact('customer'));
        if (isset($customer)) {
            $randomId = Utility::RandomString(100);
            $customer->reset_token = $randomId;
            $customer->update();
            $subject = "Reset Password";

            Mail::send('emails.forgotpassword', compact('customer'), function ($message) use ($customer, $subject) {
                $message->from('info@amaratmaterials.com', 'Amarat Materials');
                $message->subject($subject);
                $message->to($customer->email);
            });
            return response()->json([
                'code' => Response::HTTP_OK, 'message' => "Email sent. Please check mail box"
            ], Response::HTTP_OK);
        } else {
            return response()->json([
                'code' => Response::HTTP_NOT_FOUND, 'message' => "No customer found with email"
            ], Response::HTTP_NOT_FOUND);
        }
    }

    public function ResetPassword(Request $request, $id)
    {
        $customer = Customer::where('reset_token', $id)->first();
        if ($request->isMethod('post')) {
            $customer->reset_token = "";
            $customer->password = $request->password . 'z1x2c3';
            $customer->update();
            $msg = "Please go back to app and use new password to login";
            return view('customers.noUserResetPassword', compact('msg'));


        } else {
            if (isset($customer)) {

                return view('customers.resetPassword', compact('customer'));

            } else {
                $msg = "Wrong or expired reset token";

                return view('customers.noUserResetPassword', compact('msg'));
            }
        }
    }
}

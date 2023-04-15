<?php

namespace App\Http\Controllers;

use App\Models\ProductVendorMapping;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Unit;
use App\Models\Tax;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ProductExport;
use App\Models\Utility;

class ProductController extends Controller
{
    public function index()
    {
        if (Auth::user()->can('Manage Product')) {
            $products = Product::getallproducts()->get();
            $barcode = [
                'barcodeType' => Auth::user()->barcodeType() == '' ? 'code128' : Auth::user()->barcodeType(),
                'barcodeFormat' => Auth::user()->barcodeFormat() == '' ? 'css' : Auth::user()->barcodeFormat()
            ];

            return view('products.index', compact('products', 'barcode'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function create()
    {
        $user_id = Auth::user()->getCreatedBy();
        if (Auth::user()->can('Create Product')) {
            $categories = Category::where('created_by', $user_id)->pluck('name', 'id');
            $categories->prepend(__('Select Category'), '');

            $brands = Brand::where('created_by', $user_id)->pluck('name', 'id');
            $brands->prepend(__('Select Brand'), '');

            $units = Unit::where('created_by', $user_id)->pluck('name', 'id');
            $units->prepend(__('Select Unit'), '');

            $taxes = Tax::where('created_by', $user_id)->pluck('name', 'id');
            $taxes->prepend(__('Apply Tax'), '');

            $vendors = Vendor::where('created_by', $user_id)->pluck('name', 'id');

            return view('products.create', compact('categories', 'brands', 'units', 'taxes'
                , 'vendors'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function store(Request $request)
    {

        if (Auth::user()->can('Create Product')) {
            $validator = Validator::make(
                $request->all(),
                [
                    'name' => 'required|max:100',
                    'sku' => 'nullable',
                ]
            );

            if ($validator->fails()) {
                return redirect()->back()->with('error', $validator->errors()->first());
            }


            $product = new Product();
            $product->name = $request->name;
            $product->urdu_title = $request->urdu_title;
            $product->urdu_description = $request->urdu_description;
            $product->quantity = 9999;
            $product->purchase_price = (float)$request->purchase_price;
            $product->sale_price = (float)$request->sale_price;
            $product->moq = $request->moq;
            $product->unit_value = $request->unit_value;
            $product->sku = $request->sku;
            $product->description = $request->description;

            if (!empty($request->input('category_id'))) {
                $product->category_id = $request->category_id;
            }
            if (!empty($request->input('brand_id'))) {
                $product->brand_id = $request->brand_id;
            }
            if (!empty($request->input('tax_id'))) {
                $product->tax_id = $request->tax_id;
            }
            if (!empty($request->input('unit_id'))) {
                $product->unit_id = $request->unit_id;
            }
            $product->product_type = 0;
            $product->slug = Str::slug($request->name, '-');
            $product->created_by = Auth::user()->getCreatedBy();

            if ($request->hasFile('image')) {
                $validator = Validator::make(
                    $request->all(),
                    [
                        'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:20480',
                    ]
                );

                if ($validator->fails()) {
                    return redirect()->back()->with('error', $validator->errors()->first());
                }

                $filenameWithExt = $request->file('image')->getClientOriginalName();
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                $extension = $request->file('image')->getClientOriginalExtension();
                $fileNameToStore = $filename . '_' . time() . '.' . $extension;
                $filepath = $request->file('image')->storeAs('productimages', $fileNameToStore);
                // $product->image  = $filepath;
                $dir = 'productimages/';
                $path = Utility::upload_file($request, 'image', $filenameWithExt, $dir, []);


                $product->image = $path['url'];
            }

            $product->save();
            if ($request->has('vendor_ids')) {
                foreach ($request->vendor_ids as $vendorId) {
                    ProductVendorMapping::create([
                        'product_id' => $product->id,
                        'vendor_id' => $vendorId,
                    ]);
                }
            }
            return redirect()->route('products.index')->with('success', __('Product added successfully.'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function show(Product $product)
    {
        return redirect()->back()->with('error', __('Permission denied.'));
    }

    public function edit(Product $product)
    {
        $user_id = Auth::user()->getCreatedBy();
        if (Auth::user()->can('Edit Product')) {
            $categories = Category::where('created_by', $user_id)->pluck('name', 'id');
            $categories->prepend(__('Select Category'), '');

            $brands = Brand::where('created_by', $user_id)->pluck('name', 'id');
            $brands->prepend(__('Select Brand'), '');

            $units = Unit::where('created_by', $user_id)->pluck('name', 'id');
            $units->prepend(__('Select Unit'), '');

            $taxes = Tax::where('created_by', $user_id)->pluck('name', 'id');
            $taxes->prepend(__('Apply Tax'), '');

            $vendors = Vendor::where('created_by', $user_id)->pluck('name', 'id');

            $vendorMapping = [];
            $vendorMappinga = ProductVendorMapping::where('product_id', $product->id)->get();
            foreach ($vendorMappinga as $vendorMap) {
                $vendorMapping[$vendorMap->vendor_id] = $vendorMap->vendor_id;
            }

            return view('products.edit', compact('product', 'categories',
                'vendorMapping', 'brands', 'vendors', 'units', 'taxes'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function update(Request $request, Product $product)
    {
        if (Auth::user()->can('Edit Product')) {
            $validator = Validator::make(
                $request->all(),
                [
                    'name' => 'required|max:100',
                ]
            );

            if ($validator->fails()) {
                return redirect()->back()->with('error', $validator->errors()->first());
            }
            $product->urdu_title = $request->urdu_title;
            $product->urdu_description = $request->urdu_description;
            $product->name = $request->name;
            $product->purchase_price = $request->purchase_price;
            $product->sale_price = $request->sale_price;
            $product->sku = $request->sku;
            $product->moq = $request->moq;
            $product->unit_value = $request->unit_value;
            $product->description = $request->description;
            if (!empty($request->input('category_id'))) {
                $product->category_id = $request->category_id;
            }
            if (!empty($request->input('brand_id'))) {
                $product->brand_id = $request->brand_id;
            }
            if (!empty($request->input('tax_id'))) {
                $product->tax_id = $request->tax_id;
            }
            if (!empty($request->input('unit_id'))) {
                $product->unit_id = $request->unit_id;
            }
            $product->slug = Str::slug($request->name, '-');

            $oldfilepath = $product->image;

            if ($request->imgstatus == 1) {
                if (asset(Storage::exists($oldfilepath))) {
                    $product->image = '';
                    asset(Storage::delete($oldfilepath));
                }
            }
            if ($request->hasFile('image')) {
                $validator = Validator::make(
                    $request->all(),
                    [
                        'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:20480',
                    ]
                );

                if ($validator->fails()) {
                    return redirect()->back()->with('error', $validator->errors()->first());
                }

                if (asset(Storage::exists($oldfilepath))) {
                    asset(Storage::delete($oldfilepath));
                }

                $filenameWithExt = $request->file('image')->getClientOriginalName();
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                $extension = $request->file('image')->getClientOriginalExtension();
                $fileNameToStore = $filename . '_' . time() . '.' . $extension;
                $filepath = $request->file('image')->storeAs('productimages', $fileNameToStore);
                // $product->image  = $filepath;
                $dir = 'productimages/';
                $path = Utility::upload_file($request, 'image', $filenameWithExt, $dir, []);


                $product->image = $path['url'];
            }

            $product->save();
            ProductVendorMapping::where('product_id', $product->id)->delete();
            if (!empty($request->input('vendor_ids'))) {
                foreach ($request->vendor_ids as $vendorId) {
                    ProductVendorMapping::create([
                        'product_id' => $product->id,
                        'vendor_id' => $vendorId,
                    ]);
                }
            }

            return redirect()->route('products.index')->with('success', __('Product updated successfully.'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function destroy(Product $product)
    {
        if (Auth::user()->can('Delete Product')) {
            if (asset(Storage::exists($product->image))) {
                asset(Storage::delete($product->image));
            }
            $product->delete();

            return redirect()->route('products.index')->with('success', __('Product deleted successfully.'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function searchProductsByName(Request $request)
    {
        $search = $request->search;

        if (Auth::user()->can('Manage Product') && $request->ajax() && $search != '') {
            $products = Product::getallproducts()->where('products.name', 'LIKE', "%{$search}%")->get();

            $items = [];
            foreach ($products as $key => $item) {
                $price = $item->sale_price != 0 ? $item->sale_price : 0;

                $tax = Product::where('products.id', $item->id)->leftJoin(
                    'taxes',
                    function ($join) {
                        $join->on('taxes.id', '=', 'products.tax_id')->where('taxes.created_by', '=', Auth::user()->getCreatedBy())->orWhereNull('products.tax_id');
                    }
                )->select(DB::Raw('IFNULL( `taxes`.`percentage` , 0 ) as percentage'))->first();

                $items[$key]['id'] = $item->id;
                $items[$key]['name'] = $item->name;
                $items[$key]['quantity'] = '1';
                $items[$key]['maxquantity'] = $item->getTotalProductQuantity() > 0 ? $item->getTotalProductQuantity() : '';
                $items[$key]['price'] = $price;
                $items[$key]['subtotal'] = $price + ($price * $tax->percentage) / 100;
                $items[$key]['tax'] = $tax->percentage;
            }

            return json_encode($items);
        }
    }

    public function searchProducts(Request $request)
    {
        $lastsegment = $request->session_key;

        if (Auth::user()->can('Manage Product') && $request->ajax() && isset($lastsegment) && !empty($lastsegment)) {
            $output = "";
            if ($request->cat_id !== '' && $request->search == '') {
                $products = Product::getallproducts()->where('category_id', $request->cat_id)->get();
            } else {
                $products = Product::getallproducts()->where('products.name', 'LIKE', "%{$request->search}%")->orWhere('category_id', $request->cat_id)->get();

                // $products = Product::getallproducts()->where('products.name', 'LIKE', "%{request->search}%")
                // ->where(function ($q) use ($request) {
                //     $q->orWhere('category_id', $request->cat_id);
                // })
                // ->get();
            }
            if ($products) {
                foreach ($products as $key => $product) {

//                    $image_url = (!empty($product->image) && Storage::exists($product->image)) ? $product->image : 'logo/placeholder.png';
                    if ($request->session_key == 'purchases') {
                        $productprice = $product->purchase_price != 0 ? $product->purchase_price : 0;
                    } else if ($request->session_key == 'sales') {
                        $productprice = $product->sale_price != 0 ? $product->sale_price : 0;
                    } else {
                        $productprice = $product->sale_price != 0 ? $product->sale_price : $product->purchase_price;
                    }

                    $output .= '
                     <div class="col-lg-3 col-md-3">

                            <div class="tab-pane fade show active toacart" data-url="' . url('add-to-cart/' . $product->id . '/' . $lastsegment) . '">
                            <div class="card card-profile hover-shadow-lg mx-2">

                              <div class="mx-auto">

                                <img alt="Image placeholder" src="storage/' . $product->image . '" class="card-image avatar rounded-circle shadow hover-shadow-lg" style=" height: 7rem; width: 7rem;   margin-top: 0.7rem;">
                              </div>
                              <div class="card-body  mt-2 p-3 pt-0 text-center">
                                <h5 class="mb-0 h6">' . $product->name . '</h5>
                                <small class="mb-0">' . Auth::user()->priceFormat($productprice) . '</small>
                              </div>
                            </div>
                            </div>
                             </div>
                    ';
                }

                return Response($output);
            } else {
                return Response(__('No result found'));
            }
        }
    }

    public function addToCart(Request $request, $id, $session_key)
    {
        if (Auth::user()->can('Manage Product') && $request->ajax()) {
            $product = Product::find($id);

            $productquantity = 0;

            if ($product) {
                $productquantity = $product->getTotalProductQuantity();
            }

            if (!$product || ($session_key == 'sales' && $productquantity == 0)) {
                return response()->json(
                    [
                        'code' => 404,
                        'status' => 'Error',
                        'error' => __('This product is out of stock!'),
                    ],
                    404
                );
            }

            $productname = $product->name;
            if ($session_key == 'purchases') {

                $productprice = $product->purchase_price != 0 ? $product->purchase_price : 0;
            } else if ($session_key == 'sales') {

                $productprice = $product->sale_price != 0 ? $product->sale_price : 0;
            } else {

                $productprice = $product->sale_price != 0 ? $product->sale_price : $product->purchase_price;
            }

            $originalquantity = (int)$productquantity;

            $tax = Product::where('products.id', $id)->leftJoin(
                'taxes',
                function ($join) {
                    $join->on('taxes.id', '=', 'products.tax_id')->where('taxes.created_by', '=', Auth::user()->getCreatedBy())->orWhereNull('products.tax_id');
                }
            )->select(DB::Raw('IFNULL( `taxes`.`percentage` , 0 ) as percentage'))->first();

            $producttax = $tax->percentage;

            $tax = ($productprice * $producttax) / 100;

            $subtotal = $productprice + $tax;
            $cart = session()->get($session_key);
//            $image_url = (!empty($product->image) && Storage::exists($product->image)) ? $product->image : 'logo/placeholder.png';
            $model_delete_id = 'delete-form-' . $id;

            $carthtml = '';

            $carthtml .= '<div class="row mt-3" data-product-id="' . $id . '" id="product-id-' . $id . '">
                            <div class="col-sm-2">
                                <img alt="Image placeholder" src="storage/' . $product->image . '" class="card-image avatar rounded-circle shadow hover-shadow-lg">
                            </div>
                            <div class="col-sm-10">
                                <div class="row">
                                    <div class="col-sm-7">
                                      <span class="name">' . $productname . '</span>
                                    </div>
                                    <div class="col-sm-5">
                                      <span class="price">' . Auth::user()->priceFormat($productprice) . '</span>
                                    </div>
                                    <div class="col-sm-5 mt-2">
                                        <span class="quantity buttons_added">
                                            <input type="button" value="-" class="minus">
                                            <input type="number" step="1" min="1" max="" name="quantity" title="' . __('Quantity') . '" class="input-number" size="4" data-url="' . url('update-cart/') . '" data-id="' . $id . '">
                                            <input type="button" value="+" class="plus">
                                        </span>
                                    </div>
                                    <div class="col-sm-2 mt-2">
                                      <span class="tax"></span>
                                    </div>
                                    <div class="col-sm-3 mt-2">
                                      <span class="subtotal">' . Auth::user()->priceFormat($subtotal) . '</span>
                                    </div>
                                    <div class="col-sm-2 mt-2">
                                    <a href="#" class="action-btn bg-danger bs-pass-para" data-confirm="' . __("Are You Sure?") . '" data-text="' . __("This action can not be undone. Do you want to continue?") . '" data-confirm-yes=' . $model_delete_id . ' title="' . __('Delete') . '}" data-id="' . $id . '" title="' . __('Delete') . '"   >
                                    <span class=""><i class="ti ti-trash btn btn-sm text-white"></i></span>
                                    </a>
                                        <form method="post" action="' . url('remove-from-cart') . '"  accept-charset="UTF-8" id="' . $model_delete_id . '">
                                            <input name="_method" type="hidden" value="DELETE">
                                            <input name="_token" type="hidden" value="' . csrf_token() . '">
                                            <input type="hidden" name="session_key" value="' . $session_key . '">
                                            <input type="hidden" name="id" value="' . $id . '">
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>';

            // if cart is empty then this the first product
            if (!$cart) {
                $cart = [
                    $id => [
                        "name" => $productname,
                        "quantity" => 1,
                        "price" => $productprice,
                        "id" => $id,
                        "tax" => $producttax,
                        "subtotal" => $subtotal,
                        "originalquantity" => $originalquantity,
                    ],
                ];

                if ($originalquantity < $cart[$id]['quantity'] && $session_key == 'sales') {
                    return response()->json(
                        [
                            'code' => 404,
                            'status' => 'Error',
                            'error' => __('This product is out of stock!'),
                        ],
                        404
                    );
                }

                session()->put($session_key, $cart);

                return response()->json(
                    [
                        'code' => 200,
                        'status' => 'Success',
                        'success' => $productname . __(' added to cart successfully!'),
                        'product' => $cart[$id],
                        'carthtml' => $carthtml,
                    ]
                );
            }

            // if cart not empty then check if this product exist then increment quantity
            if (isset($cart[$id])) {
                $cart[$id]['quantity']++;
                $cart[$id]['id'] = $id;

                $subtotal = $cart[$id]["price"] * $cart[$id]["quantity"];
                $tax = ($subtotal * $cart[$id]["tax"]) / 100;

                $cart[$id]["subtotal"] = $subtotal + $tax;
                $cart[$id]["originalquantity"] = $originalquantity;

                if ($originalquantity < $cart[$id]['quantity'] && $session_key == 'sales') {
                    return response()->json(
                        [
                            'code' => 404,
                            'status' => 'Error',
                            'error' => __('This product is out of stock!'),
                        ],
                        404
                    );
                }

                session()->put($session_key, $cart);

                return response()->json(
                    [
                        'code' => 200,
                        'status' => 'Success',
                        'success' => $productname . __(' added to cart successfully!'),
                        'product' => $cart[$id],
                        'carttotal' => $cart,
                    ]
                );
            }

            // if item not exist in cart then add to cart with quantity = 1
            $cart[$id] = [
                "name" => $productname,
                "quantity" => 1,
                "price" => $productprice,
                "tax" => $producttax,
                "subtotal" => $subtotal,
                "id" => $id,
                "originalquantity" => $originalquantity,
            ];

            if ($originalquantity < $cart[$id]['quantity'] && $session_key == 'sales') {
                return response()->json(
                    [
                        'code' => 404,
                        'status' => 'Error',
                        'error' => __('This product is out of stock!'),
                    ],
                    404
                );
            }

            session()->put($session_key, $cart);

            return response()->json(
                [
                    'code' => 200,
                    'status' => 'Success',
                    'success' => $productname . __(' added to cart successfully!'),
                    'product' => $cart[$id],
                    'carthtml' => $carthtml,
                    'carttotal' => $cart,
                ]
            );
        } else {
            return response()->json(
                [
                    'code' => 404,
                    'status' => 'Error',
                    'error' => __('This Product is not found!'),
                ],
                404
            );
        }
    }

    public function updateCart(Request $request)
    {
        $id = $request->id;
        $quantity = $request->quantity;
        $session_key = $request->session_key;

        if (Auth::user()->can('Manage Product') && $request->ajax() && isset($id) && !empty($id) && isset($session_key) && !empty($session_key)) {
            $cart = session()->get($session_key);

            if (isset($cart[$id]) && $quantity == 0) {
                unset($cart[$id]);
            }

            if ($quantity) {
                $cart[$id]["quantity"] = $quantity;
                $producttax = $cart[$id]["tax"];
                $productprice = $cart[$id]["price"];

                $subtotal = $productprice * $quantity;
                $tax = ($subtotal * $producttax) / 100;

                $cart[$id]["subtotal"] = $subtotal + $tax;
            }

            if ($cart[$id]["originalquantity"] < $cart[$id]['quantity'] && $session_key == 'sales') {
                return response()->json(
                    [
                        'code' => 404,
                        'status' => 'Error',
                        'error' => __('This product is out of stock!'),
                    ],
                    404
                );
            }

            session()->put($session_key, $cart);

            return response()->json(
                [
                    'code' => 200,
                    'success' => __('Cart updated successfully!'),
                    'product' => $cart,
                ]
            );
        } else {
            return response()->json(
                [
                    'code' => 404,
                    'status' => 'Error',
                    'error' => __('This Product is not found!'),
                ],
                404
            );
        }
    }

    public function removeFromCart(Request $request)
    {
        $id = $request->id;
        $session_key = $request->session_key;
        if (Auth::user()->can('Manage Product') && isset($id) && !empty($id) && isset($session_key) && !empty($session_key)) {
            $cart = session()->get($session_key);
            if (isset($cart[$id])) {
                unset($cart[$id]);
                session()->put($session_key, $cart);
            }

            return redirect()->back()->with('success', __('Product removed from cart!'));
        } else {
            return redirect()->back()->with('error', __('This Product is not found!'));
        }
    }

    public function emptyCart(Request $request)
    {
        $session_key = $request->session_key;

        if (Auth::user()->can('Manage Product') && isset($session_key) && !empty($session_key)) {
            $cart = session()->get($session_key);
            if (isset($cart) && count($cart) > 0) {
                session()->forget($session_key);
            }
            return redirect()->back()->with('success', __('Cart is empty!'));
        } else {
            return redirect()->back()->with('error', __('Cart cannot be empty!.'));
        }
    }

    public function export()
    {
        $name = 'Product_' . date('Y-m-d i:h:s');
        $data = Excel::download(new ProductExport(), $name . '.xlsx');
        ob_end_clean();

        return $data;
    }
}

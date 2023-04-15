<?php

namespace App\Http\Controllers;

use App\Models\Utility;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        if(Auth::user()->can('Manage Category'))
        {
            $categories = Category::where('created_by', '=', Auth::user()->getCreatedBy())
                                    ->orderBy('id', 'DESC')
                                    ->get();

            return view('categories.index')->with('categories', $categories);
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function create()
    {
        if(Auth::user()->can('Create Category'))
        {
            return view('categories.create');
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function store(Request $request)
    {
        if(Auth::user()->can('Create Category'))
        {
            $validator = Validator::make(
                $request->all(), [
                                   'name' => 'required|max:100|unique:categories,name,NULL,id,created_by,' . Auth::user()->getCreatedBy(),
                               ]
            );

            if($validator->fails())
            {
                return redirect()->back()->with('error', $validator->errors()->first());
            }

            $category             = new Category();
            $category->urdu       = $request->urdu;
            $category->name       = $request->name;
            $category->slug       = Str::slug($request->name, '-');
            $category->created_by = Auth::user()->getCreatedBy();
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


                $category->image = $path['url'];
            }
            $category->save();

            return redirect()->route('categories.index')->with('success', __('Category added successfully.'));
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function show(Category $category)
    {
        return redirect()->back()->with('error', __('Permission denied.'));
    }

    public function edit(Category $category)
    {
        if(Auth::user()->can('Edit Category'))
        {
            return view('categories.edit', compact('category'));
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function update(Request $request, Category $category)
    {
        if(Auth::user()->can('Edit Category'))
        {
            $validator = Validator::make(
                $request->all(), [
                                   'name' => 'required|max:100|unique:categories,name,' . $category->id . ',id,created_by,' . Auth::user()->getCreatedBy(),
                               ]
            );

            if($validator->fails())
            {
                return redirect()->back()->with('error', $validator->errors()->first());
            }
            $category->urdu = $request->urdu;
            $category->name = $request->name;
            $category->slug = Str::slug($request->name, '-');
            $oldfilepath = $category->image;

            if ($request->imgstatus == 1) {
                if (asset(Storage::exists($oldfilepath))) {
                    $category->image = '';
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


                $category->image = $path['url'];
            }
            $category->save();

            return redirect()->route('categories.index')->with('success', __('Category updated successfully.'));
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function destroy(Category $category)
    {
        if(Auth::user()->can('Delete Category'))
        {
            $category->delete();

            return redirect()->route('categories.index')->with('success', __('Category deleted successfully.'));
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }
     public function getProductCategories(){

        $cat = Category::getallCategories();
        $all_products = Product::getallproducts()->count();
        $html = '<div class="col-md-3 mb-3 zoom-in ">
                  <div class="card rounded-12 card-stats mb-0 cat-active" data-id="">
                     <div class="card-body p-3 category-select" data-cat-id="">
                        <div class="row">
                           <div class="col text-white">
                              <h6 class="card-title text-white mb-0 ">'.__("All").'</h6>
                                <span class="product-count">'.$all_products.' Items</span>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>';
        foreach ($cat as $key => $c) {
            $dcls = '';
            if($c->products > 0){
                $dcls = 'category-select';
            }
            $html .= ' <div class="col-md-3 mb-3 zoom-in ">
                          <div class="card rounded-12 card-stats mb-0 " data-id="'.$c->id.'">
                             <div class="card-body p-3 '.$dcls.'" data-cat-id="'.$c->id.'">
                                <div class="row">
                                   <div class="col">
                                      <h6 class="card-title mb-0 ">'.$c->name.'</h6>
                                        <span class="product-count">'.$c->products.' Items</span>
                                   </div>
                                </div>
                             </div>
                          </div>
                       </div>';
        }
        return Response($html);
    }
}

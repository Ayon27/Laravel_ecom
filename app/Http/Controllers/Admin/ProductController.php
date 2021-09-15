<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Subcategory;
use App\Models\SubSubCategory;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Image;

class ProductController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth:admin,admin');
        $this->middleware('prevent-back-button');
        $this->middleware('XssSanitizer');
    }

    public function index()
    {
        $products = Product::latest()->get();
        return view('admin.product.all_products', compact('products'));
    }

    public function AddProduct()
    {
        try {
            $categories = Category::latest()->get();

            return view('admin.product.product_add', compact('categories'));
        } catch (Exception $e) {
            $notification = array(
                'message' => 'An Error Occurred!',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
    }

    public function SaveProduct(Request $request)
    {
        $request->validate([
            'category_id' => 'required|numeric',
            'subcategory_id' => 'required|numeric',
            'subsubcategory_id' => 'required|numeric',
            'product_name_en' => 'required|max:255',
            'product_name_bn' => 'required|max:255',
            'product_code' => 'required|max:255|unique:products',
            'product_quantity' => 'required|numeric',
            'size_en' => 'required|max:255',
            'size_bn' => 'required|max:255',
            'color_en' => 'required|max:255',
            'color_bn' => 'required|max:255',
            'sell_price' => 'required|numeric',
            'disc_price' => 'required|numeric',
            'img' => 'required|image|mimes:png,jpg,jpeg|max:5000',
            'multi_img' => 'required',
            'multi_img.*' => 'mimes:jpeg,jpg,png|image|max:5000',
            'short_desc_en' => 'required|max:1000',
            'short_desc_bn' => 'required|max:1000',
            'long_desc_en' => 'required|max:3000',
            'long_desc_bn' => 'required|max:3000',
        ]);

        $product = new Product();

        try {

            //single image process
            $image = $request->file('img');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(2000, 2000)->save(public_path('uploads/products/thumbnails/') . $name_gen);
            $img_loc = 'uploads/products/thumbnails/' . $name_gen;


            //product
            $product->admin_id = Auth::user()->id;
            $product->category_id = $request->category_id;
            $product->subcategory_id = $request->subcategory_id;
            $product->subsubcategory_id = $request->subsubcategory_id;
            $product->product_name_en = $request->product_name_en;
            $product->product_name_bn = $request->product_name_bn;
            $product->product_slug_en = strtolower(str_replace(' ', '-', $request->product_name_en));
            $product->product_slug_bn = strtolower(str_replace(' ', '-', $request->product_name_bn));
            $product->product_code = $request->product_code;
            $product->quantity = $request->product_quantity;
            $product->product_size_en = $request->size_en;
            $product->product_size_bn = $request->size_bn;
            $product->product_color_en = $request->color_en;
            $product->product_color_bn = $request->color_bn;
            $product->product_actual_price = $request->sell_price;
            $product->product_discount_price = $request->disc_price;
            $product->short_desc_en = $request->short_desc_en;
            $product->short_desc_bn = $request->short_desc_bn;
            $product->long_desc_en = $request->long_desc_en;
            $product->long_desc_bn = $request->long_desc_bn;
            $product->product_thumbnail = $img_loc;
            $product->status = 1;
            $product->offer = $request->offer;
            $product->featured = $request->featured;
            $product->created_at = Carbon::now();

            $product->save();
            $prod_id = $product->id;

            //multiimg process
            $images = $request->file('multi_img');

            foreach ($images as $img) {
                $name_gen_mult = hexdec(uniqid()) . '.' . $img->getClientOriginalExtension();
                Image::make($img)->resize(2000, 2000)->save(public_path('uploads/products/product_images/') . $name_gen_mult);
                $img_loc_mult = 'uploads/products/product_images/' . $name_gen_mult;


                //multi image model instance manipulate
                $product_images = new ProductImage();

                $product_images->product_id = $prod_id;
                $product_images->image_loc = $img_loc_mult;
                $product_images->created_at = Carbon::now();

                $product_images->save();
            }



            $notification = array(
                'message' => 'Product Inserted Successfully',
                'alert-type' => 'success'
            );
        } catch (Exception $e) {
            $notification = array(
                'message' => 'Product Insertion Failed. An Error Occurred',
                'alert-type' => 'error'
            );
        } finally {
            return redirect()->route('manage-product')->with($notification);
        }
    }

    public function EditProduct($prod_id)
    {
        try {
            $prod_imgs = ProductImage::where('product_id', $prod_id)->get();
            $product = Product::findOrFail($prod_id);
            $subsubcategories = SubSubCategory::where('subcategory_id', $product->subcategory_id)->orderBy('subsubcat_name_en', 'ASC')->get();
            $subcategories = SubCategory::where('category_id', $product->category_id)->orderBy('subcat_name_en', 'ASC')->get();
            $categories = Category::latest()->get();


            return view('admin.product.edit_product', compact('product', 'categories', 'subcategories', 'subsubcategories', 'prod_imgs'));
        } catch (Exception $e) {
            $notification = array(
                'message' => 'An Error Occurred',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
    }

    public function UpdateProduct(Request $request)
    {
        $id = $request->id;

        $request->validate([
            'category_id' => 'required|numeric',
            'subcategory_id' => 'required|numeric',
            'subsubcategory_id' => 'required|numeric',
            'product_name_en' => 'required|max:255',
            'product_name_bn' => 'required|max:255',
            'product_code' => 'required|max:255|unique:products,product_code,' . $id . 'id',
            'product_quantity' => 'required|numeric',
            'size_en' => 'required|max:255',
            'size_bn' => 'required|max:255',
            'color_en' => 'required|max:255',
            'color_bn' => 'required|max:255',
            'sell_price' => 'required|numeric',
            'disc_price' => 'required|numeric',
            // 'img' => 'required|image|mimes:png,jpg,jpeg|max:5000',
            // 'multi_img' => 'required',
            // 'multi_img.*' => 'mimes:jpeg,jpg,png|image|max:5000',
            'short_desc_en' => 'required|max:1000',
            'short_desc_bn' => 'required|max:1000',
            'long_desc_en' => 'required|max:3000',
            'long_desc_bn' => 'required|max:3000',
        ]);

        try {
            $product = Product::findOrFail($id)->update([
                'category_id' => $request->category_id,
                'subcategory_id' => $request->subcategory_id,
                'subsubcategory_id' => $request->subsubcategory_id,
                'product_name_en' => $request->product_name_en,
                'product_name_bn' => $request->product_name_bn,
                'product_slug_en' => strtolower(str_replace(' ', '-', $request->product_name_en)),
                'product_slug_bn' => strtolower(str_replace(' ', '-', $request->product_name_bn)),
                'product_code' => $request->product_code,
                'quantity' => $request->product_quantity,
                'product_size_en' => $request->size_en,
                'product_size_bn' => $request->size_bn,
                'product_color_en' => $request->color_en,
                'product_color_bn' => $request->color_bn,
                'product_actual_price' => $request->sell_price,
                'product_discount_price' => $request->disc_price,
                'short_desc_en' => $request->short_desc_en,
                'short_desc_bn' => $request->short_desc_bn,
                'long_desc_en' => $request->long_desc_en,
                'long_desc_bn' => $request->long_desc_bn,
                'featured' => $request->featured,
                'offer' => $request->offer,
                'updated_at' => Carbon::now(),
            ]);
            $notification = array(
                'message' => 'Product Updated Successfully',
                'alert-type' => 'success'
            );
        } catch (Exception $e) {
            $notification = array(
                'message' => 'Product Update Failed. An Error Occurred',
                'alert-type' => 'error'
            );
        } finally {
            return redirect()->route('manage-product')->with($notification);
        }
    }

    public function UpdateProductImage(Request $request)
    {
        if (!$request->multi_img && !$request->multi_img_new) {
            $notification = array(
                'message' => 'Image Update Failed. No Image Selected or Uploaded',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }

        if ($request->multi_img) {
            $imageID = $request->multi_img;


            foreach ($imageID as $id => $img) {

                $request->validate([
                    'multi_img.*' => 'image|mimes:png,jpg,jpeg|max:5000',
                ], [
                    'multi_img.*' => 'File must be an image of type jpg/png/jpeg'
                ]);

                try {
                    $img_to_delete = ProductImage::findOrFail($id);
                    unlink(public_path($img_to_delete->image_loc));

                    $name_gen_mult = hexdec(uniqid()) . '.' . $img->getClientOriginalExtension();
                    Image::make($img)->resize(2000, 2000)->save(public_path('uploads/products/product_images/') . $name_gen_mult);
                    $img_loc_mult = 'uploads/products/product_images/' . $name_gen_mult;

                    ProductImage::where('id', $id)->update([
                        'image_loc' => $img_loc_mult,
                        'updated_at' => Carbon::now(),
                    ]);
                    $notification = array(
                        'message' => 'Image Updated Successfully',
                        'alert-type' => 'success'
                    );
                } catch (Exception $e) {
                    $notification = array(
                        'message' => 'Image Update Failed. An Error Occurred',
                        'alert-type' => 'error'
                    );
                }
            }
        }

        if ($request->multi_img_new) {
            $request->validate([
                'multi_img_new.*' => 'mimes:jpeg,jpg,png|image|max:5000',
            ]);

            try {
                $images = $request->file('multi_img_new');

                foreach ($images as $img) {
                    $name_gen_mult = hexdec(uniqid()) . '.' . $img->getClientOriginalExtension();
                    Image::make($img)->resize(2000, 2000)->save(public_path('uploads/products/product_images/') . $name_gen_mult);
                    $img_loc_mult = 'uploads/products/product_images/' . $name_gen_mult;


                    //multi image model instance manipulate
                    $product_images = new ProductImage();

                    $product_images->product_id = $request->prod_id;
                    $product_images->image_loc = $img_loc_mult;
                    $product_images->created_at = Carbon::now();

                    $product_images->save();
                    $notification = array(
                        'message' => 'Image Updated Successfully',
                        'alert-type' => 'success'
                    );
                }
            } catch (Exception $e) {
                $notification = array(
                    'message' => 'Image Update Failed. An Error Occurred',
                    'alert-type' => 'error'
                );
            }
        }

        return redirect()->back()->with($notification);
    }

    public function UpdateProductThumbnail(Request $request)
    {

        //single image process
        $id = $request->id;

        if ($request->file('thumbnail')) {
            $request->validate([
                'thumbnail' => 'image|mimes:png,jpg,jpeg|max:5000',
            ]);

            $image = $request->file('thumbnail');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(2000, 2000)->save(public_path('uploads/products/thumbnails/') . $name_gen);
            $img_loc = 'uploads/products/thumbnails/' . $name_gen;

            try {
                $img_to_delete = $request->old_img;
                unlink(public_path($img_to_delete));

                Product::where('id', $id)->update([
                    'product_thumbnail' => $img_loc,
                    'updated_at' => Carbon::now(),
                ]);
                $notification = array(
                    'message' => 'Thumbnail Updated Successfully',
                    'alert-type' => 'success'
                );
            } catch (Exception $e) {
                $notification = array(
                    'message' => 'Thumbnail Update Failed. An Error Occurred',
                    'alert-type' => 'error'
                );
            } finally {
                return redirect()->route('manage-product')->with($notification);
            }
        } else {
            $notification = array(
                'message' => 'Thumbnail Update Failed. No Image Selected',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
    }

    public function DeleteImage($id)
    {
        try {
            $img_to_delete = ProductImage::findOrFail($id);

            unlink(public_path($img_to_delete->image_loc));
            ProductImage::findOrFail($id)->delete();
            $notification = array(
                'message' => 'Image Deletion Successful',
                'alert-type' => 'success'
            );
        } catch (Exception $e) {
            $notification = array(
                'message' => 'Image Deletion Failed. An Error Occurred',
                'alert-type' => 'error'
            );
        } finally {
            return redirect()->back()->with($notification);
        }
    }

    public function ToggleStatus($id)
    {
        # code...
        try {
            $product = Product::findOrFail($id);

            $product->status ? $stat = 0 : $stat = 1;

            Product::findOrFail($id)->update([
                'status' => $stat,
            ]);

            $notification = array(
                'message' => 'Product Status Changed Successfully',
                'alert-type' => 'success'
            );
        } catch (Exception $e) {
            $notification = array(
                'message' => 'Failed. An Error Occurred',
                'alert-type' => 'error'
            );
        } finally {
            return redirect()->back()->with($notification);
        }
    }

    public function destroy($id)
    {
        $prod_id = $id;

        try {
            $product = Product::findOrFail($id);

            $prod_imgs = ProductImage::where('product_id', $id)->get();

            unlink(public_path($product->product_thumbnail));

            Product::findOrFail($id)->delete();

            foreach ($prod_imgs as $img) {
                unlink(public_path($img->image_loc));
            }

            ProductImage::where('product_id', $id)->delete();

            $notification = array(
                'message' => 'Product Deleted Successfully',
                'alert-type' => 'success'
            );
        } catch (Exception $e) {
            $notification = array(
                'message' => 'Failed to Delete Product. An Error Occurred',
                'alert-type' => 'error'
            );
        } finally {
            return redirect()->back()->with($notification);
        }
    }
}

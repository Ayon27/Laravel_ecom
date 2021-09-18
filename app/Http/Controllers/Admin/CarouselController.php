<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Carousel;
use Exception;
use finfo;
use Illuminate\Http\Request;
use Image;
use Carbon\Carbon;

class CarouselController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $carousels = Carousel::latest()->get();
        return view('admin.carousel.carousel_index', compact('carousels'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $request->validate([
            'title' => 'max:50',
            'description' => 'max:255',
            'carousel_image' => 'required|image|mimes:png,jpg,jpeg|max:5120'
        ], [
            'carousel_image.image' => 'The file must be an image of type jpg/png/jpeg',
            'carousel_image.max' => 'The file size must not exceed 5MB',
        ]);



        try {
            $image = $request->file('carousel_image');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(1920, 1080)->save(public_path('uploads/carousel/') . $name_gen);
            $img_loc = 'uploads/carousel/' . $name_gen;

            $carousel = new Carousel();
            $carousel->title = $request->title;
            $carousel->description = $request->description;
            $carousel->carousel_image = $img_loc;
            $carousel->created_at = Carbon::now();

            $this->store($carousel);

            $notification = array(
                'message' => 'Slider Added Successfully',
                'alert-type' => 'success',
            );
        } catch (Exception $e) {
            $notification = array(
                'message' => 'Slider Adding Failed. An Error Occurred',
                'alert-type' => 'error',
            );
        } finally {
            return redirect()->back()->with($notification);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($item_to_save)
    {
        //
        $item_to_save->save();
        return;
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $carousel = Carousel::findOrFail($id);

        return view('admin.carousel.carousel_edit', compact('carousel'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
        $request->validate([
            'title' => 'max:50',
            'description' => 'max:255',
            'carousel_image' => 'image|mimes:png,jpg,jpeg|max:5120'
        ], [
            'carousel_image.image' => 'The file must be an image of type jpg/png/jpeg',
            'carousel_image.max' => 'The file size must not exceed 5MB',
        ]);
        $id = $request->carousel_id;
        try {
            $carousel = Carousel::findOrFail($id);
            $img_loc = $carousel->carousel_image;

            if ($request->carousel_image) {
                unlink(public_path($carousel->carousel_image));

                $image = $request->file('carousel_image');
                $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
                Image::make($image)->resize(1920, 1080)->save(public_path('uploads/carousel/') . $name_gen);
                $img_loc = 'uploads/carousel/' . $name_gen;
            }

            Carousel::findOrFail($id)->update([
                'title' => $request->title,
                'description' => $request->description,
                'carousel_image' => $img_loc,
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
            return redirect()->route('carousel-index')->with($notification);
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        try {
            $carousel =  Carousel::findOrFail($id);
            unlink(public_path($carousel->carousel_image));

            Carousel::findOrFail($id)->delete();
            $notification = array(
                'message' => 'Slide deleted successfully',
                'alert-type' => 'success'
            );
        } catch (Exception $e) {
            $notification = array(
                'message' => 'Failed to delete slide. An Error Occurred',
                'alert-type' => 'error'
            );
        } finally {
            return redirect()->back()->with($notification);
        }
    }

    public function ToggleStatus($id)
    {
        try {
            $carousel = Carousel::findOrFail($id);

            $carousel->status ? $stat = 0 : $stat = 1;

            Carousel::findOrFail($id)->update([
                'status' => $stat,
            ]);

            $notification = array(
                'message' => 'Slide Status Changed Successfully',
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
}

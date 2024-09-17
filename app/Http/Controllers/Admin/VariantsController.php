<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Variant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class VariantsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $variants = Variant::all();



        return view('admin.variants.index')->with(compact('variants'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $brands = Brand::all();
        return view('admin.variants.create')->with(compact('brands'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //

        $request->validate([
            'variant_name' => 'required|unique:variants,variant_name',
            'variant_rental_price' => 'required|numeric|min:100',
            'variant_image' => 'required|image|mimes:png,jpg|max:512'

        ]);

        $path = Storage::disk('public')->put('variant_images', $request->file('variant_image'));
        $path = str_replace('variant_images/', "", $path);

        $data = [
            'variant_name' => $request['variant_name'],
            'variant_rental_price' => $request['variant_rental_price'],
            'brand_id' => $request['brand'],
            'variant_image' => $path
        ];

        Variant::create($data);


        $variants = Variant::all();
        $success = "Created new variant successfully";

        return redirect(route('variants.index'))->with('success', $success);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //


        $variant = Variant::find($id);
        $brands = Brand::all();
        return view('admin.variants.edit')->with(compact('id', 'variant', 'brands'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $request->validate([
            'variant_name' => 'required|unique:variants,variant_name,' . $id . 'id',
            'variant_rental_price' => 'required|numeric|min:100',
            'variant_image' => 'nullable|image|mimes:png,jpg|max:512'

        ]);

        $data = [
            'variant_name' => $request['variant_name'],
            'variant_rental_price' => $request['variant_rental_price'],
            'brand_id' => $request['brand']

        ];



        Variant::find($id)->update($data);

        $variant = Variant::find($id);

        if (!is_null($request->file('variant_image')) && !is_null($variant['variant_image'])) {

            Storage::disk('public')->delete('variant_images/' . $variant['variant_image']);

            $path = Storage::disk('public')->put('variant_images', $request->file('variant_image'));
            $path = str_replace('variant_images/', '', $path);
            Variant::find($id)->update(['variant_image' => $path]);
        }




        $success = "Updated Variant successfully";

        return redirect(route('variants.index'))->with('success', $success);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        dd($id);
    }
}

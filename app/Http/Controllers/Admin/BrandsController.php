<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BrandsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $brands = Brand::all();
        $brands = $brands->toArray();

        return view('admin.brands.index')->with(compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.brands.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'brand_logo' => 'required|image|max:512',
            'brand_name' => 'required|min:3|unique:brands,brand_name',

        ]);

        $path = Storage::disk('public')->put('logo', $request->file('brand_logo'));

        $data = [
            'brand_name' => $request->brand_name,
            'brand_logo' => $path,
        ];
        Brand::create($data);
        $brands = Brand::all();
        $brands = $brands->toArray();
        $success = 'Successfully Created New Brand';
        // return view('admin.brands.index')->with(compact('brands','success'));
        return redirect(route('brands.index'))->with('success', $success);
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
        $brand = Brand::find($id);

        return view('admin.brands.edit')->with(compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(string $id, Request $request)
    {
        //

        $request->validate([
            'brand_name' => 'required|unique:brands,brand_name,'.$id.',id',
            'brand_logo' => 'sometimes|max:512|image',
        ]);
        $data = [
            'brand_name' => $request->brand_name,
        ];
        Brand::find($id)->update($data);

        if (! is_null($request->file('brand_logo'))) {
            $brand = Brand::find($id);
            Storage::disk('public')->delete($brand['brand_logo']);
            $path = Storage::disk('public')->put('logo', $request->file('brand_logo'));
            Brand::find($id)->update(['brand_logo' => $path]);
        }

        return redirect(route('brands.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $brand)
    {
        //
        $brand = Brand::find($brand->brand_id);
        Storage::disk('public')->delete($brand['brand_logo']);
        $brand->delete();

        return redirect(route('brands.index'))->with('success', 'Brand Deleted Successfully');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $products = Product::with('category')->get();
       return response()->json($products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    
     public function store(Request $request)
     {
         $validatedData = $request->validate([
             'name' => 'required|string|max:255',
             'description' => 'nullable|string',
             'price' => 'required|numeric',
             'stock' => 'nullable|integer',
             'category_id' => 'required|exists:categories,id',
             'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:1024', // حجم الصورة بكيلوبايت
         ]);
 
         $product = new Product();
         $product->name = $validatedData['name'];
         $product->description = $validatedData['description'];
         $product->price = $validatedData['price'];
         $product->stock = $validatedData['stock'];
         $product->category_id = $validatedData['category_id'];

 
         if ($request->hasFile('image')) {
             $imagePath = $request->file('image')->store('public/products');
             $product->image = Storage::url($imagePath);
         }
 
         $product->save();
 
         return response()->json(['message' => 'Product created successfully.', 'product' => $product]);
     }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    
    public function update(Request $request, Product $product)
{
    // Validate the incoming request data
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'required|string',
        'price' => 'required|numeric',
        'stock' => 'nullable|integer',
        'category_id' => 'required|exists:categories,id',
        'image' => 'nullable|image|max:2048', // Optional, but must be an image file if present
    ]);
    
    // Use Arr::except to remove the 'image' key from the validated data array before updating the product
    $dataWithoutImage = Arr::except($validatedData, ['image']);
    
    // Update product with the validated data (except the image)
    $product->update($dataWithoutImage);

    if ($request->hasFile('image')) {
        try {
            DB::beginTransaction();
    
            // Capture the old image path before updating
            $oldImagePath = $product->image ? str_replace('/storage', 'public', $product->image) : null;

            // Store the new image and update the product's image attribute
            $imagePath = $request->file('image')->store('public/products');
            $product->image = Storage::url($imagePath);
    
            // Save the product with the new image path
            $product->save();
    
            // Delete the old image after the new image has been saved successfully
            if ($oldImagePath) {
                Storage::delete($oldImagePath);
            }
    
            DB::commit();
    
            return response()->json(['message' => 'Product updated successfully.', 'product' => $product]);
        } catch (\Exception $e) {
            // If there's an error, rollback the transaction
            DB::rollBack();
            return response()->json(['message' => 'Failed to update the product image', 'error' => $e->getMessage()], 500);
        }
    } else {
        // If no image is part of the request, the other updates have already been saved
        return response()->json(['message' => 'Product updated successfully without image update.', 'product' => $product]);
    }
}

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {   $product->delete();
        return response()->json(null, 204); // HTTP 204 No Content
    }

}

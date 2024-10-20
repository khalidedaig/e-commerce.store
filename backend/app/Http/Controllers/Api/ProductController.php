<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Resources\ApiResource;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $products = Product::with(['unit', 'category'])
            ->filter($request->all())
            ->sorted()
            ->paginate(10);
        return ApiResource::collection($products);
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Request $request, $productId)
    {
        $product = Product::findOrFail($productId);
        $relatedProducts = Product::with('unit', 'category')
            ->where('category_id', $product->categoryId)
            ->limit(6)
            ->get();

        return (new ApiResource($product->load('unit', 'category')))
            ->additional(['relatedProducts' => $relatedProducts]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\ProductCollection;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Models\Stand;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Translation\Exception\NotFoundResourceException;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, Stand $stand)
    {
        $products = Product::where('sales_stand_id', $stand->id)->paginate(10);

        return new ProductCollection($products);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request, Stand $stand)
    {
        $data = array_merge($request->all(), ['sales_stand_id' => $stand->id]);

        $product = Product::create($data);

        return response()->json([
            'status'    => 'success',
            'message'   => __('messages.POST.success'),
            'data'      => new ProductResource($product),
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Stand $stand, Product $product)
    {
        if($product->sales_stand_id !== $stand->id) {
            throw new NotFoundHttpException('Não foi encontrado nenhum produto condizente neste stand de vendas');
        }

        return response()->json([
            'data' => new ProductResource($product),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Stand $stand, Product $product)
    {
        if($product->sales_stand_id !== $stand->id) {
            throw new NotFoundHttpException('Não foi encontrado nenhum produto condizente neste stand de vendas');
        }

        $product->update($request->all());

        return response()->json([
            'status'    => 'success',
            'message'   => __('messages.PUT.success'),
            'data'      => new ProductResource($product)
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Stand $stand, Product $product)
    {
        if($product->sales_stand_id !== $stand->id) {
            throw new NotFoundHttpException('Não foi encontrado nenhum produto condizente neste stand de vendas');
        }

        $product->delete();

        return response()->json([
            'status'    => 'success',
            'message'   => __('messages.DELETE.success'),
            'id'        => $product->id,
        ], 200);
    }
}

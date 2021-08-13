<?php

namespace App\Containers\Product\UI\API\Controllers;

use App\Containers\Product\Models\Product;
use App\Containers\Product\UI\API\Requests\CreateProductRequest;
use App\Http\Resources\ProductResource;
use App\Ship\Parents\Controllers\ApiController;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class ProductController extends ApiController
{
    /**
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        $products = Product::paginate(10);
        return ProductResource::collection($products);
    }

    public function store(CreateProductRequest $request)
    {
        $product = Product::create($request->only('title', 'description', 'image', 'price'));
        return response($product, Response::HTTP_CREATED);
    }

    /**
     * @param int $id
     * @return ProductResource
     */
    public function show(int $id): ProductResource
    {
        $product = Product::findOrFail($id);
        return new ProductResource($product);
    }

    public function update(CreateProductRequest $request, int $id)
    {
        $product = Product::findOrFail($id);
        $product->update($request->only('title', 'description', 'image', 'price'));

        return response($product, Response::HTTP_ACCEPTED);
    }

    /**
     * @param int $id
     * @return Response
     */
    public function destroy(int $id): Response
    {
        Product::destroy($id);
        return response(null, Response::HTTP_NO_CONTENT);
    }
}

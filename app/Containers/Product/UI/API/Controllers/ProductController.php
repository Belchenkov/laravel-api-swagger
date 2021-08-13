<?php

namespace App\Containers\Product\UI\API\Controllers;

use App\Containers\Product\Models\Product;
use App\Containers\Product\UI\API\Requests\CreateProductRequest;
use App\Containers\Product\UI\API\Resources\ProductResource;
use App\Ship\Parents\Controllers\ApiController;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;

class ProductController extends ApiController
{
    /**
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        Gate::authorize('view', 'products');

        $products = Product::paginate(10);
        return ProductResource::collection($products);
    }

    public function store(CreateProductRequest $request)
    {
        Gate::authorize('edit', 'products');

        $product = Product::create($request->only('title', 'description', 'image', 'price'));
        return response($product, Response::HTTP_CREATED);
    }

    /**
     * @param int $id
     * @return ProductResource
     */
    public function show(int $id): ProductResource
    {
        Gate::authorize('view', 'products');

        $product = Product::findOrFail($id);
        return new ProductResource($product);
    }

    public function update(CreateProductRequest $request, int $id)
    {
        Gate::authorize('edit', 'products');

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
        Gate::authorize('edit', 'products');

        Product::destroy($id);

        return response(null, Response::HTTP_NO_CONTENT);
    }
}

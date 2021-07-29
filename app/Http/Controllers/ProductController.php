<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class ProductController extends Controller
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
        $file = $request->file('image');
        $name = \Str::random(10);

        $url = \Storage::putFileAs('images', $file, $name . '.' . $file->extension());

        $product = Product::create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'price' => $request->input('price'),
            'image' => env('APP_URL') . '/' . $url
        ]);

        return response($product, Response::HTTP_CREATED);
    }

    /**
     * @param int $id
     * @return ProductResource
     */
    public function show(int $id): ProductResource
    {
        $product = Product::find($id);
        return new ProductResource($product);
    }

    public function update(Request $request, $id)
    {
        //
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

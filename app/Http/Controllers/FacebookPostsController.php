<?php

namespace App\Http\Controllers;

use App\Models\PageInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class FacebookPostsController extends Controller
{
//    cnlferf
    private string $base_url = 'https://graph.facebook.com/v16.0/';

    private string $catalog_id = '996327475108270';

    private string $page_id = '274125533306274';

    private string $token;

    public function __construct()
    {
        $user = app(UserController::class);

        $this->token = $user->getUserInfo()->original->page_access_token;
    }

    public function getPageInfo()
    {
        $info = PageInfo::findOrFail(1);

        return response()->json($info);
    }

    public function getProducts()
    {
        $url = $this->base_url.$this->catalog_id.'/products?fields=name,description,price,availability,condition,product_type,image_url&access_token='.$this->token;

        $data = json_decode(file_get_contents($url), true);

        return response()->json($data);
    }

    public function readProduct($product_id)
    {
        $url = $this->base_url.$product_id.'?fields=name,description,price,availability,brand,image_url,url&access_token='.$this->token;

        $data = json_decode(file_get_contents($url), true);

        return response()->json($data);
    }

    public function createProduct(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'name' => 'required|min:5|string',
            'description' => 'required|string|min:5',
            'price' => 'required|integer',
            'currency' => 'required|size:3',
            'availability' => 'required|string',
            'brand' => 'required|string',
            'image_url' => 'required|url',
            'url' => 'required|url',
        ]);

        if($validate->fails())
        {
            return response()->json([
                'status' => false,
                'error' => $validate->errors()
            ], 422);
        }

        $url = $this->base_url.$this->catalog_id.'/products';

        $headers = ['Authorization' => 'Bearer ' . $this->token];

        $response = Http::withHeaders($headers)->post($url, $request);

        $data = json_decode($response, true);

        if ($response->failed())
        {
            return response()->json([
                'status' => 'false',
                'message' => $data,
            ], 422);
        }

        return response()->json(
            $data, 201);
    }

    public function updateProduct(Request $request, $product_id)
    {
        $validate = Validator::make($request->all(), [
            'name' => 'required|min:5|string',
            'description' => 'required|string|min:5',
            'price' => 'required|integer',
            'currency' => 'required|size:3',
            'availability' => 'required|string',
            'brand' => 'required|string',
            'image_url' => 'required|url',
            'url' => 'required|url',
        ]);

        if($validate->fails())
        {
            return response()->json([
                'status' => false,
                'error' => $validate->errors()
            ], 422);
        }

        $url = $this->base_url.$product_id;

        $headers = ['Authorization' => 'Bearer ' . $this->token];

        $response = Http::withHeaders($headers)->post($url, $request);

        $data = json_decode($response, true);

        if ($response->failed())
        {
            return response()->json([
                'status' => 'false',
                'message' => $data,
            ], 422);
        }

        return response()->json(
            $data);
    }

    public function deleteProduct($product_id)
    {
        $url = $this->base_url.$product_id.'?access_token='.$this->token;

        $response = Http::delete($url);

        if($response->failed())
        {
            return response()->json([
                'status' => 'false',
                'message' => $response->body(),
            ], 500);
        }

        return response()->json([
            'status' => 'true',
            'message' => 'deleted successfully',
        ]);
    }
}

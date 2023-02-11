<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Attribute;
use App\Models\Product;
use App\Models\Variant;
use App\Models\ProductVariant;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function searchProducts(Request $request)
    {
        //dd($request->input('variants'));
        $variants=[];
        $searchString= '';
        if($request->has('variants')){
            $variants = $request->input('variants');
            if(count($variants)==1){
                $data['variant'] = Variant::where(['id' => $variants[0]])->first()->toArray();
            }
        }
        if($request->has('searchString')){
            $searchString = $request->input('searchString');
        }
        $data['products'] = Product::when($variants, function ($query, $variants) {
                $query->whereHas('variants', function ($query) use ($variants) {
                    return $query->distinct()->whereIn('id', $variants);
                }, '=', count($variants));
            })->where('name', 'LIKE', "%{$searchString}%")->get();
        return response()->json($data);
    }
    public function sliderProducts()
    {
        $data = Product::all()->random(20);
        return response()->json($data);
    }
    public function artistProducts()
    {
          $artists = DB::table('variants')
            ->Join('product_variants', 'product_variants.variant_id', '=', 'variants.id')
            ->Join('products', 'products.id', '=', 'product_variants.product_id')
            ->select('variants.id as artist_id','variants.variant as artist_name','variants.description as artist_des', 'products.image as product_image')
            ->where('variants.attribute_id', 4)
            ->groupBy('variants.id')
            ->inRandomOrder()
            ->get();
        // $artists = Variant::with(['products' => function ($query) {
        // }])->where("attribute_id", 4)->get();
        return response()->json($artists);
    }
    public function particularArtistProducts(Request $request)
    {
        if($request->has('artist_id')){
             $artist_id = $request->input('artist_id');
        }else{
            return response()->json('artist_id is required');
        }
        $Products = Variant::with(['products' => function ($query) {
        }])->where('variants.id', $artist_id)->get();
        return response()->json($Products);
    }
    public function productDetails(Request $request)
    {
        if($request->has('product_id')){
             $product_id = $request->input('product_id');
        }else{
            return response()->json('product_id is required');
        }
        //$data = Product::with('attachments','')->where('id',$product_id)->get();
        $artists = DB::table('variants')
            ->Join('product_variants', 'product_variants.variant_id', '=', 'variants.id')
            ->Join('products', 'products.id', '=', 'product_variants.product_id')
            ->select('variants.id as artist_id','variants.variant as artist_name','variants.description as artist_des','variants.image as artist_image','variants.audio as artist_audio','variants.video as artist_video','products.*')
            ->where(['variants.attribute_id'=>4,'products.id'=>$product_id])
            ->get();
         $attachments = DB::table('products')
            ->Join('product_images', 'product_images.product_id', '=', 'products.id')
            ->select('product_images.image')
            ->where(['product_images.product_id'=>$product_id])
            ->orderBy('sort_number', 'asc')
            ->get();
        $variants = DB::table('variants')
            ->Join('product_variants', 'product_variants.variant_id', '=', 'variants.id')
            ->Join('products', 'products.id', '=', 'product_variants.product_id')
            ->select('variants.id as artist_id','variants.variant as artist_name','variants.description as artist_des','variants.image as artist_image','variants.audio as artist_audio','variants.video as artist_video')
            ->where('products.id',$product_id)
            ->where('variants.attribute_id','!=',4)
            ->get();
        //$res = ['artistProduct'=>$artists,'attachments'=>$attachments];
        return response()->json(['artistProduct'=>$artists,'attachments'=>$attachments,'variants'=>$variants]);
    }
    public function soldProducts(Request $request)
    {
        $data = Product::where('quantity', 0)->get();
        return response()->json($data);
    }
}
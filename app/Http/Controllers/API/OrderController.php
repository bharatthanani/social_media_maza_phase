<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Crypt;
use App\Models\User;
use App\Models\Product;
use App\Models\Order;
use App\Models\UserCard;
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;
class OrderController extends Controller
{
    public function createOrderBackup(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name'    => 'required',
            'email'         => 'required|email',
            'address'       => 'required',
            'country'       => 'required',
            'state'         => 'required',
            'city'          => 'required',
            'zipcode'       => 'required',
            'paypal_transection_id'=> 'required',
            'total_amount'  => 'required',
        ]);
        if (!$validator->fails()) {
            $user_id = User::insertGetId([
                'first_name'    => $request->first_name??NULL,
                'last_name'     => $request->last_name??NULL,
                'phone_number'  => $request->phone_number??NULL,
                'email'         => $request->email,
                'password'      => Hash::make(12345)??NULL,
                ]);
            if($request->has("shipping_street")){
                $shipping_street = $request->shipping_street??NULL;
            }
            $shipping_street = $request->address??NULL;
            $shipping_cost = 12;
            if($request->has("shipping_cost")){
                $shipping_cost = $request->shipping_cost??12;
            }
            $order_id = Order::insertGetId([
                'user_id'                   => $request->user_id??$user_id,
                'address'                   => $request->address??NULL,
                'country'                   => $request->country??NULL,
                'state'                     => $request->state??NULL,
                'city'                      => $request->city??NULL,
                'zipcode'                   => $request->zipcode??NULL,
                'shipping_fullname'         => $request->shipping_fullname??NULL,
                'shipping_street'           => $shipping_street??NULL,
                'shipping_apt_or_suit_no'   => $request->shipping_apt_or_suit_no??NULL,
                'shipping_country'          => $request->shipping_country??NULL,
                'shipping_state'            => $request->shipping_state??NULL,
                'shipping_city'             => $request->shipping_city??NULL,
                'shipping_zipcode'          => $request->shipping_zipcode??NULL,
                'shipping_cost'             => $shipping_cost,
                'paypal_transection_id'     => $request->paypal_transection_id??NULL,
                'total_amount'              => $request->total_amount??NULL,
                ]);
            if($request->has("cartItems")){
                foreach ($request->cartItems as $cartItem) {
                    $product = Product::where(['id' => $cartItem['id']])->first()->toArray();
                    Product::where(['id' => $cartItem['id']])->update(['quantity'=>$product['quantity']-$cartItem['quantity']]);
                    OrderItem::insertGetId([
                        'product_id'   => $cartItem['id']??NULL,
                        'order_id'     => $order_id??NULL,
                        'quantity'     => $cartItem['quantity']??NULL,
                        'product_name'   => $cartItem['product_name']??NULL,
                        'product_price'   => $cartItem['product_price']??NULL,
                    ]);
                }
            }
            if ($order_id){
                return response()->json(['Order Created Successfully'],200);
            }else{
                return response()->json(['Something Went Wrong'],404);
            }
        } else {
            return response()->json($validator->errors()->all(),404);
        }
    }
    public function createOrder(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id'       => 'required',
            'address'       => 'required',
            'country'       => 'required',
            'state'         => 'required',
            'city'          => 'required',
            'zipcode'       => 'required',
            'paypal_transection_id'=> 'required',
            'total_amount'  => 'required',
        ]);
        if (!$validator->fails()) {
            DB::beginTransaction();
        try {
            if($request->has("shipping_street")){
                $shipping_street = $request->shipping_street??NULL;
            }else{
                $shipping_street = $request->address??NULL;
            }
            $shipping_cost = 12;
            if($request->has("shipping_cost")){
                $shipping_cost = $request->shipping_cost??12;
            }
            $order_id = Order::insertGetId([
                'user_id'                   => $request->user_id??NULL,
                'address'                   => $request->address??NULL,
                'country'                   => $request->country??NULL,
                'state'                     => $request->city??NULL,
                'city'                      => $request->state??NULL,
                'zipcode'                   => $request->zipcode??NULL,
                'shipping_fullname'         => $request->shipping_fullname??NULL,
                'shipping_street'           => $shipping_street??NULL,
                'shipping_apt_or_suit_no'   => $request->shipping_apt_or_suit_no??NULL,
                'shipping_country'          => $request->shipping_country??NULL,
                'shipping_state'            => $request->shipping_state??NULL,
                'shipping_city'             => $request->shipping_city??NULL,
                'shipping_zipcode'          => $request->shipping_zipcode??NULL,
                'shipping_cost'             => $shipping_cost,
                'paypal_transection_id'     => $request->paypal_transection_id??NULL,
                'total_amount'              => $request->total_amount??NULL,
                ]);
            if($request->has("cartItems")){
                $width  = 0;
                $height = 0;
                $depth  = 0;
                $weight = 0;
                $itemsdata = [];
                foreach ($request->cartItems as $cartItem) {
                    $product = Product::where('id',$cartItem['id'])->first();
                    $width += $product['width'];
                    $height += $product['height'];
                    $depth += $product['depth'];
                    $weight += $product['weight'];
                    $product_name = $cartItem['product_name'];
                    $item_id = $cartItem["id"];
                    $quantity = $cartItem["quantity"];
                    $product_price = $cartItem["product_price"];
                    $weight = $product["weight"]??0;
                    $sku = $product["sku"];
                    $itemsdata[] = [
                        "description" => preg_replace("/\s+/","",$product_name),
                        "item_id" => $item_id,
                        "quantity" => $quantity,
                        "price" => [
                            "amount" => $product_price,
                            "currency" => "USD"
                        ],
                        "weight" => [
                            "value" => $weight,
                            "unit" => "lb"
                        ],
                        "sku" => $sku
                     ];
                    Product::where(['id' => $cartItem['id']])->update(['quantity'=>$product['quantity']-$cartItem['quantity']]);
                    OrderItem::insertGetId([
                        'product_id'   => $cartItem['id']??NULL,
                        'order_id'     => $order_id??NULL,
                        'quantity'     => $cartItem['quantity']??NULL,
                        'product_name'   => $cartItem['product_name']??NULL,
                        'product_price'   => $cartItem['product_price']??NULL,
                    ]);
                }
                $itemsdata = json_encode($itemsdata);
            }
            // USPS CREATE LABEL API START
            if ($order_id){
        	    $user = User::where(['id' => $request->user_id])->first()->toArray();
        	    $email = $user['email'];
        	    $url = 'https://production-api.postmen.com/v3/labels'; // production url
        	    // d37335f9-9399-443b-8b1a-8b59cff15fae	 production_api_key
        	    //$url = 'https://sandbox-api.postmen.com/v3/labels'; // test url
        	    // 33d8801e-79e4-4b2b-ad7b-7a081ce07da0 test_api_key
        	    // 8a216853-cfc2-47ac-bd12-0000149bb308  Production shipper_account
        	    // 3ba41ff5-59a7-4ff0-8333-64a4375c7f21  Test shipper_account
        	    //$url = 'https://production-api.postmen.com/v3/labels';
        	    $method = 'POST';
        	    $headers = array(
        	        "content-type: application/json",
        	        "postmen-api-key:d37335f9-9399-443b-8b1a-8b59cff15fae"
        	    );
        	    $body = '{
                  "service_type": "usps-discounted_priority_mail",
                  "shipper_account": {
                    "id": "8a216853-cfc2-47ac-bd12-0000149bb308"
                  },
                  "paper_size": "default",
                  "shipment": {
                    "parcels": [
                      {
                        "box_type": "custom",
                        "weight": {
                          "value": '.$weight.',
                          "unit": "lb"
                        },
                        "dimension": {
                          "width": '.$width.',
                          "height": '.$height.',
                          "depth": '.$depth.',
                          "unit": "cm"
                        },
                        "items": '.$itemsdata.'
                      }
                    ],
                    "ship_from": {
                      "contact_name": "Zuni Artist Support Team",
                      "phone": "505.660.1359",
                      "email": "info@zasteam.org",
                      "company_name": "Zuni Artist",
                      "street1": "120 West Coal Avenue 87301",
                      "street2": null,
                      "street3": null,
                      "city": "Coal City",
                      "state": "West Virginia",
                      "postal_code": "87301",
                      "country": "USA",
                      "type": "business",
                      "company_url": null,
                      "tax_id": null,
                      "fax": null
                    },
                    
                    "ship_to": {
                      "contact_name": "'.$user['first_name'].' '.$user['last_name'].'",
                      "phone": "'.$user['phone_number'].'",
                      "email": "'.$user['email'].'",
                      "company_name": "Visible SCM",
                      "street1": "'.$shipping_street.'",
                      "street2": null,
                      "street3": null,
                      "city": "'.$request->city.'",
                      "state": "'.$request->state.'",
                      "postal_code": "'.$request->zipcode.'",
                      "country": "USA",
                      "type": "residential"
                    }
                  },
                  "async": false,
                  "references": [
                    "'.$order_id.'"
                  ]
                }';
                //echo ($body); die;
        	    $curl = curl_init();
        	    curl_setopt_array($curl, array(
        	        CURLOPT_RETURNTRANSFER => true,
        	        CURLOPT_URL => $url,
        	        CURLOPT_CUSTOMREQUEST => $method,
        	        CURLOPT_HTTPHEADER => $headers,
        			CURLOPT_POSTFIELDS => $body
        	    ));
        	    $response = curl_exec($curl);
        	    $err = curl_error($curl);
        	    curl_close($curl);
        	    if ($err) {
        	        DB::rollback();
        	        return response()->json(['Address verification failed.Please re-check'],404);
        	        //return response()->json($err,404);
        	    	//echo "cURL Error #:" . $err;
        	    } else {
        	        $url = json_decode($response, 1)["data"]["files"]["label"]["url"];
        	        Order::where(['id' => $order_id])->update(['usps_label'=>$url]);
        	        DB::commit();
        	        return response()->json(['Order Created Successfully'],200);
        	    	//return response()->json( $response,200);
        	    }
        	    
        	    
            }else{
                return response()->json(['Something Went Wrong'],404);
            }
            // USPS CREATE LABEL API END
        }catch (\Exception $ex) {
            DB::rollback();
            return response()->json(['Address verification failed.Please re-check'],404);
        }
        } else {
            return response()->json($validator->errors()->all(),404);
        }
    }
    public function createUserCards(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id'       => 'required',
            'ccv_number'    => 'required',
            'card_number'   => 'required|unique:user_cards',
            'expired_on'    => 'required'
        ]);
        if (!$validator->fails()) {
            // $card_number = UserCard::where(['card_number' => Crypt::encryptString($request->card_number)])->first();
            // dd(Crypt::encryptString($request->card_number));
            // if($card_number){
            //     return response()->json(['Card number already exists'],404);
            // }
            // die;
            UserCard::create([
                'user_id'       => $request->user_id??NULL,
                'ccv_number'    => $request->ccv_number??NULL,
                'card_number'   => Crypt::encryptString($request->card_number)??NULL,
                'expired_on'    => $request->expired_on??NULL,
            ]);
            return response()->json(['Card Info Added Successfully'],200);
        } else {
            return response()->json($validator->errors()->all(),404);
        }
    }
    public function getUserCards(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id'       => 'required',
        ]);
        if (!$validator->fails()) {
           //$user = Product::where(['id' => $request->user_id])->first();
           $data = UserCard::where(['user_id' => $request->user_id])->get();
           $cards =[];
          
          foreach($data as $key => $card){
              $d =['card_number'=>$card->card_number,'ccv_number'=>$card->ccv_number,'expired_on'=>$card->expired_on,'last_four_digit_card_number'=>substr (Crypt::decryptString($card->card_number), -4)];
              $cards[$key]=$d;
              
          }
          return response()->json($cards,200);
        } else {
            return response()->json($validator->errors()->all(),404);
        }
    }
}
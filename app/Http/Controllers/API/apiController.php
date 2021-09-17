<?php

namespace App\Http\Controllers\API;

use App\Agent;
use App\Http\Controllers\Controller;
use App\OrderDetail;
use App\Orders;
use App\Product;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApiController extends Controller
{
    //

    public function storeProduct(Request $request){
        $product = Product::create([
            'product_name' => $request->input('name'),
            'category' => $request->input('category'),
            'type' => $request->input('type'),
            'item' => $request->input('item'),
            'sku' => $request->input('sku'),
            'weight' => $request->input('weight'),
            'price_sell' => str_replace(",","",str_replace(".","",$request->input('price_sell'))),
            'price_agent' => str_replace(",","",str_replace(".","",$request->input('price_agent'))),
            'price_promo' => str_replace(",","",str_replace(".","",$request->input('price_promo'))),
            'description' => $request->input('description'),
            'status' => '1'
        ]);

        if ($product) {

            $data = $product;
            $status = 200;
            $msg = "create data products success";
            return response()->json(compact('status', 'msg', 'data'), 200);
        } else {
            $status = 404;
            $msg = 'create data products fail';
            return response()->json(compact('status', 'msg'), 200);
        }
    }

    public function getProducts(Request $request)
    {

       $keyword_location = $request->get('location');

        $product_list =  Product::orderBy('product.ordering', 'asc')
        ->join('product_category', 'product.category', '=', 'product_category.id')
        ->select('product.*', 'name as category_name')
        ->where('product.status', '1')
        ->paginate(15);


        if (count($product_list)>0) {

            $data = $product_list;
            $status = 200;
            $msg = "show data products success";
            return response()->json(compact('status', 'msg', 'data'), 200);
        } else {
            $status = 404;
            $msg = 'show data products fail';
            return response()->json(compact('status', 'msg'), 200);
        }
    }

    public function getProductsById(Request $request, $productid)
    {
      
             $data =  Product::where('product.id', $productid)
            ->join('product_category', 'product.category', '=', 'product_category.id')
            ->select('product.*', 'name as category_name')
            ->where('product.status', '1')
            ->first();

    
       
        if ($data) {
          
            $status = 200;
            $msg = "show data products by id success";
            return response()->json(compact('status', 'msg', 'data'), 200);
        } else {
            $status = 404;
            $msg = 'show data products by id fail';
            return response()->json(compact('status', 'msg'), 200);
        }
    }


    public function getOrder(Request $request){
        $start = $request->start ?? date('Y-m-d');
        $end = $request->end ?? date('Y-m-d');

        $order = Orders::whereIn('status', [1,2,3,4,5,6])
                ->whereBetween('order_time', [$start . " 00:00:00", $end . " 23:59:59"])
                ->orderBy('id', 'desc')
                ->paginate(15);

        if ($order) {
    
            $data = $order;
            $status = 200;
            $msg = "show data order success";
            return response()->json(compact('status', 'msg', 'data'), 200);
        } else {
            $status = 404;
            $msg = 'show data order fail';
            return response()->json(compact('status', 'msg'), 200);
        }
    }


    function storeOrder(Request $request){

        // DB::beginTransaction(); // <-- first line


            //get last code
            $today = date("Ymd");

            $getTransaction = DB::table('orders')->orderBy('id','desc')->first();

            if(empty($getTransaction)){
                $nextCode = 0001;
            }else {

                $nextTransaction = $getTransaction->id;

                $nextCode = $nextTransaction + 1;
            }

            // membuat format nomor transaksi berikutnya
            $nextNoTransaction = "INV" . $today . sprintf('%04s', $nextCode);

            $invoice_id = $nextNoTransaction;
            $customer_id = $request->input('customer_id');

            $user = User::find($customer_id);
           
            $name = $user->first_name." ".$user->last_name;
            $phone = $user->phone;
            
            $address = $request->address;
            $kelurahan = $request->kelurahan;
            $kecamatan = $request->kecamatan;
            $kota = $request->kota;
            $provinsi = $request->provinsi;
            $kode_pos = $request->kode_pos;
            $latitude = $request->latitude;
            $longitude = $request->longitude;
            $agent_id = $request->input('partner_id');
           

            $buy_by = 'customer';
            $delivery_fee = $request->input('delivery_fee');
            $delivery_date = $request->input('delivery_date');
            $delivery_time = $request->input('delivery_time');
            $order_time = date('Y-m-d H:i:s');

            $ongkir = $request->ongkir;       
            $subtotal = $request->subtotal;
            $jarak = $request->jarak;

            // code ....
            // saved order
            // code ...
            // saved order detail
            $data = Orders::create([
                'invoice_id' => $invoice_id,
                'customer_id' => $customer_id,
                'name' => $name,
                'phone' => $phone,
                'address' => $address,
                'kelurahan' => $kelurahan,
                'kecamatan' => $kecamatan,
                'kota' => $kota,
                'provinsi' => $provinsi,
                'kode_pos' => $kode_pos,
                'latitude' => $latitude,
                'longitude' => $longitude,
                'agent_id' => '15108',
                'agent_name' => 'MYR0013',
                'buy_by' => $buy_by,
                'delivery_fee' => $ongkir,
                'delivery_date' => $delivery_date,
                'delivery_time' => $delivery_time,
                'order_time' => $order_time,
                'order_distance' => $jarak,
                'status' => '1'
            ]);
            
            
            if($data){  

                $total = 0;
                $payment = 0;
                $weight = 0;
                $price = 0;
                $total_price = 0;
                $qty = 0;

                $count = count($request->input('product-id'));
                

                for($n = 0; $n < $count; $n++){

                    $product_id = $request->input('product-id')[$n];
                    $products = Product::find($product_id);

                    // $price = $products->price_sell;
                    // $price_agent = $products->price_agent;

                    $qty = $request->input('qty')[$n];
                    $harga = $request->input('harga')[$n];
                    $total_price = $harga*$qty;
                   
                    $save_detail = OrderDetail::create([
                        'product_id' => $product_id,
                        'order_id' => $data->id,
                        'price' => $harga,
                        'price_agent' => $harga,
                        'qty' => $qty,
                        'total_price' => $total_price
                    ]);

                    if($save_detail){
                        $total = $total+$qty;
                        $weight = $weight+$products->weight;
                        $payment = $payment+$total_price;
                    }

                    $products->save();

                }

                $data->payment_total = $payment;
                $data->order_weight = $weight;
                $data->payment_final = $payment + $ongkir;
                $data->save();

                $childModelSaved = true;
            }else{
                $childModelSaved = false;
            }

        if($childModelSaved) {

            $status = 200;
            $msg = "create order success";
            return response()->json(compact('status', 'msg', 'data'), 200);

        } else {
            $status = 404;
            $msg = 'create order fail';
            return response()->json(compact('status', 'msg'), 200);
        }
    }


    public function login(Request $request){
        $user = User::where('id', $request->id)->where('pin', $request->pin)->first();
        if($user) {
            $data = $user;
            $status = 200;
            $msg = "login success";
            return response()->json(compact('status', 'msg', 'data'), 200);

        } else {
            $status = 404;
            $msg = 'login fail';
            return response()->json(compact('status', 'msg'), 200);
        }
    }

}

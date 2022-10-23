<?php

namespace App\Http\Controllers;
use App\Http\Requests\order_details;
use App\Models\order;
use App\Models\order_service;
use App\Models\test;
use App\Models\User;
use App\Models\profile;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class customerController extends Controller
{
    public function index(){
        $data['hospitals']=User:: where('role','1')->get();
        return view('home',$data);
    }

    public function Hospital_services(){
       $id=$_GET['id'];


        $data['services']= Test::where('hospital_id',$id)->get();
        $data['hospital_title']=User:: where('id',$id)->first();
        $data['hospital_details']= profile:: where('hospital_id',$id)->first();
        $data['hospitals']=User:: where('role','1')->get();
       return view('customer.services',$data);

    }

    public function add_to_cart(){

        $id=$_GET['id'];
     // get test details
        $test=test::where('id',$id)->first();
        if(empty($test))
            abort (404);
          //  session()->flash('cart_error','An error occurred.. Please try again');


        if(session()->has('cart')){
            //check hospital id
            $hospital_id=session()->get('hospital');
            if($hospital_id != $test->hospital_id){
                //clear previous cart
                session()->pull('cart');
                $cart=[$id];
                session()->put('cart',$cart);
                session()->put('hospital',$test->hospital_id);
            }else{
                session()->push('cart',$id);
            }

        }else{
            $cart=[$id];
            session()->put('cart',$cart);
            session()->put('hospital',$test->hospital_id);


        }

        session()->flash('cart_success','Item is added');
         return redirect()->route('services',['id' =>$test->hospital_id]);

    }

    public function cart_list(){
        if(!session()->has('hospital')) abort(403);

        $data['hospitals']=User:: where('role','1')->get();

        $items=session()->get('cart');
        $data['cart_item']=test:: whereIn('id',$items)->get();

        return view('customer.cart_list',$data);
    }

    public function delete_cart_item(){
        $cart= array();
        $id= $_GET['id'];
        foreach(session()->get('cart') as $item ){
            if($item != $id) array_push($cart,$item);

        }

        session()->pull('cart');
        session()->put('cart',$cart);

         return redirect()->route('cart');

    }
    public function confirmation_form(){
        $data['hospitals']=User:: where('role','1')->get();
        $data['profile_data']=profile:: where('user_id',auth()->user()->id)->first();
        return view('customer.user_details',$data);
    }
    public function save_user_data(Order_details $request){
        if(!session()->has('hospital')){
            return redirect()->route('home');
        }


        $request->validated();
        $data= $request->all();

        $data['user_id']= Auth:: id();
        $data['hospital_id']=session()->get('hospital');
        order::create($data);
        $order_id=order::where('user_id',Auth::user()->id)->orderByDesc('id')->first();
        foreach(session()->get('cart') as $service){
            order_service::insert([
                'order_id'=> $order_id->id,
                'service_id'=> $service,

                ]);
        }

        session()->pull('hospital');
        session()->pull('cart');
        session()->flash('success','Appointment place successfully');
        return redirect()->route('home');

    }

    public function orders(){


        $data['hospitals']=User:: where('role','1')->get();
        $data['orders']=order::select('users.name','order.id','order.created_at','order.appointment_date','order.status')
            ->where('user_id',Auth::id())
            ->join('users','order.hospital_id',"=",'users.id')
            ->orderByDesc('order.id')->get();
       // return $data['orders'];
        return view('customer.orders',$data);
    }
    public function order_details(){
        $id=$_GET['id'];
        $data['order_details']=order::where('id',$id)->first();
        $data['hospital']=User:: where('id',$data['order_details']->hospital_id)->first();
        $data['tests']=order_service::select('order_service.id as order_service_id', 'order_service.*', 'test.*')->where('order_id',$id)->join('test','order_service.service_id',"=",'test.id')->get();
        $data['hospitals']=User:: where('role','1')->get();
        return view('customer.order_details',$data);
    }

    public function report_download($test_id){
        $filename = order_service::where('id', $test_id)->first();
        return Storage::download('public/report/'.$filename->report);
    }




}

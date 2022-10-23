<?php

namespace App\Http\Controllers;

use App\Models\order;
use App\Models\order_service;
use App\Models\profile;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class OneStopController extends Controller
{
    public function index(){
        return redirect(route('onestop.request'));
    }


    public function request(Request $request){
        $data['user'] = profile::where('user_id',Auth::id())->first();

        $data['hospital'] = User::where('id',$data['user']->hospital_id)->first();

        $data['hospital_profile'] = profile::where('user_id',$data['hospital']->id)->first();

        if($request->has('from') && $request->has('to')){
            // return $request->input('from');
            $from= $request->input('from');
            $to= $request->input('to');

            if(Carbon::parse($from)->gte($to)){
                return back()->with('error','invalid date');
            }
            $data['requests'] = order::where('hospital_id',$data['user']->hospital_id)
                ->where('status',0)
                ->whereBetween('appointment_date',[$from,$to])
                //->anywhere('appointment_date','<=',$to)
                ->get();

        }else{
            $data['requests'] = order::where('hospital_id',$data['user']->hospital_id)
                ->where('status',0)
                ->get();

        }
        $data['report_confirm'] = 1;

        return view('onestop.request', $data);
    }

    public function pending(Request $request){
        $data['user'] = profile::where('user_id',Auth::id())->first();

        $data['hospital'] = User::where('id',$data['user']->hospital_id)->first();

        $data['hospital_profile'] = profile::where('user_id',$data['hospital']->id)->first();

        if($request->has('from') && $request->has('to')){
            // return $request->input('from');
            $from= $request->input('from');
            $to= $request->input('to');

            if(Carbon::parse($from)->gte($to)){
                return back()->with('error','invalid date');
            }
            $data['requests'] = order::where('hospital_id',$data['user']->hospital_id)
                ->where('status',1)
                ->whereBetween('appointment_date',[$from,$to])
                //->anywhere('appointment_date','<=',$to)
                ->get();

        }else{
            $data['requests'] = order::where('hospital_id',$data['user']->hospital_id)
                ->where('status',1)
                ->get();

        }
        $data['report_confirm'] = 1;

        return view('onestop.pending', $data);
    }

    public function complete(Request $request){
        $data['user'] = profile::where('user_id',Auth::id())->first();

        $data['hospital'] = User::where('id',$data['user']->hospital_id)->first();

        $data['hospital_profile'] = profile::where('user_id',$data['hospital']->id)->first();

        if($request->has('from') && $request->has('to')){
            // return $request->input('from');
            $from= $request->input('from');
            $to= $request->input('to');

            if(Carbon::parse($from)->gte($to)){
                return back()->with('error','invalid date');
            }
            $data['requests'] = order::where('hospital_id',$data['user']->hospital_id)
                ->where('status','>=',2)
                ->whereBetween('appointment_date',[$from,$to])
                //->anywhere('appointment_date','<=',$to)
                ->get();

        }else{
            $data['requests'] = order::where('hospital_id',$data['user']->hospital_id)
                ->where('status','>=',2)
                ->get();

        }
        $data['report_confirm'] = 1;
        return view('onestop.completed', $data);
    }

    public function details($id,$pid, $report_confirm){
        $data['user'] = profile::where('user_id',Auth::id())->first();
        $data['hospital'] = User::where('id',$data['user']->hospital_id)->first();
        $data['hospital_profile'] = profile::where('user_id',$data['hospital']->id)->first();
        $data['order_details'] = order::where('id',$id) ->where('status', 0)->first();

        $data['tests'] = order_service::select('order_service.id', 'order_service.report', 'order_service.service_id','test.name', 'test.service_type', 'test.price')
            ->where('order_id', $id)
            ->leftJoin('test', 'order_service.service_id', 'test.id')
            ->get();


        $data['report_confirm'] = $report_confirm;
        //$data['order_id', ]
        return view('onestop.details', $data);
    }

    public function request_confirm($id){

        $order = order::where('id', $id)->first();

        if($order->payment != 0){
            order::where('id', $id)->update(['status' => 1]);
            return redirect(route('onestop.pending'));
        }

        return back();
    }

    public function update_payment(Request $request){



        $request->validate([
           //'amount' => 'numeric|min:100'
        ]);

        $previous_amount = (order::where('id', $request->input('order_id'))->first())->payment;
        $total = $previous_amount+$request->input('amount');

        order::where('id', $request->input('order_id'))->update(['payment' => $total]);
        return back();
    }

    public function c_details($id,$pid, $report_confirm){
        $data['user'] = profile::where('user_id',Auth::id())->first();
        $data['hospital'] = User::where('id',$data['user']->hospital_id)->first();
        $data['hospital_profile'] = profile::where('user_id',$data['hospital']->id)->first();
        $data['order_details'] = order::where('id',$id) ->first();

        $data['tests'] = order_service::select('order_service.id', 'order_service.report', 'order_service.service_id','test.name', 'test.service_type', 'test.price')
            ->where('order_id', $id)
            ->leftJoin('test', 'order_service.service_id', 'test.id')
            ->get();


        $data['report_confirm'] = $report_confirm;
        //$data['order_id', ]
        return view('onestop.c_details', $data);
    }

    public function p_details($id,$pid, $report_confirm){
        $data['user'] = profile::where('user_id',Auth::id())->first();
        $data['hospital'] = User::where('id',$data['user']->hospital_id)->first();
        $data['hospital_profile'] = profile::where('user_id',$data['hospital']->id)->first();
        $data['order_details'] = order::where('id',$id) ->first();

        $data['tests'] = order_service::select('order_service.id', 'order_service.report', 'order_service.service_id','test.name', 'test.service_type', 'test.price')
            ->where('order_id', $id)
            ->leftJoin('test', 'order_service.service_id', 'test.id')
            ->get();


        $data['report_confirm'] = $report_confirm;

        return view('onestop.p_details', $data);
    }

    public function order_complete($order_id, $due){
        if($due>0){
            return back();
        }
        order::where('id', $order_id)->update(['status'=> 3]);

        return back();
    }
    public function download_report($id){

        $filename = order_service::where('id', $id)->first();
        return Storage::download('public/report/'.$filename->report);
    }


}

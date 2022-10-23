<?php

namespace App\Http\Controllers;

use App\Http\Requests\order_details;
use App\Models\order;
use App\Models\profile;
use App\Models\User;
use App\Models\order_service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

use phpDocumentor\Reflection\Types\True_;
use function PHPUnit\Framework\returnArgument;

class LabController extends Controller
{
    public function index(){
        return redirect(route('lab.pending'));
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

        return view('lab.pending',$data);
    }
    public function pending_details($id,$pid, $report_confirm){
        $data['user'] = profile::where('user_id',Auth::id())->first();
        $data['hospital'] = User::where('id',$data['user']->hospital_id)->first();
        $data['hospital_profile'] = profile::where('user_id',$data['hospital']->id)->first();
        $data['order_details'] = order::where('id',$id) ->where('status','>=', 1)->first();
        $data['tests'] = order_service::select('order_service.id', 'order_service.report', 'order_service.service_id','test.name', 'test.service_type', 'test.price')
                            ->where('order_id', $id)
                            ->leftJoin('test', 'order_service.service_id', 'test.id')
                            ->get();
        //return $data['tests'];

        $data['report_confirm'] = $report_confirm;

        return view('lab.details',$data);
    }

    public function completed(Request $request){

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
                ->where('status',2)
                ->whereBetween('appointment_date',[$from,$to])
                //->anywhere('appointment_date','<=',$to)
                ->get();

        }else{
            $data['requests'] = order::where('hospital_id',$data['user']->hospital_id)
                ->where('status',2)
                ->get();

        }
        $data['report_confirm'] = 0;

        return view('lab.complete',$data);
    }

    public function upload_report(Request $request){
        $request->validate([
           'report' => 'required|file|mimetypes:application/pdf|max:2048',
            'order_service_id' => 'required|numeric'
        ]);

        $path = $request->file('report')->store('public/report');
        if(order_service::where('id', $request->input('order_service_id'))->
            update(['report'=>  substr($path, 14)]))
        {
            return back()->with('success', 'Report Upload Successfully') ;
        }

        return back()->with('error', 'An error is Occurred. Please try later..');
    }

    public function download_report($id){

        $filename = order_service::where('id', $id)->first();
        return Storage::download('public/report/'.$filename->report);
    }

    public function delete_report($id){
        order_service::where('id', $id)->update(['report'=>'Not Available']);
        return back();
    }

    public function confirm_order($id){

        $isDone = true;

        $reports  = order_service::where('order_id', $id)->get();
        foreach ($reports as $report){
            if($report->report == "Not Available") $isDone = false;
        }

        if($isDone){
            order::where('id', $id)->update(['status'=> 2]);
            return redirect(route('lab.pending'));
        }
        return back();




    }

}

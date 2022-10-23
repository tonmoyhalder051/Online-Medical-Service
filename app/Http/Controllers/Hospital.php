<?php

namespace App\Http\Controllers;

use App\Models\profile;
use App\Models\test;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class Hospital extends Controller
{

    public function index(){
        $data['user'] = profile::where('user_id',Auth::id())->first();
        $data['tests'] = test:: where('hospital_id',$data['user']->hospital_id)->get();
        $data['staffs'] = profile:: where('hospital_id',$data['user']->hospital_id)->LeftJoin('users','profile.user_id','users.id')->get();

        return view('hospital.home',$data);
    }

    public function staff_create(){
        return view('hospital.create_staff');
    }

    public function test_create(){
        return view('hospital.create_test');
    }
    public function test_save(Request $request){
        $request->validate([
            'name'=> 'string|min:3|max:20',
            'price'=> 'numeric|min:10|max:10000',
            'discount'=> 'numeric|min:0|max:80'

        ]);
        $data = $request->except('_token');
        $data['description'] = "empty";
        $data['hospital_id'] = (profile::where('user_id',Auth::id())->first())->hospital_id;
        $data['service_type'] = 1;
        $data['active'] = 1;
        if(!test::insert($data)){
            return back()->with('error'," An Error is occurred. Please try again...");
        }

        return back()->with('success',"Test save successfully");
    }

    public function staff_save(Request $request){
        $request->validate([
            'name'=> 'string|min:3|max:20',
            'password'=> 'alpha_num|min:5|max:20',
            'address'=> 'string|min:10|max:50',
            'email' => 'email|unique:App\Models\User,email'
        ]);
        $data['name'] = $request->input('name');
        $data['password'] = Hash::make($request->input('password'));
        $data['email'] = $request->input('email');
        $data['role'] = $request->input('role');
        $id = User:: insertGetId($data);

        $hospital = profile::where('user_id',Auth::id())->first();
        profile::insert(['user_id'=>$id, 'hospital_id'=>$hospital->hospital_id,'address'=>$request->input('address')]);
        return back()->with('success',"Data save successfully");

    }

    public function staff_delete($id){
        User:: where('id',$id)->delete();
        profile::where('user_id',$id)->delete();
        return redirect(route('hospital.home'));
    }


}


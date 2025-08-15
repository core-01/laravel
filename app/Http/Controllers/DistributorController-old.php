<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Distributor;
use Validator;
Use Exception;
use Hash;
class DistributorController extends Controller
{
    public function distributorRegister(Request $request){
        // dd($request->all());
        $validate = Validator::make($request->all(),[
            'name' => 'required',
            'mobile' => 'required|max:10|min:10',
            'password' => 'required',
            'confirmPassword' => 'required_with:password|same:password',
        ]);
        if($validate->fails()){
            return back()->with(['message'=>$validate->errors()->first(),'alert-type'=>'error'])
            ->withInput($request->all())
            ->withErrors($validate->errors());
        }
        try{
        $distributor = new Distributor();
        $distributor->name = $request->name;
        $distributor->email = $request->email;
        $distributor->mobile = $request->mobile;
        $distributor->address = $request->address;
        $distributor->distributor_id = rand(99999999,11111111);
        $distributor->password = Hash::make($request->password);
        $distributor->visible_pass = $request->password;
        $distributor->status = $request->status;
        $res = $distributor->save();
        if($res){
            return back()->with(['message'=>'Registerd successfully !!','alert-type'=>'success']);
        }

    }catch(Exception $e) {
       return back()->with(['message'=>$e->getMessage(),'alert-type'=>'error']);
      }
    }

    public function activeDistributor($id){
        $distributor = Distributor::where('distributor_id',$id)->first();
         $distributor->status = "Active";
         $res = $distributor->save();
        if($res){
            return back()->with('success','Distributor successfully actived.');
        }


    }
}

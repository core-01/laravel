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
            // 'password' => 'required',
            // 'confirmPassword' => 'required_with:password|same:password',
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
        // $distributor->distributor_id = rand(99999999,11111111);
        // $distributor->password = Hash::make($request->password);
        // $distributor->visible_pass = $request->password;

        if($request->bank_statement && count($request->bank_statement)){
        $distributor->statement = implode(',',$request->bank_statement);
        }

        if($request->adhar_card && count($request->adhar_card)){
        $distributor->adhar_card = implode(',',$request->adhar_card);
        }

        if($request->photo){
            $filename ='IMG'.rand(11111,99999).'.'.$request->photo->extension();
            $request->photo->move(public_path('upload/distributor/photo'),$filename);
            $distributor->passport_image = $filename;
        }

        if($request->pan_card){
            $filename ='PAN'.rand(11111,99999).'.'.$request->pan_card->extension();
            $request->pan_card->move(public_path('upload/distributor/pan_card'),$filename);
            $distributor->pan_image = $filename;
        }
       
        
        $distributor->register_date = date('Y-m-d');
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
        $distributor = Distributor::where('id',base64_decode($id))->first();
        if($distributor){
            if($distributor->status=="Active"){
                $distributor->status = "Inactive";
                $distributor->inactive_date = date('Y-m-d');

            }else{
                if($distributor->distributor_id==""){
                    $pass =rand(11111111,99999999);
                $distributor->distributor_id = rand(999999999999,111111111111);
                $distributor->password = \Hash::make($pass);
                $distributor->visible_pass = $pass;

                }
                $distributor->status = "Active";
                $distributor->Aprrove_date = date('Y-m-d');

            }
            $res = $distributor->save();
           if($res){
               return back()->with('success','Distributor successfully actived.');
           }
        }else{
            return back();
        }
        


    }


    public function uploadDistributorPDF(Request $req){
        
        $filename ='STATEMENT'.rand(11111,99999).'.'.$req->file->extension();
        $req->file->move(public_path('/distributor/bankstatement'),$filename);
        return '/bankstatement/'.$filename;
    }
    public function uploadDistributorImage(Request $req){
        
        $filename ='aadhar'.rand(11111,99999).'.'.$req->file->extension();
        $req->file->move(public_path('/distributor/aadhar'),$filename);
        return '/aadhar/'.$filename;
    }

    public function removeFiles(Request $req){
        // dd(\File::exists(public_path('distributor/bankstatement/'.$req->image_name)));
        if(\File::exists(public_path('/distributor/aadhar/'.$req->image_name))){
            \File::delete(public_path('/distributor/aadhar/'.$req->image_name));
        }

        if(\File::exists(public_path('/distributor/bankstatement/'.$req->image_name))){
            \File::delete(public_path('/distributor/bankstatement/'.$req->image_name));
        }
        return "done";
    }

    
}

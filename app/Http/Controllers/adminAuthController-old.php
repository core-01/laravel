<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use Session;
use Validator;
class adminAuthController extends Controller
{
    public function login(Request $request){

        $validator =Validator::make($request->all(),[
            'username' => 'required',
            'password'=>'required',
        ]);
        if($validator->fails()){
            return back()->with(['message'=>$validator->errors()->first(),'alert-type'=>"error"])
            ->withInput($request->all())
            ->withError($validator->errors());
        }
        $admin = Admin::where('username',$request->username)->first();
        if($admin){
            if($admin->password == $request->password){
                    Session::put('admin',$admin);
                    return redirect('admin-dashboard');
            }
            else{
                return back()->with(['message'=>'inavalid credential.','alert-type'=>'error']);
            }
        }else{
            return back()->with(['message'=>'inavalid username and password.','alert-type'=>'error']);
        }
    }

    public function logout(){
        if(Session::has('admin')){
            Session::flush('admin');
            return redirect('admin-login');
        }else{
            return back();
        }
    }


                public function updatePassword (Request $request){
                
                    $validator = Validator::make($request->all(),[
                        'oldPassword'=> 'required',
                        'newPassword'=> 'required',
                        'confirmPassword'=> 'required',
                    ]);
                    if($validator->fails()){
                        return back()->with(['message'=>$validator->errors()->first(),'alert-type'=>'error'])
                        ->withError($validator->errors())
                        ->withInput($request->all());
                    }

                $admin = Admin::where('username',Session::get('admin')->username)->first();
                if($admin){
                    if($admin->password == $request->oldPassword){
                    if($request->newPassword == $request->confirmPassword){
                        $admin->password = $request->newPassword;
                        $res =$admin->save();
                        if($res){
                            Session::flush('admin');
                            return redirect('admin-login');
                        }
                    }else{
                        return back()->with(['message'=>"Confirm password does't match",'alert-type'=>'error']);
                    }
                }
                else{
                    return back()->with(['message'=>"Old password does't match",'alert-type'=>'error']);
                }
            }
            }


                public function deleteAdmin($id){
                $admin = Admin::where('id',base64_decode($id))->first();
                    if($admin)
                    {
                        $access = AdminAccess::where('admin_id',base64_decode($id))->first();  
                        if($access){
                            $access->delete();
                        }
                        $res =  $admin->delete();
                        if($res)
                        {
                            return back()->with('success','Deleted Successfully !');
                        }
                    }else
                    {
                        return back()->with('error','Something went wrong !');
    
                    }
            
                }


}
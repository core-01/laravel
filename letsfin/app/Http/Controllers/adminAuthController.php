<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\AdminAccess;
use Session;
use Validator;
use Hash;
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
                if($admin->status !=1){
                    return back()->with(['message'=>'Your account has been deactive. please contact super Admin','alert-type'=>"error"]);
                }else if(\Hash::check($request->password, $admin->Hash_password )){ 
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
            Session::forget('admin');
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
                    // if($admin->password == $request->oldPassword){
                    if(\Hash::check($request->oldPassword, $admin->Hash_password )){

                    if($request->newPassword == $request->confirmPassword){
                        $admin->Hash_password = \Hash::make($request->newPassword);
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


            public function addAdmin(Request $request){
                // dd($request->all());

                $validator =Validator::make($request->all(),
                        [
                            'name' => 'required',
                            'email'=>'required|unique:admins,email,',
                            'mobile'=>'required',
                            'username'=>'required|unique:admins,username',
                            'password'=>'required',
                        ]
                     );

                if($validator->fails())
                {
                    return back()->with(['message'=>$validator->errors()->first(),'alert-type'=>"error"])
                    ->withInput($request->all())
                    ->withErrors($validator->errors());
                }

                $admin = new Admin();
                try{
                    \DB::beginTransaction();
                $admin->name    = $request->name;
                $admin->email    = $request->email;
                $admin->mobile    = $request->mobile;
                $admin->username    = $request->username;
                $admin->password    = $request->password;
                if($request->status){
                    $admin->status    = 1;
                }else{
                    $admin->status    = 0;
                }

                $admin->Hash_password    = \Hash::make($request->password);
                $admin->role    =2;
                $res = $admin->save(); 

                if($res){
                    // dd($admin->id);
                    $access = new AdminAccess();
                    $access->admin_id = $admin->id; 
                    if(count($request->links)){
                        $access->url_id = implode(',',$request->links);
                    }
                    $access->save();
                    \DB::commit();
                    return redirect('admin/admin')->with('success','New Admin Added Successfully');
                }

            }catch(\Exception $e){
                \DB::rollback();
                return back()->with('error',$e->getMessage())
                ->withInput($request->all())
                ->withErrors($validator->errors());
            }

            }



            public function updateAdmin(Request $request){ 


                $validator =Validator::make($request->all(),
                        [
                            'name' => 'required',
                            'email'=>'required|unique:admins,email,'.$request->id,
                            'mobile'=>'required',
                            // 'username'=>'required|unique:admins,username'.$request->id,
                            // 'password'=>'required',
                        ]
                     );

                if($validator->fails())
                {
                    return back()->with(['message'=>$validator->errors()->first(),'alert-type'=>"error"])
                    ->withInput($request->all())
                    ->withErrors($validator->errors());
                }

                $admin =  Admin::where('id',$request->id)->first();
                try{

                    \DB::beginTransaction();
                $admin->name    = $request->name;
                $admin->email    = $request->email;
                $admin->mobile    = $request->mobile; 
                if($request->status)
                {
                    $admin->status    = 1;
                }else{
                    $admin->status    = 0;
                }
                $admin->role    =2;
                $res = $admin->save(); 
                
                if($res){ 

                    $access = AdminAccess::where('admin_id',$admin->id)->first();
                    // $access->admin_id = $admin->id; 
                    if($request->links){
                        $access->url_id = implode(',',$request->links);
                    }else{
                        $access->url_id ="";
                    }
                    $access->save();
                    \DB::commit();
                    return redirect('admin/admin')->with('success','Updated Successfully');
                }

            }catch(\Exception $e){
                \DB::rollback();
                return back()->with('error',$e->getMessage())
                ->withInput($request->all())
                ->withErrors($validator->errors());
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
            
            
               public function adminView(){
                $admins = \DB::table('admins')->where('role',2)->latest()->get();

                $sessiond = Session::get('admin');
                if($sessiond->role==1)
                {
                    return view('admin.admins',compact('admins'));
                }
                else if($sessiond->role==2)
                {
                    $access_url = \DB::table('admin_accesses')->where('admin_id',$sessiond->id)->select('url_id')->first();
                     $urls = explode(',',$access_url?$access_url->url_id:'');
                     if(in_array(11,$urls)){
                        return view('admin.admins',compact('admins'));
         
                     }else{
                        return redirect('page-not-found');
                     }
                }
               
            }

}
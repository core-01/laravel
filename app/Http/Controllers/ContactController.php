<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use Validator;
class ContactController extends Controller
{
    public function contactForm(Request $request){
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'mobile' => 'required|min:10|max:10',
            // 'name' => 'required',

        ]);
        if($validator->fails()){
            return back()->with(['message'=>$validator->errors()->first(),'alert-type'=>'error'])
            ->withInput($request->all())
            ->withErrors($validator->errors());
        }
        // dd($request->all());
        $contact = new Contact();
        $contact->name = $request->name;
        $contact->email = $request->email;
        $contact->mobile = $request->mobile;
        $contact->message = $request->message;
        $res = $contact->save();
        if($res){
            return back()->with(['message'=>'your message send successfully !','alert-type'=>'success']);
        }
    }
}

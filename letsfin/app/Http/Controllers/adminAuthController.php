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
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->with(['message' => $validator->errors()->first(), 'alert-type' => "error"])
                ->withInput($request->all())
                ->withErrors($validator->errors());
        }

        $admin = Admin::where('username', $request->username)->first();

        if ($admin) {
            if ($admin->status != 1) {
                return back()->with(['message' => 'Your account has been deactivated. Please contact Super Admin.', 'alert-type' => "error"]);
            } elseif (Hash::check($request->password, $admin->Hash_password)) {
                Session::put('admin', $admin);
                return redirect('admin-dashboard');
            } else {
                return back()->with(['message' => 'Invalid credentials.', 'alert-type' => 'error']);
            }
        } else {
            return back()->with(['message' => 'Invalid username and password.', 'alert-type' => 'error']);
        }
    }

    public function logout()
    {
        if (Session::has('admin')) {
            Session::forget('admin');
            return redirect('admin-login');
        }
        return back();
    }

    public function updatePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'oldPassword' => 'required',
            'newPassword' => 'required',
            'confirmPassword' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->with(['message' => $validator->errors()->first(), 'alert-type' => 'error'])
                ->withErrors($validator->errors())
                ->withInput($request->all());
        }

        $admin = Admin::where('username', Session::get('admin')->username)->first();

        if ($admin) {
            if (Hash::check($request->oldPassword, $admin->Hash_password)) {
                if ($request->newPassword == $request->confirmPassword) {
                    $admin->Hash_password = Hash::make($request->newPassword);
                    $admin->password = $request->newPassword;
                    if ($admin->save()) {
                        Session::forget('admin');
                        return redirect('admin-login');
                    }
                } else {
                    return back()->with(['message' => "Confirm password doesn't match", 'alert-type' => 'error']);
                }
            } else {
                return back()->with(['message' => "Old password doesn't match", 'alert-type' => 'error']);
            }
        }
    }

    public function addAdmin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|unique:admins,email',
            'mobile' => 'required',
            'username' => 'required|unique:admins,username',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->with(['message' => $validator->errors()->first(), 'alert-type' => "error"])
                ->withInput($request->all())
                ->withErrors($validator->errors());
        }

        try {
            \DB::beginTransaction();

            $admin = new Admin();
            $admin->name = $request->name;
            $admin->email = $request->email;
            $admin->mobile = $request->mobile;
            $admin->username = $request->username;
            $admin->password = $request->password;
            $admin->status = $request->status ? 1 : 0;
            $admin->Hash_password = Hash::make($request->password);
            $admin->role = 2;
            $admin->save();

            $access = new AdminAccess();
            $access->admin_id = $admin->id;
            $access->url_id = count($request->links) ? implode(',', $request->links) : '';
            $access->save();

            \DB::commit();
            return redirect('admin/admin')->with('success', 'New Admin Added Successfully');
        } catch (\Exception $e) {
            \DB::rollback();
            return back()->with('error', $e->getMessage())
                ->withInput($request->all())
                ->withErrors($validator->errors());
        }
    }

    public function updateAdmin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|unique:admins,email,' . $request->id,
            'mobile' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->with(['message' => $validator->errors()->first(), 'alert-type' => "error"])
                ->withInput($request->all())
                ->withErrors($validator->errors());
        }

        try {
            \DB::beginTransaction();

            $admin = Admin::find($request->id);
            $admin->name = $request->name;
            $admin->email = $request->email;
            $admin->mobile = $request->mobile;
            $admin->status = $request->status ? 1 : 0;
            $admin->role = 2;
            $admin->save();

            $access = AdminAccess::where('admin_id', $admin->id)->first();
            $access->url_id = $request->links ? implode(',', $request->links) : '';
            $access->save();

            \DB::commit();
            return redirect('admin/admin')->with('success', 'Updated Successfully');
        } catch (\Exception $e) {
            \DB::rollback();
            return back()->with('error', $e->getMessage())
                ->withInput($request->all())
                ->withErrors($validator->errors());
        }
    }

    public function deleteAdmin($id)
    {
        $decodedId = base64_decode($id);
        $admin = Admin::find($decodedId);

        if ($admin) {
            AdminAccess::where('admin_id', $decodedId)->delete();
            if ($admin->delete()) {
                return back()->with('success', 'Deleted Successfully!');
            }
        }

        return back()->with('error', 'Something went wrong!');
    }

    public function adminView()
    {
        $admins = \DB::table('admins')->where('role', 2)->latest()->get();
        $sessionAdmin = Session::get('admin');

        if ($sessionAdmin->role == 1) {
            return view('admin.admins', compact('admins'));
        } elseif ($sessionAdmin->role == 2) {
            $access_url = \DB::table('admin_accesses')
                ->where('admin_id', $sessionAdmin->id)
                ->select('url_id')
                ->first();

            $urls = explode(',', $access_url ? $access_url->url_id : '');
            if (in_array(11, $urls)) {
                return view('admin.admins', compact('admins'));
            } else {
                return redirect('page-not-found');
            }
        }
    }
}

<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use App\Models\PatientClinicalRecord;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function login()
    {
        return view('admin.auth.admin_login');
    }

    public function systemLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);


        $email = trim($request->email);
        $data = User::where('email', $email)->first();

        if (!$data) {
            return back()->with('error', 'User not found.');
        }

        if ($data->role == "super_admin") {
            if (Auth::guard('super_admin')->attempt(['email' => $request->email, 'password' => $request->password])) {
                $request->session()->regenerate();
                return redirect()->route('admin.dashboard');
            } else {
                return back()->with('error', 'Invalid Credantials');
            }
        }else {
              return back()->with('error', 'Authentication Fails');
            }

    }


    public function dashboard()
    {


        return view('admin.backend.dashboard');
    }

    public function AdminLogout(Request $request)
    {
        if (Auth::guard('super_admin')->check()) {
            Auth::guard('super_admin')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect('/');
        }

    }

   


}

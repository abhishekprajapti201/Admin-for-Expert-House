<?php

namespace App\Http\Controllers\Backend;

use App\Events\DoctorRegEvent;
use App\Http\Controllers\Controller;
use App\Models\Appoinment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DoctorManageController extends Controller
{
    public function doctorList(){
        $doctors = User::where('role',"!=",'super_admin')->paginate(10);
        return view('admin.backend.doctors.index',compact('doctors'));
    }

    public function createdocForm(){
        return view('admin.backend.doctors.create');
    }

    public function AddDoctor(Request $request){
        $request->validate([
            'name'=>'required|string',
            'email'=>'required|email',
            'password'=>'required|min:8|max:12',
            'city'=>'required|string',
            'country'=>'required|string',
            'state'=>'required|string',
            'pin_code'=>'required|string',
            'doctor_strime'=>'required|string',
            'phone'=>'required',
            'role'=>'required|in:doctor,super_admin',
        ]);

        $planTextPasssword = trim($request->password);

        $data = User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
            'city'=>$request->city,
            'country'=>$request->country,
            'state'=>$request->state,
            'pin_code'=>$request->pin_code,
            'doctor_strime'=>$request->doctor_strime,
            'phone'=>$request->phone,
            'role'=>$request->role,
        ]);
          $createdata = DoctorRegEvent::dispatch($data,$planTextPasssword);

          if($createdata){
            return redirect()->back()->with('success','Doctor Account Created SuccessFully');
          }else{
            return redirect()->back()->with('error','Something went wrong');
          }
    }

    public function UpdateDoctor(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email,' . $id,
            'city' => 'required|string',
            'country' => 'required|string',
            'state' => 'required|string',
            'pin_code' => 'required|string',
            'doctor_strime' => 'required|string',
            'phone' => 'required',
            'role' => 'required|in:doctor,super_admin',
        ]);

        $doctor = User::findOrFail($id);

        $doctor->name = $request->name;
        $doctor->email = $request->email;
        $doctor->city = $request->city;
        $doctor->country = $request->country;
        $doctor->state = $request->state;
        $doctor->pin_code = $request->pin_code;
        $doctor->doctor_strime = $request->doctor_strime;
        $doctor->phone = $request->phone;
        $doctor->role = $request->role;
        $doctor->save();

        return redirect()->back()->with('success', 'Doctor updated successfully.');
    }

    public function DeleteDoctor($id)
    {
        $doctor = User::findOrFail($id);

        $doctor->delete();

        return redirect()->back()->with('success', 'Doctor deleted successfully.');
    }


    public function editDoctor($id)
    {
        $doctor = User::find($id);
        return view('admin.backend.doctors.edit',compact('doctor'));
    }


        public function appoinmentstore(Request $request)
    {
        $request->validate([
            'patient_name' => 'required|string|max:255',
            'patient_type' => 'required|string|max:255',
            'phone'        => 'required|string|max:20',
            'message'      => 'nullable|string',
        ]);

        $appointment = Appoinment::create([
            'patient_name' => $request->patient_name,
            'patient_type' => $request->patient_type,
            'phone'        => $request->phone,
            'message'      => $request->message,
        ]);
        return redirect()->back()->with('success','Appointment created successfully');
    }


    public function listappoinment()
    {
       $appointments = Appoinment::latest()->paginate(10);
       return view('listing.aapoinment',compact('appointments'));
    }
}

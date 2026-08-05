<?php

use Illuminate\Support\Facades\Auth;


if(!function_exists('AdminLogin')){
    function AdminLogin(){
        if(Auth::guard('super_admin')->check()){
            $data = Auth::guard('super_admin')->user();
            return $data;
        }else{
            return redirect()->route('login');
        }
    }
}


if(!function_exists('DoctorLogin')){
    function DoctorLogin(){
        if(Auth::guard('doctor')->check()){
            $data = Auth::guard('doctor')->user();
            return $data;
        }else{
            return redirect()->route('login');
        }
    }
}

if(!function_exists('report_category')){
    function report_category(){
        return
        [
            'Diabetise',
            'Hypertension',
            'Obesity',
            'Infection'
        ];
    }
}

if (!function_exists('checkReport')) {

    function checkReport($parameter, $value)
    {
        $parameter = trim($parameter);
        switch ($parameter) {

            case 'hba1c':
                return $value >= 6.5 ? 'Diabetes' : 'Normal';

            case 'sbp':
                return $value >= 140 ? 'Hypertension' : 'Normal';

            case 'dbp':
                return $value >= 90 ? 'Hypertension' : 'Normal';

            case 'bmi':
                return $value > 25 ? 'Obesity' : 'Normal';

            case 'temperature':
                return $value > 99.4 ? 'Infection' : 'Normal';

            default:
                return 'Unknown Parameter';
        }
    }
}

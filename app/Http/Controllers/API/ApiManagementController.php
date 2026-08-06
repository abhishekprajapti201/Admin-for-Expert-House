<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\HeaderFooter;

class ApiManagementController extends Controller
{
    public function settingdata()
    {
        try {
            $header = HeaderFooter::select('logo', 'whatsapp_no', 'phone_no', 'whatsappIcon', 'location', 'phoneIcon')->latest()->first();

            if (! $header) {
                return response()->json([
                    'message' => 'Header data not found',
                ], 404);
            }

            return response()->json([
                'message' => 'Header data here',
                'data' => $header,
                'status' => true,
            ], 200);
        } catch (error) {
            return response()->json([
                'message' => 'something went wrong',
                'error' => error->getMassage(),
                'status' => false,
            ], 500);
        }
    }
}

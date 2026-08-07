<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Contact;
use App\Models\HeaderFooter;
use App\Models\InsightPages;
use Illuminate\Http\Request;

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
        } catch (\Exception $error) {
            return response()->json([
                'message' => 'something went wrong',
                'error' => $error->getMessage(),
                'status' => false,
            ], 500);
        }
    }

    public function getBrands()
    {
        try {
            $data = Brand::select('images')->latest()->get();
            if (! $data) {
                return response()->json([
                    'message' => 'Data not found',
                ], 404);
            }

            return response()->json([
                'message' => 'List for branding images',
                'data' => $data,
            ], 200);
        } catch (\Exception $error) {
            return response()->json([
                'message' => 'something went wrong',
                'error' => $error->getMessage(),
                'status' => false,
            ], 500);
        }
    }

    public function getBanner()
    {
        try {
            $data = Banner::select('video_url', 'heading', 'first_button', 'second_button')->latest()->get();
            if (! $data) {
                return response()->json([
                    'message' => 'Data not found',
                ], 404);
            }

            return response()->json([
                'message' => 'List for banner data',
                'data' => $data,
            ], 200);
        } catch (\Exception $error) {
            return response()->json([
                'message' => 'something went wrong',
                'error' => $error->getMessage(),
                'status' => false,
            ], 500);
        }
    }

    public function getCategory()
    {
        try {
            $data = Category::select('id', 'category_name', 'slug')->latest()->get();
            if (! $data) {
                return response()->json([
                    'message' => 'Data not found',
                ], 404);
            }

            return response()->json([
                'message' => 'List for category data',
                'data' => $data,
            ], 200);
        } catch (\Exception $error) {
            return response()->json([
                'message' => 'something went wrong',
                'error' => $error->getMessage(),
                'status' => false,
            ], 500);
        }
    }

    public function contactstore(Request $request)
    {
        try {

            $data = Contact::create([

                'fullname' => $request->fullname,
                'lastname' => $request->lastname,
                'email' => $request->email,
                'phone' => $request->phone,
                'select_services' => $request->select_services,
                'enquiry' => $request->enquiry,

            ]);

            if (! $data) {

                return response()->json([
                    'message' => 'Something went wrong',
                    'data' => null,
                    'status' => false,
                ], 200);

            }

            return response()->json([
                'message' => 'Thanks for you connect with me',
                'data' => $data,
                'status' => true,
            ]);

        } catch (\Exception $error) {

            return response()->json([
                'message' => 'Something went wrong',
                'error' => $error->getMessage(),
            ], 500);

        }
    }

    public function allBlogs()
    {
        try {
            $datas = InsightPages::with(['category'])->latest()->get();

            if (! $datas) {
                return response()->json([
                    'message' => 'Data not found',
                    'status' => false,
                    'data' => null,
                ]);


            }
                return response()->json([
                    'message' => 'Insight datas',
                    'data' => $datas,
                    'status' => true,
                ], 200);


        } catch (\Exception $error) {
            return response()->json([
                'message' => 'Something went wrong',
                'status' => false,
                'error' => $error->getMessage(),
            ], 500);
        }
    }
}

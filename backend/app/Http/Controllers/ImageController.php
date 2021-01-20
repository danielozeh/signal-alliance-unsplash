<?php

namespace App\Http\Controllers;
use App\Http\Controllers\AuthController;

use Illuminate\Http\Request;
use Validator;
use Redirect;
use Response;
use File;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Images;
use JWTAuth;
use DB;

class ImageController extends Controller
{
    protected $user_id;

    public function __construct() {
        //$this->user_id = auth('api')->user()->id;
    }

    public function uploadImage(Request $request) {
        
        $validator = Validator::make($request->all(), [
            'image_title' => 'required|string|between:2,100',
            'image_category' => 'required|string',
            'image' => 'required|image:jpeg,png,jpg,gif,svg|max:2048'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->messages()->first(), 400);
        }
        $uploadFolder = 'users';
        $image = $request->file('image');
        $image_uploaded_path = $image->store($uploadFolder, 'public');
        $uploadedImageResponse = array(
            "image_name" => basename($image_uploaded_path),
            "image_url" => Storage::disk('public')->url($image_uploaded_path),
            "mime" => $image->getClientMimeType()
        );

        $user_id = auth('api')->user()->id;

        //save to database
        $images = new Images(); 
        $images->image_title = $request->image_title;
        $images->file_name = basename($image_uploaded_path);
        $images->image_category = $request->image_category;
        $images->user_id = $user_id;
        $images->save();

        return response()->json(['response' => 'success', 'message' => 'Image Uploaded Successfully'], 200);
    }

    public function viewAllImages() {
        $images = new Images(); 

        $all_images = Images::all();

        if($all_images) {
            foreach ($all_images as $image) {
                $image['image_path'] = 'http://127.0.0.1:8000/storage/users/';
            }
            return response()->json(['response' => 'success', 'message' => $all_images], 200);
        }
        
        return response()->json(['response' => 'failed', 'message' => 'failed to fetch images'], 400);
        
    }

    public function viewImageDetailsByID(Request $request) {
        $images = new Images();

        $image_details = Images::find($request->id);

        if($image_details) {
            $image_details['image_path'] = 'http://127.0.0.1:8000/storage/users/';
            return response()->json(['response' => 'success', 'message' => $image_details], 200);
        }

        return response()->json(['response' => 'failed', 'message' => 'Failed to Fetch Image Information'], 400);
    }

    public function searchImageByTitle(Request $request) {

        $search_string = $request->search_string;

        $images = new Images();

        $image_details = Images::where('image_title', 'like', '%' . $search_string . '%')->get();

        if($image_details) {
            return response()->json(['response' => 'success', 'message' => $image_details], 200);
        }

        return response()->json(['response' => 'failed', 'message' => 'Your search result did not match any records'], 400);
    }

    public function filterImageByCategory(Request $request) {

        $image_category = $request->image_category;

        $images = new Images();

        $image_details = DB::table('images')->join('users', 'images.user_id', '=', 'users.id')->get();

        //$image_details = Images::where('image_category', $image_category)->get();

        if($image_details) {
            return response()->json(['response' => 'success', 'message' => $image_details], 200);
        }

        return response()->json(['response' => 'failed', 'message' => 'Failed to get Records'], 400);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Services\GenericService;
use Illuminate\Support\Facades\Response;

class GenericController extends Controller
{
    public function submitContactForm(Request $request){
        $validator = Validator::make($request->all(),[
            'email'         => 'required|email',
            'name'          => 'required|min:3',
            'message'       => 'required|min:15', 
        ]);
        if ($validator->fails()) {
            return returnValidationError($validator->errors(), 'something went wrong');
        }
        
        list($status, $message) = GenericService::submitContactForm(clean($request->email), clean($request->name), clean($request->message));

        return Response::json([
            'status'    =>  $status,
            'message'   =>  $message
        ]);
    }
}

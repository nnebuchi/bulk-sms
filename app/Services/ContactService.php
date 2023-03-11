<?php
    namespace App\Services;
    use Illuminate\Support\Facades\Response;

    class ContactService{
        public static function updateFile($filepath, $content){
            $filepath_split = explode("/", $filepath);
            $filename = $filepath_split[count( $filepath_split)-1];
            file_put_contents(public_path('storage/contacts/'.$filename), $content);
            return Response::json(
                [
                    'status'=>'success', 
                    'message'=>'Contact file updated'
                ], 
            200);
        }
    }

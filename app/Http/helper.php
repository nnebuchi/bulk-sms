<?php 
	use App\Models\SiteSetting;
	use App\Custom\SanitizeInput;
	use Illuminate\Support\Facades\Response;

	function clean($input){
		$clean = new SanitizeInput;
		return $clean->sanitizeInput($input);
	}
	
	function siteSetting(){
		$siteSetting = SiteSetting::first();
		return $siteSetting;
	}

	function returnValidationError(string $errors, string $message){
        $errors = json_decode($errors, true);
        // return $validator->errors();
        foreach($errors as $key=>$err){
            return Response::json([
                'status'    => 'fail',
                'message'   => $message,
                'error'     =>  $err[0]
            ]); // Status code here
            break;
        }
    }


 ?>
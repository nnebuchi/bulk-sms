<?php 
	namespace App\Custom;

	use Pnlinh\InfobipSms\Facades\InfobipSms;
	use App\Models\UnitPurchase;
	use App\Models\ApiIntegration;
	use App\Custom\NigeriaBulkSMS;
	
	class SendMessage
	{

		// function __construct()
		// {
			
		// }

		public function sendMulti($array, $message, $units, $user_id, $message_id){

			// return $units;
			$this->deductTime($units, $user_id);
			$apiIntegration = ApiIntegration::where('name', 'nigerian_bulk_sms')->firstOrFail();
			
			$msgSender = new NigeriaBulkSMS;
			return $msgSender->send($array, $message, $message_id);
			// }
	        // $response = InfobipSms::send($array, $message);
	        // $response;
	        // return 'done';
	    }


		function deductTime($units, $user_id){
			// dd($units);
			// while ($balance > 0) {
			    $availableUnits = UnitPurchase::where('user_id', $user_id)->where('available_units', '>', '0')->first();
			    
			    if ($availableUnits->available_units >= $units) {
			    	// dd('yes');
			    	$availableUnitBal = $availableUnits->available_units - $units;
			    	$availableUnits->available_units = $availableUnitBal;
			    	$unitBal = 0;
			    	$availableUnits->save();
			    	return;
			    }else{
			    	// dd($availableUnits->available_units);
			    	$availableUnitBal =  0;
			    	$unitBal = $units - $availableUnits->available_units;
			    	$availableUnits->available_units = $availableUnitBal;
			    	$availableUnits->save();
			    	$this->deductTime($unitBal, $user_id);
			    }
			    

			    // $unitBal = $
			// }
			// $availableUnits = UnitPurchase::where('user_id', $user_id)->where('available_units', '>', '0')->get();
			// foreach($availableUnits as $availableUnit){

			// 	// if avaiable units in the row can sort out the messages
			// 	if ($availableUnit->available_units > $units) {
			// 		dd('yes';)
			// 		$availableUnit->available_units = $availableUnit->available_units - $units;
			// 		$availableUnit->save();
					
			// 	}else{
			// 		$unitBal = $units - $availableUnit->available_units;
					
			// 		$availableUnit->available_units = $availableUnit->available_units-$unitBal;
			// 		$availableUnit->save();
					
			// 		if ($unitBal > 0) {
			// 			dd('ait');
			// 			$this->deductTime($unitBal, $user_id);
			// 		}
					
			// 	}


			// }
		}

	}






 ?>
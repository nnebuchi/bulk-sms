<?php
    namespace App\Services;

    use App\Models\Contact;
    use Illuminate\Support\Facades\Response;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Auth;

    class ContactService{
        public static function updateFile($filepath, $content, $slug){
          
            $filepath_split = explode("/", $filepath);
            $filename = $filepath_split[count( $filepath_split)-1];
            $storage_path = public_path('storage/contacts/'.$filename);
            file_put_contents($storage_path, $content);

            $file = fopen($storage_path, "r");
            // return $file;
            $importData_arr = array(); // Read through the file and store the contents as an array
            $i = 0;

            //Read the contents of the uploaded file 
            while (($filedata = fgetcsv($file, 1000, ",")) !== FALSE) {
                $num = count($filedata);
                // Skip first row (Remove below comment if you want to skip the first row)
                // if ($i == 0) {
                // $i++;
                // continue;
                // }
                for ($c = 0; $c < $num; $c++) {
                    $importData_arr[$i][] = $filedata[$c];
                }
                $i++;
            }
            fclose($file); //Close after reading
           

            $headRow =$importData_arr[0];
            
            if(in_array('phone', $headRow) || in_array('Phone', $headRow)){
                
                unset($importData_arr[0]);
                
                $phone_index = gettype(array_search('Phone', $headRow)) == 'integer' ? array_search('Phone', $headRow):array_search('phone', $headRow);
                
                $bodyRow = $importData_arr;
                
                $phone_column = [];
                
                foreach($bodyRow as $key=>$row){
                    if(isset($row[$phone_index]) && $row[$phone_index] != ""){
                        array_push($phone_column, $row[$phone_index]);
                    }
                    
                }

                $contact = Contact::where('slug', $slug)->first();
                
                if($contact){
                    $contact->numbers = implode(',', $phone_column);
                    $contact->save();
                }
            }
            return Response::json(
                [
                    'status'=>'success', 
                    'message'=>'Contact file updated'
                ], 
            200);

        }
        
        public static function delete(Request $request){
            
            $contact = Contact::where('slug', clean($request->contact_slug))->delete();
            
            Session(['msg'=>'Deleted', 'alert'=>'success']);
            return redirect()->route('contacts');
        }

        public static function batchDelete(Array $contact_slugs){
            foreach ($contact_slugs as $key => $slug) {
                $contact = Contact::where('slug', clean($slug))->first();
                if($contact->user_id != Auth::user()->id){
                    return Response::json([
                        "status"=>"fail",
                        "message"=>"Unauthorised Access"
                    ], 200);
                } 
                Contact::where('slug', clean($slug))->delete();
            }
            return Response::json([
                "status"=>"success",
                "message"=>"Contacts Deleted"
            ], 200);
        }
    }


    

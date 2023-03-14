<?php 
    // contact upload extract
     // Reading file
     $file = fopen($filePath, "r");
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
     
     
     
     
     
     
     
     // dd($importData_arr);

     // $headRow = $data['headRow'] = $importData_arr[0];
     // foreach ($headRow as $key => $tableHead) {
     //     Schema::table('uploaded_contacts', function (Blueprint $table){
     //         $table->string($tableHead);
     //     });
     // }
     

     // dd('yes');
     // unset($importData_arr[0]);
     // $bodyRow = $data['bodyRow'] = $importData_arr;
     // foreach ($bodyRow as $rowKey => $tabeleRow) {
     //     $uploadedContact = new UploadedContact;
     //     $uploadedContact->id = $contact->id;

     //     foreach ($headRow as $headKey => $tableHead) {

     //         $uploadedContact->tableHead = $tabeleRow[$headKey];
     //     }

     //     $uploadedContact->save();
     // }
     
     // dd($uploadedContact);

?>
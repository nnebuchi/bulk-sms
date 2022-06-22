<?php
    namespace App\Services;

    use App\Models\Enquiry;
    use App\Events\ContactFormSubmitted;

    class GenericService{
        public static function submitContactForm(string $email, string $name, string $message){
            $enquiry = new Enquiry;
            $enquiry->name = $name;
            $enquiry->email = $email;
            $enquiry->message = $message;

            $enquiry->save();

            ContactFormSubmitted::dispatch($enquiry);
            return ['success', 'Messsage received. We will get back to you shortly'];
        }
    }
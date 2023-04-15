<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    //

    public function sendMail($id){

        $sale=Sale::find($id);

//        return view('emails.testmail',compact('sale'));
        $subject = "Order Confirmation";

        Mail::send('emails.testmail', compact('sale'), function ($message) use
        ($sale, $subject) {
            $message->from('info@amaratmaterials.com', 'Amarat Materials');
            $message->subject($subject);
            $message->to('m.aliahmed0@gmail.com');
        });

    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Twilio\Rest\Client;
use Twilio\Jwt\ClientToken;

class SmsController extends Controller
{
    public function sendSms()
    {
        $accountSid = config('app.twilio')['TWILIO_ACCOUNT_SID'];
        $authToken  = config('app.twilio')['TWILIO_AUTH_TOKEN'];
        $appSid     = config('app.twilio')['TWILIO_APP_SID'];
        $client = new Client($accountSid, $authToken);
        try
        {
            // Use the client to do fun stuff like send text messages!
            $client->messages->create(
            // the number you'd like to send the message to
                '+2348174007780',
	           array(
	                 // A Twilio phone number you purchased at twilio.com/console
	                 'from' => '+19793416661',
	                 // the body of the text message you'd like to send
	                 'body' => 'Hey Ketav! It’s good to see you after long time!'
	             )
	       );
        }
        catch (Exception $e)
        {
            echo "Error: " . $e->getMessage();
        }
    }

    public function sendAdminMessagePage(){
        return view('pages.super-admin-send-message');
    }
    
    public function sendAdminMessage(Request $request){
        $SMSfrom = $request->from;
        $phones = User::where('role', 'admin')->pluck('phone');
        $phones = implode(",", $phones);
        $SMSto = $phone .",". $request->cc;
        $SMStext = $request->text;
        $this->sendSMS($SMSfrom, $SMSto, $SMStext);

        $message = new Message;
        $message->from = $from;
        $message->to= 'admin';
        // $message->subject= $this->subject;
        $message->cc= $request->cc;
        $message->text= $request->text;
        $message->save();

        if($mesage) {
            return "Message Sent";
        }       
    }

    public function sendTeacherMessage(Request $request){
        $SMSfrom = $request->from;
        $SMSto = $request->to .",". $request->cc;
        $SMStext = $request->text;
        // $this->subject = null;
        $this->sendSMS($SMSfrom, $SMSto, $SMStext);

        $message = new Message;
        $message->from = $from; 
        $message->to= $request->user_id; 
        // $message->subject= $this->;
        $message->cc= $request->cc;
        $textTemplate = "Good morning,". $request->name;
        $message->text= $textTemplate. "\n".$request->text;
        $message->save();

        if($mesage) {
            return "Message Sent";
        }        
    }


    public function sendParentMessage(Request $request){
        $SMSfrom = $request->from;
        $SMSto = $request->to .",". $request->cc;
        $SMStext = $request->text;
        // $this->subject = null;
        $this->sendSMS($SMSfrom, $SMSto, $SMStext);

        $message = new Message;
        $message->from = $from; 
        $message->to= $to; 
        // $message->subject= $this->subject;
        $message->cc= $request->cc;
        $textTemplate = "Good morning,". $request->name;
        $message->text= $textTemplate ."\n". $request->text;
        $message->save();

        if($mesage) {
            return "Message Sent";
        }       
    }
}
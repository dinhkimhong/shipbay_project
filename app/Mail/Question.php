<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Estimate;
use Illuminate\Http\Request;

class Question extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */


    public function __construct()
    {

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(Request $request)
    {
        $estimate_id = $request->estimate_id;

        $estimate = Estimate::leftJoin('users','users.user_id','estimates.created_by')
                    ->where('estimates.estimate_id',$estimate_id)
                    ->first();
        return $this->view('mail.question')
                ->with([
                    'estimate_id'=> $estimate_id,
                    'customer_name' => $estimate->first_name,
                    'email'=> $estimate->email,
                    'tel'=> $estimate->tel,
                    'question'=>$request->question
                ])->to('donotreply.shipbay@gmail.com')
                ->subject('Registration number '. $estimate_id);
    }
}

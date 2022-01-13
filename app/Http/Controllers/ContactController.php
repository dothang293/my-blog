<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Http;

class ContactController extends Controller
{
        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function contactform()
    {
        return view('blog.contact');
    }

    public function SendNotification(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'subject' => 'required',
            'message' => 'required'
        ]);

        Http::post('https://discordapp.com/api/webhooks/930114439787733082/JJH-V3ISl3wQLPbdYWO47BCEjYJFyC62mKHP29DDIB9QerEDL3S_8b3M2aRlzQ6q1Pxh', [
            'content' 
                => "You have got a new message!\nFrom: ".$request->name."\nEmail: ".$request->email,
            'embeds' => [
                [
                    'title' => "Subject: ".$request->subject,
                    'description' => $request->message,
                    'color' => '7506394'
                ]
            ],
        ]);
        return back()-> with('message','Thank you for sending me the message. It is recorded and I will response to you as soon as possible');
    }
}

<?php

namespace App\Http\Controllers;

use App\Repositories\EmailRepository;
use App\Http\Requests\EmailRequest;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
	protected $emailRepository;
    
    public function __construct(EmailRepository $emailRepository)
    {
    	$this->emailRepository = $emailRepository;
    }

    public function getForm()
    {
    	return view('newsletter.email');
    }

    public function postForm(EmailRequest $request)
    {
    	$this->emailRepository->save($request->input('email'));

    	return view('newsletter.email_ok');
    }

    public function sendContactMail(Request $request)
    {
        Mail::send('emails.contact', ['name' => $request->input('name'), 'email' => $request->input('email'), 'content' => $request->input('content')], function($message) use ($request){
            $message->to('contact@linkini.com')->subject($request->input('subject'));
        });

        return redirect()->route('contact');
    }
}

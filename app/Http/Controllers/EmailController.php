<?php

namespace App\Http\Controllers;

use App\Repositories\EmailRepository;
use App\Http\Requests\EmailRequest;

use Illuminate\Http\Request;

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
}

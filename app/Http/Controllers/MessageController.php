<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\MessageRepository;
use App\User;

class MessageController extends Controller
{
	protected $messageRepository;

    public function __construct(MessageRepository $messageRepository)
    {
        $this->middleware('auth');
        $this->messageRepository = $messageRepository;
    }

    public function getNotifications(Request $request)
    {
    	$notifications = $this->messageRepository->notifications($request);
    	$user = $request->user();

    	return view('profiles.messages.notifications',  compact('notifications', 'user'));
    }
    
    public function getMessages(Request $request)
    {
    	$messages = $this->messageRepository->received($request);
    	$user = $request->user();

    	return view('profiles.messages.inbox',  compact('messages', 'user'));
    }
    
    public function getMessage(Request $request, $id)
    {
    	$user = $request->user();

    	$message = $this->messageRepository->getById($id);
    	
    	if($user->id == $message->receiver_id)
    	{
    		$message = $this->messageRepository->checkStatus($message);
    	}

    	return view('profiles.messages.message',  compact('message', 'user'));
    }
    
    public function getMessageSent(Request $request)
    {
    	$messages = $this->messageRepository->sent($request);
    	$user = $request->user();

    	return view('profiles.messages.sent',  compact('messages', 'user'));
    }

     public function getSendMessage(Request $request)
    {
    	$user = $request->user();

    	return view('profiles.messages.send',  compact('user'));
    }

    public function sendMessage(Request $request)
    {

    	$message = $this->messageRepository->send($request);
    	$user = $request->user();

    	return redirect()->route('messages.sent');
    }
}

<?php

namespace App\Repositories;

use App\Message;
use App\User;

class MessageRepository extends ResourceRepository
{

    protected $message;

    public function __construct(Message $message)
	{
		$this->model = $message;
	}

	public function notifications($request)
	{
		return $this->model->where('read', 0)->where('receiver_id', $request->user()->id)->orderBy('created_at', 'desc')->get();
	}

	public function received($request)
	{
		return $this->model->where('receiver_id', $request->user()->id)->orderBy('created_at', 'desc')->get();
	}

	public function sent($request)
	{
		return $this->model->where('sender_id', $request->user()->id)->orderBy('created_at', 'desc')->get();
	}

	public function message($id)
	{
		$message = $this->model->where('id', $id)->first();

		return $this->checkStatus($message);
	}

	public function checkStatus($message)
	{
		if($message->read == 0)
		{
			$message->read = 1;
			$message->save();
		}

		return $message;
	}

	public function send($request)
	{
		$receiver = User::where('email', $request->input('email'))->first();
    	$inputs = [
    		'sender_id' => $request->user()->id,
    		'receiver_id' => $receiver->id,
    		'subject'=> $request->input('subject'),
    		'message' => $request->input('message'),
    		'read' => 0
    	];

    	$this->store($inputs);
	}

	public function reply($request, $id)
	{
		$message = $this->getById($id);
		$receiver = $message->sender;
		$subject = 'RE: '. $message->subject;

    	$inputs = [
    		'sender_id' => $request->user()->id,
    		'receiver_id' => $receiver->id,
    		'subject'=> $subject,
    		'message' => $request->input('message'),
    		'read' => 0
    	];

    	$this->store($inputs);
	}
}
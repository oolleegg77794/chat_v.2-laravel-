<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\chat;

class ChatController extends Controller
{
    
	public function store() {
		
		$result = DB::table('chats')->get();
		$users = DB::table('chats')
				->select('name')
				->groupBy('name')
				->get();
		
		return view ('template.content') 
		-> with (['data'=>$result])
		-> with (['users'=>$users]);	
	}

	public function getMessages(Request $request){
		$lastMessageId = $request->input('lastMessageId');
		$result = DB::table('chats')->where('id', '>', $lastMessageId)->get();
		print_r(json_encode($result));
	}

	public function save(Request $request) {

		$chat = new chat();
		$chat->name = $request->input('name');
		$chat->message = $request->input('message');
		$chat-> save();

	}

}

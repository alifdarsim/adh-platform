<?php

namespace App\Http\Controllers;

use App\Models\ChatMessage;
use App\Models\ProjectShortlist;
use App\Models\Projects;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function getMessage($pid)
    {
        $project = Projects::select('id')->where('pid', $pid)->first();
        if (!$project) {
            abort(404);
        }
        $chat_messages = ChatMessage::where('project_id', $project->id)->get();
        // if user_id is equal to auth user id then it is mine message
        $chat_messages->each(function ($message) {
            $message->isMine = $message->user_id == auth()->user()->id;
        });
        //remove project_id from chat_messages
        $chat_messages->makeHidden('project_id');
        //remove user_id from chat_messages
        $chat_messages->makeHidden('user_id');
        // return message as api response
        return response()->json([
            'success' => true,
            'messages' => $chat_messages,
        ]);
    }

    public function sendMessage()
    {
        $project = Projects::where('pid', request()->pid)->first();
        if ($project->awardedTo->id != auth()->user()->id) error('You are not allowed to send message to this project');
        $chat_message = new ChatMessage();
        $chat_message->project_id = $project->id;
        $chat_message->user_id = auth()->user()->id;
        $chat_message->message = request()->message;
        $chat_message->save();
        // return message as api response
        return response()->json([
            'success' => true,
            'message' => [
                'id' => $chat_message->id,
                'uuid' => request()->uuid,
                'text' => request()->message,
                'time' => $chat_message->created_at,
                'isMine' => true,
            ],
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Events\NewMessage;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Http\Resources\UserResource;
/*class MessageController extends Controller
{
    public function store(Request $request)
    {
        *return $response = response()->json([
            'message' => 'The message has been send',
        ], 201);*//* $subcategory = new Subcategory(array(
            'name_subcat' => $request->name_subcat,
            'description' => $request->description,
            'active' => ($request->active)!=null ? $request->active:true ,
        ));*
        return $request;

        $message= new Message(array(
            'body' => $request->body,
            'user_send_id' => $request->userSendId,
            'user_rec_id' => $request->userRecId ,
        ));
        $message->save();
       /* $userSend = User::find($request->userSendId);
        $userRec = User::find($request->userRecId);
        $userSend->messageSend()->attach($request->userRecId, ['body' =>$request->body,]);
        /*$userRec->messageRec()->attach($request->userSendId, ['body' =>$request->body,]);
        if (!$userSend || !$userRec) {
            $response = response()->json([
                'error' => [
                    'message' => 'This  message has been cannot be found.'
                ]
            ], 404);
            return $response;
        }
*
        //$response = new UserResource($user);
        return $response = response()->json([
            'message' => 'The message has been send',
        ], 201);
    }
    public function getMessageFrom($userId,$userRecId){
        $user = User::find($userId);
        if(!$user){
            $response = response()->json([
                'error' => [
                    'message' => 'This  user cannot be found.'
                ]
            ], 404);
            return $response;
        }
       $messages=Message::where('user_rec_id',$userRecId)->where('user_send_id',$userId)->get();
      // $messagesRec=Message::where('user_send_id',$userId)->get();

    return response()->json(['message' => 'Succès','messages'=>$messages,/*'messagesRec'=>$messagesRec,*]);

    }
}*/

class ConversationsController extends Controller
{
    /**
     * Afficher index.
     *
     * @return View
     */
    public function index()
    {
        $id=Auth::user()->id;
        $users = User::where('id', '!=', $id)->get();
        $unread = $this->unReadCount($id);
        foreach ($users as $usr) {
            if (isset($unread[$usr->id])) {
                $usr->unread = $unread[$usr->id];
            } else {
                $usr->unread = 0;
            }
        }

        return   ['conversations'=>$users] ;
    }

    /**
     * Afficher la conversation de l'utilisateur par identifiant
     * -> Marquer tous les messages lus.
     */
    public function show(Request $request,$userRecId)
    {
        $from=Auth::user()->id;
        $to=$userRecId;
         // récupérer les messages
        $messages = Message::whereRaw("((user_send_id = $from AND user_rec_id = $to) OR (user_send_id = $to AND user_rec_id = $from))")
            ->orderBy('created_at', 'DESC')
            ->with('user')->get();
             // -> Marquer tous les messages lus.
        //chercher les messages non lue
        $unread=$this->unReadCount($from);
        if (isset($unread[$userRecId])) {
            $this->readAllFrom($userRecId,Auth::user()->id); // lire tous les messages
        }

        return [
           // 'users'    => $this->index(),
            'user'     => $userRecId,
            'messages' => array_reverse($messages->toArray()),
            'unread'=>$unread,
        ];
    }

    /**
     * Post Request
     * Permet d'envoyer un message.
     *
     * @param User    $user
     * @param Request $req
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function sendMessage(Request $request)
    {
        
        $from=Auth::user()->id;
        $message= new Message(array(
            'body' => $request->body,
            'user_send_id' => $from,
            'user_rec_id' => $request->userRecId,
        ));
        $message->save();
        
        broadcast(new NewMessage($message));//->toOthers();
        return 
        [
            'message'=>$message
        ];
    }

    public function readAllFrom(int $from, int $to)
    {
        Message::where('user_send_id', $from)
                ->where('user_rec_id', $to)
                ->update(['read_at' => Carbon::now()]);
                return[
       'message'=>'ok'
                ];
    }

    public function unReadCount(int $userId)
    {
        /*
         * SELECT from_id, COUNT(id) as count FROM messages WHERE to_id='userID' AND read_at is null group by from_id
         */
        return Message::where('user_rec_id', $userId)
            ->groupBy('user_send_id')
            ->selectRaw('user_send_id, COUNT(id) as count')
            ->whereRaw('read_at IS NULL')
            ->get()
            ->pluck('count', 'user_send_id');   //tableau associatif
    }
}


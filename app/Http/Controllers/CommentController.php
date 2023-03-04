<?php

namespace App\Http\Controllers;

use App\Models\Comments;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Realisations;
use App\Http\Resources\CommentResource;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index($realisations_id,$user_id=null)
    {
       // $realisations = Realisations::findOrFail($realisations_id);
        //$user = User::where('facebook_id', $data->id)->first();
        $comments=Comments::where('realisation_id',$realisations_id)->latest()/*->where('comment_id','=',$comment_id)*/->get();
        return  CommentResource::collection($comments);
    }

    /*public function indexComment1($realisations_id)
    {
       // $realisations = Realisations::findOrFail($realisations_id);
        //$user = User::where('facebook_id', $data->id)->first();
       // $comments=Comments::where('realisation_id',$realisations_id)->where('comment_id',$comment_id)->get();
        $comments=Comments::where('realisation_id',$realisations_id)->get();
        return  CommentResource::collection($comments);
    }*/
    public function indexComment($realisations_id,$comment_id=null)
    {
       // $realisations = Realisations::findOrFail($realisations_id);
        //$user = User::where('facebook_id', $data->id)->first();
        if($comment_id!=null){
        
            $comment=Comments::find($comment_id);
            
           return new CommentResource($comment);

        //$comments=Comments::where('realisation_id',$realisations_id)->whereNotNull('comment_id')->where('comment_id',$comment_id)->get();
        }else
        $comments=Comments::where('realisation_id',$realisations_id)->whereNull('comment_id')->latest()->get();
       // $comments=Comments::where('realisation_id',$realisations_id)->get();
        return  CommentResource::collection($comments);
    }

    public function commentsPaginate($realisations_id,$comment_id=null)
    {
     if($comment_id!=null){
        
        $comment=Comments::find($comment_id);
        
       return new CommentResource($comment);
    }else
    $comments=Comments::where('realisation_id',$realisations_id)->whereNull('comment_id')->paginate(2);
    return  CommentResource::collection($comments);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$realisation_id,$user_id)
    {
        //'body','user_id','realisation_id','comment_id'
        if ((!$request->body && !$user_id && !$realisation_id)) {
            $response = response()->json(['error' => ['message' => 'Please enter all required fields']], 422);
            return $response;
        }

        $comment = new Comments(array(
            'body' => $request->body,
            'user_id' => $user_id,
            'realisation_id' =>$realisation_id,//($request->active)!=null ? $request->active:true ,
            'comment_id' => $request->comment_id==null  ? null :  $request->comment_id,       
            'comment_user' => $request->comment_user==null  ? null :  $request->comment_user,       
        ));
        
        
        $comment->save();
       // $comment=Comments::find($request->comment_id);
        $response = response()->json([
            'message' => 'The comment has been created succesfully',
            'comment'=>new CommentResource($comment)
        ], 201);

        return $response;
    }

    public function like($commentId,$userId)
    {
        $comment=Comments::find($commentId);
        $user = User::find($userId);
        $user->commentReactions()->attach($commentId,['like'=>true,'dislike'=>false]);
        $result= $comment->update(['nbrLikes'=>$comment->nbrLikes+1]);
        $response = response()->json([
            'message' => $comment->nbrLikes,
            $result
        ], 201);
        return $response;
    }

    public function unlike($commentId,$userId)
    {
        $comment= Comments::find($commentId);
        $user = User::find($userId);
        $user->commentReactions()->detach($commentId);
        $result= $comment->update(['nbrLikes'=>$comment->nbrLikes-1]);
        $response = response()->json([
            'message' => $comment->nbrLikes,
            $result
        ], 201);
        return $response;
    }

    public function dislike($commentId,$userId)
    {
        $comment= Comments::find($commentId);
        $user = User::find($userId);
        $user->commentReactions()->attach($comment,['like'=>false,'dislike'=>true]);
        $result= $comment->update(['nbrdisLikes'=>$comment->nbrdisLikes+1]);
        $response = response()->json([
            'message' => $comment->nbrdisLikes,
            $result
        ], 201);
        return $response;
    }

    public function undislike($commentId,$userId)
    {
        $comment= Comments::find($commentId);
        $user = User::find($userId);
        $user->realisationReactions()->detach($commentId);
        $result= $comment->update(['nbrdisLikes'=>$comment->nbrdisLikes-1]);
        $response = response()->json([
            'message' => $comment->nbrdisLikes,
            $result
        ], 201);
        return $response;
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Comments  $comments
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $comment= Comments::find($id);
        if (!$comment) {
            $response = response()->json([
                'error' => [
                    'message' => 'This  realisation cannot be found.'
                ]
            ], 404);
            return $response;
        }

        $response = new CommentResource($comment);
        return $response;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Comments  $comments
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comments $comments)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comments  $comments
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $comment =Comments::find($id);
        if (!$comment) {
            $response = response()->json([
                'error' => [
                    'message' => 'The realisation cannot be found.'
                ]
            ], 404);

            return $response;
        }

        Comments::destroy($comment->id);

        $response = response()->json([
            'message' => 'The comment has been deleted.'
        ], 200);

        return $response;
    }
}

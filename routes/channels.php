<?php

use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|.{realisationId}
*/
Broadcast::channel('realisation', function ($user) {
        if ($user->user_type === "admin") {
            return true;
        }
    
        return false;
    });

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('App.User.{id}', function($user,$id){

    return (int) $user->id === (int) $id;
    //return $user->id ===$id//User::find($userRecId)->id;
});

/*Broadcast::channel('orders.{orderId}', function ($user, $orderId) {
    return $user->id === Order::findOrNew($orderId)->user_id;
});*/

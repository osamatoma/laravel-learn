<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\specialization;
use App\Http\Resources\UserResource;
use App\Http\Resources\UserCollection;

class apiController extends Controller
{
    public function users()
    {
        return UserCollection::collection(User::all());
    }
    public function user(User $user)
    {
        return  new  UserResource($user);
    }

    public function files()
    {
        return response()->download(public_path('js/app.js'));
    }
}

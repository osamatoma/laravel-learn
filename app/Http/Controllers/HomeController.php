<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use View;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return View::make('home');
    }



    public function test() {
        /*
            table1: id  username password image_id
            table2: id  image_name image_path  size
        */
            $users = User::all(); 
            foreach ($users as $user) {
                $users = array_add($users, 'image', Image::find($user->image_id)->first());
            }
            // display
            foreach ($users as $user) {
                echo $user->username;
                echo $user->password;
                echo $user->image->image_name;
                echo $user->image->image_path;
            }


    }
}

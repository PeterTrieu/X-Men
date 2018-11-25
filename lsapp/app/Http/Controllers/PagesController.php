<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function home(){
        $title = 'Welcome to the X-Mens';
        return view('pages.home')->with('title',$title);
    }

    // public function signup(){
    //     $title = 'Welcome to the X-Mens';
    //     return view('posts.signup')->with('title',$title);
    // }

    public function login(){
        $title = 'Welcome to the X-Mens';
        return view('pages.login')->with('title',$title);
    }
}

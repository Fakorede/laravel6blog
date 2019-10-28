<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home() {
        return view('home');
    }

    public function contact() {
        return view('contact');
    }

    public function post($id, $greet = 1) {
        $pages = [
            1 => [
                'title' => 'page one'
            ],
            2 => [
                'title' => 'page two'
            ]
        ];
    
        $greeting = [1 => 'Hello from ', 2 => 'Welcome to '];
    
        return view('post', [
            'data' => $pages[$id], 
            'welcome' => $greeting[$greet]  
        ]);
    }
}

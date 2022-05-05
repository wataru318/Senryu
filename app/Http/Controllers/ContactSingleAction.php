<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactSingleAction extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
     
    public function __invoke()
    {
        return view('contact.contact', [
            'title' => 'お問い合わせ',
            ]);
    }
}

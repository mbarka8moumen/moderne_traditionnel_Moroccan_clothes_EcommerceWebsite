<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subscriber;


class SubscriberController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:subscribers,email',
        ]);

        Subscriber::create(['email' => $request->email]);

        return response()->json(['success' => 'Merci de vous être abonné à notre newsletter !']);
    }
};
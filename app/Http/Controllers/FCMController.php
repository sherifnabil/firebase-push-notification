<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

class FCMController extends Controller
{
    public function index()
    {
        return view('firebase');
    }

    public function storeToken(Request $request)
    {
        auth()->user()->update(['device_key'=>$request->token]);
        return response()->json(['Token successfully stored.']);
    }

    public function sendWebNotification(Request $request)
    {
        $FcmToken = User::whereNotNull('device_key')->pluck('device_key')->all();

        $data = [
            "registration_ids" => $FcmToken,
            "notification" => [
                "title" => $request->title,
                "body" => $request->body,
            ],
        ];

        $result =  $this->request(
            url: 'https://fcm.googleapis.com/fcm/send',
            payload: $data
        );

        // FCM response
        return redirect()->route('push-notificaiton');
    }

    private function request($url, $payload, $method = 'post'): ?Response
    {
        return Http::withHeaders([
            'Authorization' => 'key=' . env('FIREBASE_SERVER_KEY'),
            'Content-Type'  => 'application/json'
        ])->{$method}($url, $payload);
    }
}

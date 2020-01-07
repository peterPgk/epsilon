<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\BadResponseException;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function login(Request $request)
    {
        $http = new Client();

        try {
            $response = $http->post(config('api.authentication_url'), [
                'form_params' => [
                    'grant_type' => config('api.authentication_type'),
                    'client_id' => config('api.client_id', ''),
                    'client_secret' => config('api.client_secret', ''),
                    'username' => $request->get('username'),
                    'password' => $request->get('password'),
                ]
            ]);

            return $response->getBody();
        } catch (BadResponseException $e) {
            if ($e->getCode() === 400) {
                return response()->json('Invalid Request. Please enter a username or a password.', $e->getCode());
            }

            if ($e->getCode() === 401) {
                return response()->json('Your credentials are incorect. Please try again', $e->getCode());
            }

            return response()->json('Something went wrong on the server', $e->getCode());
        }
    }
}

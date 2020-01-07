<?php

namespace App\Http\Controllers;

use App\User;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\BadResponseException;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    use AuthenticatesUsers;

    public function login(Request $request)
    {
        dump(auth()->user());

//        $http = new Client();

        try {
//            $response = $http->post(config('api.authentication_url'), [
//                'form_params' => [
//                    'grant_type' => config('api.authentication_type'),
//                    'client_id' => config('api.client_id', ''),
//                    'client_secret' => config('api.client_secret', ''),
//                    'username' => $request->get('email'),
//                    'password' => $request->get('password'),
//                ]
//            ]);


//            $data = json_decode($response->getBody(), true);
//            $request->session()->put('token', $data['access_token']);
            $user = new User;
            $user->email = $request->get('email');
            $user->name = $request->get('email');
//            $user->token = $response->getBody();

            $this->guard()->login($user);

            dump(auth()->user());

            dump(Auth::check());

            return $this->sendLoginResponse($request);

//            dd(json_decode($response->getBody(), true)['access_token']);


//            return redirect('/');

//            return $response->getBody();
        } catch (BadResponseException $e) {
            //Unprocessable Entity\
            if ($e->getCode() === Response::HTTP_UNPROCESSABLE_ENTITY) {
                return response()->json('Invalid Request. Please enter a username or a password.', $e->getCode());
            }

            if ($e->getCode() === Response::HTTP_UNAUTHORIZED) {
                return response()->json('Your credentials are incorrect. Please try again', $e->getCode());
            }

            return response()->json('Something went wrong on the server', $e->getCode());
        }
    }

//    public function validateLogin(Request $request)
//    {
//        $http = new Client();
//
//        try {
//            $response = $http->post(config('api.authentication_url'), [
//                'form_params' => [
//                    'grant_type' => config('api.authentication_type'),
//                    'client_id' => config('api.client_id', ''),
//                    'client_secret' => config('api.client_secret', ''),
//                    'username' => $request->get('email'),
//                    'password' => $request->get('password'),
//                ]
//            ]);
//
//            return $response->getBody();
//        } catch (BadResponseException $e) {
//            if ($e->getCode() === 400) {
//                return response()->json('Invalid Request. Please enter a username or a password.', $e->getCode());
//            }
//
//            if ($e->getCode() === 401) {
//                return response()->json('Your credentials are incorect. Please try again', $e->getCode());
//            }
//
//            return response()->json('Something went wrong on the server', $e->getCode());
//        }
//    }
}

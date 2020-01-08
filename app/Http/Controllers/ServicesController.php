<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\BadResponseException;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ServicesController extends Controller
{

    public function index(Request $request)
    {
        $http = new Client();

        try {
            $response = $http->get(config('api.url.services'), [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Accept' => $request->headers->get('Accept'),
                    'Authorization' => $request->headers->get('Authorization'),
                ]
            ]);

            return $response->getBody();

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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }
}

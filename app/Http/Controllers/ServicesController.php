<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\BadResponseException;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class ServicesController
 * @package App\Http\Controllers
 */
class ServicesController extends Controller
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client();
    }

    public function index(Request $request)
    {
        try {
            $response = $this->client->get(config('api.url.services'), [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Accept' => $request->headers->get('Accept'),
                    'Authorization' => $request->headers->get('Authorization'),
                ]
            ]);

            return $response->getBody();

        } catch (BadResponseException $e) {
            if ($e->getCode() === Response::HTTP_UNPROCESSABLE_ENTITY) {
                return response()->json('Invalid Request.', $e->getCode());
            }

            // Here the reason can be because 'access_token' is expired. We can process this from Frontend, and hit
            // the route for refreshing token
            if ($e->getCode() === Response::HTTP_UNAUTHORIZED) {
                return response()->json('Refresh', $e->getCode());
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

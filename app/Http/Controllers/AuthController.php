<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\BadResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Psr\Http\Message\StreamInterface;
use Symfony\Component\HttpFoundation\Response;

/**
 * We will use this controller/routes to obtain needed tokens
 *
 * Class AuthController
 * @package App\Http\Controllers
 */
class AuthController extends Controller
{
    /**
     * @var Client
     */
    protected $client;

    /**
     * AuthController constructor.
     */
    public function __construct()
    {
        $this->client = new Client();
    }

    /**
     * In first attempt to login, we will hit the authentication url
     * where will pass provided credentials.
     *
     * @param Request $request
     * @return JsonResponse|StreamInterface
     */
    public function login(Request $request)
    {
        try {
            $response = $this->client->post(config('api.authentication_url'), [
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
            if ($e->getCode() === Response::HTTP_UNPROCESSABLE_ENTITY) {
                return response()->json('Invalid Request.', $e->getCode());
            }
            //Provided credentials are wrong.
            if ($e->getCode() === Response::HTTP_UNAUTHORIZED) {
                return response()->json('Your credentials are incorrect. Please try again', $e->getCode());
            }

            return response()->json('Something went wrong on the server', $e->getCode());
        }
    }


    /**
     * This route should be hit if from some of the get Services controller
     * we receive HTTP_UNAUTHORIZED, but still have auth credentials in store.
     * This can be because 'access_token' is expired
     *
     * @param Request $request
     * @return JsonResponse|StreamInterface
     */
    public function refresh(Request $request)
    {
        try {
            $response = $this->client->post(config('api.refresh_url'), [
                'form_params' => [
                    //Should be always refresh_token
                    'grant_type' => 'refresh_token',
                    'client_id' => config('api.client_id', ''),
                    'client_secret' => config('api.client_secret', ''),
                    'refresh_token' => $request->get('refresh_token'),
                ]
            ]);

            return $response->getBody();
        } catch (BadResponseException $e) {
            if ($e->getCode() === Response::HTTP_UNPROCESSABLE_ENTITY) {
                return response()->json('Invalid Request', $e->getCode());
            }
            //Provided credentials are wrong.
            if ($e->getCode() === Response::HTTP_UNAUTHORIZED) {
                return response()->json('Your credentials are incorrect. Please try again', $e->getCode());
            }

            return response()->json('Something went wrong on the server', $e->getCode());
        }
    }


}

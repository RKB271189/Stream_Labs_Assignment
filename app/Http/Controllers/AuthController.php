<?php

namespace App\Http\Controllers;

use App\Repository\GoogleRepository;
use App\Repository\UserRepository;
use App\Usables\ReadWrite;
use Exception;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    use ReadWrite;
    private $googleService;
    private $userService;
    public function __construct(GoogleRepository $googleRepository, UserRepository $userRepository)
    {
        $this->googleService = $googleRepository;
        $this->userService = $userRepository;
    }
    public function index()
    {
        $clientId = config('services.google.client_id');
        $redirectURL = config('services.google.redirect_url');
        return inertia('Auth/Login', ['clientId' => $clientId, 'redirectURL' => $redirectURL]);
    }
    public function providerRedirect(Request $request)
    {
        $authCode = $request->query('code');
        return inertia('Auth/Login', ['code' => $authCode]);
    }
    public function providerCallback(Request $request)
    {
        try {
            $params = $request->only('code');
            $arrAccessToken = $this->googleService->exchangeCodeForToken($params['code']);
            $userInfo = $this->googleService->processUser($arrAccessToken['access_token']);
            $params['google_id'] = $userInfo['id'];
            $params['name'] = $userInfo['name'];
            $params['email'] = $userInfo['email'];
            $user = $this->userService->saveDetails($params);
            $token = $user->createToken($user->email);
            return response()->json(['message' => 'Credentials verified successfully.', 'token' => $token->plainTextToken], 200);
        } catch (Exception $ex) {
            $this->WriteGeneralException($ex);
            return response()->json(['error' => 'Something went wrong. Please try again.'], 500);
        }
    }
}

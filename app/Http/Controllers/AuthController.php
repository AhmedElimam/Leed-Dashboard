<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\ResetPasswordCheckRequest;
use App\Http\Requests\VerifyOtpRequest;
use App\Models\User;
use App\Services\AuthService;
use App\Services\ResetPasswordService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    protected $authService;
    protected $resetPasswordService;

    public function __construct(AuthService $authService, ResetPasswordService $resetPasswordService)
    {
        $this->authService = $authService;
        $this->resetPasswordService = $resetPasswordService;
    }

    // Register action
    public function register(RegisterRequest $request)
    {
        // Use validated() to get all valid data
        $data = $request->validated();
        return $this->authService->register($data);
    }

    // Login action
    public function login(LoginRequest $request)
    {
        // Use validated() to get valid data
        $credentials = $request->validated();
        return $this->authService->login($credentials);
    }

    public function resetPasswordCheck(ResetPasswordCheckRequest $request)
    {
        $phone = $request->input('phone');

        $user = User::where('phone', $phone)->first();

        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        // Pass the User object to the service
        return $this->resetPasswordService->sendOtpToUser($user);
    }


    public function verifyOtp(VerifyOtpRequest $request)
    {
        $username = $request->input('phone');
        $otp = $request->input('otp');
        $newPassword = $request->input('new_password');
        return $this->resetPasswordService->verifyOtpAndResetPassword($username, $otp, $newPassword);
    }

    public function logout(Request $request)
    {
        // Call the logout method from the AuthService
        return $this->authService->logout();
    }
}

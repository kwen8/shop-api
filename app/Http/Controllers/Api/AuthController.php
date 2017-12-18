<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
	/**
	 * Create a new AuthController instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('jwt.refresh')->only('refresh');
		$this->middleware('auth:api', ['except' => ['login', 'refresh']]);
	}

	/**
	 * Get a JWT token via given credentials.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function login(Request $request)
	{
		$credentials = $request->only('email', 'password');

		if ($token = $this->guard()->attempt($credentials)) {
			return $this->respondWithToken($token);
		}

		return response()->json(['message' => '用户名或密码不正确'], 401);
	}

	/**
	 * Get the authenticated User
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function admin()
	{
		return response()->json($this->guard()->user());
	}

	/**
	 * Log the user out (Invalidate the token)
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function logout()
	{
		$this->guard()->logout();

		return response()->json(['message' => '成功退出']);
	}

	/**
	 * Refresh a token.
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function refresh()
	{
		return response()->json([
			'message' => '成功refresh token'
		]);
	}

	/**
	 * Get the token array structure.
	 *
	 * @param  string $token
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	protected function respondWithToken($token)
	{
		return response()->json([
			'access_token' => $token,
			'token_type' => 'bearer',
			'expires_in' => $this->guard('api')->factory()->getTTL() * 60
		]);
	}

	/**
	 * Get the guard to be used during authentication.
	 *
	 * @return \Illuminate\Contracts\Auth\Guard
	 */
	public function guard()
	{
		return Auth::guard();
	}
}

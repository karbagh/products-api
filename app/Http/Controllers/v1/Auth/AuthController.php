<?php

namespace App\Http\Controllers\v1\Auth;

use App\Dtoes\Auth\UserRegisterRequestDto;
use App\Http\Requests\Auth\VerifyUserRequest;
use App\Services\Auth\AuthService;
use Illuminate\Http\JsonResponse;
use App\Dtoes\Auth\LoginRequestDto;
use App\Repositories\User\UserRepository;
use App\Http\Controllers\v1\ApiController;
use App\Http\Requests\Auth\UserRegisterRequest;
use App\Http\Requests\Auth\Login\UserLoginRequest;
use Illuminate\Support\Facades\Auth;

/**
 * @OA\Tag(
 *    name="Auth",
 *    description="API Endpoints for login"
 * )
 * */
final class AuthController extends ApiController
{
    /**
     * @OA\Post(
     *     tags={"Auth"},
     *     path="/auth/login/user",
     *     summary="Login",
     *     @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/UserLoginRequestSchema")
     *      ),
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent(
     *           @OA\Property(
     *              property="errors",
     *              type="boolean",
     *              example="false"
     *           ),
     *           @OA\Property(
     *              property="message",
     *              type="string",
     *              example="Successfully authenticated."
     *           ),
     *           @OA\Property(
     *              property="data",
     *              type="object",
     *              @OA\Property(
     *                 property="string",
     *                 type="token",
     *                 example="3265|sdAWEQWdasdAWDeqewqerqwfqw",
     *              ),
     *           ),
     *       )
     *    ),
     *    @OA\Response(
     *          response=422,
     *          description="Validation Errors",
     *          @OA\JsonContent(
     *             @OA\Property(
     *                 property="message",
     *                 type="string",
     *                 example="Validation message."
     *              ),
     *             @OA\Property(
     *                 property="errors",
     *                 type="object",
     *                 ref="#/components/schemas/UserLoginRequestMessagesSchema"
     *              )
     *          )
     *    )
     * )
     *
     * @param UserLoginRequest $request
     * @param AuthService $service
     * @return JsonResponse
     */
    public function login(UserLoginRequest $request, AuthService $service): JsonResponse
    {
        $token = $service->login(new LoginRequestDto(
            $request->email ?? $request->phone,
            $request->password,
            $request->ip()
        ), new UserRepository);

        return response()->success(['token' => $token], trans('auth.success'));
    }

    /**
     * @OA\Post(
     *     tags={"Auth"},
     *     path="/auth/sign-up",
     *     summary="Sign Up",
     *     @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/UserRegisterRequestSchema")
     *      ),
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent(
     *           @OA\Property(
     *              property="errors",
     *              type="boolean",
     *              example="false"
     *           ),
     *           @OA\Property(
     *              property="message",
     *              type="string",
     *              example="Successfully authenticated."
     *           ),
     *           @OA\Property(
     *              property="data",
     *              type="object",
     *              @OA\Property(
     *                 property="string",
     *                 type="token",
     *                 example="3265|sdAWEQWdasdAWDeqewqerqwfqw",
     *              ),
     *             @OA\Property(
     *                 property="errors",
     *                 type="object",
     *                 ref="#/components/schemas/UserResourceSchema"
     *              ),
     *           ),
     *       )
     *    ),
     *    @OA\Response(
     *          response=422,
     *          description="Validation Errors",
     *          @OA\JsonContent(
     *             @OA\Property(
     *                 property="message",
     *                 type="string",
     *                 example="Validation message."
     *              ),
     *             @OA\Property(
     *                 property="errors",
     *                 type="object",
     *                 ref="#/components/schemas/UserRegisterRequestMessagesSchema"
     *              )
     *          )
     *    )
     * )
     *
     * @param UserRegisterRequest $request
     * @param AuthService $service
     * @return JsonResponse
     */
    public function register(UserRegisterRequest $request, AuthService $service): JsonResponse
    {
        $dto = $service->register(new UserRegisterRequestDto(
            $request->fullName,
            $request->email,
            $request->password,
            $request->ip(),
        ));

        return response()->success($dto->toArray(), trans('auth.success'));
    }

    /**
     * @OA\Post(
     *     tags={"Auth"},
     *     path="/auth/verification/verify",
     *     summary="Verification",
     *     @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/VerifyUserRequestRequestSchema")
     *      ),
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent(
     *           @OA\Property(
     *              property="errors",
     *              type="boolean",
     *              example="false"
     *           ),
     *           @OA\Property(
     *              property="message",
     *              type="string",
     *              example="Successfully verified."
     *           ),
     *       )
     *    ),
     *    @OA\Response(
     *          response=422,
     *          description="Invalid token!",
     *    ),
     *    @OA\Response(
     *          response=404,
     *          description="Not Found",
     *    )
     * )
     *
     * @param VerifyUserRequest $request
     * @param AuthService $service
     * @return JsonResponse
     */
    public function verify(VerifyUserRequest $request, AuthService $service): JsonResponse
    {
        $service->verify(Auth::user(), $request->token);
        return response()->successMessage(trans('auth.verify.success'));
    }
}

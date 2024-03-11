<?php

namespace App\Http\Controllers\v1\Users;

use App\Dtoes\Users\Settings\ChangePasswordRequestDto;
use App\Dtoes\Users\Settings\UpdateUsersSettingsRequestDto;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\Settings\ChangeUserPasswordRequest;
use App\Http\Requests\User\Settings\UpdateUserSettingsRequest;
use App\Http\Resources\Users\UserResource;
use App\Services\Users\UsersService;
use Illuminate\Http\JsonResponse;


class UserSettingsController extends Controller
{
    /**
     * @OA\Put(
     *     tags={"User"},
     *     path="/auth/settings",
     *     summary="Update Settings",
     *     @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/UpdateUserSettingsRequestSchema")
     *      ),
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent(ref="#/components/schemas/UserResourceSchema")
     *     ),
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
     *                 ref="#/components/schemas/UpdateUserSettingsRequestMessagesSchema"
     *              )
     *          )
     *    )
     * )
     *
     * @param UpdateUserSettingsRequest $request
     * @param UsersService $service
     * @return UserResource
     */
    public function update(UpdateUserSettingsRequest $request, UsersService $service): UserResource
    {
        return UserResource::make($service->update(new UpdateUsersSettingsRequestDto(
            $request->name,
            $request->email,
            $request->phone,
        )));
    }

    /**
     * @OA\Put(
     *     tags={"User"},
     *     path="/auth/settings/password",
     *     summary="Update Password",
     *     @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/ChangeUserPasswordRequestSchema")
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
     *              example="Password successfully update."
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
     *                 ref="#/components/schemas/ChangeUserPasswordRequestMessagesSchema"
     *              )
     *          )
     *    )
     * )
     *
     * @param ChangeUserPasswordRequest $request
     * @param UsersService $service
     * @return JsonResponse
     */
    public function changePassword(ChangeUserPasswordRequest $request, UsersService $service): JsonResponse
    {
        $service->changePassword(new ChangePasswordRequestDto(
            $request->password,
            $request->newPassword,
        ));

        return response()->successMessage(trans('user.password.update.success'));
    }
}

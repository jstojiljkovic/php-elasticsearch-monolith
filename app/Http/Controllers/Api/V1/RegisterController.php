<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Interfaces\Services\UserServiceInterface;
use Illuminate\Http\JsonResponse;

class RegisterController extends Controller
{
    /**
     * Register an user into the system
     *
     * @OA\Post(
     *     path="/flight-advisor/v1/register",
     *     tags={"User"},
     *     operationId="store",
     *     summary="Registers a new user",
     *     description="",
     * @OA\RequestBody(
     *    required=true,
     *    description="Add user object",
     *    @OA\JsonContent(
     *       required={"first_name","last_name","username","password"},
     *       @OA\Property(property="first_name", type="string", example="John"),
     *       @OA\Property(property="last_name", type="string", example="Doe"),
     *       @OA\Property(property="username", type="string", example="john_doe"),
     *       @OA\Property(property="password", type="string", format="password", example="password"),
     *    ),
     * ),
     * @OA\Response(
     *     response=200,
     *     description="Success",
     *     @OA\JsonContent(
     *        @OA\Property(property="first_name", type="string", example="John"),
     *        @OA\Property(property="last_name", type="string", example="Doe"),
     *        @OA\Property(property="username", type="string", example="john_doe"),
     *        @OA\Property(property="id", type="int", example="1"),
     *        @OA\Property(property="created_at", type="string",
     *     format="date-time", description="Initial creation timestamp", readOnly="true"),
     *        @OA\Property(property="updated_at", type="string",
     *     format="date-time", description="Last update timestamp", readOnly="true"),
     *     )
     *  ),
     * @OA\Response(
     *     response=422,
     *     description="Returns when username is already taken or validation fails",
     *     @OA\JsonContent(
     *        @OA\Property(property="message", type="string", example="The given data was invalid."),
     *     )
     *  ),
     * )
     *
     * @param StoreUserRequest $request
     * @param UserServiceInterface $userService
     *
     * @return JsonResponse
     */
    public function store(StoreUserRequest $request, UserServiceInterface $userService): JsonResponse
    {
        $user = $userService->store($request->validated());

        return response()->json([ 'data' => $user ], 201);
    }
}

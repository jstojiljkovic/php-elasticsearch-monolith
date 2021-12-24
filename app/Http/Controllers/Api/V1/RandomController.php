<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRandomRequest;
use App\Http\Requests\UpdateRandomRequest;
use App\Interfaces\Services\RandomServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class RandomController extends Controller
{
    /**
     * @var RandomServiceInterface
     */
    protected RandomServiceInterface $randomService;

    /**
     * RandomController constructor.
     *
     * @param RandomServiceInterface $randomService
     */
    public function __construct(RandomServiceInterface $randomService)
    {
        $this->randomService = $randomService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $randomness = $this->randomService->getAll();

        return response()->json([ 'data' => $randomness ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreRandomRequest $request
     *
     * @return JsonResponse
     */
    public function store(StoreRandomRequest $request): JsonResponse
    {
        $random = $this->randomService->create($request->validated());

        return response()->json([ 'data' => $random ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRandomRequest $request
     * @param int $id
     *
     * @return JsonResponse
     */
    public function update(UpdateRandomRequest $request, int $id): JsonResponse
    {
        $random = $this->randomService->update($id, $request->validated());

        return response()->json([ 'data' => $random ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy(int $id): Response
    {
        $this->randomService->delete($id);

        return response()->noContent();
    }
}

<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\SearchDateBetweenRequest;
use App\Http\Requests\SearchGeoLocationRequest;
use App\Http\Requests\SearchRandomRequest;
use App\Http\Requests\StoreRandomRequest;
use App\Http\Requests\UpdateRandomRequest;
use App\Interfaces\Services\RandomServiceInterface;
use App\Interfaces\Services\SearchServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class RandomSQLController extends Controller
{
    /**
     * @var RandomServiceInterface
     */
    protected RandomServiceInterface $randomService;

    /**
     * @var SearchServiceInterface
     */
    protected SearchServiceInterface $searchService;

    /**
     * RandomController constructor.
     *
     * @param RandomServiceInterface $randomService
     */
    public function __construct(RandomServiceInterface $randomService, SearchServiceInterface $searchService)
    {
        $this->randomService = $randomService;
        $this->searchService = $searchService;

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
     * @param SearchRandomRequest $request
     *
     * @return JsonResponse
     */
    public function textSearch(SearchRandomRequest $request): JsonResponse
    {
        $randomness = $this->searchService->findAllText($request->input('field'), $request->input('value'));

        return response()->json([ 'data' => $randomness ]);
    }

    /**
     * @param SearchDateBetweenRequest $request
     *
     * @return JsonResponse
     */
    public function dateBetweenSearch(SearchDateBetweenRequest $request): JsonResponse
    {
        $randomness = $this->searchService->findBetweenDates(
            $request->input('column'),
            $request->input('start'),
            $request->input('end')
        );

        return response()->json([ 'data' => $randomness ]);
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

    /**
     * @param SearchGeoLocationRequest $request
     *
     * @return JsonResponse
     */
    public function searchByGeoLocation(SearchGeoLocationRequest $request): JsonResponse
    {
        $randomness = $this->searchService->findByGeoLocation(
            $request->input('lat'),
            $request->input('lon'),
            $request->input('distance', 15)
        );

        return response()->json([ 'data' => $randomness ]);
    }
}

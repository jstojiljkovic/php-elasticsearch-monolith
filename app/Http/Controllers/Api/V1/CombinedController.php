<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\SearchCardTypeRequest;
use App\Http\Requests\SearchDateBetweenRequest;
use App\Http\Requests\SearchGeoLocationRequest;
use App\Http\Requests\SearchRandomRequest;
use App\Interfaces\Services\SearchServiceInterface;
use Illuminate\Http\JsonResponse;

class CombinedController
{
    /**
     * @var SearchServiceInterface
     */
    protected SearchServiceInterface $searchService;

    /**
     * RandomESController constructor.
     *
     * @param SearchServiceInterface $searchService
     */
    public function __construct(SearchServiceInterface $searchService)
    {
        $this->searchService = $searchService;
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

    /**
     * @param SearchCardTypeRequest $request
     *
     * @return JsonResponse
     */
    public function searchByCardType(SearchCardTypeRequest $request): JsonResponse
    {
        $randomness = $this->searchService->findByCardType($request->input('type'));

        return response()->json([ 'data' => $randomness ]);
    }
}

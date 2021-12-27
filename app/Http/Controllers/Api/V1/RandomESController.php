<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\SearchRandomRequest;
use App\Interfaces\Services\SearchServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RandomESController extends Controller
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
}

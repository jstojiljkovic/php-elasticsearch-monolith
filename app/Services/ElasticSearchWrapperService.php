<?php

namespace App\Services;

use App\Interfaces\Services\ElasticSearchWrapperInterface;
use Cviebrock\LaravelElasticsearch\Manager;
use Elasticsearch\Client;

class ElasticSearchWrapperService implements ElasticSearchWrapperInterface
{
    /**
     * @var Client
     */
    protected Client $elasticSearch;

    /**
     * ElasticSearchWrapperService constructor.
     *
     * @param Manager $elasticSearch
     */
    public function __construct(Manager $elasticSearch)
    {
        $this->elasticSearch = $elasticSearch->connection();
    }

    /**
     * Basic elasticsearch's search
     *
     * @param $index
     * @param $indices
     * @param $filters
     * @param int $size
     *
     * @return array
     */
    public function search($index, $indices, $filters, int $size = 10000): array
    {
        $elasticSearchResults = $this->elasticSearch->search($this->getScrollSearchParams($index, $indices, $filters, $size));

        $results = [];
        $scrollIds[] = $elasticSearchResults['_scroll_id'];
        while (isset($elasticSearchResults['hits']['hits']) && count($elasticSearchResults['hits']['hits']) > 0) {
            $scrollIds[] = $scroll_id = $elasticSearchResults['_scroll_id'];
            $results = array_merge($results, array_column($elasticSearchResults['hits']['hits'], '_source'));
            $elasticSearchResults = $this->elasticSearch->scroll(
                [
                    'scroll_id' => $scroll_id,
                    'scroll' => '1m'
                ]
            );
        }

        $this->elasticSearch->clearScroll([
            'body' => [
                'scroll_id' => array_values($scrollIds)
            ]
        ]);

        return $results;
    }

    /**
     * Returns number of matches for a search query
     *
     * @param $index
     * @param $filters
     *
     * @return int
     */
    public function count($index, $filters): int
    {
        return $this->elasticSearch->count($this->getCountSearchParams($index, $filters))['count'];
    }

    /**
     * Count Search ElasticSearch Parameters
     *
     * @param $index
     * @param $filters
     *
     * @return mixed
     */
    private function getCountSearchParams($index, $filters)
    {
        $params = [
            'index' => $index,
            'body' => [
                'query' => [
                    'bool' => [
                        'must' => [],
                        'filter' => [],
                        'must_not' => []
                    ],
                ],
            ],
        ];

        $params = $this->setFilters($params, $filters);

        return $params;
    }

    /**
     * Scroll Search ElasticSearch Parameters
     * Scroll allow us to break data into chunks
     *
     * @param $index
     * @param $indices
     * @param $filters
     * @param $size
     *
     * @return array
     */
    private function getScrollSearchParams($index, $indices, $filters, $size)
    {
        $params = [
            'index' => $index,
            'scroll' => '1m',
            '_source' => $indices,
            'size' => $size,
            'body' => [
                'query' => [
                    'bool' => [
                        'must' => [],
                        'filter' => [],
                        'must_not' => []
                    ],
                ],
            ],
        ];

        $params = $this->setFilters($params, $filters);

        return $params;
    }

    /**
     * Set Filters to a search parameters
     *
     * @param $params
     * @param $filters
     *
     * @return mixed
     */
    private function setFilters($params, $filters)
    {
        foreach ($filters as $filter) {
            switch (strtolower($filter['operator'])) {
                case 'eq':
                case 'equals':
                    array_push($params['body']['query']['bool']['must'], [ 'match' => [ $filter['property'] => $filter['value'] ] ]);
                    break;
                case 'search_by_typing':
                    array_push($params['body']['query']['bool']['must'], [ 'multi_match' => [ 'query' => $filter['value'], 'fields' => $filter['property'], 'type' => 'best_fields', 'minimum_should_match' => '100%' ] ]);
                    break;
                case 'in':
                    array_push($params['body']['query']['bool']['filter'], [ 'terms' => [ $filter['property'] => $filter['value'] ] ]);
                    break;
                case 'neq':
                case 'notEquals':
                    array_push($params['body']['query']['bool']['must_not'], [ 'terms' => [ $filter['property'] => $filter['value'] ] ]);
                    break;
                case 'range':
                    array_push($params['body']['query']['bool']['must'], [ 'range' => [ $filter['property'] => [ $filter['value'] ] ] ]);
                    break;
                case 'gt':
                    array_push($params['body']['query']['bool']['must'], [ 'range' => [ $filter['property'] => [ 'gt' => $filter['value'] ] ] ]);
                    break;
                case 'lt':
                    array_push($params['body']['query']['bool']['must'], [ 'range' => [ $filter['property'] => [ 'lt' => $filter['value'] ] ] ]);
                    break;
                case 'sort':
                    $params['sort'] = $filter['property'] . ':' . strtolower($filter['value']);
                    break;
                case 'deleted':
                    array_push($params['body']['query']['bool']['must_not'], [ 'exists' => [ 'field' => 'deleted_at' ] ]);
                    break;
                case 'exist':
                    array_push($params['body']['query']['bool']['must'], [ 'exists' => [ 'field' => $filter['value'] ] ]);
                    break;
                case 'geo_distance':
                    array_push($params['body']['query']['bool']['filter'], [ 'geo_distance' => $filter['value'] ]);
                    break;
                default:
            }
        }

        return $params;
    }
}

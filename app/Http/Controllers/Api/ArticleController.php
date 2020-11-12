<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\ArticleRequest;
use App\Services\ArticleService;
use App\Traits\ApiResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ArticleController extends Controller
{
    use ApiResponse;

    /**
     * @var ArticleService
     */
    private $service;

    /**
     * ArticleController constructor.
     * @param ArticleService $service
     */
    public function __construct(ArticleService $service)
    {
        $this->service = $service;
    }

    /**
     * @return \Illuminate\Pagination\Paginator|mixed
     */
    public function index()
    {
        $data = $this->service->paginated();
        return $this->sendData($data);
    }

    /**
     * @param ArticleRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(ArticleRequest $request)
    {
        try {
            $data = $this->service->create($request->validated());
            return $this->sendData($data);
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage());
        }
    }

    /**
     * @param $slug
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($slug)
    {
        try {
            $data = $this->service->findBySlug($slug);
            if(is_null($data)){
                throw new NotFoundHttpException('Data not found');
            }
            return $this->sendData($data);
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage());
        }
    }
}

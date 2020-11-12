<?php

namespace App\Services;

use App\Http\Resources\ArticleResource;
use App\Repositories\ArticleRepository;
use App\Repositories\TagRepository;

/**
 * Class ArticleService
 * @package App\Services
 */
class ArticleService
{
    const PAGINATED_PER_PAGE = 5;

    /**
     * @var ArticleRepository
     */
    private $articleRepository;

    /**
     * @var TagRepository
     */
    private $tagRepository;

    /**
     * ArticleService constructor.
     * @param ArticleRepository $articleRepository
     * @param TagRepository $tagRepository
     */
    public function __construct(ArticleRepository $articleRepository, TagRepository $tagRepository)
    {
        $this->articleRepository = $articleRepository;
        $this->tagRepository = $tagRepository;
    }

    /**
     * @return mixed
     */
    public function paginated()
    {
        return $this->articleRepository->paginated(self::PAGINATED_PER_PAGE);
    }

    /**
     * @param array $input
     * @return ArticleResource
     */
    public function create(array $input)
    {
        $data = $this->articleRepository->create($input);
        if($data){
            $tagTitles = $input['tags'];
            $this->tagRepository->createAllForArticle($tagTitles, $data->id);
            $data->tags = $this->tagRepository->allByArticleId($data->id);
        }
        return new ArticleResource($data);
    }

    /**
     * @param $slug
     * @return ArticleResource
     */
    public function findBySlug($slug)
    {
        $data = $this->articleRepository->findBySlug($slug);
        if($data){
           $data->tags = $this->tagRepository->allByArticleId($data->id);
        }
        return new ArticleResource($data);

    }

}

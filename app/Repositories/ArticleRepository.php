<?php

namespace App\Repositories;

use App\Models\Article;

/**
 * Class ArticleRepository
 * @package App\Repositories
 */
class ArticleRepository
{
    /**
     * @var Article
     */
    private $model;
    public $sortBy = 'created_at';
    public $sortOrder = 'asc';

    /**
     * ArticleRepository constructor.
     * @param Article $article
     */
    public function __construct(Article $article)
    {
        $this->model = $article;
    }

    /**
      * @return mixed
      */
    public function all()
    {
        return $this->model
             ->orderBy($this->sortBy, $this->sortOrder)
             ->get();
    }

    /**
    * @param $paginate
    * @return mixed
    */
    public function paginated($paginate)
    {
         return $this
            ->model
            ->orderBy($this->sortBy, $this->sortOrder)
            ->paginate($paginate);
    }

    /**
    * @param $input
    * @return mixed
    */
    public function create($input)
    {
        $model = $this->model;
        $model->fill($input);
        $model->save();

        return $model;
    }

    /**
    * @param $id
    * @return mixed
    */
    public function find($id)
    {
        return $this->model->where('id', $id)->first();
    }
}

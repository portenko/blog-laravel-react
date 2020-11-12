<?php

namespace App\Repositories;

use App\Models\Article;
use Illuminate\Support\Facades\DB;

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
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return Article::query()
             ->orderBy($this->sortBy, $this->sortOrder)
             ->get();
    }

    /**
    * @param $paginate
    * @return mixed
    */
    public function paginated($paginate)
    {
        return DB::table('articles as t')
            ->leftJoin('article_tag as a', 'a.article_id', '=', 't.id')
            ->leftJoin('tags as g', 'a.tag_id', '=', 'g.id')
            ->select(DB::raw('t.id, t.name, t.body, t.slug, strftime("%d.%m.%Y", t.created_at) as created_at, group_concat(g.title, ", ") as tags'))
            ->groupBy('t.id')
            ->orderBy('t.created_at', 'desc')
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

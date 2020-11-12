<?php

namespace App\Repositories;

use App\Models\Tag;
use Illuminate\Support\Facades\DB;

/**
 * Class TagRepository
 * @package App\Repositories
 */
class TagRepository
{
    /**
     * @var Tag
     */
    private $model;

    /**
     * TagRepository constructor.
     * @param Tag $tag
     */
    public function __construct(Tag $tag)
    {
        $this->model = $tag;
    }

    /**
      * @return mixed
      */
    public function all()
    {
        return Tag::query()->get();
    }

    /**
     * @param $id
     * @return \Illuminate\Support\Collection
     */
    public function allByArticleId($id)
    {
        return DB::table('tags as t')
            ->join('article_tag as a', 'a.tag_id', '=', 't.id')
            ->where('a.article_id', '=', $id)
            ->select('t.*')
            ->get();
    }

    /**
     * @param $title
     * @return Tag|\Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|object
     */
    private function prepare($title)
    {
        $model = $this->findByTitle($title);
        if(!$model){
            $model = new Tag(['title' => $title]);
        }
        return $model;
    }

    /**
     * @param $titles
     * @param $article_id
     */
    public function createAllForArticle($titles, $article_id)
    {
        foreach($titles as $title){
            $model = $this->prepare($title);
            if($model->save()){
                DB::insert('insert into article_tag (article_id, tag_id) values (?, ?)', [$article_id, $model->id]);
            }
        }
    }

    /**
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        return Tag::query()->where('id', $id)->first();
    }

    /**
     * @param $title
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|object|null
     */
    private function findByTitle($title)
    {
        return Tag::query()->where('title', $title)->first();
    }
}

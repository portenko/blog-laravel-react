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
        return $this->model->get();
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

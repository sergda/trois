<?php

namespace App\Repositories;

use App\Models\Worldtc;
use App\Models\ImagesProject;

class WorldTcRepository extends BaseRepository
{
    protected $comment;
    
    protected $imagesProject;

    public function __construct(Worldtc $post, ImagesProject $imagesProject)
    {
        $this->model = $post;
        $this->imagesProject = $imagesProject;
    }

    protected function savePost($post, $inputs, $user_id = null)
    {
        $post->en_title = $inputs['en_title'];
        $post->fr_title = $inputs['fr_title'];
        $post->de_title = $inputs['de_title'];
        $post->en_description = $inputs['en_description'];
        $post->fr_description = $inputs['fr_description'];
        $post->de_description = $inputs['de_description'];
        $post->en_keywords = $inputs['en_keywords'];
        $post->fr_keywords = $inputs['fr_keywords'];
        $post->de_keywords = $inputs['de_keywords'];
        $post->en_content = $inputs['en_content'];
        $post->fr_content = $inputs['fr_content'];
        $post->de_content = $inputs['de_content'];
        $post->slug = $inputs['slug'];
        $post->active = isset($inputs['active']);
        $post->is_menu = isset($inputs['is_menu']);
        if ($user_id) {
            $post->user_id = $user_id;
        }
        $post->save();

        return $post;
    }

    protected function queryActiveWithUserOrderByDate()
    {
        return $this->model
            ->select('id', 'created_at', 'updated_at', 'en_title', 'fr_title', 'de_title', 'en_description', 'fr_description', 'de_description', 'en_keywords', 'fr_keywords', 'fr_keywords', 'slug', 'user_id')
            ->whereActive(true)
            ->with('user')
            ->latest();
    }

    public function getActiveWithUserOrderByDate($n)
    {
        return $this->queryActiveWithUserOrderByDate()->paginate($n);
    }

    public function getPostsWithOrder($n, $user_id = null, $orderby = 'created_at', $direction = 'desc')
    {
        $query = $this->model
            ->select('worldtcs.id', 'worldtcs.created_at', 'en_title', 'en_description', 'en_keywords', 'worldtcs.seen', 'active', 'is_menu', 'user_id', 'slug', 'username')
            ->join('users', 'users.id', '=', 'worldtcs.user_id')
            ->orderBy($orderby, $direction);

        if ($user_id) {
            $query->where('user_id', $user_id);
        }

        return $query->paginate($n);
    }

    public function getPostBySlug($slug)
    {
        $post = $this->model->with('user')->whereSlug($slug)->firstOrFail();
        
        $en_image = $this->imagesProject
            ->where('element_id', $post->id)
            ->where('field', 'en_images')
            ->where('table', 'worldtcs')
            ->first();

        $fr_image = $this->imagesProject
            ->where('element_id', $post->id)
            ->where('field', 'fr_images')
            ->where('table', 'worldtcs')
            ->first();

        $de_image = $this->imagesProject
            ->where('element_id', $post->id)
            ->where('field', 'de_images')
            ->where('table', 'worldtcs')
            ->first();

        $en_slider = $this->imagesProject
            ->where('element_id', $post->id)
            ->where('field', 'en_slider')
            ->where('table', 'worldtcs')
            ->get();

        $fr_slider = $this->imagesProject
            ->where('element_id', $post->id)
            ->where('field', 'fr_slider')
            ->where('table', 'worldtcs')
            ->get();

        $de_slider = $this->imagesProject
            ->where('element_id', $post->id)
            ->where('field', 'de_slider')
            ->where('table', 'worldtcs')
            ->get();
        
        return compact('post', 'en_image', 'fr_image', 'de_image', 'en_slider', 'fr_slider', 'de_slider');
    }

    public function getPostWith($post)
    {

        $en_image = $this->imagesProject
            ->where('element_id', $post->id)
            ->where('field', 'en_images')
            ->where('table', 'worldtcs')
            ->first();

        $fr_image = $this->imagesProject
            ->where('element_id', $post->id)
            ->where('field', 'fr_images')
            ->where('table', 'worldtcs')
            ->first();

        $de_image = $this->imagesProject
            ->where('element_id', $post->id)
            ->where('field', 'de_images')
            ->where('table', 'worldtcs')
            ->first();
        
        $en_slider = $this->imagesProject
            ->where('element_id', $post->id)
            ->where('field', 'en_slider')
            ->where('table', 'worldtcs')
            ->get();

        $fr_slider = $this->imagesProject
            ->where('element_id', $post->id)
            ->where('field', 'fr_slider')
            ->where('table', 'worldtcs')
            ->get();

        $de_slider = $this->imagesProject
            ->where('element_id', $post->id)
            ->where('field', 'de_slider')
            ->where('table', 'worldtcs')
            ->get();
        
        return compact('post', 'en_image', 'fr_image', 'de_image', 'en_slider', 'fr_slider', 'de_slider');
    }

    public function getByIdWith($id)
    {
        return $this->model->findOrFail($id);
    }

    public function update($inputs, $post)
    {
        $this->savePost($post, $inputs);
    }

    public function updateSeen($inputs, $id)
    {
        $post = $this->getById($id);

        $post->seen = $inputs['seen'] == 'true';

        $post->save();
    }

    public function updateActive($inputs, $id)
    {
        $post = $this->getById($id);

        $post->active = $inputs['active'] == 'true';

        $post->save();
    }

    public function store($inputs, $user_id)
    {
        $this->savePost(new $this->model, $inputs, $user_id);
    }

    public function destroy($post)
    {
        $post->delete();
    }

    public function getSlug($comment_id)
    {
        return $this->comment->findOrFail($comment_id)->post->slug;
    }
}

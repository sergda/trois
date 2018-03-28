<?php

namespace App\Repositories;

use App\Models\Collection;
use App\Models\ImagesProject;

class CollectionRepository extends BaseRepository
{
    protected $imagesProject;
    
    public function __construct(Collection $post, ImagesProject $imagesProject)
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
        $post->en_content_bottom = $inputs['en_content_bottom'];
        $post->fr_content = $inputs['fr_content'];
        $post->fr_content_bottom = $inputs['fr_content_bottom'];
        $post->de_content = $inputs['de_content'];
        $post->de_content_bottom = $inputs['de_content_bottom'];

        $post->en_image_input = $inputs['en_image_input'];
        $post->en_image_description = $inputs['en_image_description'];
        $post->fr_image_input = $inputs['fr_image_input'];
        $post->fr_image_description = $inputs['fr_image_description'];
        $post->de_image_input = $inputs['de_image_input'];
        $post->de_image_description = $inputs['de_image_description'];

        $post->en_slide_input = $inputs['en_slide_input'];
        $post->fr_slide_input = $inputs['fr_slide_input'];
        $post->de_slide_input = $inputs['de_slide_input'];

        $post->sort = $inputs['sort'];

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
            ->select('collections.id', 'collections.created_at', 'en_title', 'fr_title', 'de_title', 'sort', 'collections.seen', 'active', 'is_menu', 'user_id', 'slug', 'username')
            ->join('users', 'users.id', '=', 'collections.user_id')
            ->orderBy($orderby, $direction);

        if ($user_id) {
            $query->where('user_id', $user_id);
        }

        return $query->paginate($n);
    }

    public function getPostBySlug($slug)
    {
        $post = $this->model->with('user')->whereSlug($slug)->firstOrFail();

        return compact('post');
    }

    public function getPostWith($post)
    {

        return compact('post');
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

    public function updateIsMenu($inputs, $id)
    {
        $post = $this->getById($id);

        $post->is_menu = $inputs['is_menu'] == 'true';

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

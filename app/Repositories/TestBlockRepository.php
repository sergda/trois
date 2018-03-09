<?php

namespace App\Repositories;

use App\Models\Testblock;
use App\Models\Tag;
use App\Models\Comment;
use App\Models\ImagesProject;

class TestBlockRepository extends BaseRepository
{
    /**
     * The Tag instance.
     *
     * @var \App\Models\Tag
     */
    protected $tag;

    /**
     * The Comment instance.
     *
     * @var \App\Models\Comment
     */
    protected $comment;

    /**
     * Create a new TestBlockRepository instance.
     *
     * @param  \App\Models\Post $post
     * @param  \App\Models\Tag $tag
     * @param  \App\Models\Comment $comment
     * @return void
     */

    protected $imagesProject;

    public function __construct(Testblock $post, Tag $tag, Comment $comment, ImagesProject $imagesProject)
    {
        $this->model = $post;
        $this->tag = $tag;
        $this->comment = $comment;
        $this->imagesProject = $imagesProject;
    }

    /**
     * Create or update a post.
     *
     * @param  \App\Models\Post $post
     * @param  array  $inputs
     * @param  integer  $user_id
     * @return \App\Models\Post
     */
    protected function savePost($post, $inputs, $user_id = null)
    {
        $post->en_title = $inputs['en_title'];
        $post->fr_title = $inputs['fr_title'];
        $post->en_description = $inputs['en_description'];
        $post->fr_description = $inputs['fr_description'];
        $post->en_keywords = $inputs['en_keywords'];
        $post->fr_keywords = $inputs['fr_keywords'];
        $post->en_content = $inputs['en_content'];
        $post->fr_content = $inputs['fr_content'];
        $post->slug = $inputs['slug'];
        $post->active = isset($inputs['active']);
        if ($user_id) {
            $post->user_id = $user_id;
        }
        $post->save();

        return $post;
    }

    /**
     * Create a query for Post.
     *
     * @return Illuminate\Database\Eloquent\Builder
     */
    protected function queryActiveWithUserOrderByDate()
    {
        return $this->model
            ->select('id', 'created_at', 'updated_at', 'en_title', 'fr_title', 'en_description', 'fr_description', 'en_keywords', 'fr_keywords', 'slug', 'user_id')
            ->whereActive(true)
            ->with('user')
            ->latest();
    }

    /**
     * Get post collection.
     *
     * @param  int  $n
     * @return Illuminate\Support\Collection
     */
    public function getActiveWithUserOrderByDate($n)
    {
        return $this->queryActiveWithUserOrderByDate()->paginate($n);
    }

    /**
     * Get post collection with tag.
     *
     * @param  int  $n
     * @param  int  $id
     * @return Illuminate\Support\Collection
     */
    public function getActiveWithUserOrderByDateForTag($n, $id)
    {
        return $this->queryActiveWithUserOrderByDate()
            ->whereHas('tags', function ($q) use ($id) {
                $q->where('tags.id', $id);
            })->paginate($n);
    }

    /**
     * Get search collection.
     *
     * @param  int  $n
     * @param  string  $search
     * @return Illuminate\Support\Collection
     */
    public function search($n, $search)
    {
        return $this->queryActiveWithUserOrderByDate()
            ->where(function ($q) use ($search) {
                $q->Where('content', 'like', "%$search%")
                    ->orWhere('title', 'like', "%$search%");
            })->paginate($n);
    }

    /**
     * Get post collection.
     *
     * @param  int     $n
     * @param  int     $user_id
     * @param  string  $orderby
     * @param  string  $direction
     * @return Illuminate\Support\Collection
     */
    public function getPostsWithOrder($n, $user_id = null, $orderby = 'created_at', $direction = 'desc')
    {
        $query = $this->model
            ->select('testblocks.id', 'testblocks.created_at', 'en_title', 'en_description', 'en_keywords', 'testblocks.seen', 'active', 'user_id', 'slug', 'username')
            ->join('users', 'users.id', '=', 'testblocks.user_id')
            ->orderBy($orderby, $direction);

        if ($user_id) {
            $query->where('user_id', $user_id);
        }

        return $query->paginate($n);
    }

    /**
     * Get post collection with post slug.
     *
     * @param  string  $slug
     * @return array
     */
    public function getPostBySlug($slug)
    {
        $post = $this->model->with('user', 'tags')->whereSlug($slug)->firstOrFail();

        /*
        $comments = $this->comment
            ->wherePostId($post->id)
            ->with('user')
            ->whereHas('user', function ($q) {
                $q->whereValid(true);
            })
            ->get();
        
        return compact('post', 'comments');
        */

        $en_image = $this->imagesProject
            ->where('element_id', $post->id)
            ->where('field', 'en_images')
            ->where('table', 'testblocks')
            ->first();

        $fr_image = $this->imagesProject
            ->where('element_id', $post->id)
            ->where('field', 'fr_images')
            ->where('table', 'testblocks')
            ->first();

        $en_slider = $this->imagesProject
            ->where('element_id', $post->id)
            ->where('field', 'en_slider')
            ->where('table', 'testblocks')
            ->get();

        $fr_slider = $this->imagesProject
            ->where('element_id', $post->id)
            ->where('field', 'fr_slider')
            ->where('table', 'testblocks')
            ->get();

        return compact('post', 'en_image', 'fr_image', 'en_slider', 'fr_slider');
    }

    /**
     * Get post collection.
     *
     * @param  \App\Models\Post $post
     * @return array
     */
    public function getPostWithTags($post)
    {
        $tags = [];

        foreach ($post->tags as $tag) {
            array_push($tags, $tag->tag);
        }

        $en_image = $this->imagesProject
            ->where('element_id', $post->id)
            ->where('field', 'en_images')
            ->where('table', 'testblocks')
            ->first();

        $fr_image = $this->imagesProject
            ->where('element_id', $post->id)
            ->where('field', 'fr_images')
            ->where('table', 'testblocks')
            ->first();

        $en_slider = $this->imagesProject
            ->where('element_id', $post->id)
            ->where('field', 'en_slider')
            ->where('table', 'testblocks')
            ->get();

        $fr_slider = $this->imagesProject
            ->where('element_id', $post->id)
            ->where('field', 'fr_slider')
            ->where('table', 'testblocks')
            ->get();

        return compact('post', 'tags', 'en_image', 'fr_image', 'en_slider', 'fr_slider');
    }

    /**
     * Get post collection.
     *
     * @param  int  $id
     * @return array
     */
    public function getByIdWithTags($id)
    {
        return $this->model->with('tags')->findOrFail($id);
    }


    /**
     * Update a post.
     *
     * @param  array  $inputs
     * @param  \App\Models\Post $post
     * @return void
     */
    public function update($inputs, $post)
    {
        $post = $this->savePost($post, $inputs);

        // Tag gestion
        $tags_id = [];
        if (array_key_exists('tags', $inputs) && $inputs['tags'] != '') {
            $tags = explode(',', $inputs['tags']);

            foreach ($tags as $tag) {
                $tag_ref = $this->tag->whereTag($tag)->first();
                if (is_null($tag_ref)) {
                    $tag_ref = new $this->tag();
                    $tag_ref->tag = $tag;
                    $tag_ref->save();
                }
                array_push($tags_id, $tag_ref->id);
            }
        }

        $post->tags()->sync($tags_id);
    }

    /**
     * Update "seen" in post.
     *
     * @param  array  $inputs
     * @param  int    $id
     * @return void
     */
    public function updateSeen($inputs, $id)
    {
        $post = $this->getById($id);

        $post->seen = $inputs['seen'] == 'true';

        $post->save();
    }

    /**
     * Update "active" in post.
     *
     * @param  array  $inputs
     * @param  int    $id
     * @return void
     */
    public function updateActive($inputs, $id)
    {
        $post = $this->getById($id);

        $post->active = $inputs['active'] == 'true';

        $post->save();
    }

    /**
     * Create a post.
     *
     * @param  array  $inputs
     * @param  int    $user_id
     * @return void
     */
    public function store($inputs, $user_id)
    {
        $post = $this->savePost(new $this->model, $inputs, $user_id);

        // Tags gestion
        if (array_key_exists('tags', $inputs) && $inputs['tags'] != '') {
            $tags = explode(',', $inputs['tags']);

            foreach ($tags as $tag) {
                $tag_ref = $this->tag->whereTag($tag)->first();
                if (is_null($tag_ref)) {
                    $tag_ref = new $this->tag;
                    $tag_ref->tag = $tag;
                    $post->tags()->save($tag_ref);
                } else {
                    $post->tags()->attach($tag_ref->id);
                }
            }
        }

        // Maybe purge orphan tags...
    }

    /**
     * Destroy a post.
     *
     * @param  \App\Models\Post $post
     * @return void
     */
    public function destroy($post)
    {
        $post->tags()->detach();

        $post->delete();
    }

    /**
     * Get post slug for comment.
     *
     * @param  int  $comment_id
     * @return string
     */
    public function getSlug($comment_id)
    {
        return $this->comment->findOrFail($comment_id)->post->slug;
    }

    /**
     * Get tag name by id.
     *
     * @param  int  $tag_id
     * @return string
     */
    public function getTagById($tag_id)
    {
        return $this->tag->findOrFail($tag_id)->tag;
    }
}

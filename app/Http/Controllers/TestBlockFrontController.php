<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\SearchRequest;
use App\Repositories\TestBlockRepository;

class TestBlockFrontController extends Controller
{
    /**
     * The BlogFrontController instance.
     *
     * @var \App\Repositories\TestBlockRepository
     */
    protected $testBlockRepository;

    /**
     * The pagination number.
     *
     * @var int
     */
    protected $nbrPages;

    /**
     * Create a new BlogController instance.
     *
     * @param  \App\Repositories\TestBlockRepository $blogRepository
     * @return void
    */
    public function __construct(TestBlockRepository $testBlockRepository)
    {
        $this->testBlockRepository = $testBlockRepository;
        $this->nbrPages = config('app.nbrPages.front.testblocks');
    }

    /**
     * Display a listing of the testblocks.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = $this->testBlockRepository->getActiveWithUserOrderByDate($this->nbrPages);

        return view('front.common_template.index', compact('items'));
    }

    /**
     * Display the specified post.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  string $slug
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $slug)
    {
        $user = $request->user();

        return view('front.common_template.show', array_merge($this->testBlockRepository->getPostBySlug($slug), compact('user')));
    }

    /**
     * Get tagged testblocks
     *
     * @param  Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function tag(Request $request)
    {
        $tag = $request->input('tag');
        $testblocks = $this->testBlocksRepository->getActiveWithUserOrderByDateForTag($this->nbrPages, $tag);
        $links = $testblocks->appends(compact('tag'))->links();
        $info = trans('front/testblock.info-tag') . '<strong>' . $this->testBlockRepository->getTagById($tag) . '</strong>';
        
        return view('front.testblock.index', compact('testblocks', 'links', 'info'));
    }

    /**
     * Find search in blog
     *
     * @param  \App\Http\Requests\SearchRequest $request
     * @return \Illuminate\Http\Response
     */
   /*
    public function search(SearchRequest $request)
    {
        $search = $request->input('search');
        $testblocks = $this->blogRepository->search($this->nbrPages, $search);
        $links = $testblocks->appends(compact('search'))->links();
        $info = trans('front/testblock.info-search') . '<strong>' . $search . '</strong>';
        
        return view('front.testblock.index', compact('testblocks', 'links', 'info'));
    }
    */
}

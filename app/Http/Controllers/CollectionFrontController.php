<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\CollectionRepository;

class CollectionFrontController extends Controller
{
    protected $collectionRepository;
    
    protected $nbrPages;

    public function __construct(CollectionRepository $collectionRepository)
    {
        $this->collectionRepository = $collectionRepository;
        $this->nbrPages = config('app.nbrPages.front.collections');
    }

    public function index()
    {
        $items = $this->collectionRepository->getActiveWithUserOrderByDate($this->nbrPages);

        return view('front.common_template.index', compact('items'));
    }

    public function show(Request $request, $slug)
    {
        $user = $request->user();

        return view('front.common_template.show', array_merge($this->collectionRepository->getPostBySlug($slug), compact('user')));
    }
}

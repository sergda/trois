<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\SearchRequest;
use App\Repositories\WorldTcRepository;

class WorldTcFrontController extends Controller
{
    protected $worldTcRepository;
    
    protected $nbrPages;

    public function __construct(WorldTcRepository $worldTcRepository)
    {
        $this->worldTcRepository = $worldTcRepository;
        $this->nbrPages = config('app.nbrPages.front.worldtcs');
    }

    public function index()
    {
        $items = $this->worldTcRepository->getActiveWithUserOrderByDate($this->nbrPages);

        return view('front.common_template.index', compact('items'));
    }

    public function show(Request $request, $slug)
    {
        $user = $request->user();

        return view('front.common_template.show', array_merge($this->worldTcRepository->getPostBySlug($slug), compact('user')));
    }
}

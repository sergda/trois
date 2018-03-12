<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\FindUsRepository;

class FindUsFrontController extends Controller
{
    protected $findUsRepository;
    
    protected $nbrPages;

    public function __construct(FindUsRepository $findUsRepository)
    {
        $this->findUsRepository = $findUsRepository;
        $this->nbrPages = config('app.nbrPages.front.finduss');
    }

    public function index()
    {
        $items = $this->findUsRepository->getActiveWithUserOrderByDate($this->nbrPages);

        return view('front.common_template.index', compact('items'));
    }

    public function show(Request $request, $slug)
    {
        $user = $request->user();

        return view('front.common_template.show', array_merge($this->findUsRepository->getPostBySlug($slug), compact('user')));
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\OrderCatalogueRepository;

class OrderCatalogueFrontController extends Controller
{
    protected $orderCatalogueRepository;
    
    protected $nbrPages;

    public function __construct(OrderCatalogueRepository $orderCatalogueRepository)
    {
        $this->orderCatalogueRepository = $orderCatalogueRepository;
        $this->nbrPages = config('app.nbrPages.front.ordercatalogues');
    }

    public function index()
    {
        $items = $this->orderCatalogueRepository->getActiveWithUserOrderByDate($this->nbrPages);

        return view('front.common_template.index', compact('items'));
    }

    public function show(Request $request, $slug = "order-catalogue")
    {
        $user = $request->user();

        return view('front.common_template.show', array_merge($this->orderCatalogueRepository->getPostBySlug($slug), compact('user')));
    }
}

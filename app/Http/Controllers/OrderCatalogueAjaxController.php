<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\OrderCatalogueRepository;

class OrderCatalogueAjaxController extends Controller
{

    protected $orderCatalogueRepository;
    
    public function __construct(OrderCatalogueRepository $orderCatalogueRepository)
    {
        $this->orderCatalogueRepository = $orderCatalogueRepository;
        
        $this->middleware('admin')->only('updateSeen');
        $this->middleware('admin')->only('update');
        $this->middleware('redac')->only('updateActive');
        $this->middleware('ajax');
    }

    public function updateSeen(Request $request, $id)
    {
        $this->orderCatalogueRepository->updateSeen($request->all(), $id);

        return response()->json();
    }

    public function updateActive(Request $request, $id)
    {
        $post = $this->orderCatalogueRepository->getById($id);

        $this->authorize('change', $post);
        
        $this->orderCatalogueRepository->updateActive($request->all(), $id);

        return response()->json();
    }
}

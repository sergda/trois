<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\CollectionRepository;

class CollectionAjaxController extends Controller
{
    
    protected $collectionRepository;
    
    public function __construct(CollectionRepository $collectionRepository)
    {
        $this->collectionRepository = $collectionRepository;
        
        $this->middleware('admin')->only('updateSeen');
        $this->middleware('admin')->only('update');
        $this->middleware('admin')->only('updateActive');
        $this->middleware('admin')->only('updateIsMenu');
        $this->middleware('ajax');
    }

    public function updateSeen(Request $request, $id)
    {
        $this->collectionRepository->updateSeen($request->all(), $id);

        return response()->json();
    }

    public function updateActive(Request $request, $id)
    {
        $post = $this->collectionRepository->getById($id);

        $this->authorize('change', $post);
        
        $this->collectionRepository->updateActive($request->all(), $id);

        return response()->json();
    }

    public function updateIsMenu(Request $request, $id)
    {
        $this->collectionRepository->updateIsMenu($request->all(), $id);

        return response()->json();
    }
}

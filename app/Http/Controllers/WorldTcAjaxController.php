<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\WorldTcRepository;

class WorldTcAjaxController extends Controller
{
    
    protected $worldTcRepository;
    
    public function __construct(WorldTcRepository $worldTcRepository)
    {
        $this->worldTcRepository = $worldTcRepository;
        
        $this->middleware('admin')->only('updateSeen');
        $this->middleware('admin')->only('update');
        $this->middleware('admin')->only('updateActive');
        $this->middleware('admin')->only('updateIsMenu');
        $this->middleware('ajax');
    }

    public function updateSeen(Request $request, $id)
    {
        $this->worldTcRepository->updateSeen($request->all(), $id);

        return response()->json();
    }

    public function updateActive(Request $request, $id)
    {
        $post = $this->worldTcRepository->getById($id);

        $this->authorize('change', $post);
        
        $this->worldTcRepository->updateActive($request->all(), $id);

        return response()->json();
    }

    public function updateIsMenu(Request $request, $id)
    {
        $this->worldTcRepository->updateIsMenu($request->all(), $id);

        return response()->json();
    }
}

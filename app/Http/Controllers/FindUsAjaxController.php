<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\FindUsRepository;

class FindUsAjaxController extends Controller
{

    protected $findUsRepository;
    
    public function __construct(FindUsRepository $findUsRepository)
    {
        $this->findUsRepository = $findUsRepository;
        
        $this->middleware('admin')->only('updateSeen');
        $this->middleware('admin')->only('update');
        $this->middleware('admin')->only('updateActive');
        $this->middleware('admin')->only('updateIsMenu');
        $this->middleware('ajax');
    }

    public function updateSeen(Request $request, $id)
    {
        $this->findUsRepository->updateSeen($request->all(), $id);

        return response()->json();
    }

    public function updateActive(Request $request, $id)
    {
        $post = $this->findUsRepository->getById($id);

        $this->authorize('change', $post);
        
        $this->findUsRepository->updateActive($request->all(), $id);

        return response()->json();
    }

    public function updateIsMenu(Request $request, $id)
    {
        $this->findUsRepository->updateIsMenu($request->all(), $id);

        return response()->json();
    }
}

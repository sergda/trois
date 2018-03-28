<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\CustomerServiceRepository;

class CustomerServiceAjaxController extends Controller
{

    protected $customerServiceRepository;
    
    public function __construct(CustomerServiceRepository $customerServiceRepository)
    {
        $this->customerServiceRepository = $customerServiceRepository;
        
        $this->middleware('admin')->only('updateSeen');
        $this->middleware('admin')->only('update');
        $this->middleware('admin')->only('updateActive');
        $this->middleware('admin')->only('updateIsMenu');
        $this->middleware('ajax');
    }

    public function updateSeen(Request $request, $id)
    {
        $this->customerServiceRepository->updateSeen($request->all(), $id);

        return response()->json();
    }

    public function updateActive(Request $request, $id)
    {
        $post = $this->customerServiceRepository->getById($id);

        $this->authorize('change', $post);
        
        $this->customerServiceRepository->updateActive($request->all(), $id);

        return response()->json();
    }
    
    public function updateIsMenu(Request $request, $id)
    {
        $this->customerServiceRepository->updateIsMenu($request->all(), $id);

        return response()->json();
    }
}

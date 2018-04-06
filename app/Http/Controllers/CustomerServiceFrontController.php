<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\CustomerServiceRepository;

class CustomerServiceFrontController extends Controller
{
    protected $customerServiceRepository;
    
    protected $nbrPages;

    public function __construct(CustomerServiceRepository $customerServiceRepository)
    {
        $this->customerServiceRepository = $customerServiceRepository;
        $this->nbrPages = config('app.nbrPages.front.customerservices');
    }

    public function index()
    {
        $items = $this->customerServiceRepository->getActiveWithUserOrderByDate($this->nbrPages);

        return view('front.common_template.index', compact('items'));
    }

    public function show(Request $request, $slug)
    {
        $user = $request->user();

        if($slug == "register-your-guarantee-code"){
            return view('front.register_your_guarantee_code.show', array_merge($this->customerServiceRepository->getPostBySlug($slug), compact('user')));
        }else{
            return view('front.common_template.show', array_merge($this->customerServiceRepository->getPostBySlug($slug), compact('user')));
        }

    }
}

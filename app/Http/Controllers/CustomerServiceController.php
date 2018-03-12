<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\Repositories\CustomerServiceRepository;
use Intervention\Image;

class CustomerServiceController extends Controller
{
    protected $customerServicenRepository;

    public function __construct(CustomerServiceRepository $customerServicenRepository)
    {
        $this->customerServicenRepository = $customerServicenRepository;
        $this->middleware('redac');
    }

    public function index()
    {
        return redirect(route('customerservice.order', [
            'name' => 'customerservices.created_at',
            'sens' => 'asc',
        ]));
    }

    public function indexOrder(Request $request)
    {
        $statut = session('statut');

        $items = $this->customerServicenRepository->getPostsWithOrder(
            config('app.nbrPages.back.customerservices'),
            $statut == 'admin' ? null : $request->user()->id,
            $request->name,
            $request->sens
        );

        $links = $items->appends([
            'name' => $request->name,
            'sens' => $request->sens
        ]);

        if ($request->ajax()) {
            return [
                'view' => view('back.customerservice.table', compact('statut', 'items'))->render(),
                'links' => e($links->setPath('order')->links()),
            ];
        }

        $links->links();

        $order = new \stdClass;
        $order->name = $request->name;
        $order->sens = 'sort-' . $request->sens;

        return view('back.customerservice.index', compact('items', 'links', 'order'));
    }
    
    public function create()
    {
        return view('back.customerservice.create');
    }

    public function store(PostRequest $request)
    {
        $this->customerServicenRepository->store($request->all(), $request->user()->id);

        return redirect('adm_customerservice')->with('ok', trans('back/customerservice.stored'));
    }

    public function edit($id)
    {
        $post = $this->customerServicenRepository->getByIdWith($id);

        $this->authorize('changeCustomerservice', $post);

        return view('back.customerservice.edit', $this->customerServicenRepository->getPostWith($post));
    }

    public function update(PostRequest $request, $id)
    {
        $post = $this->customerServicenRepository->getById($id);

        $this->authorize('changeCustomerservice', $post);

        $this->customerServicenRepository->update($request->all(), $post);

        return redirect('adm_customerservice')->with('ok', trans('back/customerservice.updated'));
    }
    
    public function destroy($id)
    {
        $post = $this->customerServicenRepository->getById($id);

        $this->authorize('changeCustomerservice', $post);

        $this->customerServicenRepository->destroy($post);

        return redirect('adm_customerservice')->with('ok', trans('back/customerservice.destroyed'));
    }
}

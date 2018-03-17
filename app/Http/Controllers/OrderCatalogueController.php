<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\Repositories\OrderCatalogueRepository;
use Intervention\Image;

class OrderCatalogueController extends Controller
{
    protected $orderCatalogueRepository;

    public function __construct(OrderCatalogueRepository $orderCatalogueRepository)
    {
        $this->orderCatalogueRepository = $orderCatalogueRepository;
        $this->middleware('redac');
    }

    public function index()
    {
        return redirect(route('ordercatalogue.order', [
            'name' => 'ordercatalogues.created_at',
            'sens' => 'asc',
        ]));
    }

    public function indexOrder(Request $request)
    {
        $statut = session('statut');

        $items = $this->orderCatalogueRepository->getPostsWithOrder(
            config('app.nbrPages.back.ordercatalogues'),
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
                'view' => view('back.ordercatalogue.table', compact('statut', 'items'))->render(),
                'links' => e($links->setPath('order')->links()),
            ];
        }

        $links->links();

        $order = new \stdClass;
        $order->name = $request->name;
        $order->sens = 'sort-' . $request->sens;

        return view('back.ordercatalogue.index', compact('items', 'links', 'order'));
    }
    
    public function create()
    {
        return view('back.ordercatalogue.create');
    }

    public function store(PostRequest $request)
    {
        $this->orderCatalogueRepository->store($request->all(), $request->user()->id);

        return redirect('adm_ordercatalogue')->with('ok', trans('back/ordercatalogue.stored'));
    }

    public function edit($id)
    {
        $post = $this->orderCatalogueRepository->getByIdWith($id);

        $this->authorize('changeOrdercatalogue', $post);

        return view('back.ordercatalogue.edit', $this->orderCatalogueRepository->getPostWith($post));
    }

    public function update(PostRequest $request, $id)
    {
        $post = $this->orderCatalogueRepository->getById($id);

        $this->authorize('changeOrdercatalogue', $post);

        $this->orderCatalogueRepository->update($request->all(), $post);

        return redirect('adm_ordercatalogue')->with('ok', trans('back/ordercatalogue.updated'));
    }
    
    public function destroy($id)
    {
        $post = $this->orderCatalogueRepository->getById($id);

        $this->authorize('changeOrdercatalogue', $post);

        $this->orderCatalogueRepository->destroy($post);

        return redirect('adm_ordercatalogue')->with('ok', trans('back/ordercatalogue.destroyed'));
    }
}

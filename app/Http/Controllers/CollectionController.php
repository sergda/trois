<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\Repositories\CollectionRepository;
use Intervention\Image;

class CollectionController extends Controller
{
    protected $collectionRepository;

    public function __construct(CollectionRepository $collectionRepository)
    {
        $this->collectionRepository = $collectionRepository;
        $this->middleware('redac');
    }

    public function index()
    {
        return redirect(route('collection.order', [
            'name' => 'collections.created_at',
            'sens' => 'asc',
        ]));
    }

    public function indexOrder(Request $request)
    {
        $statut = session('statut');

        $items = $this->collectionRepository->getPostsWithOrder(
            config('app.nbrPages.back.collections'),
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
                'view' => view('back.collection.table', compact('statut', 'items'))->render(),
                'links' => e($links->setPath('order')->links()),
            ];
        }

        $links->links();

        $order = new \stdClass;
        $order->name = $request->name;
        $order->sens = 'sort-' . $request->sens;

        return view('back.collection.index', compact('items', 'links', 'order'));
    }
    
    public function create()
    {
        return view('back.collection.create');
    }

    public function store(PostRequest $request)
    {
        $this->collectionRepository->store($request->all(), $request->user()->id);

        return redirect('adm_collection')->with('ok', trans('back/collection.stored'));
    }

    public function edit($id)
    {
        $post = $this->collectionRepository->getByIdWith($id);

        $this->authorize('changeCollection', $post);

        return view('back.collection.edit', $this->collectionRepository->getPostWith($post));
    }

    public function update(PostRequest $request, $id)
    {
        $post = $this->collectionRepository->getById($id);

        $this->authorize('changeCollection', $post);

        $this->collectionRepository->update($request->all(), $post);

        return redirect('adm_collection')->with('ok', trans('back/collection.updated'));
    }
    
    public function destroy($id)
    {
        $post = $this->collectionRepository->getById($id);

        $this->authorize('changeCollection', $post);

        $this->collectionRepository->destroy($post);

        return redirect('adm_collection')->with('ok', trans('back/collection.destroyed'));
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\Repositories\WorldTcRepository;
use Intervention\Image;

class WorldTcController extends Controller
{
    protected $worldTcRepository;

    public function __construct(WorldTcRepository $worldTcRepository)
    {
        $this->worldTcRepository = $worldTcRepository;
        $this->middleware('redac');
    }

    public function index()
    {
        return redirect(route('worldtc.order', [
            'name' => 'worldtcs.created_at',
            'sens' => 'asc',
        ]));
    }

    public function indexOrder(Request $request)
    {
        $statut = session('statut');

        $items = $this->worldTcRepository->getPostsWithOrder(
            config('app.nbrPages.back.worldtcs'),
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
                'view' => view('back.worldtc.table', compact('statut', 'items'))->render(),
                'links' => e($links->setPath('order')->links()),
            ];
        }

        $links->links();

        $order = new \stdClass;
        $order->name = $request->name;
        $order->sens = 'sort-' . $request->sens;

        return view('back.worldtc.index', compact('items', 'links', 'order'));
    }
    
    public function create()
    {
        return view('back.worldtc.create');
    }

    public function store(PostRequest $request)
    {
        $this->worldTcRepository->store($request->all(), $request->user()->id);

        return redirect('worldtc')->with('ok', trans('back/worldtc.stored'));
    }

    public function edit($id)
    {
        $post = $this->worldTcRepository->getByIdWith($id);

        $this->authorize('changeWorldtc', $post);

        return view('back.worldtc.edit', $this->worldTcRepository->getPostWith($post));
    }

    public function update(PostRequest $request, $id)
    {
        $post = $this->worldTcRepository->getById($id);

        $this->authorize('changeWorldtc', $post);

        $this->worldTcRepository->update($request->all(), $post);

        return redirect('worldtc')->with('ok', trans('back/worldtc.updated'));
    }
    
    public function destroy($id)
    {
        $post = $this->worldTcRepository->getById($id);

        $this->authorize('changeWorldtc', $post);

        $this->worldTcRepository->destroy($post);

        return redirect('worldtc')->with('ok', trans('back/worldtc.destroyed'));
    }
}

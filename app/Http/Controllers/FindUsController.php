<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\Repositories\FindUsRepository;
use Intervention\Image;

class FindUsController extends Controller
{
    protected $findUsRepository;

    public function __construct(FindUsRepository $findUsRepository)
    {
        $this->findUsRepository = $findUsRepository;
        $this->middleware('redac');
    }

    public function index()
    {
        return redirect(route('findus.order', [
            'name' => 'finduss.created_at',
            'sens' => 'asc',
        ]));
    }

    public function indexOrder(Request $request)
    {
        $statut = session('statut');

        $items = $this->findUsRepository->getPostsWithOrder(
            config('app.nbrPages.back.finduss'),
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
                'view' => view('back.findus.table', compact('statut', 'items'))->render(),
                'links' => e($links->setPath('order')->links()),
            ];
        }

        $links->links();

        $order = new \stdClass;
        $order->name = $request->name;
        $order->sens = 'sort-' . $request->sens;

        return view('back.findus.index', compact('items', 'links', 'order'));
    }
    
    public function create()
    {
        return view('back.findus.create');
    }

    public function store(PostRequest $request)
    {
        $this->findUsRepository->store($request->all(), $request->user()->id);

        return redirect('adm_findus')->with('ok', trans('back/findus.stored'));
    }

    public function edit($id)
    {
        $post = $this->findUsRepository->getByIdWith($id);

        $this->authorize('changeFindus', $post);

        return view('back.findus.edit', $this->findUsRepository->getPostWith($post));
    }

    public function update(PostRequest $request, $id)
    {
        $post = $this->findUsRepository->getById($id);

        $this->authorize('changeFindus', $post);

        $this->findUsRepository->update($request->all(), $post);

        return redirect('adm_findus')->with('ok', trans('back/findus.updated'));
    }
    
    public function destroy($id)
    {
        $post = $this->findUsRepository->getById($id);

        $this->authorize('changeFindus', $post);

        $this->findUsRepository->destroy($post);

        return redirect('adm_findus')->with('ok', trans('back/findus.destroyed'));
    }
}

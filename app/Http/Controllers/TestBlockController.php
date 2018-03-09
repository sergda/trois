<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\Http\Requests\SearchRequest;
use App\Repositories\TestBlockRepository;
use Intervention\Image;

class TestBlockController extends Controller
{
    /**
     * The TetBlockRepository instance.
     *
     * @var \App\Repositories\TestBlockRepository
     */
    protected $testBlockRepository;

    /**
     * Create a new TestBlockController instance.
     *
     * @param  \App\Repositories\TestBlockRepository $testBlockRepository
     * @return void
     */
    public function __construct(TestBlockRepository $testBlockRepository)
    {
        $this->testBlockRepository = $testBlockRepository;

        $this->middleware('redac');
    }

    /**
     * Display a listing of the testblock.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return redirect(route('testblock.order', [
            'name' => 'testblocks.created_at',
            'sens' => 'asc',
        ]));
    }

    /**
     * Display a listing of the testblock.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function indexOrder(Request $request)
    {
        $statut = session('statut');

        $testblocks = $this->testBlockRepository->getPostsWithOrder(
            config('app.nbrPages.back.testblocks'),
            $statut == 'admin' ? null : $request->user()->id,
            $request->name,
            $request->sens
        );

        $links = $testblocks->appends([
            'name' => $request->name,
            'sens' => $request->sens
        ]);

        if ($request->ajax()) {
            return [
                'view' => view('back.testblock.table', compact('statut', 'testblocks'))->render(),
                'links' => e($links->setPath('order')->links()),
            ];
        }

        $links->links();

        $order = new \stdClass;
        $order->name = $request->name;
        $order->sens = 'sort-' . $request->sens;

        return view('back.testblock.index', compact('testblocks', 'links', 'order'));
    }

    /**
     * Show the form for creating a new post.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('back.testblock.create');
    }

    /**
     * Store a newly created post in storage.
     *
     * @param  \App\Http\Requests\PostRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        $this->testBlockRepository->store($request->all(), $request->user()->id);

        return redirect('testblock')->with('ok', trans('back/testblock.stored'));
    }

    /**
     * Show the form for editing the specified post.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = $this->testBlockRepository->getByIdWithTags($id);

        $this->authorize('changeTestblock', $post);

        return view('back.testblock.edit', $this->testBlockRepository->getPostWithTags($post));
    }

    /**
     * Update the specified post in storage.
     *
     * @param  \App\Http\Requests\PostUpdateRequest $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, $id)
    {
        $post = $this->testBlockRepository->getById($id);

        $this->authorize('changeTestblock', $post);

        $this->testBlockRepository->update($request->all(), $post);

        return redirect('testblock')->with('ok', trans('back/testBlock.updated'));
    }
    

    /**
     * Remove the specified post from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = $this->testBlockRepository->getById($id);

        $this->authorize('changeTestblock', $post);

        $this->testBlockRepository->destroy($post);

        return redirect('testblock')->with('ok', trans('back/testblock.destroyed'));
    }
}

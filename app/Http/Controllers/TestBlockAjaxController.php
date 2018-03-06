<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\TestBlockRepository;

class TestBlockAjaxController extends Controller
{
    /**
     * The TestBlockRepository instance.
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
        
        $this->middleware('admin')->only('updateSeen');
        $this->middleware('admin')->only('update');
        $this->middleware('redac')->only('updateActive');
        $this->middleware('ajax');
    }

    /**
     * Update "vu" for the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateSeen(Request $request, $id)
    {
        $this->testBlockRepository->updateSeen($request->all(), $id);

        return response()->json();
    }

    /**
     * Update "active" for the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateActive(Request $request, $id)
    {
        $post = $this->testBlockRepository->getById($id);

        $this->authorize('change', $post);
        
        $this->testBlockRepository->updateActive($request->all(), $id);

        return response()->json();
    }
}

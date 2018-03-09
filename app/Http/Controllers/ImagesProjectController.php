<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use Intervention\Image\Facades\Image;
use App\Models\ImagesProject;
use App\Repositories\TestBlockRepository;

class ImagesProjectController extends Controller
{

    protected $ImagesProject;
    protected $TestBlockRepository;

    public function __construct(ImagesProject $ImagesProject, TestBlockRepository $testBlockRepository)
    {
        $this->ImagesProject = $ImagesProject;
        $this->TestBlockRepository = $testBlockRepository;

        $this->middleware('redac');
    }


    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
//        $ImagesProject = $this->ImagesProject->orderBy("position")->get();

//        $this->layout->content = View::make('FacingPhotos.index', compact('FacingPhotos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
  //      $this->layout->content = View::make('FacingPhotos.create');
    }
    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
//        return Redirect::action('FacingPhotosController@edit', $id);
    }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy(PostRequest $request)
    {
        $post = $this->TestBlockRepository->getById($request->id_el);
        $this->authorize('changeTestblock', $post);

        $this->ImagesProject->find($request->id_image)->delete();
        return "ok";
  //      return Redirect::action('FacingPhotosController@index');
    }



    public function postAddImageItem(PostRequest $request) {
        $post = $this->TestBlockRepository->getById($request->id_el);
        $this->authorize('changeTestblock', $post);
        //$locale = $request->getLocale();
        //if($request->hasFile($locale.'_images')){
        if($request->hasFile('images')){

            if( $request->img_type == 'images') {
                $readImage = $this->ImagesProject
                    ->where('element_id', $request->id_el)
                    ->where('table', $request->table)
                    ->where('field', $request->field_images)
                    ->first();

                if (!empty($readImage) && file_exists(public_path('/files/' . $readImage->revent_name))) {
                    unlink(public_path('/files/' . $readImage->revent_name));
                    $readImage->delete();
                }
            }

            $images = $request->file('images');
            $filename = time() . '.' . $images->getClientOriginalExtension();
            Image::make($images)->resize(1920, 1920)->save( public_path('/files/' . $filename));
            Image::make($images)->save( public_path('/files/' . $filename));
            $imgProject = new ImagesProject;
            $imgProject->element_id = $request->id_el;
            $imgProject->table = $request->table;
            $imgProject->field = $request->field_images;
            $imgProject->original_name = $images->getClientOriginalName();
            $imgProject->revent_name = $filename;
            $imgProject->save();
        }
        die(json_encode(array(
            'success' => true,
            'errors' => false
        )));
    }

    public function getGallery() {

    //    $this->layout->content = View::make("gallery.admin.list", $this->template_data);
    }
    
}

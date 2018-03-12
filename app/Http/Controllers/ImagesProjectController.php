<?php

namespace App\Http\Controllers;

use App\Repositories\WorldTcRepository;
use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use Intervention\Image\Facades\Image;
use App\Models\ImagesProject;
use App\Repositories\TestBlockRepository;
use App\Repositories\CollectionRepository;
use App\Repositories\CustomerServiceRepository;

class ImagesProjectController extends Controller
{

    protected $imagesProject;
    protected $testBlockRepository;
    protected $worldTcRepository;
    protected $collectionRepository;
    protected $customerServiceRepository;
    
    public function __construct(ImagesProject $imagesProject, TestBlockRepository $testBlockRepository, WorldTcRepository $worldTcRepository, CollectionRepository $collectionRepository, CustomerServiceRepository $customerServiceRepository)
    {
        $this->imagesProject = $imagesProject;
        $this->testBlockRepository = $testBlockRepository;
        $this->worldTcRepository = $worldTcRepository;
        $this->collectionRepository = $collectionRepository;
        $this->customerServiceRepository = $customerServiceRepository;

        $this->middleware('admin');
        $this->middleware('redac');
        $this->middleware('ajax');
    }
    
    public function destroy(PostRequest $request)
    {
   //     $post = $this->testBlockRepository->getById($request->id_el);
   //     $this->authorize('changeTestblock', $post);

        $this->imagesProject->find($request->id_image)->delete();
        return "ok";
  //      return Redirect::action('FacingPhotosController@index');
    }

    public function imgSave($request){

        if($request->hasFile('images')){

            if( $request->img_type == 'images') {
                $readImage = $this->imagesProject
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
            //Image::make($images)->resize(1920, 1920)->save( public_path('/files/' . $filename));
            Image::make($images)->save( public_path('/files/' . $filename));
            $imgProject = new ImagesProject;
            $imgProject->element_id = $request->id_el;
            $imgProject->table = $request->table;
            $imgProject->field = $request->field_images;
            $imgProject->original_name = $images->getClientOriginalName();
            $imgProject->revent_name = $filename;
            $imgProject->save();
        }
        return json_encode(array('success' => true, 'errors' => false));
    }

    public function worldtcPostAddImageItem(PostRequest $request){

        $post = $this->worldTcRepository->getById($request->id_el);
        $this->authorize('changeworldTc', $post);
        //$locale = $request->getLocale();
        //if($request->hasFile($locale.'_images')){
        
        return $this->imgSave($request);
    }

    public function collectionPostAddImageItem(PostRequest $request){

        $post = $this->collectionRepository->getById($request->id_el);
        $this->authorize('changeCollection', $post);
        //$locale = $request->getLocale();
        //if($request->hasFile($locale.'_images')){

        return $this->imgSave($request);
    }

    public function customerServicePostAddImageItem(PostRequest $request){

        $post = $this->customerServiceRepository->getById($request->id_el);
        $this->authorize('changeCustomerservice', $post);
        //$locale = $request->getLocale();
        //if($request->hasFile($locale.'_images')){

        return $this->imgSave($request);
    }
}

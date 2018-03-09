<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\Repositories\TestBlockRepository;
use Intervention\Image;

class ImageController extends Controller
{

    
    protected $FacingPhoto;

    public function __construct(FacingPhoto $FacingPhoto)
    {
        $this->FacingPhoto = $FacingPhoto;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $FacingPhotos = $this->FacingPhoto->orderBy("position")->get();

        $this->layout->content = View::make('FacingPhotos.index', compact('FacingPhotos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $this->layout->content = View::make('FacingPhotos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $input = Input::all();
        $validation = Validator::make($input, FacingPhoto::$rules);

        if ($validation->passes())
        {
            $this->FacingPhoto->create($input);

            return Redirect::action('FacingPhotosController@index');
        }

        return Redirect::action('FacingPhotosController@create')
            ->withInput()
            ->withErrors($validation)
            ->with('message', 'There were validation errors.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        return Redirect::action('FacingPhotosController@edit', $id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $FacingPhoto = $this->FacingPhoto->find($id);

        if (is_null($FacingPhoto))
        {
            return Redirect::action('FacingPhotosController@index');
        }

        $this->AddTemplateData("slider", FacingPhotoItem::get());

        $this->layout->content = View::make('FacingPhotos.edit', compact('FacingPhoto'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        $input = array_except(Input::all(), '_method');
        $validation = Validator::make($input, FacingPhoto::$rules);


        if ($validation->passes())
        {
            $FacingPhoto = $this->FacingPhoto->find($id);
            $FacingPhoto->update($input);

            return Redirect::action('FacingPhotosController@show', $id);
        }

        return Redirect::action('FacingPhotosController@edit', $id)
            ->withInput()
            ->withErrors($validation)
            ->with('message', 'There were validation errors.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $this->FacingPhoto->find($id)->delete();

        return Redirect::action('FacingPhotosController@index');
    }

    public function postAddGalleryItem() {
        $validator = Validator::make(Input::all(), FacingPhotoItem::$rules);

        if ($validator->passes()) {
            $file = Input::file('file');
            $destinationPath = public_path().'/uploads/gallery';
            $filename = sha1($file->getClientOriginalName())."_".time();
            $upload_success = $file->move($destinationPath, $filename.".".$file->getClientOriginalExtension());
            if ($upload_success)
            {
                $img = Image::make($destinationPath. "/" .$filename.".".$file->getClientOriginalExtension());
                if ($img) {
                    $size = $img->width() > $img->height() ? $img->height() : $img->width();

                    $img->resizeCanvas($size, $size, 'top-left');
                    $img->resize(150, 150);
                }

                $img->save($destinationPath."/". $filename ."_small.".$file->getClientOriginalExtension());
            }

            $gallery = new FacingPhotoItem;
            $gallery->title = Input::get("title");
            //     $gallery->date = Input::get("date");
            $gallery->facingphotos_id = Input::get("facingphotos_id");
            $gallery->big_img = $filename .".".$file->getClientOriginalExtension();
            $gallery->small_img = $filename ."_small.".$file->getClientOriginalExtension();
            $gallery->status = Status::WORK;
            $gallery->save();


            die(json_encode(array(
                'success' => true,
                'errors' => false
            )));
        } else {
            //return Redirect::back()->with('type', 'section')->withErrors($validator)->withInput();

            die(json_encode(array(
                'success' => false,
                'errors' => $validator->getMessageBag()->toArray()
            )));
        }
    }

    public function getGallery() {

        $this->layout->content = View::make("gallery.admin.list", $this->template_data);
    }

    public function postEditGalleryItem($id) {
        $validator = Validator::make(Input::all(), FacingPhotoItem::$updateRules);
        $gallery = FacingPhotoItem::find($id);
        if ($gallery && $validator->passes()) {
            $gallery->title = Input::get("title");
            //   $gallery->date = Input::get("date");
            $gallery->status = Input::get("status");
            $gallery->save();


            die(json_encode(array(
                'success' => true,
                'errors' => false
            )));
        } else {
            //return Redirect::back()->with('type', 'section')->withErrors($validator)->withInput();

            die(json_encode(array(
                'success' => false,
                'errors' => $validator->getMessageBag()->toArray()
            )));
        }
    }

    public function postDeleteGalleryItem($id) {
        $gallery = FacingPhotoItem::find($id);
        if ($gallery) {
            $destinationPath = public_path().'/uploads/gallery/';
            @unlink($destinationPath . $gallery->small_img);
            @unlink($destinationPath . $gallery->big_img);
            $gallery->delete();
        }

        die();
    }
    
    
    
}

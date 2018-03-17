<?php

namespace App\Http\Requests;

class PostRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $id = $this->blog ? ',' . $this->blog : $this->testblock ? ',' . $this->testblock :  $this->worldtc ? ',' . $this->worldtc :  $this->collection ? ',' . $this->collection : $this->customerservice ? ',' . $this->customerservice : $this->findus ? ',' . $this->findus : $this->ordercatalogue ? ',' . $this->ordercatalogue : '';
       // $id = $this->worldtc ? ',' . $this->worldtc :  '';
        if($id && $this->getMethod() != 'PUT') {
            return [
                'en_title' => 'bail|required|max:255',
                //'summary' => 'bail|required|max:65000',
                //'content' => 'bail|required|max:65000',
                'slug' => 'bail|required|max:255|unique:posts|unique:testblocks|unique:worldtcs|unique:collections|unique:customerservices|unique:finduss|unique:ordercatalogues,slug' . $id,
                // 'tags' => ['regex:/^[A-Za-z0-9-éèàù]{1,50}?(,[A-Za-z0-9-éèàù]{1,50})*$/'],
            ];
        }else{
            return [
                'title' => 'max:255'
            ];
        }
    }
}

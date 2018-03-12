<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;

class HomeController extends Controller
{
    /**
     * Display the home page.
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke()
    {

        //dd(phpinfo());
        return view('front.index');
    }

    public function postSend(PostRequest $request) {

        $errors = [];
        $fields = [
            "name" => "Имя",
//            "phone" => "Телефон",
            "email" => "E-mail",
        ];


        if (!$request->name || !strlen($request->name) > 1)
            $errors['name'] = "Введите имя";

        if (!$request->email || !strlen($request->email) > 1)
            $errors['email'] = "Введите email";
/*
        if (!Input::get("phone") || !strlen(Input::get("phone")) > 1)
            $errors['phone'] = "Введите телефон!";
        else
            if (!preg_match("/^(?:\+?[7,8][-. ]?)?\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{2})[-. ]?([0-9]{2})$/", Input::get("phone")))
                $errors['phone'] = "Не верный формат";
*/
        if (count($errors) == 0) {
            Mail::send('emails.request', ["fields" => Input::all(), "needed" => $fields], function(\Illuminate\Mail\Message $message)
            {
                $config = Cache::remember('config', 600, function() {
                    return MainPage::getInfo();
                });

                $message->to(explode(",", $config->emails))->subject('test: '. Input::get("subject") . " (" . Input::get("type") .")");
            });

            $comment = "";
            foreach($fields as $key=>$field) {

                if ($key == "name" || $key == "phone")
                    continue;

                if (Input::get($key))
                    $comment .= $field . ": " . Input::get($key). "; ";

            }

            return Response::json(array("successMessage" => "allGood", "status" => true));

        } else {
            //return Redirect::back()->with('type', 'section')->withErrors($validator)->withInput();
            return Response::json(array("fieldErrors" => $errors));
        }

    }

}

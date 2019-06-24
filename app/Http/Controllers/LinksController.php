<?php

namespace App\Http\Controllers;

use App\Link;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;

class LinksController extends Controller
{

    public function make(){
        $validator = Validator::make(Input::all(), array(
            'url' => 'required|url|max:255'
        ));

        if($validator->fails()) {
            return Redirect::route('home')->withInput()->withErrors($validator);
        } else {

            $url = Input::get('url');
            $code = null;

            $exists = Link::where('url', '=', $url);

            if($exists->count() === 1 ) {
                echo $code = $exists->first()->code;
            } else {
                $created = Link::create(array(
                    'url' => $url
                ));

                if($created) {
                    $bytes = random_bytes(4);
                    $code =  bin2hex($bytes);

                    Link::where('id', '=', $created->id)->update(array(
                        'code' => $code
                    ));
                }
            }

            if($code) {
                return Redirect::route('home')->with('global', 'All done! Here is your short URL: <a href="' . URL::action('LinksController@get', $code) . '">' . URL::action('LinksController@get', $code) . '</a>');
            }

        }

        return Redirect::route('home')->with('global', 'Something went wrong, try again.');

    }

    public function get($code){
        $link = Link::where('code', '=', $code);

        if($link->count() === 1 ){
            return Redirect::to($link->first()->url);

        }

        return Redirect::route('home')->with('global', 'This URL does not exist');
    }


    public function show($id){
        $link = Link::find($id);
        return redirect($link->url, 301);
    }

    public function create(){
        return view('links.create');
    }

    public function store(Request $request){

        $link = Link::create(['url' => $request->post('url')]);
        return view('links.success', compact('link'));

    }

}

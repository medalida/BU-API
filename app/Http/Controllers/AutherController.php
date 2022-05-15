<?php

namespace App\Http\Controllers;

use App\Models\Auther;
use Facade\FlareClient\Http\Response;
use Illuminate\Http\Request;


class AutherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Auther::all();
    }
    public function create()
    {
        return csrf_token();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validation($request);
        $auther=Auther::create(
            [
                'name'=>$request->input('name'),
                'gender'=>$request->input('gender'),
                'nation'=>$request->input('nation'),
                'birthday'=>$request->input('birthday'),
                'resume'=>$request->input('resume'),
            ]
        );
        if ($request->hasFile('image')){

            $newImageName='IMG_'.$auther->auther_id.'.jpg';
            $move=$request
                ->image
                ->move(public_path('image').DIRECTORY_SEPARATOR.'authers', $newImageName);
            if($move){
                $auther->update(
                    ['image'=>$newImageName]
                );
            }
        }
            return $auther;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Auther  $auther
     * @return \Illuminate\Http\Response
     */
    public function show(Auther $auther)
    {
        return $auther->toJson();
    }

    public function showImage(Auther $auther){
        if($auther->image){
            $imagePath=public_path('image').
                            DIRECTORY_SEPARATOR.
                            'authers'.
                            DIRECTORY_SEPARATOR.
                            'IMG_'.
                            $auther->auther_id.
                            '.jpg';
            return Response()->file($imagePath);
        }
        else{
            abort(404,'There is no image for '.$auther->name);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Auther  $auther
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Auther $auther)
    {
        $this->validation($request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Auther  $auther
     * @return \Illuminate\Http\Response
     */
    public function destroy(Auther $auther)
    {

    }



    private function validation(Request $request){
        $today=date('Y-m-d');
        $valide=$request->validate(
            [
                'name'=>"required|max:50",
                //'gender'=>"required|in:male,female",
               // 'nation'=>"required",
                //'birthday'=>"required|date|before:$today",
               // 'resume'=>"required",
               // 'image'=>'mimes:png,jpg,jpeg',
            ]
            );
        return $valide;
        }
}

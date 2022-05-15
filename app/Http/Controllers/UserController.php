<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


include ('functions.php');

class UserController extends Controller
{
    protected function index(){



        $user=User::all();
return $user;
    }

protected function store(Request $request){

    $this->validation( $request);

    $user =User::create(
                [
                'first_n'=>$request->input('first_n'),
                'last_n'=>$request->input('last_n'),
                'email'=>$request->input('email'),
                'password'=>$request->input('password'),
                'gender'=>$request->input('gender'),
                'birthday'=>$request->input('birthday'),
                'resume'=>$request->input('resume'),
                ]
    );
if ($request->hasFile('image')){

    $newImageName='IMG_'.$user->user_id.'.jpg';
    $move=$request
        ->image
        ->move(public_path('image').DIRECTORY_SEPARATOR.'users',$newImageName);
    if($move){
        $user->update(
            ['image'=>$newImageName]
        );
    }
}
return $user;

}

protected function update(Request $request,User $user){


}





private function validation(Request $request){
    $today=date('Y-m-d');
    $tules=[
        'first_n'=>"required|max:30",
        'last_n'=>"required|max:30",
        'password' => "required|min:6|same:password_confirm",
        'password_confirm' => "required|min:6|same:password",
        'gender'=>"required|in:male,female",
        'email'=>"required|email|unique:users",
        'birthday'=>"required|date|before:$today",
        'resume'=>"required",
        'image'=>'mimes:png,jpg,jpeg',
    ];
    $valide=$request->validate(
        $tules
        );
    return $valide;
    }








}

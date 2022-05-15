<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $req)
    {
        return Auth::user();
    }

    public function create(){
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

        $user = Book::create(
        [
            'title'=>$request->input('title'),
            'year'=>$request->input('year'),
            'type'=>$request->input('type'),
            'resume'=>$request->input('resume'),

    ]
    );

    return $user;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
       return $book->toJson();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        //
    }

    private function validation(Request $request){
        $this_year=date('Y');
        $valide=$request->validate(
            [
                'title'=>"required|max:50",
                'year'=>"required|integer|max:$this_year",
                'type'=>"required",
                'resume'=>"required",
            ]
            );
        return $valide;
        }
}

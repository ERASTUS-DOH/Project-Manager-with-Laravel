<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class  CommentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(Auth::check()){
            $comment = Comment::create([
                'body' =>$request->input('comment-body'),
                'url' =>$request->input('url'),
                'commentable_id' =>$request->input('commentable_id'),
                'commentable_type' =>$request->input('commentable_type'),
                'user_id' =>Auth::user()->id
            ]);
        }

         /*if($comment){
            return redirect()->route('companies.show',['company'=> $company->id])
                ->with('success','Company Created Successfully');

        }*/
         if($comment){
             return back()->with('success','Comment Created Successfully');
         }

        return back()->with('errors','Error creating New Comment');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        //
    }
}

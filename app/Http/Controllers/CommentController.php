<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $comment = new Comment();
        $content = __("Contenido");
        $action = route("comments.store");
        return view("comments.form", compact("comment", "content", "action"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user_id = $request->user()->id;
        Comment::create([
            'user_id' => $user_id,
            'image_id' => $request->image_id,
            'content' => $request->content,
            'created_at' => now(),
        ]);
        session()->flash("success", __("El comentario se ha publicado correctamente"));
        return redirect(route("images.index"));
    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        $comment->delete();
        session()->flash("success", __("El comentario ha sido eliminado correctamente"));
        return redirect(route("images.index"));
    }
}

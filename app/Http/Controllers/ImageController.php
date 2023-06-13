<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImageRequest;
use App\Models\Image;
use App\Models\Like;
use App\Models\Comment;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $images = Image::with("user")->withCount("like","comment")->latest()->paginate();
        return view("images.index", compact(var_name: "images"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $image = new Image;
        $description = __("Descripcion");
        $action = route("images.store");
        return view("images.form", compact("image", "description", "action"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ImageRequest $request)
    {
        $path = $request->file('image_path')->storePublicly('image');
        $user = $request->user()->id;
        Image::create([
            'user_id' => $user,
            'image_path' => $path,
            'description' => $request->description,
            'created_at' => now(),
        ]);
        session()->flash("success", __("La imagen se ha publicado correctamente"));
        return redirect(route("images.index"));
    }

    /**
     * Display the specified resource.
     */
    public function show(Image $image)
    {
        $image = Image::with("user", "comment")->withCount("like","comment")->where('id', $image->id)->first();
        return view("images.show", compact("image"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Image $image)
    {
        $description = __("Descripcion");
        $action = route("images.update", ["image" => $image]);
        return view("images.edit", compact("image","description", "action"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ImageRequest $request, $id)
    {
        $validated = $request->safe()->only(['description']);
        $image = Image::where('id', $id)->first();
        $image->update($validated);
        session()->flash("success", __("La imagen se ha actualizado correctamente"));
        return redirect(route("images.index"));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Image $image)
    {
        $image->delete();
        session()->flash("success", __("La imagen ha sido eliminada correctamente"));
        return redirect(route("images.index"));
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Link;

class LinkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Fetch links from database
        // $links = Link::latest()->paginate(10); // Example with pagination
        // return view("admin.links.index", compact("links"));

        // For now, returning the view without data
        return view("links.admin_links", [
            'links' => Link::Paginate(5)

        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()

    {
        return view("links.add_link");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            "title" => "required|string|max:255",
            "url" => "required|url|max:2048",
            "type" => "required|string|in:site,journal,article",

        ]);

        // Create and save the link
        Link::create([
            'title' => $request->title,
            'url' => $request->url,
            'type' => $request->type,
            'description' => $request->description,
        ]); // Example

        // Redirect back to the index page with a success message
        // return redirect()->route("admin.links.index")->with("message", "Link added successfully!");

        // For now, just redirecting back
        return redirect()->route("links.admin_links");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id // Or use Route Model Binding: Link $link
     * @return \Illuminate\Http\Response
     */
    public function edit(Link $link) // Using Route Model Binding: public function edit(Link $link)
    {
        return view('links.edit', [
            'link' => $link
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id // Or use Route Model Binding: Link $link
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) // Using Route Model Binding: public function update(Request $request, Link $link)
    {
        // Validate the request data
        $request->validate([
            "title" => "required|string|max:255",
            "url" => "required|url|max:2048",
            "type" => "required|string|in:site,journal,article",
        ]);

        $link = Link::find($id);

        $link->update([
            'title' => $request->title,
            'url' => $request->url,
            'type' => $request->type,
            'description' => $request->description,
        ]);


        return redirect()->route("links.admin_links");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id // Or use Route Model Binding: Link $link
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) // Using Route Model Binding: public function destroy(Link $link)
    {
        // Find and delete the link
        $linkToDelete = Link::findOrFail($id); // If not using Route Model Binding
        $linkToDelete->delete(); // Example

        return redirect()->route("links.admin_links");
    }
}


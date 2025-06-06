<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use App\Models\Link; // Assuming you have a Link model

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
        return view("links.admin_links");
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
        // Link::create($request->all()); // Example

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
    public function edit($link) // Using Route Model Binding: public function edit(Link $link)
    {
        // Fetch the specific link
        // $link = Link::findOrFail($id); // If not using Route Model Binding

        // return view("admin.links.edit", compact("link"));

        // For now, returning the view without data (assuming edit view exists)
        // return view("admin.links.edit");
        return response("Edit form for link ID: " . (is_object($link) ? $link->id : $link)); // Placeholder
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id // Or use Route Model Binding: Link $link
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $link) // Using Route Model Binding: public function update(Request $request, Link $link)
    {
        // Validate the request data
        $request->validate([
            "title" => "required|string|max:255",
            "url" => "required|url|max:2048",
            "type" => "required|string|in:site,journal,article",
        ]);

        // Find and update the link
        // $linkToUpdate = Link::findOrFail($id); // If not using Route Model Binding
        // $linkToUpdate->update($request->all()); // Example
        // $link->update($request->all()); // If using Route Model Binding

        // Redirect back to the index page with a success message
        // return redirect()->route("admin.links.index")->with("message", "Link updated successfully!");

        // For now, just redirecting back
        return redirect()->route("links.admin_links");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id // Or use Route Model Binding: Link $link
     * @return \Illuminate\Http\Response
     */
    public function destroy($link) // Using Route Model Binding: public function destroy(Link $link)
    {
        // Find and delete the link
        // $linkToDelete = Link::findOrFail($id); // If not using Route Model Binding
        // $linkToDelete->delete(); // Example
        // $link->delete(); // If using Route Model Binding

        // Redirect back to the index page with a success message
        // return redirect()->route("admin.links.index")->with("message", "Link deleted successfully!");

        // For now, just redirecting back
        return redirect()->route("links.admin_links");
    }
}


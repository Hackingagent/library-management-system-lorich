<?php

namespace App\Http\Controllers\StudentPanel;

use App\Http\Controllers\Controller; // Make sure to import the base Controller
use Illuminate\Http\Request;
// use App\Models\Link; // Assuming you have a Link model

class LinkController extends Controller
{
    /**
     * Display a listing of the external links for students.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Fetch links from database (ensure you only fetch appropriate links if needed)
        // $links = Link::latest()->get(); // Example: Fetch all links
        // return view("student.links.index", compact("links")); // Assuming view path is resources/views/student/links/index.blade.php

        // For now, returning the view without data
        // Make sure your user_links_index.blade.php is in the correct view path
        // e.g., resources/views/student/links/index.blade.php or similar
        // Adjust the view name below accordingly.
        return view("links.admin_links"); // Using the name of the blade file I created earlier
    }
}


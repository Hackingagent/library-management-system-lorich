<?php

namespace App\Http\Controllers\StudentPanel;

use App\Http\Controllers\Controller;
use App\Models\book;
use Illuminate\Http\Request;

class LinkController extends Controller
{
    /**
     * Display external links
     */
    public function index()
    {
        return view("student-panel.student_links");
    }

    /**
     * Display book browsing page
     */
    public function browse()
    {
        $books = book::with(['auther', 'category'])
            ->where('status', 'Y')
            ->orderBy('name')
            ->paginate(12);

        return view("student-panel.browse-books", compact('books'));
    }
}
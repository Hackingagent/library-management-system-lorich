<?php

namespace App\Http\Controllers\StudentPanel;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;

class LinkController extends Controller
{
    /**
     * Display external links
     */
    public function index()
    {
        return view("student-panel.links");
    }

    /**
     * Display book browsing page
     */
    public function browse()
    {
        $books = Book::with(['author', 'category'])
            ->where('is_available', true)
            ->orderBy('title')
            ->paginate(12);

        return view("student-panel.browse-books", compact('books'));
    }
}
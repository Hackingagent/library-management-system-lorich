<?php

namespace App\Http\Controllers\StudentPanel;

use App\Http\Controllers\Controller;
use App\Models\book;
use Illuminate\Http\Request;
use App\Models\Link;
use App\Models\category;

class LinkController extends Controller
{
    /**
     * Display external links
     */
    public function index()
    {
        $links = Link::all(); // Assuming you have a Link model

        $groupedLinks = [
            'site' => $links->where('type', 'site')->values(),
            'journal' => $links->where('type', 'journal')->values(),
            'article' => $links->where('type', 'article')->values(),
        ];

        return view('student-panel.links', compact('groupedLinks'));
    }

    /**
     * Display book browsing page
     */
    public function browse(Request $request)
    {
        $query = $request->input('search');
        $sort = $request->input('sort', 'title'); // default sort by title
        $direction = $request->input('direction', 'asc'); // default direction asc

        $books = book::with(['auther', 'category', 'file'])
            ->when($query, function ($q) use ($query) {
                $q->where('name', 'like', '%' . $query . '%')
                    ->orWhereHas('auther', function ($q) use ($query) {
                        $q->where('name', 'like', '%' . $query . '%');
                    })
                    ->orWhereHas('category', function ($q) use ($query) {
                        $q->where('name', 'like', '%' . $query . '%');
                    });
            })
            ->join('authers', 'books.auther_id', '=', 'authers.id')
            ->when($sort, function ($q) use ($sort, $direction) {
                switch ($sort) {
                    case 'title':
                        $q->orderBy('books.name', $direction);
                        break;
                    case 'author':
                        $q->orderBy('authers.name', $direction);
                        break;
                    case 'year':
                        $q->orderBy('books.created_at', $direction);
                        break;
                    default:
                        $q->orderBy('books.name', $direction);
                        break;
                }
            })
            ->select('books.*')
            ->paginate(12);

            $category = category::all();

        return view("student-panel.browse-books", compact(['books', 'category']));
    }





}
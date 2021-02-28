<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Exports\PostsExport;
use Maatwebsite\Excel\Facades\Excel;


class PostController extends Controller
{
    public function export() 
    {
        return Excel::download(new PostsExport, 'posts.xlsx');
    }
}

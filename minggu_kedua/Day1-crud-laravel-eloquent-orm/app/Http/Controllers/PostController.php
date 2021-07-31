<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;

class PostController extends Controller
{
    // memberikan auth untuk login terlebih dahulu
    public function __construct()
    {
        // diharuskan semua nya untuk login
        // $this->middleware(['auth:sanctum', 'verified']);

        // except digunakan untuk white list jadi bisa masuk tanpa login
        $this->middleware(['auth:sanctum', 'verified'])->except(['index']);
        
        // only digunakan untuk black list jadi harus masuk terlbih dahulu dengan login
        // $this->middleware(['auth:sanctum', 'verified'])->only(['create', 'edit', 'update', 'stroe']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // menggunakan metode query builder
        // $posts = DB::table('posts')->get(); // sama seperti SELECT * FROM posts/ menampilkan semua
        
        // menggunakan metode Mass Assignment
        $posts = Post::all(); // menampilkan semua data dengan Models
        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|unique:posts|min:6',
            'body' => 'required|min:6',
            // 'profil_id' => Auth::id();
        ]);
        // menggunakan metode query builder
        // $query = DB::table('posts')->insert([
        //     "title" => $request->title,
        //     "body" => $request->body
        // ]);

        // $posts = new Post;
        // $posts->title = $request["title"];
        // $posts->body = $request["body"];
        // $posts->save(); // sama seperti insert into

        // menggunakan metode Mass Assignment
        $posts = Post::create([
            'title' => $request->title,
            'body' => $request->body,
            'user_id' => Auth::id(), 
        ]);
        return redirect('/crudposts')->with('success', 'Data Berhasil di Tambahkan!');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // menggunakan metode query builder
        // $show = DB::table('posts')
        //     ->where('id', $id)
        //     ->get();

        // menggunakan metode Mass Assignment
        $show = Post::find($id);
        // return view('posts.show',['show'=>$show]);
        return view('posts.show', compact('show'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // menggunakan metode query builder
        // $edit = DB::table('posts')
        //     ->where('id', $id)
        //     ->first();

        // menggunakan metode Mass Assignment
        $edit = Post::find($id); // menampilkan semua data dengan Models
        return view('posts.edit', compact('edit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|min:6',
            'body' => 'required',
        ]);
        
        // menggunakan metode query builder
        // DB::table('posts')
        //     ->where('id', $id)
        //     ->update([
        //         'title' => $request->title,
        //         'body' => $request->body
        //     ]);

        // menggunakan metode Mass Updates
        Post::where('id', $id)->update([
            'title' => $request->title, 
            'body' => $request->body
        ]);

        return redirect('/crudposts')->with('success', 'Data Berhasil di Update!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    
    // menggunakan metode query builder
    // DB::table('posts')
    // ->where('id', $id)
    // ->delete();

    // menggunakan metode Deleting Models
    Post::destroy($id);
    return redirect('/crudposts')->with('success', 'Data Berhasil di Delete!');
    }
}
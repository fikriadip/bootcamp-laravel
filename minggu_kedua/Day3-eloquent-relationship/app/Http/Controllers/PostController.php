<?php

namespace App\Http\Controllers;

// Sweet Alert
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PostsExport;
use App\Models\Post;
use App\Models\Tag; 

class PostController extends Controller
{
    // memberikan auth untuk login terlebih dahulu
    public function __construct()
    {
        // diharuskan semua nya untuk login
        $this->middleware(['auth:sanctum', 'verified']);

        // except digunakan untuk white list jadi bisa masuk tanpa login
        // $this->middleware(['auth:sanctum', 'verified'])->except(['index']);
        
        // only digunakan untuk black list jadi harus masuk terlbih dahulu dengan login
        // $this->middleware(['auth:sanctum', 'verified'])->only(['create', 'edit', 'update', 'stroe']);
    }

    // Export Excel
    public function export() 
    {
        ob_end_clean(); 
        ob_start();
        return Excel::download(new PostsExport, 'posts.xls');
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
        $user = Auth::user(); // menampilkan pembuat yang sedang login sekarang
        $posts = $user->posts; // menampilkan pembuat postingan yang sedang login 
        // $posts = Post::all(); // menampilkan semua data dengan Models
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
        // $posts = Post::create([
        //     'title' => $request->title,
        //     'body' => $request->body,
        //     // 'user_id' => Auth::id() // metode menampilkan user id tanpa metode save 
        // ]);

        // menampilkan user id degan metode save
        // $user = Auth::user();
        // $user->posts()->save($posts);

        // menggunakan The Create Method
        // dd($request->tags);
        //1.explode untuk menggubah request tags menjadi array
        $tags_arr = explode(',', $request["tags"]);
        // dd($tags_arr);
        //2.looping array tags yang tadi, buat array penampung  
        //3.setiap sekali looping lakukan pengecekan apakah sudah ada tag nya
        //4.kalo sudah ada ambil id nya
        //5.kalo belum ada id nya simpan dulu tag nya, lalu ambil id nya
        //6.tampung id di array penampung
        
        $tag_ids = [];
        foreach ($tags_arr as $tag_name) {
            // menggunakan cara firstOrCreate
            $tag = Tag::firstOrCreate(["tag_name" => $tag_name]);
            $tag_ids[] = $tag->id;

            // menggunakan cara where dengan if else
            // $tag = Tag::where("tag_name", $tag_name)->first();
            // if ($tag) {
            //     $tag_ids[] = $tag->id;
            // } else {
            //     $new_tag = Tag::create(["tag_name" => $tag_name]);
            //     $tag_ids[] = $new_tag->id;
            // }
            
        }

        // dd($tag_ids);


        // $user = Auth::user();
        // $posts = $user->posts()->create([
        //     'title' => $request->title,
        //     'body' => $request->body,
        // ]);

        $posts = Post::create([
            'title' => $request->title,
            'body' => $request->body,
            'user_id' => Auth::id() // metode menampilkan user id tanpa metode save 
        ]);
        $posts->tags()->sync($tag_ids);

        // $user = Auth::user();
        // $posts->posts()->save($posts);
        // $user->posts()->associate($posts);
        // $user->save();

        // Sweet Alert Message
        Alert::success('Success', 'Berhasil Menambahkan Data Baru');

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
        // dd($show->maker);
        // return view('posts.show',['show'=>$show]);
        return view('posts.show', compact('show'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        // menggunakan metode query builder
        // $edit = DB::table('posts')
        //     ->where('id', $id)
        //     ->first();

       // menggunakan The Create Method
        // dd($request->tags);
        //1.explode untuk menggubah request tags menjadi array
        $tags_arr = explode(',', $request["tags"]);
        // dd($tags_arr);
        //2.looping array tags yang tadi, buat array penampung  
        //3.setiap sekali looping lakukan pengecekan apakah sudah ada tag nya
        //4.kalo sudah ada ambil id nya
        //5.kalo belum ada id nya simpan dulu tag nya, lalu ambil id nya
        //6.tampung id di array penampung
        
        $tag_ids = [];
        foreach ($tags_arr as $tag_name) {
            // menggunakan cara firstOrCreate
            $tag = Tag::firstOrCreate(["tag_name" => $tag_name]);
            $tag_ids[] = $tag->id;

            // menggunakan cara where dengan if else
            // $tag = Tag::where("tag_name", $tag_name)->first();
            // if ($tag) {
            //     $tag_ids[] = $tag->id;
            // } else {
            //     $new_tag = Tag::create(["tag_name" => $tag_name]);
            //     $tag_ids[] = $new_tag->id;
            // }
            
        }
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
        Post::where('id', $id)
            ->update([
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
    Post::destroy('id', $id);
    // Alert::warning('Warning Title', 'Yakin Ingin Menghapus Data?');
    Alert::success('Success', 'Berhasil Mendelete Data!');
    return redirect('/crudposts')->with('success', 'Data Berhasil di Delete!');
    }
}
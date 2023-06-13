<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Like;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
//      $posts=Post::with('user')->get();
        $posts=Post::when(\request('searchKey'),function($query){
            $searchKey=\request('searchKey');
            $query->orWhere('body', 'LIKE', '%'.$searchKey.'%');
        })
        ->with('user')->get();

      return view('index',['posts' => $posts]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $posts=new Post();
        $posts->body=$request->body;
        if ($request->hasFile('image'))
        {
            $file=$request->file('image');
           $file_name=$file->hashName();
            $path=$file->storeAs('public',$file_name);

           $posts->image=$path;
           $posts->image=$file_name;
        }
        $user=Auth::user();
        $posts->user()->associate($user);

        $posts->save();

        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $post=Post::find($id);
       return view('edit',["post"=>$post]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $post=Post::find($id);
        $post->body=$request->body;

        $file=$request->file('image');
        if ($file){
            $file_name=$file->hashName();
            $path=$file->storeAs('public',$file_name);

            $post->image=$path;
            $post->image=$file_name;

        }

        $post->save();

        return redirect('dashboard');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post=Post::find($id);
        $post->delete();

        return back();

    }

    public function like(Request $request, $postId)
    {
        $post=Post::findOrFail($postId);
        // Check if the user has already liked the post
        $user = auth()->user(); // Assuming you have authentication
        $hasLiked = $post->likes()->where('user_id', $user->id)->exists();

        if ($hasLiked) {
            // User has already liked the post, so remove the like
            $post->likes()->where('user_id', $user->id)->delete();
            $post->like_count--;
        } else {
            // User hasn't liked the post, so add the like
            $like = new Like();
            $like->user_id = $user->id;
            $post->likes()->save($like);
            $post->like_count++;
        }

        $post->save();
       $like_count=$post->like_count;

        return redirect(route('index',["like_count"=>$like_count]));
    }
}

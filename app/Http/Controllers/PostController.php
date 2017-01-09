<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Post::latest()->take(5)->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->file('image')) {
            // it has to be stored within the storage/images/uploads
            // and the following line for sure will save it there oncondition of
            // php artisan storage:link
            $fileName = $this->saveImage($request, 'image', 'large', '600', '600');
            $this->saveImage($request, 'image', 'medium', '360', '360');
            $request->request->add(['image' => $fileName]);

        } else {
            return response()->json(['message' => 'you must upload an image'], 500);
        }

        $title = $request->input('title');
        $body = $request->input('body');
        $user = JWTAuth::parseToken()->authenticate();

        if (!$user) {

            return response()->json(['message' => 'you not authorized for such action'], 505);

        }


        $post = Post::create([
            'title' => $request->title,
            'body' => $request->body,
            'image' => $request->request->get('image'),
            'user_id' => $user->id
        ]);

        if (!$post) {
            return response()->json(['message' => 'Post not Saved successfully'], 500);
        }

        return response()->json(['message' => 'Post Saved successfully'], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Post::whereId($id)->first();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

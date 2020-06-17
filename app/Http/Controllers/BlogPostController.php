<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\BlogPost;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
class BlogPostController extends Controller
{

    public function __construct()
    {
        auth()->setDefaultDriver('api');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showAllPosts()
    {

        //
        $blog_posts = BlogPost::all();
        $apikey = base64_encode(Str::random(40));


//        User::create(
//            [
//                'name' => "Djurdjijan",
//                'email' => "dragojevic.negotin@gmail.com",
//                'password' => Hash::make('djurdjijan'),
//                'api_token'=>$apikey
//            ]
//        );
        return response()->json($blog_posts);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
 echo 'muda';

//        $validatedData = Validator::make($request->all(), [
//            'title' => 'required',
//            'author' => 'required',
//            'content' => 'required',
//        ]);
//        if ($validatedData->fails()) {
//            return response()->json($validatedData->errors(), 400);
//        }
//        BlogPost::create($request->all());
//        return response()->json(['status' => 'OK']);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function showOnePost($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int                      $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        //
    }
}

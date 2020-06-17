<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use App\Blog;


class BlogController extends Controller
{
    public function user_blogs(Request $request)
    {
        $blogs = $request->auth->Blogs->sortByDesc('created_at');
        return response()->json([
            'status' => 'success',
            'message' => 'Founded user blog posts',
            'data' => $blogs
        ], 200);
    }

    public function user_single_blog(Request $request, $id)
    {
        $blog = $request->auth->Blogs->firstWhere('id', $id);
        if ($blog) {
            return response()->json([
                'status' => 'success',
                'message' => 'Single blog post found',
                'data' => $blog
            ], 200);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Single blog post not found'
            ], 404);
        }
    }

    public function create_blog_post(Request $request)
    {
        $this->validate($request, [
            'post_content' => 'required'
        ]);
        $blog = new Blog;
        $blog->post_content = $request->post_content;
        $blog->user_id = $request->auth->id;
        $save = $blog->save();
        if ($save) {
            return response()->json([
                'status' => 'success',
                'message' => 'Blog post created successfully'
            ], 200);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to create blog post'
            ], 400);
        }
    }

    public function update_blog_post(Request $request, $id)
    {
        $this->validate($request, [
            'post_content' => 'required'
        ]);
        $blog = $request->auth->Blogs->firstWhere('id', $id);
        if (!$blog) {
            return response()->json([
                'status' => 'error',
                'message' => 'Blog post not found'
            ], 404);
        }
        $blog->post_content = $request->post_content;
        $save = $blog->save();
        if ($save) {
            return response()->json([
                'status' => 'success',
                'message' => 'Blog post updated successfully'
            ], 200);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to update blog post'
            ], 400);
        }
    }

    public function delete_blog_post(Request $request, $id)
    {
        $blog = $request->auth->Blogs->firstWhere('id', $id);
        if (!$blog) {
            return response()->json([
                'status' => 'error',
                'message' => 'Blog post mot found'
            ], 404);
        }
        if ($blog->delete()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Blog post deleted successfully'
            ], 200);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to delete blog post'
            ], 400);
        }
    }
}

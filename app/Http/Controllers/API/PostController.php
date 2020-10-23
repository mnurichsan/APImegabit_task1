<?php

namespace App\Http\Controllers\API;

use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Validator;

class PostController extends Controller
{
    public function index()
    {
        $post = Post::with('user')->get();

        return response()->json([
            'data' => $post
        ], 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        } else {
            $post = [
                'title' => $request->title,
                'slug' => Str::slug($request->title),
                'description' => $request->description,
                'id_user' => Auth::user()->id
            ];
            $create = Post::create($post);

            if ($create) {
                return response()->json(['success' => true], 200);
            } else {
                return response()->json(['error' => false], 401);
            }
        }
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required'
        ]);

        $postid = Post::findOrFail($id);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        } else {

            if (Gate::allows('isMember', $postid) || Gate::allows('IsAdmin', $postid)) {
                $post = [
                    'title' => $request->title,
                    'slug' => Str::slug($request->title),
                    'description' => $request->description
                ];

                $update = $postid->update($post);

                if ($update) {
                    return response()->json(
                        [
                            'success' => true,
                            'data' => 'data berhasil di update'
                        ],
                        200
                    );
                } else {
                    return response()->json(['error' => false], 401);
                }
            } else {
                return response()->json(['error' => 'anda tidak memiliki akses'], 401);
            }
        }
    }

    public function destroy($id)
    {
        $postid = Post::findOrFail($id);

        if (Gate::allows('isMember', $postid) || Gate::allows('IsAdmin', $postid)) {
            $delete = $postid->delete();
            if ($delete) {
                return response()->json([
                    'success' => true,
                    'data' => 'data berhasil di delete'
                ], 200);
            } else {
                return response()->json(['error' => false], 401);
            }
        } else {
            return response()->json(['error' => 'anda tidak memiliki akses'], 401);
        }
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Http\Resources\PostCollection;
use Str;
use Carbon;
use Exception;


class PostController extends Controller
{
    public function index()
    {
        return response()->json([
            "message" => "success",
            "posts" => Post::orderBy('created_at', 'Desc')->get(),
        ], 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'caption' => 'string',
            'location' => 'string',
            'photo' => 'required|string'
        ]);

        $image = $request->photo;  // your base64 encoded
        $image = str_replace('data:image/png;base64,', '', $image);
        $image = str_replace(' ', '+', $image);
        $imageName = Str::random(5).'.'.'png';

        \File::put(public_path('storage'). '/' . $imageName, base64_decode($image));

        $p = Post::create([
            'caption' => $request->caption,
            'location' => $request->location,
            'photo' => $imageName,
        ]);

        return response()->json([
            "message" => "success"
        ], 201);
    }
}

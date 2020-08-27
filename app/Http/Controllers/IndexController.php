<?php

namespace App\Http\Controllers;

use App\Banner;
use App\Foto;
use App\Post;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        $banners = Banner::where('ativo',true)->orderBy('ordem')->get();
        $posts = Post::where('ativo',true)->orderBy('created_at', 'desc')->get();
        $fotos = Foto::where('ativo',true)->orderBy('created_at', 'desc')->get();
        return view('welcome',compact('banners','posts','fotos'));
    }
}

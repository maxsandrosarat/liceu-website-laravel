<?php

namespace App\Http\Controllers;

use App\Banner;
use App\Foto;
use App\Outro;
use App\Post;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(){
        return view('admin.home_admin');
    }

    //OUTROS(COLABORADOR)
    public function indexOutros()
    {
        $outros = Outro::orderBy('name')->paginate(10);
        $view = "inicial";
        return view('admin.outros', compact('view','outros'));
    }
    
    public function novoOutro(Request $request)
    {
        $outro = new Outro();
        $outro->name = $request->input('name');
        $outro->email = $request->input('email');
        $outro->password = Hash::make($request->input('password'));
        $outro->save();
        return back();
    }
    
    public function filtroOutros(Request $request)
    {
        $nome = $request->input('nome');
        if(isset($nome)){
            $outros = Outro::where('ativo',true)->where('name','like',"%$nome%")->orderBy('name')->paginate(10);
        } else {
            return back();
        }
        $view = "filtro";
        return view('outros.outros', compact('view','outros'));
    }
    
    public function editarOutro(Request $request, $id)
    {
        $outro = Outro::find($id);
        if(isset($outro)){
            $outro->name =$request->input('name');
            $outro->email =$request->input('email');
            if($request->input('password')!=""){
            $outro->password = Hash::make($request->input('password'));
            }
            $outro->save();
        }
        return back();
    }
    
    public function apagarOutro($id)
    {
        $outro = Outro::find($id);
        if(isset($outro)){
            $outro->ativo = false;
            $outro->save();
        }
        return back();
    }
    
    //BANNER
    public function indexBanners()
    {
        $banners = Banner::all();
        return view('admin.banners',compact('banners'));
    }

    public function novoBanner(Request $request)
    {
        $banner = new Banner();
        if($request->file('foto')!=""){
            $path = $request->file('foto')->store('fotos','public');
            $banner->foto = $path;
        }
        if($request->input('titulo')!=""){
            $banner->titulo = $request->input('titulo');
        }
        if($request->input('descricao')!=""){
            $banner->descricao = $request->input('descricao');
        }
        if($request->input('ordem')!=""){
            $banner->ordem = $request->input('ordem');
        }
        if($request->input('ativo')!=""){
            $banner->ativo = $request->input('ativo');
        }
        $banner->save();
        return back();
    }

    public function editarBanner(Request $request, $id)
    {
        $banner = Banner::find($id);
        if(isset($banner)){
            if($request->file('foto')!=""){
                Storage::disk('public')->delete($banner->foto);
                $path = $request->file('foto')->store('fotos','public');
                $banner->foto = $path;
            }
            if($request->input('titulo')!=""){
                $banner->titulo = $request->input('titulo');
            }
            if($request->input('descricao')!=""){
                $banner->descricao = $request->input('descricao');
            }
            if($request->input('ordem')!=""){
                $banner->ordem = $request->input('ordem');
            }
            if($request->input('ativo')!=""){
                $banner->ativo = $request->input('ativo');
            }
            $banner->save();
        }
        return back();
    }

    public function apagarBanner($id)
    {
        $banner = Banner::find($id);
        if(isset($banner)){
            Storage::disk('public')->delete($banner->foto);
            $banner->delete();
        }
        return back();
    }

    //POST
    public function indexPosts()
    {
        $posts = Post::all();
        return view('admin.posts',compact('posts'));
    }

    public function novoPost(Request $request)
    {
        $post = new Post();
        if($request->file('foto')!=""){
            $path = $request->file('foto')->store('fotos','public');
            $post->foto = $path;
        }
        if($request->input('data')!=""){
            $post->data = $request->input('data');
        }
        if($request->input('titulo')!=""){
            $post->titulo = $request->input('titulo');
        }
        if($request->input('descricao')!=""){
            $post->descricao = $request->input('descricao');
        }
        if($request->input('ativo')!=""){
            $post->ativo = $request->input('ativo');
        }
        $post->save();
        return back();
    }

    public function editarPost(Request $request, $id)
    {
        $post = Post::find($id);
        if(isset($post)){
            if($request->file('foto')!=""){
                Storage::disk('public')->delete($post->foto);
                $path = $request->file('foto')->store('fotos','public');
                $post->foto = $path;
            }
            if($request->input('data')!=""){
                $post->data = $request->input('data');
            }
            if($request->input('titulo')!=""){
                $post->titulo = $request->input('titulo');
            }
            if($request->input('descricao')!=""){
                $post->descricao = $request->input('descricao');
            }
            if($request->input('ativo')!=""){
                $post->ativo = $request->input('ativo');
            }
            $post->save();
        }
        return back();
    }

    public function apagarPost($id)
    {
        $post = Post::find($id);
        if(isset($post)){
            Storage::disk('public')->delete($post->foto);
            $post->delete();
        }
        return back();
    }

    //FOTOS
    public function indexFotos()
    {
        $fotos = Foto::all();
        return view('admin.fotos',compact('fotos'));
    }

    public function novaFoto(Request $request)
    {
        $foto = new Foto();
        if($request->file('foto')!=""){
            $path = $request->file('foto')->store('fotos','public');
            $foto->foto = $path;
        }
        if($request->input('titulo')!=""){
            $foto->titulo = $request->input('titulo');
        }
        if($request->input('ativo')!=""){
            $foto->ativo = $request->input('ativo');
        }
        $foto->save();
        return back();
    }

    public function editarFoto(Request $request, $id)
    {
        $foto = Foto::find($id);
        if(isset($foto)){
            if($request->file('foto')!=""){
                Storage::disk('public')->delete($foto->foto);
                $path = $request->file('foto')->store('fotos','public');
                $foto->foto = $path;
            }
            if($request->input('titulo')!=""){
                $foto->titulo = $request->input('titulo');
            }
            if($request->input('ativo')!=""){
                $foto->ativo = $request->input('ativo');
            }
            $foto->save();
        }
        return back();
    }

    public function apagarFoto($id)
    {
        $foto = Foto::find($id);
        if(isset($foto)){
            Storage::disk('public')->delete($foto->foto);
            $foto->delete();
        }
        return back();
    }

    public function indexClientes()
    {
        $clientes = User::paginate(20);
        return view('admin.clientes',compact('clientes'));
    }

    public function filtroCliente(Request $request)
    {
        $nome = $request->input('nome');
        $email = $request->input('email');
        if(isset($nome)){
            if(isset($email)){
                $clientes = User::where('name','like',"%$nome%")->where('email','like',"%$email%")->paginate(100);
            } else {
                $clientes = User::where('name','like',"%$nome%")->paginate(100);
            }
        } else {
            if(isset($email)){
                $clientes = User::where('email','like',"%$email%")->paginate(100);
            } else {
                return redirect('/admin/clientes');
            }
        }
        
        return view('admin.clientes',compact('clientes'));
    }
}

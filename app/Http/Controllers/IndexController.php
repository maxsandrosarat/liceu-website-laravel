<?php

namespace App\Http\Controllers;

use App\Album;
use App\Anuncio;
use App\Banner;
use App\Foto;
use App\Post;
use Illuminate\Http\Request;
use App\Produto;
use App\Categoria;
use App\FotosAlbum;

class IndexController extends Controller
{
    public function index()
    {
        $banners = Banner::where('ativo',true)->orderBy('ordem')->get();
        $posts = Post::where('ativo',true)->orderBy('created_at', 'desc')->get();
        return view('welcome',compact('banners','posts'));
    }

    public function promocoes()
    {
        $view = "inicial";
        $prods = Produto::where('ativo',true)->where('estoque','>=',1)->where('promocao',true)->paginate(12);
        $cats = Categoria::where('ativo',true)->orderBy('nome')->get();
        $turmas = Produto::select('turma')->distinct()->get();
        $anuncios = Anuncio::where('ativo',true)->get();
        return view('promocoes',compact('view','prods','cats','turmas','anuncios'));
    }

    public function produtos()
    {
        $view = "inicial";
        $prods = Produto::where('ativo',true)->where('estoque','>=',1)->paginate(12);
        $cats = Categoria::where('ativo',true)->orderBy('nome')->get();
        $turmas = Produto::select('turma')->distinct()->get();
        $anuncios = Anuncio::where('ativo',true)->get();
        return view('produtos',compact('view','prods','cats','turmas','anuncios'));
    }

    public function buscar(Request $request)
    {
        $nome = $request->input('nome');
        $cat = $request->input('categoria');
        $turma = $request->input('turma');
        if(isset($nome)){
            if(isset($cat)){
                if(isset($turma)){
                    $prods = Produto::where('ativo',true)->where('estoque','>=',1)->where('nome','like',"%$nome%")->where('categoria_id',"$cat")->where('turma',"$turma")->orderBy('nome')->paginate(12);
                } else {
                    $prods = Produto::where('ativo',true)->where('estoque','>=',1)->where('nome','like',"%$nome%")->where('categoria_id',"$cat")->orderBy('nome')->paginate(12);
                }
            } else {
                if(isset($turma)){
                    $prods = Produto::where('ativo',true)->where('estoque','>=',1)->where('nome','like',"%$nome%")->where('turma',"$turma")->paginate(12);
                } else {
                    $prods = Produto::where('ativo',true)->where('estoque','>=',1)->where('nome','like',"%$nome%")->orderBy('nome')->paginate(12);
                }
            }
        } else {
            if(isset($cat)){
                if(isset($turma)){
                    $prods = Produto::where('ativo',true)->where('estoque','>=',1)->where('categoria_id',"$cat")->where('turma',"$turma")->orderBy('nome')->paginate(12);
                } else {
                    $prods = Produto::where('ativo',true)->where('estoque','>=',1)->where('categoria_id',"$cat")->orderBy('nome')->paginate(12);
                }
            } else {
                if(isset($turma)){
                    $prods = Produto::where('ativo',true)->where('estoque','>=',1)->where('turma',"$turma")->orderBy('nome')->paginate(12);
                } else {
                    $prods = Produto::where('ativo',true)->where('estoque','>=',1)->orderBy('nome')->paginate(12);
                } 
            }
        }
                
        $view = "filtro";
        $turmas = Produto::select('turma')->distinct()->get();
        $cats = Categoria::where('ativo',true)->orderBy('nome')->get();
        return view('produtos',compact('view','prods','turmas','cats'));
    }

    public function album($id)
    {
        $album = Album::find($id);
        $album->total_visualizacao ++;
        $album->save();
        return view('fotos_albuns',compact('album'));
    }

    public function albumFotos(Request $request)
    {
        $id = $request->input('id');
        return FotosAlbum::where('album_id',"$id")->orderBy('created_at','desc')->get();
    }

    public function gosteiAlbum(Request $request)
    {
        $album = Album::find($request->input('id'));
        $album->total_gostei ++;
        $album->save();
    }

    public function naoGosteiAlbum(Request $request)
    {
        $album = Album::find($request->input('id'));
        $album->total_naogostei ++;
        $album->save();
    }

    public function albuns()
    {
        return Album::where('ativo',true)->orderBy('created_at', 'desc')->get();
    }

    public function gosteiFoto(Request $request)
    {
        $foto = FotosAlbum::find($request->input('id'));
        $foto->total_gostei ++;
        $foto->save();
    }

    public function naoGosteiFoto(Request $request)
    {
        $foto = FotosAlbum::find($request->input('id'));
        $foto->total_naogostei ++;
        $foto->save();
    }

}

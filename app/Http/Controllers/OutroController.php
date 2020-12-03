<?php

namespace App\Http\Controllers;

use App\Album;
use App\Banner;
use App\CompraLivro;
use App\Foto;
use App\FotosAlbum;
use App\Post;
use PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OutroController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:outro');
    }

    public function index(){
        return view('outro.home_outro');
    }

    public function indexBanners()
    {
        $banners = Banner::all();
        return view('outro.banners',compact('banners'));
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
        $ordem = $banner->ordem;
        if(isset($banner)){
            Storage::disk('public')->delete($banner->foto);
            $banner->delete();
        }
        $banners = Banner::where('ordem','>',"$ordem")->get();
        foreach ($banners as $banner) {
            $ban = Banner::find($banner->id);
            $ban->ordem -= 1;
            $ban->save();
        }
        return back();
    }

    public function indexPosts()
    {
        $posts = Post::all();
        return view('outro.posts',compact('posts'));
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

    public function indexFotos()
    {
        $fotos = Foto::all();
        return view('outro.fotos',compact('fotos'));
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

    //ALBUNS
    public function indexAlbuns()
    {
        $albuns = Album::all();
        foreach ($albuns as $album) {
            $fotos = FotosAlbum::where('album_id',"$album->id")->count();
            if($fotos>0){
                $foto = FotosAlbum::where('album_id',"$album->id")->first();
                $album = Album::find($album->id);
                $album->foto_capa = $foto->foto;
                $album->qtd_fotos = $fotos;
                $album->save();
            } else{
                $album = Album::find($album->id);
                $album->foto_capa = "";
                $album->qtd_fotos = $fotos;
                $album->save();
            }
        }
        $albuns = Album::orderBy('created_at','desc')->get();
        return view('outro.albuns',compact('albuns'));
    }

    public function novoAlbum(Request $request)
    {
        $album = new Album();
        if($request->file('capa')!=""){
            $path = $request->file('capa')->store('capas_albuns','public');
            $album->foto_capa = $path;
        }
        if($request->input('titulo')!=""){
            $album->titulo = $request->input('titulo');
        }
        if($request->input('descricao')!=""){
            $album->descricao = $request->input('descricao');
        }
        $album->save();
        return back();
    }

    public function adicionarAlbum($id)
    {
        $album = Album::find($id);
        $fotos = FotosAlbum::where('album_id',"$id")->orderBy('created_at','desc')->get();
        return view('outro.fotos_albuns',compact('album','fotos'));
    }

    public function editarAlbum(Request $request, $id)
    {
        $album = Album::find($id);
        if(isset($album)){
            if($request->file('capa')!=""){
                Storage::disk('public')->delete($album->foto_capa);
                $path = $request->file('capa')->store('capas_albuns','public');
                $album->foto_capa = $path;
            }
            if($request->input('titulo')!=""){
                $album->titulo = $request->input('titulo');
            }
            if($request->input('descricao')!=""){
                $album->descricao = $request->input('descricao');
            }
            if($request->input('ativo')!=""){
                $album->ativo = $request->input('ativo');
            }
            $album->save();
        }
        return back();
    }

    public function apagarAlbum($id)
    {
        $album = Album::find($id);
        if(isset($album)){
            $fotos = FotosAlbum::where('album_id',"$id")->get();
            foreach ($fotos as $foto) {
                $fotoAlbum = FotosAlbum::find($foto->id);
                if(isset($fotoAlbum)){
                    $fotoAlbum->delete();
                }
            }
            Storage::disk('public')->delete($album->foto_capa);
            $album->delete();
        }
        return back();
    }

    public function novaFotoAlbum(Request $request)
    {
        $foto = new FotosAlbum();
        if($request->file('foto')!=""){
            $path = $request->file('foto')->store('fotos_albuns','public');
            $foto->foto = $path;
        }
        if($request->input('descricao')!=""){
            $foto->descricao = $request->input('descricao');
        }
        $foto->album_id = $request->input('album');
        $foto->save();
        return back();
    }

    public function editarFotoAlbum(Request $request)
    {
        $foto = FotosAlbum::find($request->input('id'));
        if(isset($foto)){
            if($request->input('descricao')!=""){
                $foto->descricao = $request->input('descricao');
            }
            $foto->save();
        }
        return back();
    }

    public function novasFotos(Request $request)
    {
        foreach ($request->allFiles()['fotos'] as $photo) {
            $foto = new FotosAlbum();
            $path = $photo->store('fotos','public');
            $foto->foto = $path;
            $foto->album_id = $request->input('album');
            $foto->save();
        }
        
        return back();
    }

    public function apagarFotoAlbum($id)
    {
        $foto = FotosAlbum::find($id);
        if(isset($foto)){
            Storage::disk('public')->delete($foto->foto);
            $foto->delete();
        }
        return back();
    }

    public function indexCompraLivros()
    {
        $recibos = CompraLivro::orderBy('created_at','desc')->paginate(10);
        $view = "inicial";
        $series = DB::table('compra_livros')->select(DB::raw("serie"))->groupBy('serie')->get();
        $turmas = DB::table('compra_livros')->select(DB::raw("turma"))->groupBy('turma')->get();
        return view('outro.compra_livros',compact('view','series','turmas','recibos'));
    }

    public function novaCompraLivro(Request $request)
    {
        $recibo = new CompraLivro();
        $recibo->nomeAluno = $request->input('nomeAluno');
        $recibo->serie = $request->input('serie');
        $recibo->turma = $request->input('turma');
        $recibo->ensino = $request->input('ensino');
        $recibo->nomeResp = $request->input('nomeResp');
        $recibo->cpf = $request->input('cpf');
        $recibo->valor = $request->input('valor');
        $recibo->formaPagamento = $request->input('formaPagamento');
        $recibo->user = Auth::user()->name;
        $recibo->save();
        return back();
    }

    public function gerarRecibo($id)
    {
        $recibo = CompraLivro::find($id);
        $pdf = PDF::loadView('outro.recibo_compralivro_pdf', compact('recibo'));
        return $pdf->setPaper('a4')->stream('Recibo '.$recibo->nomeAluno.'.pdf');
    }

    public function filtroCompraLivro(Request $request)
    {
        $nome = $request->input('nome');
        $serie = $request->input('serie');
        $turma = $request->input('turma');
        if(isset($nome)){
            if(isset($serie)){
                if(isset($turma)){
                    $recibos = CompraLivro::where('nomeAluno','like',"%$nome%")->where('serie',"$serie")->where('turma',"$turma")->orderBy('nomeAluno')->paginate(50);
                } else {
                    $recibos = CompraLivro::where('nomeAluno','like',"%$nome%")->where('serie',"$serie")->orderBy('nomeAluno')->paginate(50);
                }
            } else {
                if(isset($turma)){
                    $recibos = CompraLivro::where('nomeAluno','like',"%$nome%")->where('turma',"$turma")->orderBy('nomeAluno')->paginate(50);
                } else {
                    $recibos = CompraLivro::where('nomeAluno','like',"%$nome%")->orderBy('nomeAluno')->paginate(50);
                }
            }
        } else {
            if(isset($serie)){
                if(isset($turma)){
                    $recibos = CompraLivro::where('serie',"$serie")->where('turma',"$turma")->orderBy('nomeAluno')->paginate(50);
                } else {
                    $recibos = CompraLivro::where('serie',"$serie")->orderBy('nomeAluno')->paginate(50);
                }
            } else {
                if(isset($turma)){
                    $recibos = CompraLivro::where('turma',"$turma")->orderBy('nomeAluno')->paginate(50);
                } else {
                    return redirect('/outro/compraLivro');
                }
            }
        }
        $series = DB::table('compra_livros')->select(DB::raw("serie"))->groupBy('serie')->get();
        $turmas = DB::table('compra_livros')->select(DB::raw("turma"))->groupBy('turma')->get();
        $view = "filtro";
        return view('outro.compra_livros', compact('view','series','turmas','recibos'));
    }
}

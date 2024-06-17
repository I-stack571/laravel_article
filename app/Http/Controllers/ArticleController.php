<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::with(['likes'])->orderBy('created_at', 'desc')->paginate(10);
        // dd($articles);
        $data = ['articles' => $articles];
        return view('articles.index', $data);
    }

    public function create()
    {
        $article = new Article();
        $data = ['article' => $article];
        return view('articles.create', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'body' => 'required'
        ]);
        $article = new Article();
        $article->user_id = Auth::id(); // 一行追加
        $article->title = $request->title;
        $article->body = $request->body;
        $article->save();

        return redirect(route('articles.index'));
    }

    public function show(Article $article)
    {
        $data = ['article' => $article];
        return view('articles.show', $data);
        //
    }

    public function edit($id)
    {
        $article = Article::where('id', $id)->first();
        return view('articles.edit', compact('article'));
    }

    public function update(Request $request, Article $article)
    {
        $request->validate([
            'title' => 'required|max:255',
            'body' => 'required',
        ]);

        $target = Article::where('id', $request->id)->first();
        $target->title = $request->title ?? null;
        $target->body = $request->body ?? null;
        $target->save();

        return redirect()->route('articles.index')->with('success', '記事が更新されました');
    }

 
    public function destroy($id)
    {
        $item = Article::findOrFail($id);
        $item->delete();

        return redirect()->route('articles.index')->with('success', 'アイテムが削除されました');
    }
}
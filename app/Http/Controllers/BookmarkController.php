<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class BookmarkController extends Controller
{
    public function index()
    {
        $user = Auth::user(); // 認証されたユーザーを取得
        $articles = $user->bookmark_articles()->get(); // ユーザーがブックマークした記事を取得

        return view('bookmarks.index', ['articles' => $articles]); // ビューにデータを渡す
    }

    // ブックマークの登録
    public function store($articleId)
    {
        $user = Auth::user();
        if (!$user->is_bookmark($articleId)) {
            $user->bookmark_articles()->attach($articleId);
        }
        return back(); // 前のページに戻る
    }

    // ブックマークの削除
    public function destroy($articleId)
    {
        $user = Auth::user();
        if ($user->is_bookmark($articleId)) {
            $user->bookmark_articles()->detach($articleId);
        }
        return back(); // 前のページに戻る
    }
}

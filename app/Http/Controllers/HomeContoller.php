<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article; // 追記
use Illuminate\Support\Facades\Auth;
class HomeController extends Controller

{
    public function index()
    {
        // 自分の記事一覧を投稿日降順で取得
        $user = Auth::user();
        $articles = $user->articles->orderBy('created_at', 'desc')->paginate(10);        
        $data = [
            'articles' => $articles,
        ];
        return view('home', $data);
    }
}
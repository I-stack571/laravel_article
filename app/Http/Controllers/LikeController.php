<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\Article;

class LikeController extends Controller
{
    //
    public function store(Request $request, Article $article)
    {
        $article->likes()->syncWithoutDetaching(auth()->id());
        return back();
    }

    public function destroy(Article $article)
    {
        $article->likes()->detach(auth()->id());
        return back();
    }

}

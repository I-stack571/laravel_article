@extends('layouts.app')
@section('content')
<p><a href="{{ route('articles.create') }}">記事を書く</a></p>
@foreach ($articles as $article)
    <article class="article-item">
        <div class="article-title">
            <a href="{{ route('articles.show', $article) }}">{{ $article->title }}</a>
        </div>
        <div>{{ $article->body }}</div>
        <div class="article-info">{{ $article->created_at }}</div>
        <a href="{{ route('articles.edit', $article->id) }}">更新</a>
        <form action="{{ route('articles.destroy', $article->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" onclick="return confirm('本当に削除しますか？')">削除</button>
        </form>

    </article>
</article>
@endforeach
@endsection
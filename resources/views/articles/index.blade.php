@extends('layouts.app')
@section('content')
<p><a href="{{ route('articles.create') }}">記事を書く</a></p>
<!-- @foreach ($articles as $article)
<article class="article-item">
    <div class="article-title">{{ $article->title }}</div>
    <div class="article-body">{{ $article->body }}</div> -->
    @foreach ($articles as $article)
<article class="article-item">
    <div class="article-title">
        <a href="{{ route('articles.show', $article) }}">{{ $article->title }}</a>
    </div>
    <div>{{ $article->body }}</div>
    <div class="article-info">{{ $article->created_at }}</div>
</article>
@endforeach
</article>
@endforeach
@endsection()
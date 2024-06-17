@foreach ($articles as $article)
<article class="article-item">
    <div class="article-title"><a href="{{ route('articles.show', $article) }}">{{ $article->title }}</a></div>
    {{$article->body}}
    <a class="btn btn-success" href="{{ route('articles.edit', $article->id) }}" style="margin-right: 10px;">編集</a>
    <!-- 削除フォーム -->
    <form action="{{ route('articles.destroy', $article->id) }}" method="POST" style="display: inline;">
    @csrf
    @method('DELETE')
        <button class="btn btn-danger" type="submit" onclick="return confirm('Are you sure?')">削除</button>
    </form>
    <!-- いいね追加フォーム -->
    @if(auth()->user() && !$article->likes->contains(auth()->user()->id))
            <form action="{{ route('articles.likes.store', $article) }}" method="POST">
                @csrf
                <button type="submit">    
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16">
                        <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z"/>
                    </svg>
                </button>
                {{ $article->likes->count() }}
            </form>
        @endif  
        <!-- いいね取り消しフォーム -->
        @if(auth()->user() && $article->likes->contains(auth()->user()->id))
            <form action="{{ route('articles.likes.destroy', $article) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart-fill" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z"/>
                    </svg>
                </button>
                {{ $article->likes->count() }}
            </form>
        @endif
    <div class="article-info">
        {{ $article->created_at }}｜{{ $article->user->name }}
    </div>
</article>
@endforeach
{{ $articles->links() }}
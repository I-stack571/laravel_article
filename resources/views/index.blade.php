<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Bookmarked Articles</title>
</head>
<body>
    <h1>Bookmarked Articles</h1>
    <ul>
        @foreach ($articles as $article)
            <li>
                {{ $article->title }} - {{ $article->created_at->toFormattedDateString() }}
                <!-- 更新リンク -->
                <a href="{{ route('articles.edit', $article->id) }}" style="margin-right: 10px;">編集</a>
                <!-- 削除フォーム -->
                <form action="{{ route('articles.destroy', $article->id) }}" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Are you sure?')">削除</button>
                </form>
            </li>
        @endforeach
    </ul>
</body>
</html>

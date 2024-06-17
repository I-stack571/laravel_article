@csrf
<dl class="form-list">
    <dt>タイトル</dt>
    <dd><input type="text" name="title" value="{{ $article->title }}"></dd>
    <dt>本文</dt>
    <dd><textarea name="body" rows="30" cols="150">{{ $article->body }}</textarea></dd>
    <input type="hidden" name='id' value='{{$article->id}}'>
</dl>

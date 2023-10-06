<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>Liveコメント</title>
        <!-- Fonts -->
      
        <link rel=“stylesheet” href=“{{ asset(‘/css/li.css’)  }}” >
    </head>
    <body>
        <h1>Liveコメントタイムライン</h1>
        <div>
      <form action="/" method="GET">
          @csrf
        <input type="text" name="keyword" value="{{ $keyword }}">
        <input type="submit" value="検索">
      </form>
      
        </div>
        <a href='/posts/create'>Liveコメント投稿画面</a>
        <div class='posts'>
            @foreach ($posts as $post)
            <div class='post'>
                <h2 class='artist_name'><a href="/posts/{{ $post->id }}">{{ $post->artist_name }}</h2>
                <p class='venue'>{{ $post->venue }}</p>
            </div>
            @endforeach
        </div>
        <div class='paginate'>
            {{ $posts->links() }}
        </div>
    </body>
</html>
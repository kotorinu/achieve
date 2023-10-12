<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>Liveコメント</title>
        <!-- Fonts -->
      
       <link rel="stylesheet" href='/css/index.css' >
    </head>
    <body>
        <h1>Liveコメントタイムライン</h1>
        <div>
      <form action="/" method="GET">
          @csrf
        <input type="text" name="keyword" value="{{ $keyword }}" placeholder="キーワードを入力">
        <input type="submit" value="検索">
      </form>
      
        </div>
        <a href='/posts/create'>Liveコメント投稿画面</a>
        <div class='posts'>
            @foreach ($posts as $post)
            <div class='post'>
                <p class='artist_name'>アーティスト名：{{ $post->artist_name }}</p>
                <p class='venue'>会場名：{{ $post->venue }}</p>
                <p class='theday'>日付：{{ $post->theday }}</p>
                <p class='seat'>座席：{{ $post->seat }}</p>
                <p class='stage_distance'>自分の座席位置からどのステージ（トロッコなど）が近いか：{{ $post->stage_distance }}<a href="/posts/{{ $post->id }}">...</a></p>
                
              
            </div>
            @endforeach
        </div>
        <div class='paginate'>
            {{ $posts->links() }}
        </div>
       <script src='/js/index.js'></script>
      
    </body>
</html>
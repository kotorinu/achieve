<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>詳細画面</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    </head>
    <body>
        <h1>詳細画面</h1>
        <h2 class="artist_name">
           アーティスト名：{{ $post->artist_name }}
        </h2>
         <h2 class="venue">
          会場名：{{ $post->venue }}
        </h2>
        <h2 class="theday">
          日付：{{ $post->theday }}
        </h2>
         <h2 class="seat">
          座席位置：{{ $post->seat }}
        </h2>
        <h2 class="stage_distancee">
           自分の座席位置からどのステージ（トロッコなど）が近いか：{{ $post->stage_distance}}
        </h2>
         <h2 class="others">
          その他もしくは無いステージ：{{ $post->others}}
        </h2>
        <h2 class="fan_service">
          ファンサ：{{ $post->fan_service}}
        </h2>
         <h2 class="seat">
          落下物：{{ $post->seat }}
        </h2>
        <h2 class="visible">
          肉眼で目が見えたか：{{ $post->visible }}
        </h2>
         <h2 class="seat">
          ライブでの感想やこのライブを見る人へのアドバイス：{{ $post->seat }}
        </h2>
        <div class="edit">
            <a href="/posts/{{$post->id}}/edit">編集</a>
        </div>
            
        <form action="/posts/{{ $post->id }}" id="form_{{ $post->id }}" method="post">
        @csrf
        @method('DELETE')
        <button type="button" onclick="deletePost({{ $post->id }})">削除</button> 
        </form>
        
        <div class="footer">
            <a href="/">戻る</a>
        </div>
          <script>
            function deletePost(id) {
                'use strict'
        
                if (confirm('削除すると復元できません。\n本当に削除しますか？')) {
                    document.getElementById(`form_${id}`).submit();
                }
            }
        </script>
    </body>
</html>
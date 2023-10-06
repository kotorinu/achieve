<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>投稿画面</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    </head>
    <body>
        <h1>Liveコメント投稿作成画面</h1>
        <form action="/posts" method="POST">
            @csrf
            <div class="artist_name">
                <h2>アーティスト名</h2>
                <input type="text" name="post[artist_name]" placeholder="すとぷり"/>
                 <p class="title__error" style="color:red">{{ $errors->first('post.artist_name') }}</p>
            </div>
            
            <div class="venue">
                <h2>会場名</h2>
                <input type="text" name="post[venue]" placeholder="エコパアリーナ"/>
                 <p class="title__error" style="color:red">{{ $errors->first('post.venue') }}</p>
            </div>
            <div class="theday">
                <h2>日付</h2>
                <input type="text" name="post[theday]" placeholder="2019/08/18"/>
                 <p class="title__error" style="color:red">{{ $errors->first('post.theday') }}</p>
            </div>
             <div class="seat">
                <h2>座席位置</h2>
                <input type="text" name="post[seat]" placeholder="アリーナ20列 16番 "/>
                 <p class="title__error" style="color:red">{{ $errors->first('post.seat') }}</p>
            </div>
            <div class="stage_distance">
                <h2>自分の座席位置からどのステージ（トロッコなど）が近いか</h2>
                <input type="text" name="post[stage_distance]" placeholder="バックステージ　外周トロッコ"/>
                 <p class="title__error" style="color:red">{{ $errors->first('post.stage_distance') }}</p>
            </div>
            <div class="others">
                <h2>その他もしくは無いステージ</h2>
                <textarea name="post[others]" placeholder="メインステージとセンターステージの埋もれ席　トロッコなし"></textarea>
                 <p class="title__error" style="color:red">{{ $errors->first('post.others') }}</p>
            </div>
             <div class="fan_service">
                <h2>ファンサ</h2>
                <input type="text" name="post[fan_service]" placeholder="ありorなし"/>
                 <p class="title__error" style="color:red">{{ $errors->first('post.fan_service') }}</p>
            </div>
            <div class="falling_objects">
                <h2>落下物</h2>
                <input type="text" name="post[falling_objects]" placeholder="ありorなし"/>
                 <p class="title__error" style="color:red">{{ $errors->first('post.falling_objects') }}</p>
            </div>
             <div class="visible">
                <h2>肉眼で目が見えたか</h2>
                <input type="text" name="post[visible]" placeholder="見えたor見えなかった"/>
                 <p class="title__error" style="color:red">{{ $errors->first('post.visible') }}</p>
            </div>
            <div class="comment">
                <h2>ライブの感想やこのライブを見る人へのアドバイス</h2>
                <textarea name="post[comment]" placeholder="○○の曲名でばっきゅんのファンサを○○からもらえた❣　ファンサもらえる可能性が高いからファンサうちわ絶対作っていって！双眼鏡使ったらメンバーの顔細部まで堪能できるぞ"></textarea>
                 <p class="title__error" style="color:red">{{ $errors->first('post.comment') }}</p>
            </div>
            <input type="submit" value="投稿"/>
        </form>
        <div class="footer">
            <a href="/">戻る</a>
        </div>
    </body>
</html>
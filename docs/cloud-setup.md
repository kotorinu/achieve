# どのPCからでも同じ状態で作業するための設定

このプロジェクトのデータは、置き場所が3つに分かれています。

| データ | 置き場所 | 同期のしかた |
| --- | --- | --- |
| ソースコード | GitHub | `git pull` / `git push` |
| 投稿データ（DB） | クラウドのMySQL | 自動（どのPCからも同じDBを見る） |
| アップロードファイル | S3互換ストレージ（使うときだけ） | 自動 |

> プロジェクトフォルダを Google Drive などの同期フォルダに置かないでください。
> `vendor/` の大量のファイルで同期が重くなり、競合でファイルが壊れることがあります。
> PCの中では C ドライブなど普通のフォルダに置き、同期は GitHub で行います。

---

## 方法A：GitHub Codespaces（PCに何も入れない）

PHP も MySQL もクラウドの中で動くので、ブラウザがあればどのPCでも作業できます。

1. GitHub のリポジトリページで **Code → Codespaces → Create codespace** を押す
2. 数分待つと VS Code が開き、自動で次のことが行われる
   - `.env` の作成（DB は Codespace の中の MySQL）
   - `composer install`、`php artisan key:generate`、`php artisan migrate`
   - `php artisan serve` の起動（ポート 8000 がブラウザで開く）
3. 作業が終わったら `git push` する

止めた Codespace は、次に開いたとき続きから使えます（DBの中身も残ります）。
ただし Codespace を**削除**すると、その中の MySQL のデータも消えます。
データをずっと残したいときは、次の「クラウドDB」と組み合わせてください。

### Codespaces でクラウドDBを使う

GitHub の **Settings → Codespaces → Secrets** に、このリポジトリ用として次を登録します。
登録した値は `.env` より優先されます。

- `DB_HOST` / `DB_PORT` / `DB_DATABASE` / `DB_USERNAME` / `DB_PASSWORD`
- SSL が必要なら `MYSQL_ATTR_SSL_CA` = `/etc/ssl/certs/ca-certificates.crt`

登録後に Codespace を作り直すと、クラウドDBにつながります。

---

## 方法B：自分のPC + クラウドDB

### 1. クラウドのMySQLを用意する（最初の1回だけ）

無料枠があるサービスの例：

- **TiDB Cloud Serverless**（MySQL互換、SSL必須）
- **Aiven for MySQL**（SSL必須）

どれも、作成するとダッシュボードに接続情報（ホスト・ポート・ユーザー名・パスワード）が出ます。
データベース名は自分で決めて作ってください（例：`achieve`）。

### 2. 各PCで `.env` を作る（PCごとに1回だけ）

`.env` はパスワードを含むので GitHub には上がりません。PCごとに作ります。

```bash
git clone https://github.com/kotorinu/achieve.git
cd achieve
cp .env.example .env        # Windows のコマンドプロンプトなら copy .env.example .env
composer install
php artisan key:generate
```

`.env` の DB 部分を、クラウドDBの接続情報に書き換えます。

```dotenv
DB_CONNECTION=mysql
DB_HOST=（ダッシュボードに出ているホスト名）
DB_PORT=（ポート番号。TiDB Cloud なら 4000）
DB_DATABASE=achieve
DB_USERNAME=（ユーザー名）
DB_PASSWORD=（パスワード）
MYSQL_ATTR_SSL_CA=（CA証明書のパス）
```

`MYSQL_ATTR_SSL_CA` には、OSに入っている証明書のパスを書きます。

- Mac: `/etc/ssl/cert.pem`
- Windows: 証明書ファイルがOSに無いので、サービスの案内に従って `.pem` をダウンロードし、
  `"C:/certs/isrgrootx1.pem"` のように `/` 区切りで書く

### 3. テーブルを作る（全PCで最初の1回だけ）

```bash
php artisan migrate
```

2台目以降のPCでは、もうテーブルがあるので「Nothing to migrate」と出れば成功です。

### 4. ふだんの作業

```bash
git pull           # 作業を始める前
php artisan serve
# ...作業...
git add .
git commit -m "やったこと"
git push           # 作業が終わったら
```

投稿データはクラウドDBにあるので、どのPCで書いた投稿も全PCで見えます。

---

## アップロードファイル（画像など）をクラウドに置く

今のところ画像のアップロード機能はありませんが、付けたときは `.env` を次のようにすると
保存先がクラウドになり、全PCで共有されます（S3用のパッケージはインストール済みです）。

```dotenv
FILESYSTEM_DISK=s3
AWS_ACCESS_KEY_ID=...
AWS_SECRET_ACCESS_KEY=...
AWS_DEFAULT_REGION=auto
AWS_BUCKET=（バケット名）
AWS_ENDPOINT=（Cloudflare R2 などS3互換サービスのときだけ）
AWS_URL=（ファイルを公開するURL）
```

コードでは `Storage::put()` や `$request->file('image')->store('images')` を使えば、
`FILESYSTEM_DISK` の設定どおりの場所に保存されます。

---

## うまくいかないとき

- **`SQLSTATE[HY000] [2002]`**：`DB_HOST` か `DB_PORT` が違う。クラウドDB側で接続元IPの制限がかかっていないかも確認する
- **`Connections using insecure transport are prohibited`**：`MYSQL_ATTR_SSL_CA` が空か、パスが違う
- **Codespaces で保存後のページが開かない**：`.env` に `TRUSTED_PROXIES=*` があるか確認する

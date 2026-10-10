#!/usr/bin/env bash
# Codespaces / Dev Container を作成したときに1回だけ実行される初期設定
set -euo pipefail

cd "$(dirname "$0")/.."

# .env が無ければ作る。DB はコンテナ内の MySQL を使う
if [ ! -f .env ]; then
  cp .env.example .env
  sed -i \
    -e 's/^DB_HOST=.*/DB_HOST=mysql/' \
    -e 's/^DB_USERNAME=.*/DB_USERNAME=laravel/' \
    -e 's/^DB_PASSWORD=.*/DB_PASSWORD=password/' \
    -e 's/^TRUSTED_PROXIES=.*/TRUSTED_PROXIES=*/' \
    .env
fi

composer install --no-interaction

grep -q '^APP_KEY=base64:' .env || php artisan key:generate --ansi

# コンテナ内の MySQL を使うときは、起動を待ってからテーブルを作る
# （Codespaces のシークレットでクラウドDBを指定している場合は待たない）
DB_HOST_VALUE="${DB_HOST:-$(grep '^DB_HOST=' .env | cut -d= -f2)}"
for i in $(seq 1 30); do
  [ "$DB_HOST_VALUE" = "mysql" ] || break
  if php -r 'try { new PDO("mysql:host=mysql;port=3306", "laravel", "password"); exit(0); } catch (Exception $e) { exit(1); }'; then
    break
  fi
  echo "MySQL の起動待ち... ($i)"
  sleep 2
done

php artisan migrate --force

# Apache + PHP コンテナ生成 ＠2018/11/21

# Docker 公式イメージの PHP7.2.12 を用いる
FROM php:7.2.12-apache
#FROM php:5.6-apache

# 手元の php.ini をコンテナ内にコピー
COPY ./php.ini /usr/local/etc/php/

# RUN は、コマンドの実行
RUN apt-get update \
  && apt-get install -y libfreetype6-dev libjpeg62-turbo-dev libpq-dev \
  && docker-php-ext-install pdo pdo_pgsql pgsql gd
# GD と PgSQL 関係のライブラリをインストールする
# PHP のエクステンションをインストールする

# 外部公開ポートの設定
EXPOSE 80
# docker-compose.yml の ports: と組み合わせて公開ポートを設定する

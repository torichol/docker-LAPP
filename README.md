# docker-compose で LAPP 環境を構築する（未完成）  
  
## docker-compose を用いて PHP7.2.12 + PostgreSQL11.1 環境を構築するコンテナ群です（未完成）  
  
## 未完成！  
phpinfo() の表示と PHP ⇒ PostgreSQL の接続はできていますが、PostgreSQL の日本語環境での initdb が上手く行かず、データベースの言語環境は en_US.utf8 のままです...(-_-)。  
  
いろいろ解決次第、更新します。  
  
## 作成＆~~~確認~~~試行錯誤環境  
<dl>
  <dt>OS</dt>
  <dd>Windows 10 Pro</dd>
  <dt>Docker for Windows</dt>
  <dd>Version 2.0.0.0-win78(28905)</dd>
  <dt>Docker</dt>
  <dd>Docker version 18.09.0, build 4d60db4</dd>
  <dt>docker-compose</dt>
  <dd>docker-compose version 1.23.1, build b02f1306</dd>
  <dt>その他</dt>
  <dd>Kitematicなど</dd>
</dl>
  
## 使い方  
*作成中*
  
## 現状  
いろいろ試行錯誤を重ねて、  
```html:sample
  RUN localedef -i ja_JP -c -f UTF-8 -A /usr/share/locale/locale.alias ja_JP.UTF-8
  ENV LANG ja_JP.utf8
```  
や  
```html:sample
  POSTGRES_INITDB_ARGS: "--encoding=UTF-8 --locale=ja_JP.UTF-8"
```  
を加えてみました。  
ビルドは問題無く進み↓、  
```html:sample
  PS C:\Users\*****\docker\study05> docker-compose up -d --build  
  Creating network "study05_default" with the default driver  
  Building pgsql  
  Step 1/5 : FROM postgres:11.1  
   ---> 8d84c7940aa6  
  Step 2/5 : COPY ./pg_hba.conf /var/lib/postgresql/data/  
   ---> Using cache  
   ---> 55d2b7bb9f21  
  Step 3/5 : COPY ./postgresql.conf /var/lib/postgresql/data/  
   ---> Using cache  
   ---> ba3c956d0cfa  
  Step 4/5 : RUN localedef -i ja_JP -c -f UTF-8 -A /usr/share/locale/locale.alias ja_JP.UTF-8  
   ---> Using cache  
   ---> 1a436c42334b  
  Step 5/5 : ENV LANG ja_JP.utf8  
   ---> Using cache  
   ---> 0e82f395ff30  
  Successfully built 0e82f395ff30  
  Successfully tagged study05_pgsql:latest  
  Building web  
  Step 1/4 : FROM php:7.2.12-apache  
   ---> e0b497689a40  
  Step 2/4 : COPY ./php.ini /usr/local/etc/php/  
   ---> Using cache  
   ---> ad4a859b6ac7  
  Step 3/4 : RUN apt-get update   && apt-get install -y libfreetype6-dev libjpeg62-turbo-dev libpq-dev   && docker-php-ext-install pdo pdo_pgsql pgsql gd  
   ---> Using cache  
   ---> c41f7199c8c7  
  Step 4/4 : EXPOSE 80  
   ---> Using cache  
   ---> 05d8eb4d8941  
  Successfully built 05d8eb4d8941  
  Successfully tagged study05_web:latest  
  Creating study05_pgsql_1_af86fb871f8e ... done  
  Creating study05_web_1_f73a09e57c58   ... done  
  PS C:\Users\*****\docker\study05>  
```  
２つのコンテナは無事に起動、index.php ファイルにて PHP から PostgreSQLとの接続も確認できました。  
  
ところが、PostgreSQL のコンテナを覗いてみると、  
```html:sample
  root@2e981972ac4d:/# psql -l  
  psql: FATAL:  role "root" does not exist  
  root@2e981972ac4d:/# psql -U postgres  
  psql: FATAL:  role "postgres" does not exist  
  root@2e981972ac4d:/# psql -U pguser  
  psql (11.1 (Debian 11.1-1.pgdg90+1))  
  "help" でヘルプを表示します。  
    
  pguser=# \l  
                                        データベース一覧  
     名前    | 所有者 | エンコーディング |  照合順序  | Ctype(変換演算子) |   アクセス権限  
  -----------+--------+------------------+------------+-------------------+-------------------  
   pguser    | pguser | UTF8             | en_US.utf8 | en_US.utf8        |  
   postgres  | pguser | UTF8             | en_US.utf8 | en_US.utf8        |  
   template0 | pguser | UTF8             | en_US.utf8 | en_US.utf8        | =c/pguser        +  
             |        |                  |            |                   | pguser=CTc/pguser  
   template1 | pguser | UTF8             | en_US.utf8 | en_US.utf8        | =c/pguser        +  
             |        |                  |            |                   | pguser=CTc/pguser  
  (4 行)  
    
  pguser=#  
```  
環境変数に入れておいた "postgres" ユーザが使えない他、データベースは en_US.utf8 で初期化されていましたとさ...(-_-)。  
  
ということで、現在、行き詰まっております..f^^;。  
  
*by FUJIMOTO（torichol）＠2018/11/24*  
  

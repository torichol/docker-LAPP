# PostgreSQL コンテナ生成 ＠2018/11/21

# Docker 公式イメージの PostgreSQL11.1 を用いる
FROM postgres:11.1

# 手元の conf をコンテナ内にコピー
COPY ./pg_hba.conf /var/lib/postgresql/data/
COPY ./postgresql.conf /var/lib/postgresql/data/

# 試行錯誤中
RUN localedef -i ja_JP -c -f UTF-8 -A /usr/share/locale/locale.alias ja_JP.UTF-8
ENV LANG ja_JP.UTF-8

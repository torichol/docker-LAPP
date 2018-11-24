# Docker 公式イメージの PostgreSQL11.1 を用いる
FROM postgres:11.1
#FROM postgres:10.6

COPY ./pg_hba.conf /var/lib/postgresql/data/
COPY ./postgresql.conf /var/lib/postgresql/data/
# 手元の conf をコンテナ内にコピー

RUN localedef -i ja_JP -c -f UTF-8 -A /usr/share/locale/locale.alias ja_JP.UTF-8

ENV LANG ja_JP.utf8

#RUN addgroup postgres
#RUN useradd postgres -p password -g postgres
#RUN chown postgres:postgres /var/lib/postgresql/data/ -R

#USER postgres

#RUN su - postgres
#RUN /etc/init.d/postgresql initdb --encoding=UTF-8 --locale=ja_JP.UTF-8
#RUN /etc/init.d/postgresql start --encoding=UTF-8 --locale=ja_JP.UTF-8


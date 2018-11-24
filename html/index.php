<?php
echo("docker-compose による LAPP 環境作成<br />\n");

//▼DB初期値
$dbHOST="pgsql";																//▼主DBホスト名
$dbPORT="5432";																//▼主DBポート番号
$dbNAME="pguser";																//▼主DB名
$dbUSER="pguser";																//▼主DBアクセスユーザ名
$dbPWD="pguser";																//▼主DBＰＷＤ

//◆データベース接続
$db1Connect=pg_Connect("host=".$dbHOST." port=".$dbPORT." dbname=".$dbNAME." user=".$dbUSER." password=".$dbPWD);
//▼ＤＢ接続チェック
if(!$db1Connect){
	echo("PostgreSQLデータベース接続に失敗しました...(-_-)<br />\n");
}else{
	echo("PostgreSQLデータベース接続成功＼(^o^)／<br />\n");
}

echo("　<br />\n");
echo("　<br />\n");
echo("　<br />\n");

phpinfo();

echo("　<br />\n");
echo("　<br />\n");
echo("　<br />\n");

$HOGE=gd_info();
foreach($HOGE as $key => $value){
	echo($key." => ".$value."<br />\n");
}
echo("　<br />\n");
echo("　<br />\n");
echo("「JIS-mapped Japanese Font Support」が「OK」になっている場合は、GD の SJIS 変換が有効になっているので、imageTtfText() 関数の修正の必要がありますよー。<br />\n");
echo("　<br />\n");

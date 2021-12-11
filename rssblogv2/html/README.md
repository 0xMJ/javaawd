# RssBlogV2.0
connect.php配置数据库用户密码，然后建立article数据库，执行如下语句即可运行
```sql
create table article(id int(11) primary key auto_increment,title char(100) not null,author char(50) not null,
description text not null,content text not null,dateline int(11) not null default 0);
```
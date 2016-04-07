create database bit_nvshen;
use bit_nvshen;
create table user(uid primary key varchar(10) not null,
username varchar(30) not null,
password varchar(32) not null,
img_url  varchar(100) default 'nsc' not null,
vote_number int(8) default '0' not null,
phone int(10),
last_vote_time varchar(20) default '0' not null,
last_donate_vote_time varchar(20) default '0' not null,
last_biaobaiqiang_time varchar(20) default '0' not null,
major_class varchar(40),
qq varchar(12),
wetchat varchar(40), 
other_info varchar(200) ,
is_ban bool default 0 not null,
is_donate bool default 0 not null,
is_public bool default 1 not null,
is_female bool default 0 not null);

create table public(
register_number  varchar(10) default '0' not null,
vote_number  varchar(10) default '0' not null,
donate_number varchar(10) default '0' not null,
public_message varchar(1000) default '0' not null
);

create table message(
mid primary key varchar(10) AUTO_INCREMENT not null,
from_uid varchar(10) not null,
to_uid varchar(10) not null,
message varchar(200) not null,
send_time varchar(20) default '0' not null,
is_read bool default 0 not null,
is_biaobaiqiang bool default 0 not null
);

create table donate(
uid primary key varchar(10) not null,
donate_amount varchar(20) not null
);

create table iptable(
up_ip varchar(20) not null,
down_ip varchar(20) not null,
position varchar(100) not null
);

create table admin(
login_time varchar(30) ,
admin_login_ip varchar(30)
);


/*初始化sql*/
INSERT INTO `public`(`register_number`, `total_vote_number`, `donate_number`, `public_message`) VALUES ('5','100','0','hello world!')

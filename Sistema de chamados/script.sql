create database if not exists call_assis_afternoon;
use call_assis_afternoon;
create table if not exists users(
	id tinyint unsigned primary key auto_increment,
    name varchar(20) not null,
    email varchar(30) not null,
    password char(60) not null
);
create table if not exists equipments(
	pc_number varchar(10) primary key,
    floor tinyint unsigned not null,
    room tinyint unsigned not null
);
create table if not exists calls(
	id tinyint unsigned primary key auto_increment,
    open_date date not null,
    last_modify_date date null,
    user_id tinyint unsigned not null,
    equipment_id varchar(10) not null,
    classification tinyint not null,
    description text not null,
    notes text null,
    constraint fk_user foreign key (user_id) references users(id),
    constraint fk_equipment foreign key (equipment_id) references equipments(pc_number)
);
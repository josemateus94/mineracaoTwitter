create table joao_batista_mares_guia(
id Integer unsigned auto_increment primary key not null,
tw_id varchar(255) not null,
nome varchar(255) not null,
localizacao varchar(255) not null,
aparelho varchar(255) not null,
dia varchar(255) not null,
hora varchar(255) not null,
post varchar(255) not null,
sentimento varchar(255) default null
)engine = InnoDB;

create table twitter_por_usuario(
id Integer unsigned auto_increment primary key not null,
id_origem varchar(255) not null,
origem varchar(255) not null,
tw_id varchar(255) not null,
dia varchar(255) not null,
hora varchar(255) not null
)engine = InnoDB;
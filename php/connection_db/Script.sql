create database if not exists diego_renesto_itis;

use diego_renesto_itis;

create table studenti(
id int auto_increment primary key,
nome varchar(30),
cognome varchar(30),
media float,
data_iscrizione date
)

insert into studenti(nome, cognome, media, data_iscrizione) values
("Antonio", "Rossi", 6, "2003-05-12"),
("Luca", "Bianchi", 7, "2003-05-12"),
("Giuseppe", "Sera", 8, "2003-05-12");
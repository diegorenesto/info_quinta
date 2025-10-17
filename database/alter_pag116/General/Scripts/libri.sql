create table libri (
isbn varchar(16) primary key,
titolo varchar(50),
autore varchar(50),
argomento varchar(50),
editore varchar(50),
anno int,
edizione int
);

alter table libri change column anno anno_pubblicazione int;

alter table libri add column cognome char(40);

alter table libri add column nome char(40);

alter table libri drop column autore;

alter table libri change column cognome autore_cognome varchar(50);

alter table libri change column nome autore_nome varchar(50);

insert into libri (isbn, titolo, argomento, editore, anno_pubblicazione, edizione, autore_cognome, autore_nome) values
(2, "titolo1", "argomento1", "Mondadori", 2025, 1, "cognome1", "nome1");

#delete from libri where isbn = 1;

alter table libri change column autore_cognome autore_cognome varchar(50) not null;
alter table libri change column autore_nome autore_nome varchar(50) not null;
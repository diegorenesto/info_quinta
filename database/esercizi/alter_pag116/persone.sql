create table persone(
nr_tessera int auto_increment primary key,
cf varchar(16) not null,
cognome varchar(50) not null,
nome varchar(50) not null,
data date,
patologia varchar(50),
esenzione varchar(50),
allergia varchar(50),
eta int
);

insert into persone (cf, cognome, nome, data, patologia, esenzione, allergia, eta) values
("cf1", "Bazaj", "Francesco", "2005-05-13", "disabile", "dallo studio", "ossigeno", 75),
("cf2", "Pavarin", "Mattia", "2007-06-17", "gigante", "no", "stolypin", 18),
("cf3", "Renesto", "Diego", "2007-09-13", "lebbra", "E48", "no", 18),
("cf4", "cognome4", "nome4", null, null, null, null, null),
("cf5", "cognome5", "nome5", null, null, null, null, null),
("cf6", "cognome6", "nome6", null, null, null, null, null),
("cf7", "cognome7", "nome7", null, null, null, null, null),
("cf8", "cognome8", "nome8", null, null, null, null, null);

delete from persone where esenzione = "E48";

update persone set
cognome = UPPER(cognome),
nome = UPPER(nome),
patologia = UPPER(patologia),
esenzione = UPPER(esenzione),
allergia = UPPER(allergia);

update persone set esenzione = "per età" where eta > 70;
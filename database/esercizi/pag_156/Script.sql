create table utenti(
ID_utente int auto_increment primary key,
cognome varchar(20),
nome varchar(20),
stipendio int,
id_zona int not null
);

insert into utenti(cognome, nome, stipendio, id_zona) values
("Rossi", "Marco", null, 1),
("Esposito", "Raffaele", 1790, 2),
("Verdini", "Manuele", 1850, 3),
("Corti", "Erika", 2100, 1),
("Marsan", "Marisa", null, 1),
("Capuano", "Roberto", 1600, 2),
("Russo", "Marta", 1350, 4),
("Capittu", "Gavino", 900, 6);

# esercizio 1 pag. 156
select id_zona,
min(stipendio) as stipendio_min,
max(stipendio) as stipendio_max
from utenti
group by id_zona;

# esercizio 2 pag 156
select cognome, nome, avg(stipendio)
as media_stipendi
from utenti
group by cognome, nome
having media_stipendi > 2000;

# esercizio 3 pag 156
select avg(stipendio) from utenti;

# esercizio 4 pag 156
select stddev(stipendio) from utenti;
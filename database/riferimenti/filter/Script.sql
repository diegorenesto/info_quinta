create table studenti(
id int auto_increment PRIMARY KEY,
cognome varchar(20),
nome varchar(20),
materia varchar(20),
voto int
);

insert into studenti(cognome, nome, materia, voto) values
("Renesto", "Diego", "Storia", 9),
("Renesto", "Diego", "Italiano", 7),
("Renesto", "Diego", "Matematica", 8),
("Renesto", "Diego", "Tpsit", 8),
("Renesto", "Diego", "Sistemi", 8),
("Pavarin", "Mattia", "Italiano", 7),
("Pavarin", "Mattia", "Tpsit", 7),
("Pavarin", "Mattia", "Informatica", 7),
("Bazaj", "Francesco", "Inglese", 9),
("Bazaj", "Francesco", "Italiano", 6),
("Bazaj", "Francesco", "Informatica", 7),
("Zanforlin", "Nicolo'", "Motoria", 10),
("Zanforlin", "Nicolo'", "Informatica", 3),
("Zanforlin", "Nicolo'", "Tpsit", 2),
("Zanforlin", "Nicolo'", "Sistemi", 6),
("Pizzo", "Simone", "Moda", 2),
("Pizzo", "Simone", "Italiano", 6),
("Guezam", "Mohamed", "Informatica", 8),
("Guezam", "Mohamed", "Matematica", 6),
("Prearo", "Enrico", "Storia", 6),
("Prearo", "Enrico", "Italiano", 6),
("Savogin", "Gaia", "Matematica", 5),
("Savogin", "Gaia", "Italiano", 7),
("Savogin", "Gaia", "Inglese", 8),
("Brivio", "Sofia", "Francese", 9),
("Marchioro", "Giulia", "Spagnolo", 8),
("Marchioro", "Giulia", "Italiano", 6),
("Bismarck", "Otto", "Educazione civica", 10),
("Hohenzollern", "Friedrich", "Educazione civica", 3);

select cognome, nome, avg(voto)
as media_voti
from studenti
group by cognome, nome;


select cognome, nome, materia, avg(voto)
as media_voti
from studenti
group by cognome, nome, materia
having media_voti > 7;

alter table studenti
add num_interrogazioni int;

update studenti
set num_interrogazioni = 3
where id = 59;

update studenti
set num_interrogazioni = 4;

select cognome, nome, materia,
avg(voto) as media_voti,
sum(num_interrogazioni) as num_interrogazioni_count
from studenti
group by cognome, nome, materia
having media_voti > 7 and num_interrogazioni_count > 3;

# Trova la media dei voti per materia , ma considera solo i voti da 6 in su e mostra solo le materie con media superiore a 7
select cognome,nome, materia, avg(voto)
as media_voti
from studenti
where voto >= 6
group by cognome, nome, materia
having media_voti > 7;

select cognome,nome, materia, avg(voto)
as media_voti
from studenti
where materia = "Informatica"
group by cognome, nome, materia
having media_voti >= 7;

select cognome,nome, materia, avg(voto)
as media_voti
from studenti
where cognome = "Renesto" and nome = "Diego" and voto >= 6
group by cognome, nome, materia
having media_voti >= 7;

update studenti
set voto = 5
where id = 85;

select cognome,nome, materia, avg(voto)
as media_voti
from studenti
where cognome = "Marchioro" and nome = "Giulia" and voto >= 6
group by cognome, nome, materia
having media_voti >= 7;
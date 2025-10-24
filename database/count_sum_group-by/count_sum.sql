#funzioni di aggregazione
create table studenti(
id int auto_increment primary key,
nome varchar(50),
cognome varchar(50),
eta int
);

insert into studenti(nome, cognome, eta) values
("Diego", "Renesto", 18),
("Simone", "Pizzo", 18),
("Nicolo'", "Zanforlin", 17),
(NULL, NULL, NULL),
("Diego", "Giammei", 18);

select count(*) as totale_studenti from studenti

select count(cognome) as totale_cognomi from studenti

select count(distinct nome) as totale_distinti from studenti

select sum(eta) as somma_eta from studenti

select sum(eta) as somma_eta from studenti where nome = 'Diego'

select count(eta) as tutti, sum(eta) as somma from studenti

select count(distinct eta) as distinct_eta, sum(distinct eta) as somma_distinct_eta from studenti

# average
select avg(eta) as media_eta from studenti

select avg(eta) as media_eta_diego from studenti where nome = "Diego"

# min e max
select min(eta) as eta_min from studenti

select max(eta) as eta_max from studenti

drop table studenti
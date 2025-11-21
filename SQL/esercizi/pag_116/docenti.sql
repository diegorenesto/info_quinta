create table docenti(
codice int primary key,
cf varchar(50),
cognome varchar(50),
nome varchar(50),
abilitazione varchar(10)
);

alter table docenti change column abilitazione classe_concorso varchar(10);

alter table docenti change column cf codice_fiscale varchar(50);

alter table docenti add column ruolo bool;

alter table docenti drop column citta;

alter table docenti drop column telefono;

alter table docenti change column classe_concorso classe_concorso varchar(10) not null;


create table autori(
codice int primary key,
cf char(16),
cognome varchar(50),
nome varchar(50),
citta varchar(50)
);

insert into autori(codice, cf, cognome, nome, citta) values
(1, "CODICEFISCALE", "Renesto", "Diego", "Rovigo");

alter table autori change column cf codice_fiscale char(16);

alter table autori add column indirizzo char(40);

alter table autori add column cap char(5);

alter table autori change column cognome cognome varchar(50) not null;
alter table autori change column nome nome varchar(50) not null;


-- NON INSERITO
# insert into autori(codice, codice_fiscale, cognome, nome, citta) values
# (2, "CODICEFISCALE", null, "Diego", "Rovigo");

-- INSERITO
# insert into autori(codice, codice_fiscale, cognome, nome, citta) values
#(2, "CODICEFISCALE", "Renesto", "Diego", null);
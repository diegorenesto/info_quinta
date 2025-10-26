CREATE TABLE autori(
codice int PRIMARY KEY,
cf char(16) unique,
cognome varchar(50),
nome varchar(50),
citta varchar(50)
);

CREATE TABLE libri(
isbn varchar(13) PRIMARY KEY,
titolo varchar(50),
autore varchar(50),
argomento varchar(50),
editore varchar(50),
anno int,
edizione int
);

CREATE TABLE dipendenti(
ID_dipendente int PRIMARY KEY,
cognome varchar(50),
nome varchar(50),
data_nascita date,
cap bigint,
citta varchar(50),
anzianita int,
ID_reparto int NOT NULL
);

CREATE TABLE reparti(
ID_reparto int PRIMARY KEY,
nome_reparto varchar(50) unique,
cod_responsabile int
);
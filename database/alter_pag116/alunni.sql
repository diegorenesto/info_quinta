create table alunni(
codice int primary key,
cf varchar(16),
cognome varchar(50),
nome varchar(50),
data date,
classe varchar(5)
);

alter table alunni change column cf codice_fiscale varchar(16);

alter table alunni change column data data_nascita date;

alter table alunni add column corso varchar(20);

alter table alunni add column sezione varchar(5);

alter table alunni change column corso indirizzo varchar(20);

alter table alunni drop column telefono;
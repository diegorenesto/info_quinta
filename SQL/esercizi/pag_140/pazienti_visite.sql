create table pazienti(
	codice_paziente int auto_increment primary key,
	cognome varchar(20),
	nome varchar(20),
	citta varchar(20),
	codice_asl varchar(20),
	peso int,
	pressione_max int,
	pressione_min int
);

create table visite(
	id_visita int auto_increment primary key,
	data_visita date,
	glicemia int,
	peso int,
	codice_paziente int,
	foreign key(codice_paziente) references pazienti(codice_paziente)
);

insert into pazienti (codice_paziente, cognome, nome, citta, codice_asl, peso, pressione_max, pressione_min) values
(1, 'Rossi', 'Mario', 'Milano', 'ASL_MI_001', 85, 140, 90),
(2, 'Bianchi', 'Laura', 'Roma', 'ASL_RM_002', 58, 150, 95),
(3, 'Verdi', 'Giuseppe', 'Napoli', NULL, 92, 130, 85),
(4, 'Ferrari', 'Anna', 'Milano', 'ASL_MI_003', 95, 160, 100),
(5, 'Russo', 'Luigi', 'Napoli', 'ASL_NA_004', 68, 125, 80),
(6, 'Esposito', 'Maria', 'Roma', NULL, 55, 145, 110),
(7, 'Romano', 'Giovanni', 'Milano', 'ASL_MI_005', 72, 135, 90),
(8, 'Gallo', 'Francesca', 'Napoli', 'ASL_NA_006', 63, 128, 85),
(9, 'Conti', 'Alessio', 'Roma', 'ASL_RM_007', 89, 142, 105),
(10, 'Costa', 'Elena', 'Milano', NULL, 65, 118, 82);

insert into visite (id_visita, data_visita, glicemia, peso, codice_paziente) values
(1, '2024-03-15', 95, 85, 1),
(2, '2024-02-20', 105, 57, 2),
(3, '2020-06-10', 125, 91, 3),
(4, '2024-01-05', 98, 94, 4),
(5, '2020-11-30', 115, 68, 5),
(6, '2024-03-22', 92, 55, 6),
(7, '2023-12-15', 88, 71, 7),
(8, '2020-08-25', 130, 63, 8),
(9, '2024-02-10', 102, 88, 9),
(10, '2024-03-18', 96, 64, 10),
(11, '2020-09-15', 135, 92, 3),
(12, '2024-03-01', 108, 67, 5),
(13, '2020-07-12', 105, 56, 6),
(14, '2024-02-28', 120, 63, 8);

-- selezione dei pazienti senza codice ASL
select
	*
from
	pazienti
where
	codice_asl is null;

-- elenco di tutte le visite: data visita, cognome del paziente e peso della visita
select
	v.data_visita,
	p.cognome,
	v.peso as peso_visita
from
	visite v
join
	pazienti p on
	v.codice_paziente = p.codice_paziente;

-- elenco di tutti i pazienti con diferenza tra pressione minima e massima inferiore a 40
select
	cognome,
	nome,
	pressione_max,
	pressione_min
from
	pazienti
where
	(pressione_max - pressione_min) < 40;

-- elenco di tutti i pazienti che pesano tra il 60 e i 70 kg
select
	cognome,
	nome,
	peso
from
	pazienti
where
	peso between 60 and 70; -- 60 < peso < 70

-- elenco di tutti i pazienti di Milano con peso > 90 kg
select
	cognome,
	nome,
	citta,
	peso
from
	pazienti
where
	citta = "Milano"
	and peso > 90;

-- elenco di tutti i pazienti di Napoli con problemi di diabete (glicemia > 110) nell'anno 2020
select
	p.cognome,
	p.nome,
	p.citta,
	v.glicemia,
	v.data_visita
from
	pazienti p
join visite v on
	p.codice_paziente = p.codice_paziente
where
	citta = "Napoli"
	and v.glicemia > 110
	and year(v.data_visita) = '2020';

-- elenco di tutti i pazienti di Roma ipertesi (pressione_max > 140) con peso inferiore ai 60 kg
select
	cognome,
	nome,
	citta,
	pressione_max,
	peso
from
	pazienti
where
	citta = "Roma"
	and pressione_max > 140
	and peso < 60;

-- elenco di tutti i pazienti in ordine alfabetico con visite efettuate quest'anno
select
	p.cognome,
	p.nome,
	v.data_visita
from
	pazienti p
join visite v on
	p.codice_paziente = v.codice_paziente
where
	year(v.data_visita) = year(CURDATE());
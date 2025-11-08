create table pazienti(
id_paziente int auto_increment primary key,
cognome varchar(20),
nome varchar(20),
data_nascita varchar(20),
provincia char(2),
codice_asl varchar(20)
);

create table visite(
id_visita int auto_increment primary key,
data_visita date,
peso int,
pressione_min int, 
pressione_max int,
glicemia decimal(5,2),
id_paziente int,
foreign key(id_paziente) references pazienti(id_paziente)
);


insert into pazienti(cognome, nome, data_nascita, provincia, codice_asl) values
('Bianchi', 'Luca', '1985-04-10', 'MI', 'ASL-MI01'),
('Rossi', 'Marco', '1990-07-23', 'NA', NULL),
('Verdi', 'Anna', '1978-12-01', 'RM', 'ASL-RM05'),
('Neri', 'Giulia', '2000-02-14', 'MI', 'ASL-MI03'),
('Esposito', 'Francesco', '1983-09-19', 'NA', 'ASL-NA07'),
('Conti', 'Marta', '1995-05-30', 'RM', NULL);


insert into visite(data_visita, peso, pressione_min, pressione_max, glicemia, id_paziente) values
('2024-03-15', 70, 80, 120, 95.00, 1),
('2024-06-10', 75, 85, 125, 100.00, 1),
('2020-05-22', 92, 95, 145, 112.00, 2),
('2020-11-03', 88, 90, 135, 108.00, 5),
('2020-08-12', 89, 85, 140, 115.00, 5),
('2025-01-09', 59, 100, 150, 99.00, 3),
('2025-02-02', 65, 85, 118, 100.00, 4),
('2025-09-05', 62, 70, 110, 98.00, 4),
('2025-03-15', 58, 95, 145, 85.00, 6),
('2025-11-08', 70, 80, 120, 95.00, 1);


select * from pazienti p
join visite v
on p.id_paziente = v.id_paziente;


select p.cognome, p.nome, v.data_visita
from pazienti p join visite v
on p.id_paziente = v.id_paziente; 


select p.cognome, p.nome, v.pressione_min, v.pressione_max
from pazienti p join visite v
on p.id_paziente = v.id_paziente 
where v.pressione_min > 80;


select p.cognome, p.nome, v.pressione_min, v.pressione_max, avg(pressione_min)
from pazienti p
join visite v
on p.id_paziente = v.id_paziente
where p.cognome like ("Bianchi");


select p.cognome, p.nome, avg(pressione_min)
from pazienti p
join visite v
on p.id_paziente = v.id_paziente
group by cognome, nome;


# SELECT CURRENT DATE
select p.cognome, p.nome, v.data_visita 
from pazienti p
join visite v
on p.id_paziente = v.id_paziente
where(v.data_visita) = (CURDATE());


# SELECT CURRENT YEAR
select p.cognome, p.nome, v.data_visita 
from pazienti p
join visite v
on p.id_paziente = v.id_paziente
where YEAR(v.data_visita) = YEAR(CURDATE());
-- oppure
select p.cognome, p.nome, v.data_visita 
from pazienti p
join visite v
on p.id_paziente = v.id_paziente
where v.data_visita like '2025-%-%';


# selezione per mese
select p.cognome, p.nome, v.data_visita 
from pazienti p
join visite v
on p.id_paziente = v.id_paziente
where v.data_visita like '%-11-%';


-- visualizzare i pazienti che hanno una differenza tra pressione max e presisone min 
select p.cognome, p.nome
from pazienti p
join visite v
on p.id_paziente = v.id_paziente
where (v.pressione_max - v.pressione_min) < 40;
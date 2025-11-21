# Renesto Diego 5F FILA 2
create database diego_renesto_verifica;

create table clienti(
id_cliente int auto_increment primary key,
nome varchar(20),
cognome varchar(20),
citta varchar(20),
email varchar(50)
);

create table vendite(
id_vendita int auto_increment primary key,
data_vendita date,
descrizione varchar(20),
importo int,
id_cliente int,
foreign key(id_cliente) references clienti(id_cliente)
);

insert into clienti(nome, cognome, citta, email) values
("Luca", "Rossi", "Roma", "luca.rossi@gmail.com"),
("Simone", "Verdi", "Milano", "simone.verdi@gmail.com"),
("Gianna", "Bianchi", "Napoli", "gianna.bianchi@gmail.com"),
("Francesco", "Neri", "Salerno", "francesco.neri@gmail.com");

insert into vendite(data_vendita, descrizione, importo, id_cliente) values
("2025-11-20", "frigorifero", 800, 2),
("2025-05-10", "PS5", 550, 2),
("2019-06-04", "PC", 1000, 1),
("2020-02-02", "scrivania", 1200, 3),
("2023-12-19", "macchina", 20000, 1),
("2024-08-28", "bicicletta", 500, 3);

#clienti che non hanno effettuato vendite, per nome,cognome,citta
select c.nome, c.cognome, c.citta, count(v.id_vendita) as numero_vendite
from vendite v
right join clienti c
on v.id_cliente = c.id_cliente
group by c.nome, c.cognome
having numero_vendite = 0;

#media importo vendite anno 2024
select avg(importo)
from vendite
where data_vendita like '2024-%-%';

#vendite per nome,cognome,datavendita,descrizione,importo
select c.nome, c.cognome, v.data_vendita, v.descrizione, v.importo
from vendite v
join clienti c
on v.id_cliente = c.id_cliente;

#vendite clienti di milano, per nome,cognome,descrizione,datavendita,importo
select c.nome, c.cognome, v.descrizione, v.data_vendita, v.importo 
from vendite v
join clienti c
on v.id_cliente = c.id_cliente
where c.citta = "Milano";

#totale vendite per ogni cliente, per nome,cognome,numerovendite
select c.nome,c.cognome, count(v.id_vendita) as numero_vendite
from vendite v
join clienti c
on v.id_cliente = c.id_cliente
group by c.nome, c.cognome;

#clienti che hanno acquistato importo > 500, per nome,cognome,importo
select c.nome, c.cognome, v.importo 
from clienti c
join vendite v
on c.id_cliente = v.id_cliente
where importo > 500;

#clienti e numero di vendite 2025, order by numerovendite desc
select c.nome, c.cognome, count(v.id_vendita) as numero_vendite
from vendite v
right join clienti c
on v.id_cliente = c.id_cliente
where YEAR(v.data_vendita) = YEAR(CURDATE())
group by c.nome, c.cognome
order by data_vendita desc;
create table giocatori(
	ID_giocatore int auto_increment primary key,
	cognome varchar(20),
	nome varchar(20),
	squadra varchar(20),
	id_capitano int,
	foreign key (id_capitano) references giocatori(ID_giocatore)
);

-- inserisco prima i capitani (altrimenti la foreign key dei giocatori da errore)
insert into giocatori(cognome, nome, squadra, id_capitano) values
("Mudu", "Simone", "Borsea", NULL),
("Tommasello", "Erik", "Union River", NULL),
("Guerra", "Gabriel", "Vittoriosa", NULL);
-- inserisco i giocatori
insert into giocatori(cognome, nome, squadra, id_capitano) values
("Bonavigo", "Nicola", "Borsea", 1),
("Renesto", "Diego", "Borsea", 1),
("Campion", "Matteo", "Union River", 2);

-- query per vedere i giocatori con i loro capitani
select 
	g.cognome as cognome_giocatore,
	g.nome as nome_giocatore,
	g.squadra as squadra,
	c.cognome as cognome_capitano,
	c.nome as nome_capitano
from
	giocatori g
join
	giocatori c on
	g.id_capitano = c.ID_giocatore;
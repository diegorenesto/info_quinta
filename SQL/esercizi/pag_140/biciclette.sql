create table esemplari(
	ID_prodotto int auto_increment primary key,
	id_marca int not null,
	codice_modello varchar(20) not null,
	nome_modello varchar(20),
	tipo varchar(20),
	colore varchar(20),
	dimensione int,
	foreign key(id_marca) references marche(Id_marca)
);

create table marche(
	ID_marca int auto_increment primary key,
	nome varchar(20),
	citta varchar(20)
);

insert into marche (nome, citta) values
('Campagnolo', 'Vicenza'),
('Bianchi', 'Milano'),
('Colnago', 'Milano'),
('Gios', 'Torino'),
('Olmo', 'Pordenone'),
('Atala', 'Milano'),
('Cinelli', 'Milano');

insert into esemplari (id_marca, codice_modello, nome_modello, tipo, colore, dimensione) values
(1, 'h001', 'Superleggera', 'corsa', 'rosso', 56),
(1, 'e002', 'Turismo Plus', 'turismo', 'verde', 58),
(2, 'c003', 'Oltre', 'corsa', 'blu', 54),
(2, 't004', 'Family', 'tandem', 'nero', 60),
(3, 'r005', 'XCR', 'rampichino', 'giallo', 52),
(3, 's006', 'Sport Pro', 'sport', 'rosso', 55),
(4, 'h007', 'Torino', 'corsa', 'bianco', 57),
(4, 'e008', 'Verdetta', 'rampichino', 'verde', 54),
(5, 'b009', 'Graziella', 'city', 'rosso', 50),
(5, 's010', 'Competition', 'sport', 'nero', 56),
(6, 'r011', 'Mountain', 'rampichino', 'blu', 58),
(7, 't012', 'Team', 'tandem', 'rosso', 59),
(1, 'h013', 'Racing', 'corsa', 'giallo', 55),
(2, 'e014', 'Urban', 'city', 'nero', 52),
(5, 's015', 'Active', 'sport', 'verde', 54),
(5, 'g016', 'Graziella', 'city', 'rosso', 50);

-- elenco di tutti i tipi di biciclette presenti nell'archivio
select
	distinct(tipo)
from
	esemplari;

-- elenco di tutte le biciclette prodotte da "Campagnolo" di tipo da "turismo"
select
	e.codice_modello,
	e.nome_modello,
	e.tipo,
	m.nome
from
	esemplari e
join marche m on
	e.id_marca = m.ID_marca
where
	m.nome = "Campagnolo"
	and e.tipo = "turismo";

-- elenco di utte le biciclette prodotte da "Bianchi" e "Colnago", di tipo da "corsa" e "tandem"
select
	e.codice_modello,
	e.nome_modello,
	e.tipo,
	m.nome
from
	esemplari e
join marche m on
	e.id_marca = m.ID_marca
where
	m.nome in ("Bianchi", "Colnago")
	and e.tipo in ("corsa", "tandem");

-- elenco di tutti i produttori che hanno prodotto almeno una bicicletta di tipo "rampichino" e "sport"
select
	distinct
m.nome as produttore
from
	marche m
where
	m.ID_marca in (
	select
		e1.id_marca
	from
		esemplari e1
	where
		e1.tipo = "rampichino"
)
	and m.ID_marca in (
	select
		e2.id_marca
	from
		esemplari e2
	where
		e2.tipo = "rampichino"
);

-- elenco di tutte le biciclette prodotte dai produttori "Gios" e "Olmo"
select 
	e.codice_modello,
	e.nome_modello,
	e.tipo,
	m.nome
from
	esemplari e
join marche m on
	e.id_marca = m.ID_marca
where
	m.nome in ("Gios", "Olmo");

-- elenco di tutti i produttori che hanno prodotto biciclette con codice che inizia per "h" e "e"
select
	distinct
m.nome as produttore
from
	marche m
where
	m.ID_marca in (
	select
		e1.id_marca
	from
		esemplari e1
	where
		e1.codice_modello like "h%"
)
	and m.ID_marca in (
	select
		e2.id_marca
	from
		esemplari e2
	where
		e2.codice_modello like "e%"
);

-- elenco di tutte le biciclette rosse modello "Graziella" prodotte da "Olmo"
select  
	e.codice_modello,
	e.nome_modello,
	e.tipo,
	e.colore,
	m.nome
from
	esemplari e
join marche m on
	e.id_marca = m.ID_marca
where
	e.colore = "rosso"
	and e.nome_modello = "Graziella"
	and m.nome = "Olmo";

-- elenco di tutte le marche con le rispettive biciclette prodotte
select
	m.nome as marca,
	e.codice_modello,
	e.nome_modello,
	e.tipo,
	e.colore
from
	marche m
join esemplari e on
	m.ID_marca = e.id_marca
order by
	m.nome;











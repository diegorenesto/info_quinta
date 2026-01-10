/* SQL:
Creare un DB con tre tabelle:
	una per contenere diversi modelli di access-point wi-fi,
	una per i dati dei produttori di questi dispositi
	e la terza per lo standard WiFi e le relative bande supportate (immaginare di includere nel database anche prodotti vecchi con standard ormai obsoleti);
in base alle proprie conoscenze, ed eventualmente ricercando in rete, creare gli schemi di relazione delle tabelle.
Sulle tabelle così ottenute eseguire le seguenti operazioni:
 - CRUD
 - JOIN (tutti i tipi, coinvolgendo due e tre tabelle)
 - utilizzo degli operatori aggregati(inclusi group-by e having)
 */

CREATE database IF NOT EXISTS diego_renesto_ripasso;

CREATE TABLE access_points(
id int auto_increment primary key,
marchio varchar(20),
nome_modello varchar(20),
classe_banda_frequenza varchar(20),
standard_comunicazione varchar(20),
velocita_gigabit varchar(20),
colore varchar(20),
prezzo int,
id_produttore int,
id_standard int,
foreign key(id_produttore) references produttori(id_produttore),
foreign key(id_standard) references standard_wifi(id_standard)
)

CREATE TABLE produttori(
id_produttore int auto_increment primary key,
nome varchar(20),
paese varchar(20)
)

CREATE TABLE standard_wifi(
id_standard int auto_increment primary key,
nome varchar(20),
velocita_mbps int,
frequenza decimal(3, 1)
)

# inserimento produttori
INSERT INTO produttori (nome, paese) VALUES
('TP-Link', 'Cina'),
('Netgear', 'Stati Uniti'),
('ASUS', 'Taiwan');

# inserimento standard wifi
INSERT INTO standard_wifi (nome, velocita_mbps, frequenza) VALUES
('802.11n', 600, 2.4),
('802.11ac', 1300, 5.0),
('802.11ax', 9600, 5.0);

# inserimento access points
INSERT INTO access_points 
(marchio, nome_modello, classe_banda_frequenza, standard_comunicazione, velocita_gigabit, colore, prezzo, id_produttore, id_standard) VALUES
('TP-Link', 'Archer C6', 'Dual-Band', '802.11ac', '1G', 'Nero', 79, 1, 2),
('Netgear', 'Nighthawk R7000', 'Dual-Band', '802.11ac', '1G', 'Nero', 189, 2, 2),
('ASUS', 'RT-AX88U', 'Dual-Band', '802.11ax', '10G', 'Nero', 349, 3, 3),
('TP-Link', 'TL-WR841N', 'Single-Band', '802.11n', '0.3G', 'Bianco', 29, 1, 1),
('Netgear', 'AX1800 EAX15', 'Dual-Band', '802.11ax', '1.8G', 'Bianco', 129, 2, 3),
('ASUS', 'RT-N12', 'Single-Band', '802.11n', '0.3G', 'Nero', 39, 3, 1);

# read
select *
from produttori;

# update
alter table access_points change column nome_modello modello varchar(20);

# delete
alter table access_points drop column colore;


# join di due tabelle
# marchio, modello e standard_wifi di ciascun access_point
select
	ap.marchio,
	ap.modello,
	sw.nome as standard_wifi
from access_points ap
join standard_wifi sw
on ap.id_standard = sw.id_standard;

# join di tre tabelle
# modello, produttore e standard_wifi di ciascun access_point
select 
    ap.modello,
    p.nome as produttore,
    sw.nome as standard_wifi
from access_points ap
join produttori p on ap.id_produttore = p.id_produttore
join standard_wifi sw on ap.id_standard = sw.id_standard;

# operatori aggregati
# access_points con standard_wifi 802.11n
select
	ap.modello,
	p.nome as produttore,
	sw.nome as standard_wifi
from access_points ap
join produttori p on ap.id_produttore = p.id_produttore 
join standard_wifi sw on ap.id_standard = sw.id_standard 
where sw.nome = "802.11n";

# count di quanti access_point con lo stesso standard_wifi
select 
	sw.nome as standard_wifi, 
	count(sw.nome)
from access_points ap
join produttori p on ap.id_produttore = p.id_produttore 
join standard_wifi sw on ap.id_standard = sw.id_standard 
group by standard_wifi;

# stessa query con l'having
select 
	sw.nome as standard_wifi, 
	count(sw.nome) as count
from access_points ap
join produttori p on ap.id_produttore = p.id_produttore 
join standard_wifi sw on ap.id_standard = sw.id_standard 
group by standard_wifi
having count = 2;
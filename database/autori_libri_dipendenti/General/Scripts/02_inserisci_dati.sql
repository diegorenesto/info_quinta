-- es 1
INSERT INTO autori(codice, cf, cognome, nome, citta) VALUES
(1, 'RNSDGI07P13H620Z', 'Renesto', 'Diego', 'Rovigo'),
(2, 'PZZSMN07C10A059M', 'Pizzo', 'Simone', 'Rovigo'),
(3, 'ZNFNCL07T07H620M', 'Zanforlin', 'Nicolo', 'Rovigo');

-- es 2
INSERT INTO libri (isbn, titolo, autore, argomento, editore, anno, edizione) VALUES
('9788800000001', 'Il deserto dei tartari', 'Dino Buzzati', 'Romanzo', 'Mondadori', 1940, 3),
('9788800000002', 'Il barone rampante', 'Italo Calvino', 'Romanzo', 'Einaudi', 1957, 2),
('9788800000004', 'Se questo è un uomo', 'Primo Levi', 'Memorialistica', 'Einaudi', 1947, 3);


-- es 3
INSERT INTO reparti (ID_reparto, nome_reparto, cod_responsabile) VALUES
(1, 'Amministrazione', NULL),
(2, 'Vendite', NULL),
(3, 'Produzione', NULL),
(4, 'IT', NULL);

INSERT INTO dipendenti (ID_dipendente, cognome, nome, data_nascita, cap, citta, anzianita, ID_reparto) VALUES
(101, 'Ferrari', 'Marco', '1985-03-15', '00100', 'Roma', 5, 1),
(102, 'Russo', 'Anna', '1990-07-22', '20100', 'Milano', 3, 2),
(103, 'Romano', 'Luigi', '1988-11-30', '80100', 'Napoli', 7, 3),
(104, 'Gallo', 'Laura', '1992-05-10', '10100', 'Torino', 2, 4),
(105, 'Costa', 'Giovanni', '1980-12-05', '00100', 'Roma', 10, 1);


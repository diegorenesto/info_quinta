ALTER TABLE studenti ADD dipartimento varchar(50);

ALTER TABLE studenti DROP COLUMN dipartimento;

ALTER TABLE studenti CHANGE COLUMN cognome cognome char(20) NOT NULL AFTER studenti;

ALTER TABLE studenti CHANGE COLUMN cognome cognome char(20) NOT NULL FIRST;
DELETE FROM studenti WHERE nome = "Simone" and cognome = "Pizzo";

# DROP elimina tutta la tabella, mentre TRUNCATE la svuota

TRUNCATE TABLE studenti

UPDATE studenti SET cognome = "Maradona" WHERE nome = "Diego";
UPDATE studenti set nome = "Alessandro" WHERE cognome = "Pizzo";
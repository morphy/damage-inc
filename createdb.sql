CREATE TABLE dzialy
(
  id_dzial SERIAL PRIMARY KEY,
  nazwa VARCHAR(40) NOT NULL,
  audyt BOOLEAN NOT NULL
);

CREATE TABLE pracownicy
(
  id_pracownik SERIAL PRIMARY KEY,
  imie VARCHAR(20) NOT NULL,
  nazwisko VARCHAR(40),
  id_dzial INT REFERENCES dzialy ON DELETE SET NULL ON UPDATE CASCADE,
  menedzer BOOLEAN NOT NULL
);


CREATE TABLE zlecenia
(
  id_zlecenie SERIAL PRIMARY KEY,
  nazwa VARCHAR(40) NOT NULL,
  opis TEXT,
  data DATE NOT NULL,
  ukonczone BOOLEAN NOT NULL
);

CREATE TABLE przydzialy
(
  id_zlecenie INT NOT NULL REFERENCES zlecenia ON UPDATE CASCADE ON DELETE CASCADE,
  id_pracownik INT NOT NULL REFERENCES pracownicy ON UPDATE CASCADE ON DELETE CASCADE,
  PRIMARY KEY (id_zlecenie,id_pracownik)
);

CREATE VIEW pwd_view AS
SELECT count(id_pracownik), nazwa
FROM pracownicy, dzialy
WHERE pracownicy.id_dzial=dzialy.id_dzial
GROUP BY dzialy.nazwa;

CREATE VIEW mwd_view AS
SELECT count(id_pracownik), nazwa
FROM pracownicy, dzialy
WHERE pracownicy.id_dzial=dzialy.id_dzial
AND pracownicy.menedzer=true
GROUP BY dzialy.nazwa;

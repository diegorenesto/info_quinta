const colori = ["Giallo", "Verde", "Blu", "Rosso", "Nero"];

// stampa elemento e indice
colori.forEach((e, i) => {
  console.log("Colore: " + e.toUpperCase() + " indice: " + i);
});

/* ------------------------------------------------------- */
// FILTER

const numeri = [11, 12, 28, 17, 34, 55, 2, 48, 9, 10];
const numeriFiltrati = numeri.filter((num) => num > 20);
console.log(numeriFiltrati);

/* ------------------------------------------------------- */
// MAP

const test = [1, 2, 3, 4];
const testSquared = test.map((num) => num * num);
console.log(testSquared);

/* ------------------------------------------------------- */
// REDUCE

const array = [1, 2, 3, 4, 5];
console.log(array.reduce((num, somma) => (somma += num)));
console.log(array.reduce((num, somma) => (somma += num), -5)); // parte da -5 (output: somma-5)

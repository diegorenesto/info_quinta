// elementi DOM
const evidenziaBtn = document.getElementById("btn");
const aggiungiBtn = document.getElementById("aggiungi-btn");

// bottone cambia background color
evidenziaBtn.addEventListener("click", () => {
  const divs = document.querySelectorAll("div");
  //scorro tutti i div ad uno ad uno
  divs.forEach((d) => {
    d.style.backgroundColor = "red";
  });
});

// bottone aggiungi p
aggiungiBtn.addEventListener("click", function () {
  const nuovoP = document.createElement("p");
  nuovoP.textContent = "ciao";
  document.body.appendChild(nuovoP);
  // OPPURE
  // document.body.appendChild(document.createElement("p")).textContent = "ciao";
});

//Declaration d'une variable 
let usagers;

//Fonction qui permet d'afficher les usagers
// utilise la fonction afficheusager

function afficheDesUsagers(desUsagers) {
  let chaine = "";
  for (let i = 0; i < desUsagers.length; i++) {
    let unUsager = desUsagers[i];
    chaine += afficheUsager(unUsager);
  }

  document.querySelector("#divUsagers").innerHTML = chaine;

}

//Fonction qui permet d'afficher seulement les usagers rechercher

function rechercheNomUsager() {
  let NomRechercher = document.querySelector("#rechercheUsager").value
  console.log(NomRechercher)
  let resultat = [];
  for (let i = 0; i < usagers.length; i++) {
    let unUsager = usagers[i];
    if (unUsager.nom.toLowerCase().includes(NomRechercher.toLowerCase()) || unUsager.prenom.toLowerCase().includes(NomRechercher.toLowerCase())) {
      resultat.push(unUsager);
    }

  }
  afficheDesUsagers(resultat);
}

function afficheUsager(unUsager) {

  return `
  <tr>
    <td>${unUsager.id}</td>
    <td>${unUsager.genre}</td>
    <td>${unUsager.nom}</td>
    <td>${unUsager.prenom}</td>
    <td>${unUsager.tel}</td>
    <td>${unUsager.email}</td>
    <td>${unUsager.adresse}</td>
    <td>${unUsager.cp} - ${unUsager.ville}</td>
    <td>
    <a class="btn btn-outline-secondary" href="${unUsager.id}">
							<i class="fa-regular fa-eye"></i>
						</a>

						<a class="btn btn-outline-secondary" href="${unUsager.id}/edit">
							<i class="fa-regular fa-pen-to-square"></i>
						</a>

						<a class="btn btn-outline-secondary" href="${unUsager.id}">
							<i class="fa-regular fa-trash-can"></i>
						</a>
    </td>
  </tr>
`
}
//Procedure qui permet de constituer le dataList de manière dynamique


function afficheDataList() {
  let chaine = "";
  for (let i = 0; i < usagers.length; i++) {
    let nomUsager = usagers[i].nom;
    let prenomUsager = usagers[i].prenom;
    chaine += `<option value='${nomUsager} ${prenomUsager}'>${nomUsager} ${prenomUsager}</option>`
  }
  document.querySelector("#dataListNom").innerHTML = chaine;
}


  
(async () => {

  const res = await fetch('https://localhost:8000/usager/api/usager');
  usagers = await res.json();

  console.log(usagers);

  afficheDesUsagers(usagers);
  afficheDataList(usagers);


})();



// scripte de barre de reherche vue  home

//scripte de barre de reherche vue  home



//Declaration d'une variable 
let ateliers;

//Fonction qui permet d'afficher les ateliers
// utilise la fonction affiche atelier

function afficheLesAteliers(lesAteliers) {
  let chaine = "";
  for (let i = 0; i < lesAteliers.length; i++) {
    let unAtelier = lesAteliers[i];
    chaine += afficheAtelier(unAtelier);
  }

  document.querySelector("#divAteliers").innerHTML = chaine;

}

//Fonction qui permet d'afficher seulement les ateliers rechercher

function rechercheTitreAtelier() {
  let TitreRechercher = document.querySelector("#rechercheAtelier").value
  console.log(TitreRechercher)
  let resultat = [];
  for (let i = 0; i < ateliers.length; i++) {
    let unAtelier = ateliers[i];
    if (unAtelier.libelle.toLowerCase().includes(TitreRechercher.toLowerCase())) {
      resultat.push(unAtelier);
    }

  }
  //afficheLesAteliers(resultat);
  
}

function afficheAtelier(unAtelier) {


  return `
  
  <div class="col">
    <div class="card h-100">
      <img src="../uploads/images/${unAtelier.image}" class="card-img-top" alt="...">
      <div class="card-body">
        <h5 class="card-title">${unAtelier.libelle.toUpperCase()}</h5>
        <p class="card-text">${unAtelier.id}</p>
      </div>
      <div class="card-footer">
        <small class="text-muted">Last updated 3 mins ago</small>
      </div>
    </div>
  </div>

`;
}
//Procedure qui permet de constituer le dataList de manière dynamique

function afficheDataListAtelier() {
  let chaine = "";
  for (let i = 0; i < ateliers.length; i++) {
    let titreAtelier = ateliers[i].libelle;
    chaine += `<option value='${titreAtelier}'>${titreAtelier}</option>`
  }
  document.querySelector("#dataListAtelier").innerHTML = chaine;
}

(async () => {

  const resp = await fetch('https://localhost:8000/atelier/api/atelier');
  ateliers = await resp.json();

  console.log(ateliers);

  //   afficheLesAteliers(ateliers);
  afficheDataListAtelier(ateliers);
 
})();



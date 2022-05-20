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
  // console.log(NomRechercher)
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

    chaine += `<option value='${nomUsager}'>${nomUsager} ${prenomUsager}</option>`

  }
  document.querySelector("#dataListNom").innerHTML = chaine;
}


  
(async () => {

  const res = await fetch('http://127.0.0.1:8000/usager/api/usager');
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
  // console.log(TitreRechercher)
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
  
  <div class="row row-cols-1 row-cols-md-4 row-cols-sm-2 g-4 mt-4 mx-0">
  
  
		<div class="col">

			<div class="card h-100">
				<img src="uploads/images/${unAtelier.image}" class="card-img-top w-100 h-100 mx-auto" alt="{{ atelier.image }}">
				<div class="card-body">
					<h5 class="card-title text-center text-white bg-primary w-100">Atelier :<b>
							${unAtelier.libelle.toUpperCase()}</b>
					</h5>
					<hr>
					<p class="card-text text-center">Animateur :
						<b>${ unAtelier.animateurs }</b>
					</p>
					<p class="card-text text-center">Date :
						<b>${ unAtelier.date ? atelier.date|date('d / m / Y') : '' }</b>
					</p>
					<p class="card-text text-center">
						Horaire :

						<b>${ unAtelier.heureDebut }
						</b>

						<i class="fa-solid fa-arrow-right-long"></i>
						<b>
							${ unAtelier.heureFin }</b>
					</p>
					<p class="card-text text-center">

					
							<b class="text-danger">Complet</b>
					
						
						Places disponible :
						<b class="text-success">${ unAtelier.nbrPlaces - (counts[i][1]) }</b>

					
							Places disponible :
							<b class="text-danger">${ unAtelier.nbrPlaces - (counts[i][1]) }</b>
					


					</p>
					<p class="card-text text-center">Statut :
				
							<b class="text-warning">${ unAtelier.statut }
								<i class="fa-solid fa-hourglass-start"></i>
							</b>
						</p>
						<button type="button" class="btn btn-lg btn-outline-secondary w-100 btn-sm" disabled>S'inscrire</button>
			
						<b class="text-success">${ unAtelier.statut }
							<i class="fa-solid fa-circle-check"></i>
						</b>
					</p>
			
						<a href="{{ path('app_planning_new_usager', {'atelier': atelier.id }) }}" class="btn btn-primary w-100 btn-sm">S'inscrire</a>
	
						<a href="{{ path('app_login') }}" class="btn btn-primary w-100 btn-sm ">S'inscrire</a>
	

					<b class="text-danger">${ unAtelier.statut }
						<i class="fa-solid fa-circle-xmark"></i>
					</b>
				</p>
			<hr class="text-primary"></div>
	</div>
  

`

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
  
  const resp = await fetch('http://127.0.0.1:8000/atelier/api/atelier');
  ateliers = await resp.json();
  console.log(ateliers);

  //   afficheLesAteliers(ateliers);
  afficheDataListAtelier(ateliers);
 
})();


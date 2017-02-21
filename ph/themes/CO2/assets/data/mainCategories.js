var mainCategories = {
		
		"loisir" : { 
			"color" : "lightblue",
			"items" : [ { name: "Actualité", 			faIcon: "newspaper-o" }, 
						{ name: "Météo", 				faIcon: "sun-o" }, 
						{ name: "TV", 					faIcon: "television" }, 
						{ name: "Cinémas", 				faIcon: "film"},
						{ name: "Sorties", 				faIcon: "ticket fa-rotate-90",
							keywords: ["sortir", "concert", "théâtre", "culture", "restaurant"]
						},
						{ name: "Tourisme", 			faIcon: "plane",
							keywords: ["hotel", "gite", "sortie", "guide", "auberge", "voiture", "transport"]
						},
						{ name: "Bar réstaurants", 		faIcon: "glass"},
						{ name: "E-boutiques", 			faIcon: "shopping-cart",
							keywords: ["market", "shop", "vêtement", "chaussure", "bio", "jouet", "accessoire"]
						},
						
					  ]
		},
		"pratique" : {
			"color" : "lightblue",
			"items" : [ { name: "Scolaire", 			faIcon: "graduation-cap" ,
							keywords: ["univ", "bibliothèque", "médiathèque", "documentation", "formation", "école"]
						}, 
						{ name: "Logement",  			faIcon: "building-o",
							keywords: ["BienMeLoger", "SIC", "aide au logement", "agence"]}, 
						{ name: "Véhicules",  			faIcon: "car",
							keywords: ["achat", "vente", "location", "garage", "pièce", "casse", "immatriculation", "assurance"]
						}, 

						{ name: "Télécom", 				faIcon: "volume-control-phone"}, 
						{ name: "Transport en commun",  faIcon: "bus"},
						{ name: "Petites annonces",  	faIcon: "tag",
							keywords: ["annonce", "auto", "pièce auto", "immobilier", "embauche"]
						}, 
						{ name: "Radios", 				faIcon: "microphone" }, 
						{ name: "Administrations",  	faIcon: "id-card",
							keywords: ["impot", "fisc", "développement", "entreprise", 
										"logement", "province", "congrès", "compétence", "service", "agriculture", "commune", "etat"]
						}, 

						{ name: "Banques",  			faIcon: "dollar"}, 
						{ name: "Santé",  				faIcon: "medkit"}, 
						{ name: "Travail",  			faIcon: "briefcase",
							keywords: ["emplois", "formation", "administration", "metier", "interim", "recrutement", "patente"]
						}, 
						{ name: "Entreprises",  		faIcon: "industry"},  
						{ name: "Culture",  			faIcon: "book"}, 
						{ name: "Petite enfance",  		faIcon: "child"}, 
						{ name: "Organismes",  			faIcon: "certificate",
							keywords: ["recrutement", "recherche", "institut", "recyclage", "agriculture", 
										"société", "province", "entreprise", "technologique", "interim", "immo"]
						}, 
						{ name: "Services en ligne",  	faIcon: "flash"}, 
					  ]
		},
		"verte" : {
			"color" : "green",
			"items" : [ { name: "Association",  		faIcon: "group"}, 
						{ name: "Environnement",  		faIcon: "globe"}, 
						{ name: "Artistes",  			faIcon: "diamond"}, 
						{ name: "Éco-conso",  			faIcon: "shopping-cart"}, 
					  ]
		}
	};

	/*
	1 don de 10 000 CFP == 1 journée de publicité
	1 don de 50 000 CFP == 1 semaine de publicité
	1 don de 150 000 CFP == 1 mois de publicité
	*/
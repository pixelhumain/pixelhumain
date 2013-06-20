pixelhumain Version 0.01
===========

##Architecture KISS

*Serveur : Php 
    ** open source
    ** souplesse
    ** language populaire donc plus suceptible d'interresser les devs
*BDD : MongoDB hébergé chez MongoLab 
    ** souplesse noSQL
    ** s'adapte a tout les languages actuels
    ** simplicité de lecture et d'utilisation


##Structure DB 

on a une collection 'france'
qui contient chaque : 
* région referencé par son indicatif ex : 974 pour la Réunion
* commune referencé par son codepostal ex : 97421 pour la Rivière

une commune est décrite comme cela 
automatiquement rempli (en parti) en recuperant directement les infos chez wikipedia 
``` json
{
    "_id": {
        "$oid": "51bf6fd9e4b029a28a55bfb3"
    },
    "name": "Bras-Panon",
    "pays": " France ",
    "région": "La Réunion",
    "département": "La Réunion",
    "arrondissement": "Saint-Benoît",
    "canton": "Bras-Panon",
    "intercommunalité": "CIREST",
    "maire": "Daniel Gonthier 2008 - 2014",
    "codepostal": "97412",
    "codecommune": "97402",
    "gentilé": "Panonnais",
    "populationmunicipale": "11 725 hab. (2010)",
    "densité": "132 hab./km2 ",
    "coordonnées": "20° 59' 43'' S 55° 40' 34'' E / -20.9953, 55.6761 / -20.9953; 55.6761 20° 59' 43'' Sud 55° 40' 34'' Est / -20.9953, 55.6761 / -20.9953; 55.6761 ",
    "altitude": "Min. 0 m – Max. 2 092 m ",
    "superficie": "88,55 km2 ",
    "imgGeo": "http://upload.wikimedia.org/wikipedia/commons/thumb/e/e7/R%C3%A9union-Bras-Panon.png/280px-R%C3%A9union-Bras-Panon.png",
    "imgLogo": "http://upload.wikimedia.org/wikipedia/fr/thumb/f/f0/Logo-Bras-Panon.jpg/80px-Logo-Bras-Panon.jpg",
    "imgValo": "img/region/974/brasPanon/Trou-de-Fer.jpg",
    "activity": "camping climbing fishing swimming",
    "geoPosition": "northeast"
}
```
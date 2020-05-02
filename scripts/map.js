/**
 * Project  : Capteur ACMP
 * Date     : 25/05/2020
 * Autor    : CARDINAL Florian
 * Nom      : map.js
 * Location : /assets/scripts/
 */

function mapInit() {
	// Connexion au service Here
	const platform = new H.service.Platform({
		apikey: "MrQdjSM58WPTG8w0Blb7-CiGBPquXZLKfpwVNzI6zcQ"
	});

	// Création des constante pour l'apparence et les coordonnées
	const defaultLayers = platform.createDefaultLayers();
	const pos = {
		toulouse: { // Coordonnée de la ville
			lat: 43.60226,
			lng: 1.44548
		},
		deodat: { // Coordonnée du Lyçée
			lat: 43.5904,
			lng: 1.4257
		}
	};

	// Affichage des coordonnées dans la console debug
	console.table(pos);

	// Création de la map avec l'api et le sélecteur jQuery
	const map = new H.Map(
		$('#map')[0], // Sélecteur JQuery pour l'affichage
		defaultLayers.vector.normal.map, // Apparence
		{ zoom: 13, center: pos.toulouse } // Position & Zoom
	);

	// Création de l'interface utilisateur de la map
	var ui = H.ui.UI.createDefault(map, defaultLayers);

	// Affichage des événement de la map (traffic, travaux, etc...)
	var mapEvents = new H.mapevents.MapEvents(map);

	// Activation du comportement de la map (déplacement, zoom, etc...)
	var behavior = new H.mapevents.Behavior(mapEvents);

	// Placement du marqueur sur déodat
	var posMarker = new H.map.Marker(pos.deodat);
	map.addObject(posMarker);
}

/**
 * END
 */

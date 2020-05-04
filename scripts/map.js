/**
 * Autor    : CARDINAL Florian
 * Project  : Capteur ACMP
 * Date     : 25/05/2020
 * Location : /scripts/
 * Nom      : map.js
 */

"use strict";

/**
 * Display a map
 * @param {object} box html object to display
 * @param {array} data array of json data captor
 */
function mapInit(box, data) {
 	let icon = {
		broadcast: new H.map.Icon("/assets/img/broadcast.png", { size: { w: 30, h: 45 }}),
		location: new H.map.Icon("/assets/img/location.png", { size: { w: 30, h: 45 }})
	};

	// Création des constante pour l'apparence et les coordonnées
	let defaultLayers = platform.createDefaultLayers();
	let pos = {
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
	let map = new H.Map(
		box[0], // Sélecteur JQuery pour l'affichage
		defaultLayers.vector.normal.map, // Apparence
		{ zoom: 13, center: pos.toulouse } // Position & Zoom
	);

	// Création de l'interface utilisateur de la map
	let ui = H.ui.UI.createDefault(map, defaultLayers);

	// Affichage des événement de la map (traffic, travaux, etc...)
	let mapEvents = new H.mapevents.MapEvents(map);

	// Activation du comportement de la map (déplacement, zoom, etc...)
	let behavior = new H.mapevents.Behavior(mapEvents);

	// Placement du marqueur sur déodat
	let posMarker = new H.map.Marker(pos.deodat, { icon: icon.broadcast });
	map.addObject(posMarker);

	data.forEach((item) => {
		let posMarker = new H.map.Marker({
			lat: item.lat,
			lng: item.lon
		}, { icon: icon.location });

		map.addObject(posMarker);
	})
}

/**
 * END
 */

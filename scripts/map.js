/**
 * Autor    : CARDINAL Florian
 * Project  : Capteur ACMP
 * Date     : 25/05/2020
 * Location : /scripts/
 * Nom      : map.js
 */

"use strict";

function mapLink(href) {
	$("section").load(`/${href.split("#")[1]}`);
}

/**
 * Add a Dynamic Marker on Map
 * @param {object} group js object of Group Map
 * @param {object} coord position to show Info Bubble
 * @param {object} icon marker design
 * @param {string} content html content of Info Bubble
 */
function addMarker(group, coord, icon, content) {
	let marker = new H.map.Marker(coord, { icon: icon });
	marker.setData(content);
	group.addObject(marker);
}

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

	let map = new H.Map(
		box[0],
		defaultLayers.vector.normal.map,
		{
			zoom: 13,
			center: pos.toulouse
		}
	);

	let group = new H.map.Group();
	let ui = H.ui.UI.createDefault(map, defaultLayers);
	let mapEvents = new H.mapevents.MapEvents(map);
	let behavior = new H.mapevents.Behavior(mapEvents);

	map.addObject(group);

	group.addEventListener('tap', (evt) => {
		var bubble = new H.ui.InfoBubble(evt.target.getGeometry(), {
			content: evt.target.getData()
		});

		ui.addBubble(bubble);
	}, false);

	let content = [
		'<div style="width: 15em">',
			'<a href="https://deodat.mon-ent-occitanie.fr/" target="_blank">Lycée Déodat de Séverac</a>',
		'</div>'
	].join('');
	addMarker(group, pos.deodat, icon.broadcast, content);

	data.forEach((item) => {
		let coord = {
			lat: item.lat,
			lng: item.lon
		};

		let content = [
			'<div style="width: 15em">',
				`<p>ID Capteur: ${item.id}</p>`,
				`<p>Puissance: ${item.rssi} dBm</p>`,
				`<p>Grandeur: ${item.name}</p>`,
				`<p>Valeur: ${item.value} ${item.unit}</p>`,
				`<p>Prise le: ${item.time}</p>`,
				`<p><a onclick="javascript:mapLink('#telemetry-${item.id}');" href="#telemetry-${item.id}">Télémétrie</a></p>`,
			'</div>'
		].join('');

		addMarker(group, coord, icon.location, content);
	});
}

/**
 * END
 */

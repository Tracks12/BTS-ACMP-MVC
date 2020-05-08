/**
 * Autor    : CARDINAL Florian
 * Project  : Capteur ACMP
 * Date     : 25/05/2020
 * Location : /scripts/
 * Nom      : map.js
 */

"use strict";

/**
 * Redirect URI from Map
 * @param {string} href URI Directory
 */
function mapLink(href) {
	document.location.hash = `telemetry-${href}`;
	$("section").load(`/${href}`);
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
		marker: new H.map.Icon("/assets/img/marker.png", { size: { w: 30, h: 45 }})
	};

	let defaultLayers = platform.createDefaultLayers();
	let pos = {
		toulouse: { // Coordonnée de la ville
			lat: 43.60226,
			lng: 1.44548
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
		let bubble = new H.ui.InfoBubble(evt.target.getGeometry(), {
			content: evt.target.getData()
		});

		ui.addBubble(bubble);
	}, false);

	data.forEach((item) => {
		item.time = new Date(item.time);
		item.time = `${item.time.toLocaleDateString()} à ${item.time.toLocaleTimeString()}`;

		let content = [
			'<div class="mapInfoBox">',
				`<p>ID Capteur: ${item.id}</p>`,
				`<p>Puissance: ${item.rssi} dBm</p>`,
				`<p>Grandeur: ${item.name}</p>`,
				`<p>Valeur: ${parseFloat(item.value)} ${item.unit}</p>`,
				`<p>Prise le: ${item.time}</p>`,
				`<p><a class="button" onclick="javascript:mapLink('${item.id}');">Télémétrie</a></p>`,
			'</div>'
		].join('');

		addMarker(
			group,
			{
				lat: item.lat,
				lng: item.lon
			},
			icon.marker,
			content
		);
	});
}

/**
 * END
 */

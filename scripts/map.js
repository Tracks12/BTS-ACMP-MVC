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
		item.time = `${item.time.toLocaleDateString()} ${item.time.toLocaleTimeString()}`;

		let content = [
			'<div class="H_tib_content H_tib_content_captor">',
				'<div class="H_rdo_title">',
					`<h1>${item.name}</h1>`,
				'</div>',
				'<div class="H_tib_desc">',
					'<div class="H_tib_time">',
						'<span class="H_tib_left">id:</span>',
						`<span class="H_tib_right">${item.id}</span><br />`,
						'<span class="H_tib_left">signal:</span>',
						`<span class="H_tib_right"> ${item.rssi} dBm</span><br />`,
						'<span class="H_tib_left">valeur:</span>',
						`<span class="H_tib_right"> ${parseFloat(item.value)} ${item.unit}</span><br />`,
						'<span class="H_tib_left">date:</span>',
						`<span class="H_tib_right"> ${item.time}</span><br />`,
					'</div>',
					`<a class="button" onclick="javascript:mapLink('${item.id}');">télémétrie</a>`,
				'</div>',
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

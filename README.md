# Pollution sensor mapping

## [ACMP Project](http://92.222.109.216/)

BTS training project, a map displaying telemetry data from the LoraWan pollution sensor network provided by Tetaneutral.

> This is a redesign of the angular-based interface sensor project.

---

## Clone the repository

### Windows Users
* Download & Install [Git Bash](https://gitforwindows.org/)

### Linux Users
* Type `sudo apt install git` on your terminal

After Git installation type `git clone https://github.com/Tracks12/BTS-ACMP-MVC.git` to clone the repository.

After cloning the repository you need to create the database connection file in the `/core` directory which will be called `connect.php` with inside:

```php
<?php
	class bdd {
		public static function disconnect() {
			return self::$bdd['db'] = NULL;
		}

		public static function connect() {
			try {
				self::$bdd['db'] = new PDO(
					'mysql:host='.self::$bdd['host'].'; dbname='.self::$bdd['name'].'; charset='.self::$bdd['char'],
					self::$bdd['user'],
					self::$bdd['pass'],
					[ PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING ]
				);
			}

			catch(Exception $e) {
				die("[Err]:[{$e->getmessage()}]");
			}

			return self::$bdd['db'];
		}

		private static $bdd = [
			"db"   => NULL,
			"host" => "...",
			"name" => "...",
			"char" => "utf8",
			"user" => "...",
			"pass" => "...-"
		];
	}
```

---

## Dépendances

### Front (Styles & Scripts)
* [Here Map](https://developer.here.com/)
* [HighCharts 8.0.4](https://www.highcharts.com/blog/download/?_ga=2.170300512.1736851386.1588551901-428133042.1582636352)
* [JQuery 3.4.1](https://api.jquery.com/)
* [Font Awesome 4.7.0](https://fontawesome.com/v4.7.0/)

### Fonts
* [Lato](http://www.latofonts.com/lato-free-fonts/)
* [Monospace](https://fontmeme.com/polices/police-monospace/)
* [ROCKET](http://www.fontriver.com/font/rocket_wildness/)

---

## MVC Ressources

### Source files in `/core/`
* controllers ressources: `/core/controllers/`
* models ressources: `/core/models/`
* views ressources: `/core/views/`

### Routing
* HTTP Request: `/core/HTTPRoute.php`
* XHR Request: `/core/XHRRoute.php`

### Modules Annexes
* Data Base connexion: `/core/connect.php`
* Injection Verification & Protection: `/core/services.php`

---

## Views Ressources

### Telemetry

* real-time data: `/core/views/telemetry/instant.php`
Retrieves the last data from a desired sensor and displays it at a gauge in js

* story data: `/core/views/telemetry/story.php`
Displays graphs of pollution sensor data (Ozones, CO2, Fine Particles)

### Map

* sensor map: `/core/views/map.php`
Displays the pollution sensors on a Here map

---

## Routing

to add a new route you have to go to the `/core` directory, from there you will have access to the HTTP and XHR route.

### HTTP Route `/core/HTTPRoute.php`

A variable `$page` is used to choose the resource to display, by default, it has the value `index.php` to display the index

Add the redirection by putting the uri prefix in the `case ` /example':` box, then change the `$page' variable to display the desired resource (you can also do a redirection with a `header()`).

Don't forget to put `http_response_code(200)` to confirm the request, otherwise there will be a 404 error instead.

```php
// Default page to show
$page = 'index.php';

switch(services::isInput($_SERVER['REQUEST_URI'])) {
	/**
	 * Redirect URI
	 */

	case "/node-red": // Node Red UI Link
		header("location: http://{$_SERVER['HTTP_HOST']}:1880/");
		break;
	// ...

	case "/map": // About Page
		http_response_code(200);
		$page = 'map.php';
		break;

	case "/telemetry": // About Page
		http_response_code(200);
		$page = 'telemetry/telemetry.php';
		break;
	// ...
}
```

After that the resource requisition is done in a second switch.

```php
switch(http_response_code()) {
	case 200:
		require_once("./core/views/{$page}");
		break;

	case 403:
	case 404:
		require_once('./core/views/error.php');
		break;

	default:
		die();
		break;
}
```

The display of the page will be done on the front side by the XHR call thanks to the `.load()` function of JQuery in the `/scripts/main.js` using a dynamic uri

```html
<a href="#ressource-example">Ressource Example</a>
```

```js
$(document).ready(() => {
	let uri = window.location.hash.split('#')[1];
	uri = !uri ? 'map' : uri;
	$('section').load(`/${uri}`);
})
```

### XHR Route `/core/XHRRoute.php`

Same procedure as for HTTP, except that instead of putting resources, we call the controller directly.

```php
switch(services::isInput($_SERVER['REQUEST_URI'])) {
	case '/?ping':
		$return = [ "response" => "pong" ];
		break;

	default:
		http_response_code(404);
		$return = [ "code" => 404, "error" => "NOT FOUND !" ];
		break;
}
```

---

## Last Update

### May 4, 2020
* Update Map
* Update Graph
* Add New Models
* Add New Controllers
* Dynamic Nav Bar
* Script fixed
* Add Doc
* MVD Design

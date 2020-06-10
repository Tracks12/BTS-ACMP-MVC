# Pollution sensor mapping

## **[ACMP Project](http://92.222.109.216/)**
BTS training project, a map displaying telemetry data from the LoraWan pollution sensor network provided by Tetaneutral.

> This is a redesign of [BTS-ACMP-Captor-Interface](https://github.com/Tracks12/BTS-ACMP-Captor-Interface).

---

## **Clone the repository**

### Windows Users
* Download & Install [Git Bash](https://gitforwindows.org/)

### Linux Users
* Type `sudo apt install git` on your terminal

After Git installation type `git clone https://github.com/Tracks12/BTS-ACMP-MVC.git` to clone the repository.

### Database connection
After cloning the repository **you need to create the database connection file in the `/core` directory which will be called `connect.php` with inside**:

```php
class bdd {
	/**
	 * disconnect to the database
	 * @return void
	 */
	public static function disconnect(): void {
		self::$bdd['db'] = NULL;
		return;
	}

	/**
	 * connect to the database
	 * @return object[PDO] database object
	 */
	public static function connect(): PDO {
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

	// Data Base auth fields
	private static $bdd = [
		"db"   => NULL,
		"host" => "...",
		"name" => "...",
		"char" => "utf8",
		"user" => "...",
		"pass" => "..."
	];
}
```

**Don't forget to import the `capteur.sql` file into your database !**

---

## **Dependencies**

### Front (Styles & Scripts)
Librairies / API's | version
------------------ | -------
[Here Map](https://developer.here.com/) | /
[HighCharts](https://www.highcharts.com/blog/download/?_ga=2.170300512.1736851386.1588551901-428133042.1582636352) | 8.0.4
[JQuery](https://api.jquery.com/) | 3.4.1
[Font Awesome](https://fontawesome.com/v4.7.0/) | 4.7.0

### Fonts
* [Lato](http://www.latofonts.com/lato-free-fonts/)
* [Monospace](https://fontmeme.com/polices/police-monospace/)
* [ROCKET](http://www.fontriver.com/font/rocket_wildness/)

---

## **MVC Resources**

### Source files in `/core/`
* controllers resources: `/core/controllers/`
* models resources: `/core/models/`
* views resources: `/core/views/`

### Routing
* HTTP Request: `/core/HTTPRoute.php`
* XHR Request: `/core/XHRRoute.php`

### Modules Annexes
* Data Base connexion: `/core/connect.php`
* Injection Verification & Protection: `/core/services.php`

---

## **Views Resources**

### Telemetry
* **Real-time data**: `/core/views/telemetry/instant.html`, retrieves the last data from a desired sensor and displays it at a gauge in js
* **Story data**: `/core/views/telemetry/story.html`, displays graphs of pollution sensor data (Ozones, CO2, Fine Particles)

### Map
* **Sensor map**: `/core/views/map.html`, displays the pollution sensors on a Here map

### Administration
* **Captors manager**: `/core/views/admin/captors.html`, displays and manages the sensors inserted in the database
* **Users manager**: `/core/views/admin/users.html`, displays and manages user profiles in the database

---

## **Routing**

To add a new route you have to go to the `/core` directory, from there you will have access to the **HTTP and XHR route** (`HTTPRoute.php` & `XHRRoute.php`).

### HTTP Route `/core/HTTPRoute.php`

A variable `$page` is used to choose the resource to display, **by default, it has the value `index.php` to display the index**

Add the redirection by putting the uri prefix in the `case '/example':` box, then change the `$page` variable to display the desired resource (you can also do a redirection with a `header()`).

**Don't forget to put `http_response_code(200)` to confirm the request, otherwise there will be a 404 error instead.**

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

Same procedure as for HTTP, except that instead of putting resources, **we call the controller directly**.

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

And the query response appears in **JSON format**.

```php
switch(http_response_code()) {
	case 200:
		echo(json_encode($return));
		break;

	default:
		echo(json_encode($return));
		die();
		break;
}
```

And here is the **XHR request to place on the front side in `/scripts/xhr.js` to retrieve the information to exploit them**

```js
class xhr {
	/**
	 * ping the back side
	 */
	static ping() {
		return $.ajax({
			async: false,
			type: 'post',
			url: '/?ping',
			dataType: 'json',
		}).responseJSON.response;
	}
}
```

And call the request like this: `xhr.ping();`.

---

## **To do list**

- [x] **[@Laurent-Andrieu](https://github.com/Laurent-Andrieu)** in charge to establish the connection to the LoRaWan network
	- [x] Creating the LoRaWan profile
	- [x] Creation of the flow node red
	- [x] LoRaWan connection to the Node Red server
	- [x] Insertion of data in the database
	- [x] Creation of the node red UI


- [ ] **[@Tracks12](https://github.com/Tracks12)** in charge of setting up the web architecture and editing the cartography
	- [x] Implementation of the MVC architecture
	- [x] Integration of front-end dependencies
	- [x] Controllers, Models, Routes & Views creations (Map, Instant, Story)
	- [x] XHR query creation
	- [x] Editing the style sheet design
	- [x] Display of sensor positions on a map
	- [x] User Profile
	- [ ] Captor management
	- [ ] User management


- [x] **[@MENEGHE](https://github.com/MENEGHE)** in charge of installing and configuring the web server as well as managing access ports
	- [x] Fedora Server system installation
	- [x] Apache, MySQL, Php & PhpMyAdmin (LAMPP) installation
	- [x] Ports configuration
	- [x] Display historical curves


- [x] **[@Flopicx](https://github.com/Flopicx)** in charge of installing and creating the database
	- [x] Database building
	- [x] Edits of sql procedures
	- [x] Integration of ROT13 function
	- [x] Display instant data gauge

---

## **Last Update**

### May 28, 2020
* Add Logger Requests
* Input XHR Request for views
* transforms all views on html content

### May 4, 2020
* Update Map
* Update Graph
* Add New Models
* Add New Controllers
* Dynamic Nav Bar
* Script fixed
* Add Doc
* MVC Design

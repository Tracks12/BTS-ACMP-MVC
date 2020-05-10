<!DOCTYPE html>
<!-- ERROR -->
<html lang="fr">
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="icon" type="image/ico" href="/assets/img/favicon.ico" />
		<style rel="stylesheet" type="text/css">
			:root { --bg: rgb(50, 50, 50); --color: rgb(235, 235, 235); }
			html { background: var(--bg); color: var(--color); height: 100%; width: 100%; }
			#console { background: rgb(0, 0, 0, .75); border-radius: 3px; height: 20em; left: 50%; overflow: hidden; position: fixed; top: 50%; transform: translate(-50%, -50%); width: 30em; }
			#console > p { background: var(--color); color: var(--bg); display: block; font-family: sans-serif; height: 1em; margin: 0; padding: .5em; text-align: center; }
			#console > #prompt { bottom: 0; overflow: auto; position: absolute; top: 2em; width: 100%; }
			#console > #prompt > pre { margin: 0; padding: 1em; white-space: pre-wrap; }
			#console > #prompt > pre li { list-style-type: none; }
			#console > #prompt > pre a { color: currentColor; }
			#console > #prompt > pre .bold { font-weight: bold; }
			#console > #prompt > pre .warn { color: #EE0000; text-transform: uppercase; }
			#console > #prompt > pre .green { color: #00EE00; }
			#console > #prompt > pre .blue { color: #0000EE; }
			#console > #prompt > pre .purple { color: #EE00EE; }
			@media(max-width: 720px) { #console { bottom: 1em; height: auto; left: 1em; right: 1em; top: 1em; transform: none; width: auto; }}
		</style>
		<script language="javascript" type="text/javascript" src="/scripts/jquery-3.4.1.min.js"></script>
		<script language="javascript" type="text/javascript">
			const audio = new Audio();
			audio.src = "/assets/sounds/angryCat.mp3";

			$(document).ready(() => {
				let count = parseInt($("#timer").text());

				$('#angryCat')
					.css({ background: 'url(/assets/img/angryCat.png) center / contain no-repeat', backgroundAttachement: 'cover', borderRadius: '100%', height: '15em', margin: 0, padding: 0, position: 'fixed', width: '15em' })
					.click(function() {
						$(this)
							.css({ right: 'inherit' })
							.animate({ right: 0, deg: 90 }, { duration: 800, step: (now) => $(this).css({ transform: `rotate(${now}deg)` }) })
							.animate({ bottom: 0, deg: 180 }, { duration: 800, step: (now) => $(this).css({ transform: `rotate(${now}deg)` }) })
							.animate({ left: 0, deg: 270 }, { duration: 800, step: (now) => $(this).css({ transform: `rotate(${now}deg)` }) })
							.animate({ top: 0, deg: 360 }, { duration: 800, step: (now) => $(this).css({ transform: `rotate(${now}deg)` }) })
							.css({ bottom: 'inherit', left: 'inherit', top: 'inherit', });

						audio.play();
					});

				let timer = setInterval(() => {
					count--;
					$("#timer").text(count);

					if(!count) {
						clearInterval(timer);
						window.location.href = $('#redirect').text();
					}
				}, 1000);
			});
		</script>
	</head>
	<body>
		<figure id="angryCat"></figure>
		<div id="console">
			<p>ACMP - console</p>
			<div id="prompt">
				<pre><?php
					$cursor = '<span class="bold"><span class="green">acmp@acmp</span>:<span class="blue">~</span>$</span>';

					$HTTPResponse = [
						'code' => http_response_code(),
						'note' => strtoupper('server error'),
						'todo' => strtoupper('redirect to index')
					];

					switch($HTTPResponse['code']) {
						case 403: $HTTPResponse['note'] = strtoupper('unauthorized access'); break;
						case 404: $HTTPResponse['note'] = strtoupper('not found'); break;
					}

					$consolePrompt = [
						"$cursor {$_SERVER['REQUEST_METHOD']} {$_SERVER['REQUEST_URI']}\n\n",
						"[<span class='warn'>error</span>]\n\n",
						"[<span class='purple'>code</span>]:[{$HTTPResponse['code']}]\n",
						"[<span class='purple'>note</span>]:[{$HTTPResponse['note']}]\n",
						"[<span class='purple'>todo</span>]:[{$HTTPResponse['todo']}]\n\n",
						"You will be redirect to <a id='redirect' href='/'>http://{$_SERVER['HTTP_HOST']}/</a> in <span id='timer'>10</span> sec\n",
					];

					foreach($consolePrompt as $prompt)
						echo("$prompt");
				?></pre>
			</div>
		</div>
	</body>
</html>
<!-- END -->

<!DOCTYPE html>
<!-- ERROR -->
<html lang="fr">
	<head>
		<style rel="stylesheet" type="text/css">
			html { background: rgb(50, 50, 50); color: rgb(235, 235, 235); }
			#console { background: rgb(0, 0, 0, .25); border-radius: 3px; height: 20em; left: 50%; overflow: hidden; position: fixed; top: 50%; transform: translate(-50%, -50%); width: 30em; }
			#console > p { background: rgb(235, 235, 235); color: rgb(50, 50, 50); display: block; font-family: sans-serif; height: 1em; margin: 0; padding: .5em; text-align: center; }
			#console > #prompt { bottom: 0; overflow: auto; position: absolute; top: 2em; width: 100%; }
			#console > #prompt pre { margin: 0; padding: 1em; }
			#console > #prompt > pre a { color: currentColor; }
			#console > #prompt > pre .bold { font-weight: bold; }
			#console > #prompt > pre .warn { color: #EE0000; text-transform: uppercase; }
			#console > #prompt > pre .green { color: #00EE00; }
			#console > #prompt > pre .blue { color: #0000EE; }
			#console > #prompt > pre .purple { color: #EE00EE; }
		</style>
		<script language="javascript" type="text/javascript" src="/scripts/jquery-3.4.1.min.js"></script>
		<script language="javascript" type="text/javascript">
			$(document).ready(() => {
				let count = parseInt($("#timer").text());

				let timer = setInterval(() => {
					count--;
					$("#timer").text(count);

					if(!count) {
						clearInterval(timer);
						//window.location.href = $('#redirect').text();
						window.location.href = "/x";
					}
				}, 1000);
			});
		</script>
	</head>
	<body>
		<div id="console">
			<p>ACMP - console</p>
			<div id="prompt">
				<pre><?php
					$cursor = '<span class="bold"><span class="green">acmp@acmp</span>:<span class="blue">~</span>$</span>';

					$HTTPResponse = [
						'code' => http_response_code(),
						'note' => 'server error'
					];

					switch($HTTPResponse['code']) {
						case 403: $HTTPResponse['note'] = 'unauthorized access'; break;
						case 404: $HTTPResponse['note'] = 'not found'; break;
					}

					$HTTPResponse['note'] = strtoupper($HTTPResponse['note']);

					$consolePrompt = [
						"$cursor GET {$_SERVER['REQUEST_URI']}\n\n",
						"[<span class='warn'>error</span>]\n\n",
						"[<span class='purple'>code</span>]:[{$HTTPResponse['code']}]\n",
						"[<span class='purple'>note</span>]:[{$HTTPResponse['note']}]\n\n",
						"You will be redirect to <a id='redirect' href='/'>http://{$_SERVER['HTTP_HOST']}/</a> in <span id='timer'>5</span> sec\n\n"
					];

					foreach($consolePrompt as $prompt)
						echo($prompt);
				?></pre>
			</div>
		</div>
	</body>
</html>
<!-- END -->

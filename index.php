<?php
define('API_KEY', '8d5305371596640df4aab65c6db928617611d93a');
define('API_SECRET', 'cb3ce7693fa4ae5ce6f9dc9955a7bd3e19d7b751');

$query = "http://api.thisismyjam.com/1/search/jam.json?by=artist&q=red+hot+chili+peppers&key=".API_KEY;

$data = json_decode(file_get_contents($query), true);

?>
<html>
<head>
	<title>Chili Jam</title>
	<link href="css/style.css" rel="stylesheet" type="text/css" />
</head>
<body>
	
	<div id="container">
		
	<h1>Chili Jam</h1>
	
	<ul class="jams">
	<?php
	foreach($data['jams'] as $jam) {	
		if ($jam['artist'] == "Red Hot Chili Peppers") {
			
			?>
			<li style="background-image: url('<?php echo $jam['background']; ?>')">
			
				<div class="title"><?php echo $jam['title']; ?></div>
				
				<div class="player">

				<?php
				if ($jam['via'] == 'youtube') {
					$videoId = array_pop(explode('=', $jam['viaUrl']));
					?>

						<iframe id="player" type="text/html" width="640" height="360"
						  src="http://www.youtube.com/embed/<?php echo $videoId; ?>?enablejsapi=1&origin=http://chilijam.iainmullan.com"
						  frameborder="0"></iframe>

					<?php
					
				} else if ($jam['via'] == 'vimeo') {
					$videoId = array_pop(explode('/', $jam['viaUrl']));
					
					?>
					<iframe src="http://player.vimeo.com/video/<?php echo $videoId; ?>" width="640" height="360" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>						
					<?php
				}
				?>
				</div>
				
			</li>
			<?php		
		}
	}
	?>
	</ul>
	
	</div>
	
</body>
</html>

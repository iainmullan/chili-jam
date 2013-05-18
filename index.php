<?php
define('API_KEY', '8d5305371596640df4aab65c6db928617611d93a');
define('API_SECRET', 'cb3ce7693fa4ae5ce6f9dc9955a7bd3e19d7b751');

$query = "http://api.thisismyjam.com/1/search/jam.json?by=artist&q=red+hot+chili+peppers&key=".API_KEY;

$data = json_decode(file_get_contents($query), true);

?>
<html>
<head>
	<title>Chili Jam</title>
	<link href="css/reset.css" rel="stylesheet" type="text/css" />
	<link href="css/style.css" rel="stylesheet" type="text/css" />
	
	<meta property="fb:admins" content="714655333" />
	<meta property="og:title" content="Chili Jam" />
	<meta property="og:description" content="A Red Hot Chili Peppers flavoured hack by Iain Mullan" />
	<meta property="og:image" content="http://chilijam.iainmullan.com/img/chili-jam.jpg" />

	<meta property="og:url" content="http://chilijam.iainmullan.com/" />
	<meta property="og:type" content="website" />
</head>
<body>
	<div id="fb-root"></div>
	
	<div id="social" style="margin-top: 3px">
		<div class="fb-like" data-href="http://chilijam.iainmullan.com" data-send="false" data-layout="button_count" data-width="450" data-show-faces="false"></div>
		<div style="display:inline; margin-top: 5px;"><a href="https://twitter.com/share" class="twitter-share-button" data-url="http://chilijam.iainmullan.com" data-related="iainmullan">Tweet</a></div>

	</div>
	
	<div id="container">
		
		<div id="header">
			<h1><img src="img/header.jpg" alt="Chili Jam" width="640" height="91" /></h1>
		</div>
	
		<ul class="jams">
		<?php
		foreach($data['jams'] as $jam) {

			$classes = $jam['via'];
			$isChili = false;
		
			if ($jam['artist'] == "Red Hot Chili Peppers") {
				$isChili = true;
				$classes .= ' chili';
			}
		
			?>
			<li style="background-image: url('<?php echo $jam['background']; ?>')" class="<?php echo $classes; ?>">
			
				<div class="title"><?php echo $jam['title']; ?></div>
			
				<div class="player">
					<?php
					if ($isChili) {
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
					}			
					?>
				</div>

				<div class="title"><?php echo $jam['title']; ?></div>
				<div class="artist"><?php echo $jam['artist']; ?></div>

				<div class="via">via <?php echo $jam['via']; ?></div>
			</li>
			<?php		
		}
		?>
		</ul>
	
		<div id="footer">
			A Red Hot Chili Peppers flavoured hack by <a href="http://www.iainmullan.com" target="_blank">Iain Mullan</a>, powered by <a href="Http://www.thisismyjam.com" target="_blank">This Is My Jam</a>
		</div>
		
	</div>

	
	<script>(function(d, s, id) {
	  var js, fjs = d.getElementsByTagName(s)[0];
	  if (d.getElementById(id)) return;
	  js = d.createElement(s); js.id = id;
	  js.src = "//connect.facebook.net/en_GB/all.js#xfbml=1&appId=568418229846948";
	  fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));</script>

	<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>

	<script type="text/javascript">

	  var _gaq = _gaq || [];
	  _gaq.push(['_setAccount', 'UA-323014-32']);
	  _gaq.push(['_trackPageview']);

	  (function() {
	    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
	    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
	    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
	  })();

	</script>

</body>
</html>

<?php
define('ROOT', dirname(__FILE__));
define('API_KEY', '8d5305371596640df4aab65c6db928617611d93a');
define('API_SECRET', 'cb3ce7693fa4ae5ce6f9dc9955a7bd3e19d7b751');
require 'classes/timj.php';

$api = new Timj(API_KEY, API_SECRET);
$data = $api->search();

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
		<a href="http://twitter.com/iainmullan" class="twitter-follow-button" data-show-count="false">Follow @iainmullan</a>
	</div>

	<div id="container">

		<div id="header">
			<h1><img src="img/header.jpg" alt="Chili Jam" width="640" height="91" /></h1>
			<div id="footer">
				A Red Hot Chili Peppers flavoured hack by <a href="http://www.iainmullan.com" target="_blank">Iain Mullan</a>, powered by <a href="Http://www.thisismyjam.com" target="_blank">This Is My Jam</a>
			</div>
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

				<?php $date = strtotime($jam['creationDate']); ?>
				<div class="author">
					Jammed by <a href="http://thisismyjam.com/<?php echo $jam['from']; ?>" target="_blank"><?php echo $jam['from']; ?></a>
					on <a href="<?php echo $jam['url']; ?>" target="_blank"><?php echo date('l', $date)." at ".date('g:ia', $date); ?></a>
				</div>

				<div class="title"><?php echo $jam['title']; ?></div>
				<div class="artist"><?php echo $jam['artist']; ?></div>

				<div class="via">via <?php echo $jam['via']; ?></div>
			</li>
			<?php
		}
		?>
		</ul>


	</div>


	<script>(function(d, s, id) {
	  var js, fjs = d.getElementsByTagName(s)[0];
	  if (d.getElementById(id)) return;
	  js = d.createElement(s); js.id = id;
	  js.src = "//connect.facebook.net/en_GB/all.js#xfbml=1&appId=568418229846948";
	  fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));</script>

	<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>

	<script>
	  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

	  ga('create', 'UA-323014-33', 'iainmullan.com');
	  ga('send', 'pageview');

	</script>


</body>
</html>

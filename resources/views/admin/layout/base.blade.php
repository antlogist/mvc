<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<title>Admin panel - @yield("title")</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="/css/all.css">
</head>

<body>

	<div class="off-canvas position-left reveal-for-large" id="offCanvas" data-off-canvas>

		<!-- Menu -->
		<ul class="vertical menu">
			<li><a href="#">Foundation</a></li>
			<li><a href="#">Dot</a></li>
			<li><a href="#">ZURB</a></li>
			<li><a href="#">Com</a></li>
			<li><a href="#">Slash</a></li>
			<li><a href="#">Sites</a></li>
		</ul>

	</div>

	<div class="off-canvas-content" data-off-canvas-content>
		@yield("content")
	</div>


	<script src="/js/all.js"></script>
</body>

</html>

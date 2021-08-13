<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<title>Admin panel - @yield("title")</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="./public/css/all.css">
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
		<div class="title-bar">
			<div class="title-bar-left">
				<button class="menu-icon hide-for-large" type="button" data-open="offCanvas"></button>
				<span class="title-bar-title">{{ $_SERVER["APP_NAME"] }}</span>
			</div>
		</div>

		@yield("content")
	</div>


	<script src="./public/js/all.js"></script>
</body>

</html>

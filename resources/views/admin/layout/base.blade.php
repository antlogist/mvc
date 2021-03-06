<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<title>Admin panel - @yield("title")</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="<?php echo $_SERVER["APP_URL"] ?>/public/css/all.css">
	<script src="https://use.fontawesome.com/bd91b9f588.js"></script>
</head>

<body data-page-id="@yield('data-page-id')">

	@include("includes/admin-sidebar")

	<div class="off-canvas-content admin_title_bar" data-off-canvas-content>
		<div class="title-bar">
			<div class="title-bar-left">
				<button class="menu-icon hide-for-large" type="button" data-open="offCanvas"></button>
				<span class="title-bar-title">{{ $_SERVER["APP_NAME"] }}</span>
			</div>
		</div>

		@yield("content")
	</div>


	<script src="<?php echo $_SERVER["APP_URL"] ?>/public/js/all.js"></script>
</body>

</html>

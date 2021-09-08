<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>MVC Store - @yield("title")</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="<?php echo $_SERVER["APP_URL"] ?>/public/css/all.css">
  <script src="https://cdn.jsdelivr.net/npm/vue@2"></script>
  <script src="https://use.fontawesome.com/bd91b9f588.js"></script>
</head>

<body data-page-id="@yield('data-page-id')">


  @yield("body")


  <script src="<?php echo $_SERVER["APP_URL"] ?>/public/js/all.js"></script>
</body>

</html>

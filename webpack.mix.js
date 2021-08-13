const mix = require("laravel-mix");

//Compile SASS in CSS
mix.sass("resources/assets/sass/app.scss", "resources/assets/css");

//Combine CSS files
mix.combine([
  "resources/assets/css/app.css",
  "resources/assets/bower/vendor/slick-carousel/slick/slick.css"
], "public/css/all.css");

//Combine JS files
const bower = "resources/assets/bower/vendor";
mix.scripts([
  bower + "/jquery/dist/jquery.min.js",
  bower + "/foundation-sites/dist/js/foundation.min.js",
  bower + "/slick-carousel/slick/slick.min.js",
	"resources/assets/js/*.js"
], "public/js/all.js");

(function () {
  "use strict";

  $(document).foundation();

  $(document).ready(function () {
    //Switch pages
    switch ($("body").data("page-id")) {
      case "home":
        MVCSTORE.homeslider.initCarousel();
      case "adminProduct":
        MVCSTORE.admin.changeEvent();
        MVCSTORE.admin.delete();
      case "adminCategories":
        MVCSTORE.admin.update();
        MVCSTORE.admin.delete();
        MVCSTORE.admin.create();
        break;
      default:
        //do nothing
    }
  });
})();

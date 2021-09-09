(function () {
  "use strict";

  $(document).foundation();

  $(document).ready(function () {
    //Switch pages
    switch ($("body").data("page-id")) {
      case "home":
        MVCSTORE.homeslider.initCarousel();
        MVCSTORE.homeslider.homePageProducts();
      case "product":
        MVCSTORE.product.details();
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

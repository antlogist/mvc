(function () {
  "use strict";

  $(document).foundation();

  $(document).ready(function () {
    //Switch pages
    switch ($("body").data("page-id")) {
      case "home":
        MVCSTORE.homeslider.initCarousel();
        MVCSTORE.homeslider.homePageProducts();
        break;
      case "product":
        MVCSTORE.product.details();
        break;
      case "cart":
        MVCSTORE.product.cart();
        break;
      case "adminProduct":
        MVCSTORE.admin.changeEvent();
        MVCSTORE.admin.delete();
        break;
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

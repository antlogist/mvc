(function () {
  "use strict";

  $(document).foundation();

  $(document).ready(function () {
    //Switch pages
    switch ($("body").data("page-id")) {
      case "home":
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

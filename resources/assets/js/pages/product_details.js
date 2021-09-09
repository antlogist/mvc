(function() {
  "use strict";
  
  MVCSTORE.product.details = function() {
    const app = new Vue({
      el: "#product",
      data: {
        product: [],
        category: [],
        subCategory: [],
        productId: $("#product").data("id"),
        loading: false
      }
    });
  }
  
})();
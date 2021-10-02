(function() {
  "use strict";

  MVCSTORE.product.cart  = function() {
    const app = new Vue({
      el: "#shopping_cart",
      data: {
        items: [],
        cartTotal: [],
        loading: false,
        fail: false,
        message: ""
      }
    });
  };
})();
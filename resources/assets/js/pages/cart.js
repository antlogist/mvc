(function() {
  "use strict";

  MVCSTORE.product.cart  = function() {
    const app = new Vue({
      el: "#shoppingCart",
      data: {
        items: [],
        cartTotal: [],
        loading: false,
        fail: false,
        message: ""
      },
      methods: {
        displayItems() {
          this.loading = true;
          setTimeout(function() {
            axios.get("/mvc/cart/items").then(function(response) {
              if(response.data.fail) {
                app.fail = true;
                app.message = response.data.fail;
                app.loading = false;
              } else {
                app.items = response.data.items;
                app.cartTotal = response.data.cartTotal;
                app.loading = false;
              }
            })
          }, 2000);
        },
        updateQuantity(product_id, operator) {
          alert(product_id + " " + operator);
        }
      },
      created() {
        this.displayItems();
      }
    });
  };
})();
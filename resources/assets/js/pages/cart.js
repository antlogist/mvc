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
        authenticated: false,
        message: ""
      },
      methods: {
        displayItems(time) {
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
                app.authenticated = response.data.authenticated;
              }
            })
          }, time);
        },
        updateQuantity(product_id, operator) {
          const postData = $.param({ product_id: product_id, operator: operator });
          axios.post("/mvc/cart/update-qty", postData).then(function(response) {
            app.displayItems(200);
          });
        },
        removeItem(index) {
          const postData = $.param({ item_index: index });
          axios.post("/mvc/cart/remove-item", postData).then(function(response) {
            $(".notify").css("display", "block").delay(4000).slideUp(300).html(response.data.success);
            app.displayItems(200);
          });
        },
        emptyCart() {
          const postData = $.param({ empty_cart: true });
          axios.post("/mvc/cart/empty", postData).then(function(response) {
            $(".notify").css("display", "block").delay(4000).slideUp(300).html(response.data.success);
            app.displayItems(200);
          });
        }
      },
      created() {
        this.displayItems(2000);
      }
    });
  };
})();
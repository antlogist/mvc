(function() {
  "use strict";

  MVCSTORE.products.showAll = function () {
    const app = new Vue({
      el: "#root",
      data: {
        products: [],
        count: 0,
        loading: false
      },
      methods: {
        getProducts: function() {
          this.loading = true;
          axios.get('/mvc/get-products').then(function(response){
            app.products = response.data.products;
            app.count = response.data.count;
            app.loading = false;
          });
        },
        loadMoreProducts: function () {
          const token = $(".display-products").data("token");
          this.loading = true;
          const data = $.param({
            next: 2,
            token: token,
            count: app.count
          });
          axios.post("/mvc/product/load-more", data).then(function (response) {
            app.products = response.data.products;
            app.count = response.data.count;
            app.loading = false;
          })
        },
        stringLimit: function (string, value) {
          return MVCSTORE.module.truncateString(string, value);
        },
      },
      created: function () {
        this.getProducts();
      },
      mounted: function() {
        $(window).scroll(function () {
          if($(window).scrollTop() + $(window).height() == $(document).height()) {
            app.loadMoreProducts();
          }
        })
      }
    })
  }
})();
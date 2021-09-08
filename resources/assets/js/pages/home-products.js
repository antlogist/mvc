(function () {
  "use strict";

  MVCSTORE.homeslider.homePageProducts = function () {
    const app = new Vue({
      el: "#root",
      data: {
        featured: [],
        products: [],
        count: 0,
        loading: false
      },
      methods: {
        getFeaturedProducts: function () {
          this.loading = true;
          axios.all([
            axios.get("/mvc/featured"), axios.get("/mvc/get-products")
          ]).then(axios.spread(function (featuredResponse, productsResponse) {
            app.featured = featuredResponse.data.featured;
            app.products = productsResponse.data.products;
            app.count = productsResponse.data.count;
            app.loading = false;
          }));
        },
        stringLimit: function (string, value) {
          if (string.length > value) {
            return string.substring(0, value) + '...';
          } else {
            return string;
          }
        }
      },
      created: function () {
        this.getFeaturedProducts();
      }
    });
  }
})();

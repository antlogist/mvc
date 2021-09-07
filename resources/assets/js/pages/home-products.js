(function () {
  "use strict";

  MVCSTORE.homeslider.homePageProducts = function () {
    const app = new Vue({
      el: "#root",
      data: {
        featured: [],
        loading: false
      },
      methods: {
        getFeaturedProducts: function () {
          this.loading = true;
          axios.get("/mvc/featured").then(function (response) {
            app.featured = response.data.featured;
            app.loading = false;
          })
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

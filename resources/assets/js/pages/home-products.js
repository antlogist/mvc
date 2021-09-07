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
        getFeaturedProducts: function() {
          this.loading = true;
          axios.get("/mvc/featured").then(function (response) {
            app.featured = response.data.featured;
            app.loading = false;
          })
        }
      },
      created: function() {
        this.getFeaturedProducts();
      }
    });
  }
})();

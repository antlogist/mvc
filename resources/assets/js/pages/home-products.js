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
            console.log(response.data);
          })
        }
      },
      created: function() {
        this.getFeaturedProducts();
      }
    });
  }
})();

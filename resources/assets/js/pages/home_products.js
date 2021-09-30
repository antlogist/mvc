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
          return MVCSTORE.module.truncateString(string, value);
        },
        addToCart: function(id) {
          MVCSTORE.module.addItemToCart(id, function(message) {
            $(".notify").css("display", "block").delay(4000).slideUp(300).html(message);
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
          axios.post("/mvc/load-more", data).then(function (response) {
            app.products = response.data.products;
            app.count = response.data.count;
            app.loading = false;
          })
        }
      },
      created: function () {
        this.getFeaturedProducts();
      },
      mounted: function () {
        $(window).scroll(function () {
          if($(window).scrollTop() + $(window).height() == $(document).height()) {
            app.loadMoreProducts();
          }
        })
      }
    });
  }
})();

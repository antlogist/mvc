(function () {
  "use strict";

  MVCSTORE.module = {
    truncateString: function limit(string, value) {
      if (string.length > value) {
        return string.substring(0, value) + '...';
      } else {
        return string;
      }
    },
    addItemToCart: function(id, callback) {
      let token = $(".display-products").data("token");
      if (token == null || !token)  {
        token = $(".product").data("token");
      }
      const postData = $.param({
        product_id: id,
        token: token
      });
      axios.post("/mvc/cart", postData).then(function(response) {
        callback(response.data.success);
      });
    }
  }
})();

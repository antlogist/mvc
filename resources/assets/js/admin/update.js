(function () {
  "use strict";

  ACMESTORE.admin.update = function () {
    // update product category
    $(".update-category").on("click", function (e) {
      e.preventDefault();
      const token = $(this).data("token");
      const id = $(this).attr("id");
      const name = $("#item-name-" + id).val();
      
      $.ajax({
        type: "POST",
        url: `/mvc/admin/product/categories/${id}/edit`,
        data: {
          token: token,
          name: name 
        },
          success: function (data) {
            const response = jQuery.parseJSON(data);
            $(".notification").css("display", "block").delay(4000).slideUp(300).html(response.success);
          },
          error: function (request, error) {
            const errors = jQuery.parseJSON(request.responseText);
            const ul = document.createElement("ul");
            $.each(errors, function (key, value) {
              const li = document.createElement("li");
              li.appendChild(document.createTextNode(value));
              ul.appendChild(li);
            })
            $(".notification").css("display", "block").delay(6000).slideUp(300).html(ul);
          }
      });
    })

  };
})();

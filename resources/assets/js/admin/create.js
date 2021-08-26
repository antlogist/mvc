(function () {
  "use strict";

  ACMESTORE.admin.create = function () {
    // update product category
    $(".add-subcategory").on("click", function (e) {
      e.preventDefault();
      const token = $(this).data("token");
      const category_id = $(this).attr("id");
      const name = $("#subcategory-name-" + id).val();

      $.ajax({
        type: "POST",
        url: `/mvc/admin/product/subcategory/create`,
        data: {
          token: token,
          name: name,
          category_id: category_id
        },
        success: function (data) {
          const response = jQuery.parseJSON(data);
          $(".notification").css("display", "block").removeClass("primary", "alert").addClass("success").delay(4000).slideUp(300).html(response.success);
        },
        error: function (request, error) {
          const errors = jQuery.parseJSON(request.responseText);
          const ul = document.createElement("ul");
          $.each(errors, function (key, value) {
            const li = document.createElement("li");
            li.appendChild(document.createTextNode(value));
            ul.appendChild(li);
          })
          $(".notification").css("display", "block").removeClass("primary", "success").addClass("alert").delay(6000).slideUp(300).html(ul);
        }
      });
    })

  };
})();

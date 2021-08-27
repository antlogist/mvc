(function () {
  "use strict";

  MVCSTORE.admin.update = function () {
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
    });
    
    // update subcategory
    $(".update-subcategory").on("click", function (e) {
      e.preventDefault();
      const token = $(this).data("token");
      const id = $(this).attr("id");
      const name = $("#item-subcategory-name-" + id).val();
      let category_id = $(this).data("category-id");
      const selected_category_id = $("#item-category-" + category_id + " option:selected").val();
      
      if (category_id !== selected_category_id) {
        category_id = selected_category_id;
      }
      
      $.ajax({
        type: "POST",
        url: `/mvc/admin/product/subcategory/${id}/edit`,
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
    });
    

  };
})();

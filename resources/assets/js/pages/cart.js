(function() {
  "use strict";

  MVCSTORE.product.cart  = function() {

    // const stripe = Stripe($('#properties').data('stripe-key'));
    // const elements = stripe.elements({
    //   locale: "auto",

    // })

    // const Stripe = StripeCheckout.configure({
    //   key: $('#properties').data('stripe-key'),
    //   locale: "auto",
    //   image: "",
    //   token: function (token) {
    //       const data = $.param({stripeToken: token.id, stripeEmail:token.email});
    //       axios.post('/cart/payment', data).then(function (response) {
    //           $(".notify").css("display", 'block').delay(4000).slideUp(300)
    //               .html(response.data.success);
    //           app.displayItems(200);
    //       }).catch(function (error) {
    //           console.log(error);
    //       })
    //   }
    // });

    const app = new Vue({
      el: "#shoppingCart",
      data: {
        items: [],
        cartTotal: 0,
        loading: false,
        fail: false,
        authenticated: false,
        message: "",
        amountInCents: 0
      },
      methods: {
        displayItems(time) {
          this.loading = true;
          setTimeout(function() {
            axios.get("/mvc/cart/items").then(function(response) {
              if(response.data.fail) {
                app.fail = true;
                app.message = response.data.fail;
                app.loading = false;
              } else {
                app.items = response.data.items;
                app.cartTotal = response.data.cartTotal;
                app.loading = false;
                app.authenticated = response.data.authenticated;
                app.amountInCents = response.data.amountInCents;
              }
            })
          }, time);
        },
        updateQuantity(product_id, operator) {
          const postData = $.param({ product_id: product_id, operator: operator });
          axios.post("/mvc/cart/update-qty", postData).then(function(response) {
            app.displayItems(200);
          });
        },
        removeItem(index) {
          const postData = $.param({ item_index: index });
          axios.post("/mvc/cart/remove-item", postData).then(function(response) {
            $(".notify").css("display", "block").delay(4000).slideUp(300).html(response.data.success);
            app.displayItems(200);
          });
        },
        emptyCart() {
          const postData = $.param({ empty_cart: true });
          axios.post("/mvc/cart/empty", postData).then(function(response) {
            $(".notify").css("display", "block").delay(4000).slideUp(300).html(response.data.success);
            app.displayItems(200);
          });
        },
        // async checkout2() {
          // alert("Stripe!!!")
          // stripe.open({
          //   name: "Podlesnyy, Inc.",
          //   description: "Shopping Cart Items",
          //   email: $('#properties').data('customer-email'),
          //   amount: app.amountInCents,
          //   zipCode: true
          // });
          // Call your backend to create the Checkout Session
          // const response = await fetch('/mvc/cart/create-checkout-session', { method: 'POST' });
          // const session = await response.json();

          // When the customer clicks on the button, redirect them to Checkout.
          // const result = await stripe.redirectToCheckout({
          //   sessionId: session.id,
          // });

          // if (result.error) {
          //   // If `redirectToCheckout` fails due to a browser or network
          //   // error, display the localized error message to your customer
          //   // using `result.error.message`.
          //   console.log(result.error);
          // }

        // },
        checkout() {
          const postData = $.param({

          });
          axios.post('/mvc/cart/create-checkout-session', "").then(function (response) {
            console.log(response["data"]);
            window.location.replace(response["data"]);
          }).catch(function (error) {
              console.log(error);
          })
        }
      },
      created() {
        this.displayItems(2000);
      }
    });
  };
})();
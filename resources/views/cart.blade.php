@extends("layouts.app")

@section("title", "Your shopping cart")

@section("data-page-id", "cart")

@section("content")
<div class="shopping_cart" id="shoppingCart">

  <div class="text-center">
    <i v-show="loading" class="fa fa-spinner fa-spin" style="font-size: 3rem; padding: 3rem; position: fixed; top: 40%; color: black;"></i>
  </div>

  <section v-if="loading === false" class="items" style="margin-top: 7rem;">
    <div class="grid-container">
      <div class="small-up-12">
        <h2 v-if="fail" v-text="message"></h2>
        <div v-else>
          <h2>Your cart</h2>
          <table class="hover unstriped">
            <thead class="text-left">
                <tr>
                    <th>#</th><th>Product Name</th>
                    <th>($) Unit Price</th> <th>Qty</th><th>Total</th> <th>Action</th>
                </tr>
            </thead>
            <tbody>
              <tr v-for="item in items">
                <td class="medium-text-center">
                  <a :href="'/mvc/product/' + item.id">
                      <img :src="'<?php echo $_SERVER["APP_URL"] ?>/public/' + item.image" height="60px" width="60px" alt="item.name">
                  </a>
                </td>

                <td>
                  <h5><a :href="'/mvc/product/' + item.id">@{{ item.name }}</a></h5>
                  Status:
                  <span v-if="item.stock > 1" style="color: #00AA00;">In Stock</span>
                  <span v-else style="color: #ff0000;">Out of Stock</span>
                </td>

                <td>@{{ item.price }}</td>
                <td>
                  @{{ item.quantity }}
                  <button @click.prevent="updateQuantity(item.id, '+')" v-if="item.stock > item.quantity"
                          style="cursor: pointer; color: #00AA00;">
                      <i class="fa fa-plus-square" aria-hidden="true"></i>
                  </button>
                  <button @click.prevent="updateQuantity(item.id, '-')" v-if="item.quantity > 1"
                          style="cursor: pointer; color: #ff8000;">
                      <i class="fa fa-minus-square" aria-hidden="true"></i>
                  </button>
                </td>
                <td>@{{ item.total }}</td>
                <td class="text-center">
                  <button @click="removeItem(item.index)">
                      <i class="fa fa-times" aria-hidden="true"></i>
                  </button>
                </td>
              </tr>
            </tbody>
          </table>

          <table>
            <tr>
              <td valign="top">
                <div class="input-group">
                  <input type="text" name="coupon" class="input-group-field" placeholder="coupon code">
                  <div class="input-group-button">
                      <button class="button">Apply</button>
                  </div>
                </div>
              </td>
              <td>
                <table class="unstriped">
                  <tr>
                      <td><h6>Subtotal:</h6></td>
                      <td class="text-right"><h6>$@{{ cartTotal }}</h6></td>
                  </tr>
                  <tr>
                      <td><h6>Discount Amount:</h6></td>
                      <td class="text-right"><h6>$0.00</h6></td>
                  </tr>
                  <tr>
                      <td><h6>Tax:</h6></td>
                      <td class="text-right"><h6>$0.00</h6></td>
                  </tr>
                  <tr>
                      <td><h6>Total:</h6></td>
                      <td class="text-right"><h6>$@{{ cartTotal }}</h6></td>
                  </tr>
                </table>
              </td>
            </tr>
          </table>

          <div class="text-right">
            <a href="<?php echo $_SERVER["APP_URL"] ?>" class="button secondary">
                Continue Shopping &nbsp; <i class="fa fa-shopping-cart" aria-hidden="true"></i>
            </a>
            <button type="submit" class="button success">
                Checkout &nbsp; <i class="fa fa-credit-card-alt" aria-hidden="true"></i>
            </button>
          </div>

        </div>
      </div>
    </div>
  </section>
  <pre>
    <?php var_dump($_SESSION); ?>
  </pre>

</div>
@stop

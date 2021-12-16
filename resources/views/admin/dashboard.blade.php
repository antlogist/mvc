@extends("admin.layout.base")
@section("title", "Dashboard")
@section("data-page-id", "adminDashboard")

@section("content")
<div class="dashboard grid-container" style="margin-top: 1rem;">
  <div class="grid-x grid-margin-x" data-equalizer data-equalize-on="medium">

    {{--Order sumary--}}

    <div class="medium-3 cell">
      <div class="callout" data-equalizer-watch>

        <div class="card">

          <div class="card-section">
            <div class="grid-x grid-margin-x text-center">
              <div class="small-3 cell">
                Order
              </div>
              <div class="small-9 cell">
                500
              </div>
            </div>
          </div>

          <div class="card-divider">
            <a href="./admin/products">Total Orders</a>
          </div>

        </div>

      </div>
    </div>

    {{--Stock sumary--}}

    <div class="medium-3 cell">
      <div class="callout" data-equalizer-watch>

        <div class="card">

          <div class="card-section">
            <div class="grid-x grid-margin-x text-center">
              <div class="small-3 cell">
                Stock
              </div>
              <div class="small-9 cell">
                500
              </div>
            </div>
          </div>

          <div class="card-divider">
            <a href="./admin/products">View Products</a>
          </div>

        </div>

      </div>
    </div>

    {{--Revenue sumary--}}

    <div class="medium-3 cell">
      <div class="callout" data-equalizer-watch>

        <div class="card">

          <div class="card-section">
            <div class="grid-x grid-margin-x text-center">
              <div class="small-3 cell">
                Revenue
              </div>
              <div class="small-9 cell">
                500
              </div>
            </div>
          </div>

          <div class="card-divider">
            <a href="./admin/products">Payment Details</a>
          </div>

        </div>

      </div>
    </div>

    {{--Signup summary--}}

    <div class="medium-3 cell">
      <div class="callout" data-equalizer-watch>

        <div class="card">

          <div class="card-section">
            <div class="grid-x grid-margin-x text-center">
              <div class="small-3 cell">
                Signup
              </div>
              <div class="small-9 cell">
                500
              </div>
            </div>
          </div>

          <div class="card-divider">
            <a href="./admin/products">Registered Users</a>
          </div>

        </div>

      </div>
    </div>

  </div>

  <div class="grid-x grid-margin-x monthly-sales">

    <div class="medium-6 cell">

      <div class="callout" data-equalizer-watch>

        <div class="card">

          <div class="card-section">

            <h4>Monthly Orders</h4>

            <canvas id="order"></canvas>

          </div>

        </div>

      </div>

    </div>

    <div class="medium-6 cell monthly-revenue">

      <div class="callout" data-equalizer-watch>

        <div class="card">

          <div class="card-section">

            <h4>Monthly Revenue</h4>

            <canvas id="order"></canvas>

          </div>

        </div>

      </div>

    </div>

  </div>

</div>
@endsection

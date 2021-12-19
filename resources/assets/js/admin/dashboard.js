(function() {
  'use strict';

  MVCSTORE.admin.dashboard = function () {
    charts();
    setInterval(charts, 10000);
  };

  function charts() {
    const revenue = document.getElementById("revenue");
    const order = document.getElementById("order");

    //Labels
    const orderLabels = [];
    const revenueLabels = [];

    const orderData = [];
    const revenueData = [];

    axios.get("/mvc/admin/charts").then(function(response) {
      response.data.orders.forEach(function(monthly) {
        orderData.push(monthly.count);
        orderLabels.push(monthly.new_date);
      });

      response.data.revenues.forEach(function(monthly) {
        revenueData.push(monthly.amount);
        revenueLabels.push(monthly.new_date);
      });

      new Chart(revenue, {
        type: 'bar',
        data: {
          labels: revenueLabels,
          datasets: [
            {
              label: "# Revenue",
              data: revenueData
            }
          ]
        }
      });

      new Chart(order, {
        type: 'line',
        data: {
          labels: orderLabels,
          datasets: [
            {
              label: "# Orders",
              data: orderData
            }
          ]
        }
      });

    })

  }

})();
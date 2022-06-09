<template>
  <div class="container-full">
    <!-- Main content -->
    <section class="content mt-30">
      <!-- Nav tabs -->
      <ul class="nav nav-tabs" role="tablist">
        <li class="nav-item tab-item-invoice">
          <a class="nav-link active" data-toggle="tab" href="#home" role="tab"
            ><span class="hidden-sm-up"><i class="ion-home"></i></span>
            <span class="hidden-xs-down">Tháng</span></a
          >
        </li>
        <li class="nav-item tab-item-invoice">
          <a class="nav-link" data-toggle="tab" href="#profile" role="tab"
            ><span class="hidden-sm-up"><i class="ion-person"></i></span>
            <span class="hidden-xs-down">Năm</span></a
          >
        </li>
      </ul>
      <!-- Tab panes -->
      <div class="tab-content tabcontent-border">
        <div class="tab-pane active" id="home" role="tabpanel">
          <div class="p-15">
            <canvas id="myChart" width="400" height="400"></canvas>
          </div>
        </div>
        <div class="tab-pane" id="profile" role="tabpanel">
          <div class="p-15">
            <h4>
              Fusce porta eros a nisl varius, non molestie metus mollis.
              Pellentesque tincidunt ante sit amet ornare lacinia.
            </h4>
            <h3>Donec vitae laoreet neque, id convallis ante.</h3>
            <p>
              Duis cursus eros lorem, pretium ornare purus tincidunt eleifend.
              Etiam quis justo vitae erat faucibus pharetra. Morbi in
              ullamcorper diam. Morbi lacinia, sem vitae dignissim cursus, massa
              nibh semper magna, nec pellentesque lorem nisl quis ex.
            </p>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>

<script>
import Chart from "chart.js/auto";

export default {
  mounted() {
    const ctx = document.getElementById("myChart");
    const myChart = new Chart(ctx, {
      type: "bar",
      data: {
        labels: ["Red", "Blue", "Yellow", "Green", "Purple", "Orange", "Red", "Blue", "Yellow", "Green", "Purple", "Orange"],
        datasets: [
          {
            label: "# of Votes",
            data: [120, 19, 3, 5, 2, 3],
            backgroundColor: [
              "rgba(255, 99, 132, 0.2)",
              "rgba(54, 162, 235, 0.2)",
              "rgba(255, 206, 86, 0.2)",
              "rgba(75, 192, 192, 0.2)",
              "rgba(153, 102, 255, 0.2)",
              "rgba(255, 159, 64, 0.2)",
            ],
            borderColor: [
              "rgba(255, 99, 132, 1)",
              "rgba(54, 162, 235, 1)",
              "rgba(255, 206, 86, 1)",
              "rgba(75, 192, 192, 1)",
              "rgba(153, 102, 255, 1)",
              "rgba(255, 159, 64, 1)",
            ],
            borderWidth: 1,
          },
        ],
      },
      options: {
        scales: {
          y: {
            beginAtZero: true,
          },
        },
      },
    });
  },
};
</script>

<style lang="scss" scoped>
  .tab-item-invoice{
    width: 50%;
    text-align: center;
    .nav-link {
      padding: 10px 0;
      font-size: 18px;
      font-weight: 600;
    }
  }
</style>
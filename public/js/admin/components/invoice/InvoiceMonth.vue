<template>
  <div class="container-full">
    <!-- Main content -->
    <section class="content mt-30">
      <!-- Nav tabs -->
      <ul class="nav nav-tabs" role="tablist">
        <li class="nav-item tab-item-invoice">
          <a
            class="nav-link active"
            data-toggle="tab"
            href="#home"
            role="tab"
            ><span class="hidden-sm-up"><i class="ion-home"></i></span>
            <span class="hidden-xs-down">Tháng</span></a
          >
        </li>
        <li class="nav-item tab-item-invoice">
          <a
            class="nav-link"
            data-toggle="tab"
            href="#profile"
            role="tab"
            ><span class="hidden-sm-up"><i class="ion-person"></i></span>
            <span class="hidden-xs-down">Năm</span></a
          >
        </li>
      </ul>
      <!-- Tab panes -->
      <div class="tab-content tabcontent-border">
        <div
          class="tab-pane active"
          id="home"
          role="tabpanel"
        >
          <div class="p-15">
            <canvas id="invoice-monthy" width="400" height="150"></canvas>
            <div class="d-flex justify-content-between mt-10">
              <div>
                <a href="" class="btn btn-info mb-5"
                  ><i class="fa fa-angle-left" aria-hidden="true"></i>
                </a>
                <strong class="ml-20">Năm: {{ max_year }}</strong>
              </div>
              <a href="" class="btn btn-info mb-5"
                ><i class="fa fa-angle-right" aria-hidden="true"></i>
              </a>
            </div>
          </div>
        </div>
        <div class="tab-pane" id="profile" role="tabpanel">
          <div class="p-15">
            <canvas id="invoice-yearly" width="400" height="150"></canvas>
            <div class="d-flex justify-content-between mt-10">
              <div>
                <a href="" class="btn btn-info mb-5"
                  ><i class="fa fa-angle-left" aria-hidden="true"></i>
                </a>
              </div>
              <a href="" class="btn btn-info mb-5"
                ><i class="fa fa-angle-right" aria-hidden="true"></i>
              </a>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>

<script>
import Chart from "chart.js/auto";

export default {
  data() {
    return {
      labelsMonthy: [],
      labelsYearly: []
    };
  },
  props: ["max_year", "min_year", "invoices"],
  methods: {
    getLabelsMonthy() {
      for (let i = 1; i <= 12; i++) {
        this.labelsMonthy.push(`Tháng ${i}`);
      }

      return this.labelsMonthy;
    },
    getLabelsYearly() {
      for (let i = this.max_year - 10; i <= this.max_year; i++) {
        this.labelsYearly.push(i);
      }

      return this.labelsYearly;
    },
    getInvoiceMonthy() {
      let data = [];

      for (let key in this.invoices) {
        let invoice = {
          x: `Tháng ${key}`,
          y: this.invoices[key],
        };

        data.push(invoice);
      }

      return data;
    },
    initChartMonthy() {
      let invoiceMonthy = document.getElementById("invoice-monthy");
      let ChartMonthy = new Chart(invoiceMonthy, {
        type: "bar",
        data: {
          labels: this.getLabelsMonthy(),
          datasets: [
            {
              label: "Tổng giá trị hóa đơn theo tháng",
              data: [123,123,124545],
              backgroundColor: ["#1e3799"],
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
    initChartYearly() {
      let invoiceYearly = document.getElementById("invoice-yearly");
      let chartYearly= new Chart(invoiceYearly, {
        type: "bar",
        data: {
          labels: this.getLabelsYearly(),
          datasets: [
            {
              label: "Tổng giá trị hóa đơn theo năm",
              data: [123,123,124545],
              backgroundColor: ["#1e3799"],
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
  },
  mounted() {
    this.initChartMonthy();
    this.initChartYearly();
  },
  
};
</script>

<style lang="scss" scoped>
.tab-item-invoice {
  width: 50%;
  text-align: center;
  .nav-link {
    padding: 10px 0;
    font-size: 18px;
    font-weight: 600;
  }
}
</style>
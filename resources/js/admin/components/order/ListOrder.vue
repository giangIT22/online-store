<template>
  <div class="container-full">
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="box">
            <div class="box-header with-border">
              <div class="d-flex justify-content-between">
                <h3 class="box-title">Danh sách đơn hàng</h3>
              </div>
            </div>
            <div class="box-body">
              <div class="row">
                <div class="col-sm-12 col-md-4">
                  <div class="input-group">
                    <input
                      type="search"
                      id="search-data"
                      name="search_key"
                      class="form-control"
                      style="border-radius: 7px !important"
                      placeholder="Nhập mã đơn hàng..."
                      v-model="searchKey"
                    />
                    <button
                      type="button"
                      @click="searchOrder"
                      class="btn btn-primary ml-15"
                      style="border-radius: 7px !important"
                    >
                      Tìm kiếm
                    </button>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="table-responsive">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>Đơn hàng</th>
                      <th>Ngày</th>
                      <th>Địa chỉ</th>
                      <th>Giá trị đơn hàng</th>
                      <th>Phương thức thanh toán</th>
                      <th>Trạng thái</th>
                      <th>Thao tác</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="item in listOrders" :key="item.id">
                      <td>{{ item.order_code }}</td>
                      <td>{{ formatDate(item.created_at) }}</td>
                      <td>
                        {{
                          item.province + ", " + item.district + ", Viet Nam"
                        }}
                      </td>
                      <td>
                        {{
                          item.sum_price.toLocaleString("it-IT", {
                            style: "currency",
                            currency: "vnd",
                          })
                        }}
                      </td>
                      <td>{{ item.payment_type }}</td>
                      <td>
                        <span
                          v-if="item.status == 0"
                          class="badge badge-pill badge-danger"
                        >
                          Chưa xác nhận
                        </span>
                        <span
                          v-if="item.status == 1"
                          class="badge badge-pill badge-primary"
                        >
                          Đã xác nhận
                        </span>
                        <span
                          v-if="item.status == 2"
                          class="badge badge-pill badge-primary"
                        >
                          Đang giao hàng
                        </span>
                        <span
                          v-if="item.status == 3"
                          class="badge badge-pill badge-primary"
                        >
                          Đã giao hàng
                        </span>
                        <span
                          v-if="item.status == 4"
                          class="badge badge-pill badge-primary"
                        >
                          Yêu cầu hủy đơn hàng
                        </span>
                        <span
                          v-if="item.status == 5"
                          class="badge badge-pill badge-primary"
                        >
                          Đơn hàng đã bị hủy
                        </span>
                      </td>
                      <td>
                        <a :href="`/admin/orders/detail/${item.order_code}`" class="btn btn-info"
                          ><i class="fa fa-eye"></i>
                        </a>
                        <a
                          target="_blank"
                          :href="`/admin/orders/dowload/${item.order_code}`"
                          class="btn btn-danger"                          
                        >
                          <i class="fa fa-download"></i
                        ></a>
                      </td>
                    </tr>
                  </tbody>
                </table>
                <paginate :page-count="lastPage"></paginate>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
    <loading :active="isLoading"
                 :is-full-page="fullPage"/>
  </div>
</template>

<script>
import Paginate from "../Paginate.vue";
import Loading from 'vue-loading-overlay';
import 'vue-loading-overlay/dist/vue-loading.css';

const axios = require('axios');
export default {
  components: { Paginate, Loading },
  props: {
    orders: Array,
    total: Number,
    lastPage: Number,
  },
  data() {
    return {
      listOrders: [],
      searchKey: "",
      isLoading: false,
      fullPage: true
    };
  },
  created() {
    this.listOrders = this.orders;
  },
  methods: {
    formatDate(date) {
      var d = new Date(date),
        month = "" + (d.getMonth() + 1),
        day = "" + d.getDate(),
        year = d.getFullYear();

      if (month.length < 2) month = "0" + month;
      if (day.length < 2) day = "0" + day;

      return [year, month, day].join("-");
    },
    searchOrder: async function () {
      this.isLoading = true;
      const response = await axios.get(`/admin/orders/search?search_key=${this.searchKey}`);
      setTimeout(() => {
        this.isLoading = false;
        this.lastPage = response.data.lastPage;
        this.listOrders = response.data.listOrders;
      }, 500);
    },
  },
};
</script>

<style lang="scss" scoped>
</style>

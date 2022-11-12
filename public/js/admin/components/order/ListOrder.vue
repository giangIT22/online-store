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
                    <tr v-for="item in orders" :key="item.id">
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
  </div>
</template>

<script>
import Paginate from "../Paginate.vue";

export default {
  components: { Paginate },
  props: {
    orders: Array,
    total: Number,
    lastPage: Number,
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
  },
};
</script>

<style lang="scss" scoped>
</style>

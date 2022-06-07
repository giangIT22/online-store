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
                      <th>TRạng thái</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="item in orders" :key="item.id">
                      <td>{{ item.order_code }}</td>
                      <td>{{ item.created_at }}</td>
                      <td>{{ item.province + ', ' + item.district + ', Viet Nam' }}</td>
                      <td>{{ item.sum_price }}</td>
                      <td>{{ item.payment_type }}</td>
                      <td>
                        <span
                          v-if="item.status == 1"
                          class="badge badge-pill badge-success"
                        >
                          Active
                        </span>
                        <span
                          v-if="item.status == 0"
                          class="badge badge-pill badge-danger"
                          >Not Active
                        </span>
                      </td>
                      <td>
                        <a
                          :href="`/admin/coupon/edit/${item.id}`"
                          class="btn btn-info"
                          title="Edit Data"
                          ><i class="fa fa-pencil"></i>
                        </a>
                        <a
                          href=""
                          :data-url="`/admin/coupon/delete/${item.id}`"
                          class="btn btn-danger action-delete"
                          title="Delete Data"
                          id="delete"
                        >
                          <i class="fa fa-trash"></i
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
    orders: Object,
    total: Number,
    lastPage: Number,
  },
};
</script>

<style lang="scss" scoped>
</style>

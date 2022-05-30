<template>
  <div class="container-full">
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="box">
            <div class="box-header with-border">
              <div class="d-flex justify-content-between">
                <h3 class="box-title">Danh sách Coupon</h3>
                <a
                  href="/admin/coupon/create"
                  type="button"
                  class="btn btn-rounded btn-primary mb-5"
                  >Thêm</a
                >
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="table-responsive">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>Coupon name</th>
                      <th>Coupon discount</th>
                      <th>Validity</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="item in coupons" :key="item.id">
                      <td >{{ item.coupon_name }}</td>
                      <td >{{ item.coupon_discount }}</td>
                      <td>{{ item.coupon_validity}}</td>
                      <td>
                          <span v-if="item.status == 1" class="badge badge-pill badge-success"> Active </span>
                          <span v-if="item.status == 0" class="badge badge-pill badge-danger">Not Active </span>
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
    coupons: Object,
    total: Number,
    lastPage: Number,
  },
};
</script>

<style lang="scss" scoped>

</style>

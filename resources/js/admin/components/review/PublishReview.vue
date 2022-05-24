<template>
  <div class="container-full">
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="box">
            <div class="box-header with-border">
              <div class="d-flex justify-content-between">
                <h3 class="box-title">Danh sách đánh giá công khai</h3>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="table-responsive">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>Sản phẩm</th>
                      <th>Nội dung đánh giá</th>
                      <th>Người đánh giá</th>
                      <th>Tình trạng</th>
                      <th>Hành động</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="item in reviews" :key="item.id">
                      <td>{{ item.product.name }}</td>
                      <td>{{ item.comment }}</td>
                      <td>{{ item.user.name }}</td>
                      <td v-if="item.status == 1">
                        <span class="badge badge-pill badge-primary"
                          >Công khai</span
                        >
                      </td>
                      <td>
                        <a
                          :href="`/admin/review/delete/${item.id}`"
                          class="btn btn-danger"
                        >
                          Xóa
                        </a>
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
    reviews: Object,
    total: Number,
    lastPage: Number,
  },
};
</script>

<style lang="scss" scoped>
</style>
<template>
  <div class="container-full">
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="box">
            <div class="box-header with-border">
              <div class="d-flex justify-content-between">
                <h3 class="box-title">Danh sách sản phẩm</h3>
                <a
                  href="/admin/product/create"
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
                      <th>Ảnh sản phẩm</th>
                      <th>Tên</th>
                      <th>Slug</th>
                      <th>Giá sản phẩm</th>
                      <th>Số lượng</th>
                      <th>Giá sale</th>
                      <th>Trạng thái</th>
                      <th>Thao tác</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr
                      class="fix-font"
                      v-for="item in products"
                      :key="item.id"
                    >
                      <td><img :src="item.image" alt="" width="50px" /></td>
                      <td style="width:200px;">{{ item.name }}</td>
                      <td style="width:200px;">{{ item.product_slug }}</td>
                      <td>
                        {{
                          item.product_price.toLocaleString("it-IT", {
                            style: "currency",
                            currency: "vnd",
                          })
                        }}
                      </td>
                      <td>{{ item.amount }}</td>
                      <td>
                        {{item.sale_price ?
                          item.sale_price.toLocaleString("it-IT", {
                            style: "currency",
                            currency: "vnd",
                          }) : ""
                        }}
                      </td>
                      <td>
                        {{ item.status == 1 ? 'Tạm dừng' : 'Đang bán'}}
                      </td>
                      <td>
                        <a
                          :href="`/admin/product/edit/${item.id}`"
                          class="btn btn-info"
                          title="Edit Data"
                          ><i class="fa fa-pencil"></i>
                        </a>
                        <a
                          href=""
                          :data-url="`/admin/product/delete/${item.id}`"
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
    products: Array,
    total: Number,
    lastPage: Number,
  },
};
</script>

<style lang="scss" scoped>

.fix-font td span {
  width: 100%;
  white-space: pre-wrap;
  overflow: hidden;
  text-overflow: ellipsis;
  -webkit-line-clamp: 3;
  -webkit-box-orient: vertical;
  display: -webkit-box;
}
</style>
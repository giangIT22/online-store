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
                      placeholder="Nhập tên hoặc mã sản phẩm ..."
                      v-model="searchKey"
                    />
                    <button
                      type="button"
                      @click="searchProduct"
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
                      <th>Mã sản phẩm</th>
                      <th>Ảnh sản phẩm</th>
                      <th>Tên</th>
                      <th>Loại sản phẩm</th>
                      <th>Giá bán</th>
                      <th>Số lượng</th>
                      <th>Giá sale</th>
                      <th>Trạng thái</th>
                      <th>Thao tác</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr
                      class="fix-font"
                      v-for="item in listProducts"
                      :key="item.id"
                    >
                      <td style="width:200px;">{{ item.product_code }}</td>
                      <td><img :src="item.image" alt="" width="100px" /></td>
                      <td style="width:200px;">{{ item.name }}</td>
                      <td style="width:200px;">{{ item.category.name }}</td>
                      <td>
                        {{ item.product_price ? 
                          item.product_price.toLocaleString("it-IT", {
                            style: "currency",
                            currency: "vnd",
                          }) : 0
                        }}
                      </td>
                      <td>{{ item.amount }}</td>
                      <td>
                        {{item.sale_price ?
                          item.sale_price.toLocaleString("it-IT", {
                            style: "currency",
                            currency: "vnd",
                          }) : 0
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
    products: Array,
    total: Number,
    lastPage: Number,
  },
  data() {
    return {
      listProducts: [],
      searchKey: "",
      isLoading: false,
      fullPage: true
    };
  },
  created() {
    this.listProducts = this.products;
  },
  methods: {
    searchProduct: async function () {
      this.isLoading = true;
      const response = await axios.get(`/admin/product/search?search_key=${this.searchKey}`);
      setTimeout(() => {
        this.isLoading = false;
        this.lastPage = response.data.lastPage;
        this.listProducts = response.data.listProducts;
      }, 500);
    },
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
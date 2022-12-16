<template>
  <div class="container-full">
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
              <div class="d-flex justify-content-between">
                <h3 class="box-title">Danh mục sản phẩm</h3>
                <a
                  href="/admin/category/create"
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
                      placeholder="Nhập tên danh mục ..."
                      v-model="searchKey"
                    />
                    <button
                      type="button"
                      @click="searchCategory"
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
                      <th>Mã danh mục</th>
                      <th>Tên</th>                      
                      <th>Ngày cập nhật</th>
                      <th>Thao tác</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="item in categories" :key="item.id">
                      <td>{{ item.id }}</td>
                      <td>{{ item.name }}</td>                      
                      <td>{{ new Date(item.updated_at).toLocaleDateString() }}</td>                      
                      <td>
                        <a
                          :href="`/admin/category/edit/${item.id}`"
                          class="btn btn-info"
                          title="Edit Data"
                          ><i class="fa fa-pencil"></i>
                        </a>
                        <a
                          href=""
                          :data-url="`/admin/category/delete/${item.id}`"
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
      <!-- loading -->
        <loading :active="isLoading"
                 :is-full-page="fullPage"/>
    <!-- loading -->
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
    listCategory: Array,
    total: Number,
    lastPage: Number,
  },
  data() {
    return {
      categories: [],
      searchKey: "",
      isLoading: false,
      fullPage: true
    };
  },
  created() {
    this.categories = this.listCategory;
  },
  methods: {
    searchCategory: async function () {
      this.isLoading = true;
      const response = await axios.get(`/admin/category/search?search_key=${this.searchKey}`);
      setTimeout(() => {
        this.isLoading = false;
        this.lastPage = response.data.lastPage;
        this.categories = response.data.categories;
      }, 500);
    },
  },
};
</script>

<style scoped>
</style>

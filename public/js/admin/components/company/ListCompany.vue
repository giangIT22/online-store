<template>
  <div class="container-full">
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="box">
            <div class="box-header with-border">
              <div class="d-flex justify-content-between">
                <h3 class="box-title">Danh sách Nhà cung cấp</h3>
                <a
                  href="/admin/company/create"
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
                      v-model="searchKey"
                    />
                    <button
                      type="button"
                      @click="searchCompany"
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
                      <th>Tên nhà cung cấp</th>
                      <th>Email</th>
                      <th>Số điện thoại</th>
                      <th>Địa chỉ</th>
                      <th>Thao tác</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="item in listCompanies" :key="item.id">
                      <td >{{ item.name }}</td>
                      <td >{{ item.email }}</td>
                      <td>{{ item.phone }}</td>
                      <td>{{ item.address }}</td>
                      <td>
                        <a
                          :href="`/admin/company/edit/${item.id}`"
                          class="btn btn-info"
                          title="Edit Data"
                          ><i class="fa fa-pencil"></i>
                        </a>
                        <a
                          href=""
                          :data-url="`/admin/company/delete/${item.id}`"
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
    companies: Array,
    total: Number,
    lastPage: Number,
  },
  data() {
    return {
      listCompanies: [],
      searchKey: "",
      isLoading: false,
      fullPage: true
    };
  },
  created() {
    this.listCompanies = this.companies;
  },
  methods: {
    searchCompany: async function () {
      this.isLoading = true;
      const response = await axios.get(`/admin/company/search?search_key=${this.searchKey}`);
      setTimeout(() => {
        this.isLoading = false;
        this.lastPage = response.data.lastPage;
        this.listCompanies = response.data.listCompanies;
      }, 500);
    },
  },
};
</script>

<style lang="scss" scoped>

</style>

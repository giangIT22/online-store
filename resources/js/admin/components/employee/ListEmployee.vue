<template>
  <div class="container-full">
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="box">
            <div class="box-header with-border">
              <div class="d-flex justify-content-between">
                <h3 class="box-title">Danh sách nhân viên</h3>
                <a
                  href="/admin/employee/create"
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
                      @click="searchEmployee"
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
                      <th>Ảnh nhân viên</th>
                      <th>Tên</th>
                      <th>Email</th>
                      <th>Số điện thoại</th>
                      <th>Số căn cước</th>
                      <th>Địa chỉ</th>
                      <th>Vị trí</th>
                      <th>Trạng thái</th>
                      <th>Thao tác</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="item in listEmployees" :key="item.id">
                      <td>
                        <img
                          :src="
                            item.profile_photo_path
                              ? item.profile_photo_path
                              : '/backend/images/no-image.jpg'
                          "
                          alt=""
                          width="50px"
                        />
                      </td>
                      <td>{{ item.name }}</td>
                      <td>{{ item.email }}</td>
                      <td>{{ item.phone }}</td>
                      <td>{{ item.cccd }}</td>
                      <td>{{ item.address }}</td>
                      <td>{{ item.role.name }}</td>
                      <td>{{ item.status == 1 ? "Đang làm" : "Nghỉ làm" }}</td>

                      <td>
                        <a
                          :href="`/admin/employee/edit/${item.id}`"
                          class="btn btn-info"
                          title="Edit Data"
                          ><i class="fa fa-pencil"></i>
                        </a>
                        <a v-if="role == 1"
                          href=""
                          :data-url="`/admin/employee/delete/${item.id}`"
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
    <loading :active="isLoading" :is-full-page="fullPage" />
  </div>
</template>

<script>
import Paginate from "../Paginate.vue";
import Loading from "vue-loading-overlay";
import "vue-loading-overlay/dist/vue-loading.css";

const axios = require("axios");
export default {
  components: { Paginate, Loading },
  props: {
    employees: Array,
    total: Number,
    lastPage: Number,
    role: Number
  },
  data() {
    return {
      listEmployees: [],
      searchKey: "",
      isLoading: false,
      fullPage: true,
    };
  },
  created() {
    this.listEmployees = this.employees;
  },
  // watch: {
  //   searchKey() {
  //     this.searchEmployee();
  //   }
  // },
  methods: {
    searchEmployee: async function () {
      this.isLoading = true;
      const response = await axios.get(
        `/admin/employee/search?search_key=${this.searchKey}`
      );
      setTimeout(() => {
        this.isLoading = false;
        this.lastPage = response.data.lastPage;
        this.listEmployees = response.data.listEmployees;
      }, 500);
    },
  },
};
</script>

<style lang="scss" scoped>
</style>
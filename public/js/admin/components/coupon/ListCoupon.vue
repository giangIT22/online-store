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
                      placeholder="Nhập mã giảm giá"
                      v-model="searchKey"
                    />
                    <button
                      type="button"
                      @click="searchCoupon"
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
                      <th>Mã giảm giá</th>
                      <th>Phần trăm giảm</th>
                      <th>Thời hạn</th>
                      <th>Mức giá tối thiểu</th>
                      <th>Người tạo</th>
                      <th>Trạng thái</th>
                      <th>Thao tác</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="item in listCoupons" :key="item.id">
                      <td >{{ item.coupon_name }}</td>
                      <td >{{ item.coupon_discount }}</td>
                      <td>{{ item.coupon_validity }}</td>
                      <td>{{ item.minimum_price.toLocaleString("it-IT", {
                            style: "currency",
                            currency: "vnd",
                          }) }}</td>
                      <td>{{ item.admin.name }}</td>
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
    coupons: Array,
    total: Number,
    lastPage: Number,
  },
  data() {
    return {
      listCoupons: [],
      searchKey: "",
      isLoading: false,
      fullPage: true
    };
  },
  created() {
    this.listCoupons = this.coupons;
  },
  methods: {
    searchCoupon: async function () {
      this.isLoading = true;
      const response = await axios.get(`/admin/coupon/search?search_key=${this.searchKey}`);
      setTimeout(() => {
        this.isLoading = false;
        this.lastPage = response.data.lastPage;
        this.listCoupons = response.data.listCoupons;
      }, 500);
    },
  },
};
</script>

<style lang="scss" scoped>

</style>

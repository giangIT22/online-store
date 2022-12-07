<template>
  <div class="container-full">
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="box">
            <div class="box-header with-border">
              <div class="d-flex justify-content-between">
                <h3 class="box-title">Danh sách phiếu nhập kho</h3>
                <a
                  href="/admin/receipt/create"
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
                      @click="searchReceipt"
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
                      <th>Mã đơn hàng</th>
                      <th>Ghi chú</th>
                      <th>Người nhập</th>
                      <th>Ngày tạo</th>
                      <th>Thao tác</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="item in listReceipts" :key="item.id">
                      <td>{{ item.receipt_code }}</td>
                      <td>{{ item.notes }}</td>
                      <td>{{ item.admin.name }}</td>
                      <td>{{ formatDate(item.created_at) }}</td>
                      <td>
                        <a :href="`/admin/receipt/detail/${item.id}`" class="btn btn-info"
                          ><i class="fa fa-eye"></i>
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
    receipts: Array,
    total: Number,
    lastPage: Number,
  },
  data() {
    return {
      listReceipts: [],
      searchKey: "",
      isLoading: false,
      fullPage: true
    };
  },
  created() {
    this.listReceipts = this.receipts;
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
    searchReceipt: async function () {
      this.isLoading = true;
      const response = await axios.get(`/admin/receipt/search?search_key=${this.searchKey}`);
      setTimeout(() => {
        this.isLoading = false;
        this.lastPage = response.data.lastPage;
        this.listReceipts = response.data.listReceipts;
      }, 500);
    },
  },
};
</script>

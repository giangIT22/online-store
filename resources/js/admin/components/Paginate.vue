<template>
  <nav v-if="pageCount > 1" class="navigation text-center">
    <Paginate
      :page-range="pageRange"
      :page-count="pageCount"
      container-class="pagination w-100"
      page-class="page-item"
      page-link-class="page-link border-0"
      prev-link-class="page-link border-0"
      next-link-class="page-link border-0"
      :prev-text="'<'"
      :next-text="'>'"
      :click-handler="paginate"
      :value="pageQuery"
    ></Paginate>
  </nav>
</template>

<script>
import Paginate from 'vuejs-paginate';

export default {
  components: {
    Paginate
  },
  props: {
    pageCount: Number,
    queryName: {
      type: String,
      default: 'page'
    }
  },
  data() {
    return {
      width: 0
    };
  },
  computed: {
    pageQuery() {
      const queryParams = new URLSearchParams(window.location.search);
      if (queryParams.get(this.queryName)) {
        return parseInt(queryParams.get(this.queryName));
      }
      return 1;
    },
    pageRange() {
      if (this.width < 768) {
        return 3;
      }
      if (this.pageCount === 7) {
        return 7;
      }
      return 5;
    }
  },
  methods: {
    paginate(page) {
      let url = new URL(window.location.href);
      let searchParams = url.searchParams;
      searchParams.set(this.queryName, page);
      url.search = searchParams.toString();
      const newUrl = url.toString();
      window.location.assign(newUrl);
    }
  }
};
</script>

<style scoped>
  
</style>

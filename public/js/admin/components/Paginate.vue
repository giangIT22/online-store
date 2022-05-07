<template>
  <nav v-if="pageCount > 1" class="navigation text-center">
    <Paginate
      first-last-button
      hide-prev-next
      :page-range="pageRange"
      :page-count="pageCount"
      container-class="pagination pagination-sm flex-center"
      page-class="page-item"
      page-link-class="page-link font-20 p-0 mx-2 my-1"
      prev-class="d-none"
      prev-link-class="d-none"
      next-class="d-none"
      next-link-class="d-none"
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

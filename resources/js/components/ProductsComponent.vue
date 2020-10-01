<template>
  <div class="container-fluid">
    <div class="row justify-content-center">
      <div class="col-4" v-for="(product, index) in products" :key="index">

        <product-component :product="product"></product-component>

      </div>
    </div>

    <ul
      class="pagination justify-content-center"
      role="navigation"
      v-if="prev_page_url || next_page_url"
    >
      <!-- Previous Page Link -->
      <template v-if="prev_page_url === null">
        <li class="page-item disabled" aria-disabled="true">
          <span class="page-link"> << </span>
        </li>
      </template>
      <template v-else>
        <li class="page-item">
          <button @click="changePage('prev')" class="page-link" rel="prev"> << </button>
        </li>
      </template>

      &nbsp;&nbsp;&nbsp;

      <!-- Next Page Link -->
      <template v-if="next_page_url !== null">
        <li class="page-item">
          <button @click="changePage('next')" class="page-link" rel="next"> >> </button>
        </li>
      </template>
      <template v-else>
        <li class="page-item disabled" aria-disabled="true">
          <span class="page-link"> >> </span>
        </li>
      </template>
    </ul>

  </div>
</template>

<script>
  export default {

    data() {
      return {
        page: 1,
        prev_page_url: null,
        next_page_url: null,
        products: [],
      }
    },

    mounted() {
      // console.log('mounted!');
    },

    created() {
      axios.get('/api/products-list?page=' + this.page).then( res => {
        this.products = res.data.data;
        this.prev_page_url = res.data.prev_page_url;
        this.next_page_url = res.data.next_page_url;
      });
    },

    methods: {
      changePage(direction) {
        this.page = ( direction === 'next' ) ? this.page + 1 : this.page - 1;

        axios.get('/api/products-list?page=' + this.page).then( res => {
          this.products = res.data.data;
          this.prev_page_url = res.data.prev_page_url;
          this.next_page_url = res.data.next_page_url;
        });
      },
    },
  }
</script>


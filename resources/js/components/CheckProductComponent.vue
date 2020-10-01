<template>

  <div class="card" style="margin-bottom: 1em;">
    <img src="/images/product.svg" style="width: 7em;" class="card-img-top" alt="" />
    <div class="card-body">
      <h5 class="card-title">{{ product.name }}</h5>
      <h6><span class="badge badge-light">{{ product.category.name }}</span></h6>
      <p class="card-text">{{ product.description }}</p>
      <p>
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <button
              class="btn btn-outline-secondary"
              type="button"
              @click="resetOrder"
            >Reset Order</button>
          </div>
          <select
            aria-label="Select with reset button"
            class="custom-select"
            id="inputGroupSelect"
            v-model="quantitySelectedData"
          >
            <option value="0" selected>How many ? ...</option>
            <option
              v-for="index in product.quantity"
              :key="index"
              :value="index"
            >{{ index }}</option>
          </select>
        </div>
        <span class="font-weight-bold">{{ product.price | real_price }} $</span>

        <template v-if="totalCostSelected > 0">
          &nbsp;&nbsp;&nbsp; => &nbsp;&nbsp;&nbsp;
          <span class="font-weight-bold"><mark>{{ totalCostSelected | real_price }} $</mark></span>
        </template>
      </p>
      <button
        class="btn btn-primary"
        @click="toCartPage"
        :disabled='disableButton'
      >To Cart!</button>
    </div>
  </div>

</template>

<script>
  export default {
    props: {
      api_token: String,
      product: Object,
      quantitySelected: String,
    },

    data() {
      return {
        quantitySelectedData: this.quantitySelected,
      }
    },

    mounted() {
    },

    computed: {
      totalCostSelected: function() {
        return parseInt(this.product.price) * parseInt(this.quantitySelectedData);
      },

      disableButton: function() {
        return this.totalCostSelected == 0;
      },
    },

    methods: {
      resetOrder() {

        axios.post('/api/delete-cart-item', {
          _method: 'delete',
          api_token: this.api_token,
          product_id: this.product.id,
        }).then(response => {
          console.log(response);
          window.location = window.location;
        }).catch(error => {
          console.log(error);
        });

      },

      toCartPage() {
        axios.post('/api/put-in-cart', {
          api_token: this.api_token,
          product_id: this.product.id,
          quantity: this.quantitySelectedData,
          price: this.product.price,
        }).then(response => {
          console.log(response);
          window.location = '/checkout';
        }).catch(error => {
          console.log(error);
        });
      },
    },

    filters: {
      real_price: function (value) {
        if (!value) return '';

        value = value.toString();

        return value.slice(0, -2) + ',' + value.slice(-2);
      }
    },
  }
</script>

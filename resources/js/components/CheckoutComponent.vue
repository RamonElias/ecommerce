<template>
  <div class="container-fluid">
    <div class="row justify-content-center">
      <table class="table table-hover">
        <thead>
          <tr>
            <th scope="col">Product</th>
            <th scope="col">Price</th>
            <th scope="col">Quantity</th>
            <th scope="col">Charge</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(cart_item, index) in cart_items" :key="index">
            <td><a :href="'/product/' + cart_item.product.name">{{ cart_item.product.name }}</a></td>
            <td>{{ cart_item.price | real_price }}</td>
            <td>{{ cart_item.quantity }}</td>
            <td>{{ (cart_item.price * cart_item.quantity) | real_price }}</td>
          </tr>
          <tr>
            <td></td>
            <td><h3><span class="badge badge-info">TOTAL COST</span></h3></td>
            <td></td>
            <td><h3><span class="badge badge-info">{{ totalCost | real_price }} $</span></h3></td>
          </tr>
        </tbody>
      </table>
      <button
        class="btn btn-primary btn-lg"
        @click="chargeOrder"
      >Click to Charge</button>
    </div>
  </div>
</template>

<script>
  export default {
    props: {
      api_token: String,
      cart_items: Array,
    },

    data() {
      return {
        // products: [],
      }
    },

    mounted() {
      // console.log('mounted!');
    },

    created() {
    },

    methods: {

      chargeOrder() {
        axios.post('/api/charge-cart', {
          api_token: this.api_token,
          cart_items: this.cart_items,
          totalCost: this.totalCost,
        }).then(response => {
          // console.log(response);
          alert(response.data);
          window.location = '/checkout';
        }).catch(error => {
          console.log(error);
        });
      },

    },

    computed: {
      totalCost: function() {

        const total = this.cart_items.reduce( function(accumulator, item) {
          return accumulator + (item.price * item.quantity);
        }, 0);

        return total;
      },
    },

    filters: {
      real_price: function (value) {
        if (!value) return '0';

        value = value.toString();

        return value.slice(0, -2) + ',' + value.slice(-2);
      }
    },

  }
</script>


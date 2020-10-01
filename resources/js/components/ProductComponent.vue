<template>

  <div class="card" style="margin-bottom: 1em;">
    <svg-product-icon-component
      alt=""
      class="card-img-top"
      :color="product.color"
      style="width: 6em;"
    ></svg-product-icon-component>
    <div class="card-body">
      <h5 class="card-title">{{ product.name }}</h5>
      <h6><span class="badge badge-light">{{ product.category.name }}</span></h6>
      <p class="card-text">{{ product.description }}</p>
      <p>
        <span class="badge badge-info">Q : {{ product.quantity }}</span>
        &nbsp;&nbsp;&nbsp;
        <span class="font-weight-bold">{{ product.price | real_price }} $</span>
      </p>
      <a :href="'/product/' + product.name" class="btn btn-primary">Go Buy!</a>
    </div>
  </div>

</template>

<script>
  export default {
    props: {
      product: Object,
    },
    mounted() {
    },
    // computed: {
    // },
    filters: {
      real_price: function (value) {
        if (!value) return '';

        value = value.toString();

        return value.slice(0, -2) + ',' + value.slice(-2);
      }
    },
  }
</script>



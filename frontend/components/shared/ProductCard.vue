<template>
  <!-- Shop Products -->
  <div
    class="relative p-2 mx-auto overflow-hidden bg-white border border-transparent rounded-md hover:border-primary-500 product"
  >
    <!-- image -->
    <div
      class="relative flex justify-center bg-white rounded-md item-center product-image"
    >
      <img
        :src="product.imageUrl"
        class="w-full h-full"
        alt="product"
        style="object-fit: cover"
      />

      <!-- options on hover -->
      <div class="absolute flex items-center justify-center product-options">
        <!-- add to cart button -->
        <button
          @click="addToCart"
          class="flex items-center justify-center w-12 h-12 bg-white rounded-md shadow-md cursor-pointer hover:bg-primary-500 text-primary-500 hover:text-white"
        >
          <svg
            xmlns="http://www.w3.org/2000/svg"
            class="w-5 h-5"
            fill="none"
            viewBox="0 0 24 24"
            stroke="currentColor"
          >
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"
            />
          </svg>
        </button>

        <!-- view button -->
        <nuxt-link
          :to="`/products/${product.id}`"
          class="flex items-center justify-center w-12 h-12 ml-4 bg-white rounded-md shadow-md cursor-pointer hover:bg-primary-500 text-primary-500 hover:text-white"
        >
          <svg
            xmlns="http://www.w3.org/2000/svg"
            class="w-5 h5"
            fill="none"
            viewBox="0 0 24 24"
            stroke="currentColor"
          >
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"
            />
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"
            />
          </svg>
        </nuxt-link>
      </div>

      <!-- badge -->
      <div class="absolute top-3 right-3">
        <!-- <span class="px-3 py-1 text-xs tracking-wider text-white uppercase rounded-md bg-primary-500">NEW</span> -->
        <span
          class="px-3 py-1 text-xs tracking-wider text-white uppercase bg-red-500 rounded-md"
          v-if="product.quantity <= 0"
          >Out of stock</span
        >
      </div>
    </div>

    <!-- details -->
    <div class="flex items-center justify-between p-4">
      <h6>
        <nuxt-link
          :to="`/products/${product.id}`"
          class="font-medium hover:text-primary-500"
        >
          <truncate :value="product.name" :length="40"></truncate>
        </nuxt-link>
      </h6>
      <p class="text-sm text-grey-300 whitespace-nowrap">
        {{ product.priceFormatted }}
      </p>
    </div>
  </div>
  <!-- End Shop Products -->
</template>

<script>
import { mapGetters } from "vuex";

export default {
  name: "product-card",
  props: {
    product: {
      type: Object,
    },
  },

  computed: {
    ...mapGetters({
      cartItems: "cart/getCartItems",
    }),
  },

  methods: {
    addToCart() {
      let selectedItem = this.cartItems.find(
        (product) => product.id == this.product.id
      );

      if (selectedItem) {
        if (selectedItem.quantity + 1 > this.product.quantity) {
          return this.$toast.error("Quantity exceeds available stock");
        }
      }
      
      this.$store.dispatch("cart/addToCart", {
        ...this.product,
        quantity: 1,
      });
    },
  },
};
</script>

<style lang="scss" scoped>
.product {
  box-shadow: #7c3aed15 1px 2px 6px 2px;
}
.product:hover {
  box-shadow: #7c3aed1b 1px 4px 12px;
}

.product-options {
  opacity: 0;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -20%);
  transition: all 0.3s ease-in;
}

.product:hover {
  .product-image {
    @apply bg-gray-300;
    transition: all 0.2s ease-in;

    .product-options {
      color: red;
      transform: translate(-50%, -50%);
      opacity: 1;
    }
  }
}
</style>

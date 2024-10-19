<template>
  <loader :loading="$fetchState.pending">
    <!-- product -->
    <div class="container my-5 lg:flex md:my-10" v-if="product">
      <!-- left side -->
      <div class="mr-4 lg:w-9/12">
        <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
          <div class="overflow-hidden bg-gray-300 border rounded-md">
            <img
              class="object-cover h-full lg:object-scale-down"
              :src="product.imageUrl"
              :alt="product.name"
            />
          </div>
          <!-- product details -->
          <div class="flex flex-col mt-6 flex-grow-1">
            <!-- category -->
            <div class="mt-1 ml-1 text-xs font-semibold text-gray-700">
              {{ product.category.name }}
            </div>

            <h3 class="mt-2 text-xl font-bold">{{ product.name }}</h3>

            <!-- price -->
            <div class="mt-2 text-2xl font-bold">
              <span class="text-primary-500">{{ product.priceFormatted }}</span>
            </div>

            <!-- quantity and add to cart button  -->
            <div class="py-4 border-b">
              <div class="w-32">
                <form-input-group
                  type="number"
                  v-model.number="quantity"
                  :label="product.unit.code"
                />
              </div>
              <div class="mt-1">
                <span
                  class="px-3 py-1 text-xs tracking-wider text-white uppercase bg-red-500 rounded-md"
                  v-if="outOfStock"
                  >Out of stock</span
                >
              </div>
            </div>

            <form-button type="button" @click="addToCart" class="w-full mt-auto"
              >Add To Cart</form-button
            >
          </div>
        </div>

        <!-- description and reviews -->
        <div class="mt-12 lg:pr-6">
          <!-- nav -->
          <div class="flex border-b-2 border-gray-200">
            <h5
              class="pb-4 font-semibold cursor-pointer mr-7"
              :class="{ active: activeComponent == 'product-description' }"
              @click="activeComponent = 'product-description'"
            >
              Description
            </h5>
            <h5
              class="pb-4 font-semibold cursor-pointer mr-7"
              :class="{ active: activeComponent == 'product-reviews' }"
              @click="activeComponent = 'product-reviews'"
            >
              Reviews
            </h5>
          </div>

          <!-- body -->
          <div class="my-8">
            <div v-if="activeComponent == 'product-description'">
              <product-description :description="product.description" />
            </div>
            <div v-else>
              <product-reviews />
            </div>
          </div>
        </div>
      </div>

      <!-- Right side -->
      <div class="lg:w-3/12">
        <!-- Related products -->
        <div
          class="px-5 mt-6 overflow-hidden bg-white border border-gray-200 rounded-md lg:mt-0"
        >
          <h4 class="my-5 font-semibold">Related products</h4>

          <div>
            <div
              class="flex py-5 border-t border-gray-200"
              v-for="(relatedProduct, i) in relatedProducts"
              :key="i"
            >
              <!-- image -->
              <div class="flex-none w-20 h-20">
                <img
                  :src="relatedProduct.imageUrl"
                  style="object-fit: contain"
                  alt="product"
                />
              </div>
              <!-- details -->
              <div class="ml-3">
                <!-- category -->
                <div class="mt-1 ml-1 text-xs font-semibold text-gray-700">
                  {{ relatedProduct.category.name }}
                </div>

                <!-- name -->
                <h6>
                  <nuxt-link
                    :to="`/products/${product.id}`"
                    class="inline-block mt-2 font-semibold text-md"
                    >{{ relatedProduct.name }}</nuxt-link
                  >
                </h6>
                <!-- price -->
                <div class="mt-1 text-sm font-bold">
                  <span class="text-primary-500">{{
                    relatedProduct.priceFormatted
                  }}</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </loader>
</template>

<script>
import { mapGetters } from "vuex";
export default {
  name: "single-product",
  head() {
    return {
      title: this.product && this.product.name,
    };
  },
  data() {
    return {
      quantity: 1,
      product: null,
      relatedProducts: null,
      activeComponent: "product-description",
    };
  },
  computed: {
    ...mapGetters({
      cartItems: "cart/getCartItems",
    }),
    shareLink() {
      return `${process.env.APP_URL}shop/${this.$route.params.id}`;
    },

    outOfStock() {
      return this.product.quantity <= 0 ? true : false;
    },
  },

  methods: {
    addToCart() {
      // before adding to cart, check quantity
      if (this.quantity <= 0) {
        return this.$toast.error("Quantity must be greater than 0");
      }
      let selectedItem = this.cartItems.find(
        (product) => product.id == this.product.id
      );

      let quantityTotal = this.quantity;
      if (selectedItem) {
        quantityTotal += selectedItem.quantity;
      }

      // check the stock
      if (quantityTotal > this.product.quantity) {
        return this.$toast.error("Quantity exceeds available stock");
      }

      this.$store.dispatch("cart/addToCart", {
        ...this.product,
        quantity: this.quantity,
      });
    },
  },
  async fetch() {
    const response = await this.$axios.$get(
      `/products/${this.$route.params.id}`
    );
    this.product = response.data;
    this.relatedProducts = response.relatedProducts;
  },
};
</script>

<style lang="scss" scoped>
.active {
  margin-bottom: -2px;
  @apply border-b-2 border-primary-500 text-primary-500;
}
</style>

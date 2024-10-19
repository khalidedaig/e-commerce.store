<template>
  <div class="py-10">
    <div class="container">
      <div :class="{'lg:flex':isCartNotEmpty}">
        <div :class="{'lg:w-9/12 lg:mr-5':isCartNotEmpty}">
          <h5 class="mb-3 text-xl font-semibold">Cart Items</h5>
          <!-- cart item -->
          <div class="overflow-hidden rounded-md" v-if="isCartNotEmpty">
            <div class="w-full overflow-x-auto overflow-y-hidden">
              <table>
                <thead>
                  <tr>
                    <th>Product</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="(item, index) in cartItems" :key="index">
                    <td>
                      <div class="w-16 h-16">
                        <img
                          :src="item.imageUrl"
                          class="object-cover w-full h-full"
                          :alt="item.name"
                        />
                      </div>
                    </td>
                    <td>{{ item.name }}</td>
                    <td>{{ item.priceFormatted }}</td>
                    <td>
                      <form-input-group
                        :label="item.unit.code"
                        @input="changedQuantity($event, item)"
                        :value="item.quantity"
                      ></form-input-group>
                    </td>
                    <td>
                      <span class="font-semibold">
                        {{ currencyFormat(item.quantity * item.price) }}
                      </span>
                    </td>
                    <td>
                      <remove-icon-button
                        @click="removeFromCart(item)"
                      ></remove-icon-button>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          <!-- if no cart items -->
          <div v-else>
            <div
              class="flex flex-col items-center justify-center text-gray-300 rounded-lg h-44 bg-gray-50"
            >
              <svg
                xmlns="http://www.w3.org/2000/svg"
                class="w-8 h-8"
                viewBox="0 0 20 20"
                fill="currentColor"
              >
                <path d="M4 3a2 2 0 100 4h12a2 2 0 100-4H4z" />
                <path
                  fill-rule="evenodd"
                  d="M3 8h14v7a2 2 0 01-2 2H5a2 2 0 01-2-2V8zm5 3a1 1 0 011-1h2a1 1 0 110 2H9a1 1 0 01-1-1z"
                  clip-rule="evenodd"
                />
              </svg>
              <p class="mt-2 text-gray-400">Your cart is Empty!</p>
            </div>
          </div>
        </div>
        <div v-if="isCartNotEmpty" class="mt-10 md:w-6/12 lg:w-3/12 lg:mt-0">
          <h5 class="mb-3 text-xl font-semibold">Cart Details</h5>

          <div class="p-4 bg-gray-200 rounded-md">
            <p class="flex justify-between py-2 text-sm">
              <span class="font-medium"> Sub Total: </span>
              <span class="font-bold">
                {{ currencyFormat(totalPrice) }}
              </span>
            </p>
            <p
              class="flex justify-between py-2 text-sm border-b border-gray-300"
            >
              <span class="font-medium"> Discount: </span>
              <span class="font-bold">
                {{ currencyFormat(totalDiscount) }}
              </span>
            </p>
            <p class="flex justify-between py-2 text-sm">
              <span class="font-medium"> Cart Total: </span>
              <span class="font-bold">
                {{ currencyFormat(grandTotal) }}
              </span>
            </p>
          </div>
          <button-link class="w-full mt-4 text-sm uppercase" to="/checkout"
            >PROCEED TO CHECKOUT</button-link
          >
        </div>
        <div v-else class="flex justify-center">
          <button-link class="mt-4 text-sm uppercase" to="/shop"
            >
            CONTINUE SHOPPING
            </button-link>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { mapGetters, mapMutations } from "vuex";
export default {
  computed: {
    ...mapGetters({
      cartItems: "cart/getCartItems",
      totalItems: "cart/getTotalItem",
      totalPrice: "cart/getTotalPrice",
      totalDiscount: "cart/getTotalDiscount",
      grandTotal: "cart/getGrandTotal",
    }),

    isCartNotEmpty() {
      return !this.totalItems === 0;
    },
  },

  methods: {
    ...mapMutations({
      cartItemQuantity: "cart/CART_ITEM_QUANTITY",
    }),

    removeFromCart(item) {
      this.$store.dispatch("cart/removeFromCart", item);
    },

    changedQuantity(value, item) {
      this.cartItemQuantity({
        item,
        val: value,
      });
    },
  },
};
</script>

<style lang="scss" scoped>
.disabled {
  pointer-events: none;
  opacity: 0.6;
}
</style>

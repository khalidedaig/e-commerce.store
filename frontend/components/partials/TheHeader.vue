<template>
  <header>
    <!-- main nav -->
    <nav class="fixed z-10 w-full px-2 bg-white shadow nav">
      <div class="container flex items-center justify-between h-full">
        <!-- logo -->
        <responsive-logo></responsive-logo>

        <!-- Nav items -->
        <div class="items-center hidden h-full navigation md:flex md:ml-auto">
          <!-- links -->
          <ul class="flex items-center h-full px-6 mt-1">
            <li class="nav-item">
              <h6>
                <nuxt-link to="/">Home</nuxt-link>
              </h6>
            </li>
            <li class="nav-item">
              <h6>
                <nuxt-link to="/shop">Shop</nuxt-link>
              </h6>
            </li>
            <li class="nav-item">
              <h6>
                <nuxt-link to="/contact-us">Contact-us</nuxt-link>
              </h6>
            </li>
          </ul>
        </div>

        <div class="flex items-center ml-auto md:ml-0">
          <!-- Cart -->
          <cart-dropdown></cart-dropdown>

          <!-- profile -->
          <profile-dropdown
            class="hidden md:inline-block"
            v-if="$auth.loggedIn && $auth.user.type == 'customer'"
          ></profile-dropdown>

          <!-- Login button -->
          <form-button
            v-else
            type="button"
            @click="$router.push('/login')"
            class="hidden px-4 md:inline-block lg:px-6"
            to="/register"
            >Sign In</form-button
          >
        </div>

        <!-- Mobile Nav toggle -->
        <div
          @click="toggleMobileNav"
          class="inline-block ml-4 cursor-pointer md:hidden text-primary-500"
        >
          <hamburger-icon></hamburger-icon>
        </div>
      </div>
    </nav>
    <!-- mobile-nav -->
    <transition name="mobile-nav" mode="out-in" appear>
      <sidebar v-if="mobileNav" v-click-outside="hide"></sidebar>
    </transition>
  </header>
</template>

<script>
import ClickOutside from "vue-click-outside";
export default {
  name: "TheHeader",
  data() {
    return {
      mobileNav: false,
      cartItem: true,
    };
  },
  methods: {
    toggleMobileNav() {
      this.mobileNav = !this.mobileNav;
    },
    hide() {
      this.mobileNav = false;
    },
  },

  // do not forget this section
  directives: {
    ClickOutside,
  },

  mounted() {
    // prevent click outside event with popupItem.
    this.popupItem = this.$el;
  },
};
</script>

<style lang="scss" scoped>
header {
  z-index: 99;
  box-shadow: 0 0 10px rgb(136 136 136 / 10%);
}

.nav {
  height: 80px;
}

.nav-item {
  @apply px-4 lg:px-6 font-semibold;
}

.nav-link {
  transition: all 0.2s ease;
  @apply hover:text-primary-500 mx-1 text-sm;
}

.dropdown-link {
  @apply block px-4 py-2 mt-2 text-sm font-semibold bg-transparent text-gray-900 rounded-lg md:mt-0 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none cursor-pointer;
}

.nuxt-link-exact-active {
  @apply text-primary-500;
}

.mobile-nav-enter-active,
.mobile-nav-leave-active {
  transition: all 0.3s ease-in-out;
}

.mobile-nav-enter,
.mobile-nav-leave-to {
  transform: translateX(-100%);
}
</style>

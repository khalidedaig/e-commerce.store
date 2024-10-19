<template>
  <div
    class="flex items-center justify-center h-full py-10 bg-white food-categories"
  >
    <div class="container">
      <div class="p-6 bg-white rounded-md food-box">
        <section-header>
          <template #title>Popular Categories</template>
          <template #subtitle>
            Organic food has been a major trend with farmers and consumers alike
            for the past decade. These days, you can buy organic food in just
            about every grocery store. But many people don’t even know exactly
            what organic food is. Let’s dig into the five main types of organic
            food and the benefits they can bring!
          </template>
        </section-header>
        <div class="mt-16" v-if="categories.length">
          <category-slider :categories="categories"></category-slider>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { mapGetters } from "vuex";
export default {
  name: "food-categories",

  computed: {
    ...mapGetters({
      categories: "global/getCategories",
    }),
  },
};
</script>

<style lang="scss" scoped>
.food-box {
  box-shadow: #7c3aed15 2px 2px 6px 2px;
}
</style>

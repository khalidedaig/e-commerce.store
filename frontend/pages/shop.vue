<template>
  <div class="bg-white">
    <!-- shop -->
    <div class="py-10">
      <div class="container flex flex-col md:flex-row">
        <!-- left side -->
        <div class="w-full">
          <!-- top filters -->
          <div class="flex flex-col justify-between xs:flex-row">
            <div class="flex items-center space-x-2">
              <form-select
                class="w-full mb-4 xs:mb-0"
                v-model="filters.sort"
                track="value"
                :showPlaceholder="false"
                :options="sortOptions"
                variant="small"
              />
              <form-select
                class="w-full mb-4 xs:mb-0"
                v-model="filters.categories"
                track="value"
                :showPlaceholder="false"
                :options="customCategories"
                variant="small"
              />
            </div>

            <!-- Search -->
            <form-search
              v-model="filters.search"
              width="200px"
              variant="small"
            ></form-search>
          </div>

          <!-- products -->
          <div
            class="grid grid-cols-1 gap-5 mt-6 xs:grid-cols-2 md:grid-cols-3 lg:grid-cols-4"
          >
            <product-card
              v-for="(product, index) in products"
              :key="index"
              :product="product"
            ></product-card>
          </div>

          <!-- infinite loading -->
          <client-only>
            <infinite-loading
              @distance="10"
              @infinite="handleLoadMore"
              :identifier="infiniteId"
            >
              <span slot="no-more"></span>
            </infinite-loading>
          </client-only>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { mapGetters } from "vuex";
import debounce from "lodash/debounce";
import { name } from "nuxt-dropzone";
export default {
  name: "shop",
  head() {
    return {
      title: "Shop",
    };
  },
  data() {
    return {
      products: [],
      page: 1,
      infiniteId: +new Date(),
      filters: {
        categories: [],
        search: "",
        sort: "created_at,desc",
      },
      sortOptions: [
        { value: "created_at,desc", name: "Newest First" },
        { value: "price,asc", name: "Lowest Price Frist" },
        { value: "price,desc", name: "Highest Price Frist" },
      ],
    };
  },

  computed: {
    ...mapGetters({
      categories: "global/getCategories",
    }),
    customCategories() {
      return [
        {
          value: "",
          name: "All Categories",
        },
        ...this.categories.map((category) => {
          return {
            value: category.id,
            name: category.name,
          };
        }),
      ];
    },
  },

  watch: {
    filters: {
      handler: debounce(function () {
        this.infiniteId++;
        this.products = [];
        this.page = 1;
      }, 500),
      deep: true,
    },
  },

  methods: {
    getQueries() {
      let queryString = "";
      for (const key in this.filters) {
        queryString += `&${key}=${this.filters[key]}`;
      }
      return queryString;
    },

    handleLoadMore($state) {
      this.$axios
        .$get(`/products?page=${this.page}${this.getQueries()}`)
        .then((res) => {
          const result = res.data;
          if (result.length) {
            result.forEach((value) => {
              this.products.push(value);
            });
            $state.loaded();
          } else {
            $state.complete();
          }
        });
      this.page = this.page + 1;
    },
  },

  mounted() {
    // Set search form route
    if (this.$route.query.search) {
      this.filters.search = this.$route.query.search;
    }
    // Set category form route
    if (this.$route.query.category) {
      this.filters.categories.push(parseInt(this.$route.query.category));
    }
  },
};
</script>

<style lang="scss" scoped></style>

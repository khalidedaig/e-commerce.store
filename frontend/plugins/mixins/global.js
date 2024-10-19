import Vue from "vue";

Vue.mixin({
  methods: {
    currencyFormat(value) {
      return "$ " + new Intl.NumberFormat("en-US").format(Math.round(value));
    },
  },
});

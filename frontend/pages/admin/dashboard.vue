<template>
  <main>
    <h1 class="text-2xl font-semibold text-gray-900">Dashboard</h1>
    <!-- Replace with your content -->
    <div class="py-4">
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        <card-statistic
          :count="statistics.visitors_count"
          name="Visitors"
          bgColor="primary"
        >
          <users-group-icon className="stroke-current text-primary-500" />
        </card-statistic>
        <card-statistic :count="statistics.orders_count" name="Orders">
          <shopping-bag-icon className="stroke-current text-blue-500" />
        </card-statistic>
        <card-statistic :count="statistics.sales" name="Sales">
          <arrow-trending-up-icon className="stroke-current text-red-500" />
        </card-statistic>
        <card-statistic :count="statistics.balances" name="Balances">
          <currency-icon className="stroke-current text-green-500" />
        </card-statistic>
      </div>
    </div>
    <!-- /End replace -->
  </main>
</template>

<script>
import CardStatistic from "~/components/admin/AdminCardStatistic.vue";
import CurrencyIcon from "~/components/icons/CurrencyIcon.vue";
export default {
  name: "dashboard",
  layout: "admin",
  components: { CardStatistic, CurrencyIcon },
  head() {
    return {
      title: "Dashboard",
    };
  },
  data() {
    return {
      statistics: {
        orders_count: 10,
        visitors_count: 20,
        sales: "$10,000",
        balances: "$2,000",
      },
    };
  },
};
</script>

<style lang="scss" scoped></style>

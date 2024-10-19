<template>
  <svg
    width="30"
    height="30"
    fill="none"
    viewBox="0 0 24 24"
    stroke="currentColor"
    :class="className"
  >
    <path
      stroke-linecap="round"
      stroke-linejoin="round"
      stroke-width="2"
      d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"
    ></path>
  </svg>
</template>

<script>
export default {
  props: {
    className: {
      type: String,
      default: "h-5 w-5",
    },
  },
};
</script>

<style lang="scss" scoped></style>

<template>
  <div
    :class="[
      `bg-${bgColor}-500
    dark:bg-gray-800
    shadow-lg
    rounded-md
    flex
    items-center
    justify-between
    p-3
    border-b-4
    border-${bgColor}-600
    dark:border-gray-600
    text-${textColor}
    font-medium
    group`,
    ]"
  >
    <div
      :class="[
        `flex justify-center items-center w-14 h-14 bg-${textColor} rounded-full transition-all duration-300 transform group-hover:rotate-12`,
      ]"
    >
      <slot />
    </div>
    <div class="text-right">
      <p class="text-2xl">{{ count }}</p>
      <p>{{ name }}</p>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    count: [String, Number],
    name: String,
    bgColor: {
      type: String,
      default: "blue",
    },
    textColor: {
      type: String,
      default: "white",
    },
  },
};
</script>

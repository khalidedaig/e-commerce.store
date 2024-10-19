<template>
  <div>
    <h2 class="text-xl font-semibold">Customer Reviews</h2>

    <!-- rating -->
    <div class="flex items-center pb-8 mt-3 text-sm rating">
      <!-- rating component -->
      <client-only>
        <star-rating
          :rating="4.5"
          :star-size="15"
          :increment="0.5"
          :padding="5"
          :show-rating="false"
          active-color="#F59E0B"
          :read-only="true"
          :star-points="[
            23, 2, 14, 17, 0, 19, 10, 34, 7, 50, 23, 43, 38, 50, 36, 34, 46, 19,
            31, 17,
          ]"
          style="margin-top: -2px"
        ></star-rating>
      </client-only>
      <span class="mt-1 ml-1 font-bold text-gray-700"> ( 95 Reviews ) </span>
    </div>

    <!-- users -->
    <div
      v-for="(item, i) in 3"
      :key="i"
      class="flex items-start py-8 border-t border-gray-200"
    >
      <!-- user image -->
      <div>
        <div
          class="flex items-center justify-center w-16 h-16 overflow-hidden bg-gray-100 rounded-md shadow-sm md:w-24 md:h-24"
        >
          <svg
            xmlns="http://www.w3.org/2000/svg"
            class="w-10 h-10"
            fill="none"
            viewBox="0 0 24 24"
            stroke="currentColor"
          >
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"
            />
          </svg>
          <img
            src="/images/users/user-02.png"
            alt=""
            class="object-cover w-full h-full"
          />
        </div>
      </div>

      <div class="ml-5">
        <div class="items-center justify-between sm:flex">
          <div>
            <h3 class="text-lg font-semibold">Username</h3>
            <!-- rating -->
            <div class="flex items-center text-sm text-yellow-500 rating">
              <!-- rating component -->
              <client-only>
                <star-rating
                  v-model="userReview.rating"
                  :read-only="true"
                  :star-size="15"
                  :padding="5"
                  :increment="0.5"
                  :show-rating="false"
                  active-color="#F59E0B"
                  :star-points="[
                    23, 2, 14, 17, 0, 19, 10, 34, 7, 50, 23, 43, 38, 50, 36, 34,
                    46, 19, 31, 17,
                  ]"
                  style="margin-top: -3px"
                ></star-rating>
              </client-only>
            </div>
          </div>
          <div class="mt-1 sm:mt-0">
            <span
              class="hidden px-4 py-2 text-xs border border-gray-200 rounded-md sm:block md:text-sm"
              >Oct 19, 2024</span
            >
            <span class="block text-xs rounded-md sm:hidden md:text-sm"
              >Oct 19, 2024</span
            >
          </div>
        </div>

        <!-- review -->
        <div class="mt-4">
          <p>
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Minus
            consequuntur deserunt inventore soluta distinctio nisi!
          </p>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "ProductReview",
  data() {
    return {
      userReview: {
        rating: null,
        review: null,
      },
    };
  },
};
</script>

<style lang="scss" scoped></style>

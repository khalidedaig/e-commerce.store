<template>
	<div class="py-10">
			<div class="container flex flex-col items-center justify-center">
					<h3 class="mb-4 text-3xl font-bold text-primary-500">
							Contact Us
					</h3>
					<p class="mb-4 text-center text-gray-600">
							We are here to help and answer any questions you might have. We look forward to hearing from you.
					</p>
					<form
							@submit.prevent="register"
							class="w-full max-w-lg px-4 py-8 mt-5 bg-white border rounded-md shadow-lg"
					>
							<!-- First Name -->
							<div class="">
									<form-label
											class="mb-2"
											for="name"
											value="First Name"
									></form-label>
									<form-input
											id="name"
											type="text"
											class="w-full"
											v-model="form.name"
									></form-input>
									<form-error :message="validationErrors.name" class="mt-2" />
							</div>

							<!-- Email -->
							<div class="mt-4">
									<form-label class="mb-2" for="email" value="Email"></form-label>
									<form-input
											id="email"
											type="email"
											class="w-full"
											v-model="form.email"
									></form-input>
									<form-error :message="validationErrors.email" class="mt-2" />
							</div>


							<!-- Message -->
							<div class="mt-4">
									<form-label class="mb-2" for="message" value="Message"></form-label>
									<form-text-input
											id="message"
											class="w-full"
											v-model="form.message"
									></form-text-input>
									<form-error :message="validationErrors.message" class="mt-2" />
							</div>

							<form-button class="w-full py-3 mt-6 text-white bg-primary-500">
									Send
							</form-button>
					</form>
			</div>
	</div>
</template>

<script>
import form from "~/plugins/mixins/form";
export default {
	name: "customer-register",
	mixins: [form],
	data() {
			return {
					form: {
							name: "",
							email: "",
							message: "",
					},
			};
	},
	methods: {
			async register() {
					try {
							await this.$axios.$post("/contact-us", this.form)
							.then((response) => {
									this.$toast.success(response.data.message);
									this.form = {};
							})
					} catch (error) {
							console.log(error);
					}
			},
	},
};
</script>

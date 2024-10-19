<template>
	<div class="flex items-center justify-center py-10 review-categories">
		<div class="container">
			<div class="w-full max-w-4xl py-6 mx-auto bg-white rounded-lg shadow-md">
				<!-- icon -->
				<div class="flex items-center justify-center w-24 h-24 mx-auto bg-primary-500">
					<svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-white" viewBox="0 0 20 20" fill="currentColor">
						<path d="M2 5a2 2 0 012-2h7a2 2 0 012 2v4a2 2 0 01-2 2H9l-3 3v-3H4a2 2 0 01-2-2V5z" />
						<path d="M15 7v2a4 4 0 01-4 4H9.828l-1.766 1.767c.28.149.599.233.938.233h2l3 3v-3h2a2 2 0 002-2V9a2 2 0 00-2-2h-1z" />
					</svg>
				</div>

				<div class="mt-16">
					<review-slider :reviews="reviews"></review-slider>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
export default {
	data() {
		return {
			reviews: [
				{
					name: "Motasim Fuad",
					review: " Extend Accurate Services Long Term High Impact Experiences Interactiv Streamline Team Compelingly Simplify Solutions Before Technicaly Sound Leadership Skills Creative Holstic Process Improvements Proactively Streamline Alternative Niche Markets Forwor Resource Conveniently cultivate pandemic technology and corporate.",
					profilePhotoUrl: "/images/users/user-02.png",
				},
				{
					name: "Naveed Ali",
					profession: "Profession",
					review: " Extend Accurate Services Long Term High Impact Experiences Interactiv Streamline Team Compelingly Simplify Solutions Before Technicaly Sound Leadership Skills Creative Holstic Process Improvements Proactively Streamline Alternative Niche Markets Forwor Resource Conveniently cultivate pandemic technology and corporate.",
					profilePhotoUrl: "/images/users/user-03.png",
				},
				{
					name: "Irfan Khan",
					profession: "Profession",
					review: " Extend Accurate Services Long Term High Impact Experiences Interactiv Streamline Team Compelingly Simplify Solutions Before Technicaly Sound Leadership Skills Creative Holstic Process Improvements Proactively Streamline Alternative Niche Markets Forwor Resource Conveniently cultivate pandemic technology and corporate.",
					profilePhotoUrl: "/images/users/user-04.png",
				},
			],
		};
	},
};
</script>

<style lang="scss" scoped>
.review-categories {
	background-image: linear-gradient(
			rgba(139, 92, 246, 0.1),
			rgba(139, 92, 246, 0.1)
		),
		url("/images/banners/food-category.jpg");
	background-size: cover;
}
.review-box {
	@media (min-width: 1200px) {
		padding: 110px 70px;
	}
	@media (min-width: 576px) {
		padding: 60px 40px;
	}
	padding: 60px 30px;
	@apply rounded-lg shadow-md;
}
</style>

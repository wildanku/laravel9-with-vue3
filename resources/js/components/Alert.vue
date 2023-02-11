<template>
  <div v-if="type === 'success'">
		<div id="alertVue" style="position: fixed; bottom: 2em; right: 2em">
			<div class="box has-background-success has-text-white">
				<i class="far fa-thumbs-up"></i> <span class="ml-2">{{ message }}</span>
			</div>
		</div>
	</div>

	<div v-if="type === 'error'">
		<div id="alertVue" style="position: fixed; bottom: 2em; right: 2em">
			<div class="box has-background-danger has-text-white">
					<i class="fas fa-success"></i> <span class="ml-2">{{ message }}</span>
			</div>
		</div>
	</div>
</template>

<script>
	export default {
		props: {
			type: String,
			message: String
		},
		data() {
			return {

			}
		},
		created: function() {

		},
		methods: {

		}
	}
</script>

<style>

</style>
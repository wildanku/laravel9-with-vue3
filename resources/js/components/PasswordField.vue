<template>
	<div class="field">
		<label class="has-text-white">Password</label>
		<div class="is-flex">
			<input class="input password is-success" :type="passwordType" name="password" placeholder="Password">
			<button type="button" class="button" @click="changeType" style="cursor:pointer">
				<i class="fas fa-eye"></i>
			</button>
		</div>
	</div>
</template>

<script>

export default {
    data() {
        return {
            passwordType: 'password'
        }
    },
    methods: {
        changeType() {
            if(this.passwordType === 'password') {
							this.passwordType = 'text'
            } else {
							this.passwordType = 'password'
            }
        }
    }
}
</script>

<style>
	input.password {
		border: none !important;
		border-radius: 5px 0px 0px 5px;
		background: #fff !important;
	}
	.button {
		background: #fff;
		border: none !important;
		border-radius: 0px 5px 5px 0px;
	}
</style>

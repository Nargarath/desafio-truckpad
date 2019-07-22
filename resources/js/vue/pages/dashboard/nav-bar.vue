<template>
	<a-layout-sider
		:trigger="null"
		collapsible
		v-model="collapsed"
	>
		<div class="logo" />
		<a-menu theme="dark" mode="inline" :defaultSelectedKeys="['1']">
			<a-menu-item key="1">
				<a-icon type="user" />
				<span>Pessoas</span>
			</a-menu-item>
		</a-menu>
	</a-layout-sider>
</template>
<script>
export default {
	props: {
		collapsed: {
			type: Boolean,
			required: true
		}
	},
	data(){
		return{
		}
	}
}
</script>
<style lang="scss" scoped>
.logo {
  height: 32px;
  background: rgba(255,255,255,.2);
  margin: 16px;
}
</style>

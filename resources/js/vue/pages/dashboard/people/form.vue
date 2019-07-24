<template>
	<div>
		<div class="title">
			<h2>Fulano</h2>
			<a-button shape="circle" icon="edit" />
		</div>
		<a-form
				:layout="formLayout"
				:form="form"
				@submit="handleSubmit"
			>
			<a-row :gutter="24">
			<a-col
				:span="12"
			>
			<a-form-item
				label="Name"
				:label-col="{ span: 2 }"
				:wrapper-col="{ span: 19 }"
			>
				<a-input
					v-decorator="[
						'name',
						{rules: [{ required: true, message: 'Please input your note!' }]}
					]"
				/>
			</a-form-item>
			</a-col>
			<a-col
				:span="12"
			>			
			<a-form-item
				label="Birthday"
				:label-col="{ span: 3 }"
				:wrapper-col="{ span: 19 }"
				:style="{ position: 'relative' }"
			>
				<a-date-picker style="width: 100%" />
			</a-form-item>
			</a-col>
			</a-row>
		</a-form>
	</div>
</template>
<script>
export default {
		props: {
			people: {
				type: Object,
				required: false
			},
			editing: {
				type: Boolean,
				required: false,
				default: false
			}
		},
    data(){
			return {
				formLayout: 'horizontal',
				form: this.$form.createForm(this),
			}
		},
		methods: {
			handleSubmit (e) {
				e.preventDefault();
				this.form.validateFields((err, values) => {
					if (!err) {
						console.log('Received values of form: ', values);
					}
				});
			},
			handleSelectChange (value) {
				console.log(value);
				this.form.setFieldsValue({
					note: `Hi, ${value === 'male' ? 'man' : 'lady'}!`,
				});
			},
		}
}
</script>
<style lang="scss" scoped>

</style>

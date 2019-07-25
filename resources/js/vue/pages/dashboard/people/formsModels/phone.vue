<template>
	<div :id="divId">
		<a-form
			:layout="formLayout"
			:form="form"
			@submit="handleSubmit"
		>
			<a-form-item
				label="Número"
			>
				<a-input
					v-decorator="[
						'number',
						{rules: [{ required: true, message: 'Por favor, digite número de telefone!' }]}
					]"
					:disabled="disabled"
					@change="(value) => {
						this.onChangeInput('number',value);
					}"
				/>
			</a-form-item>
		</a-form>
	</div>
</template>
<script>
import { mapGetters, mapMutations } from "vuex";
import {
	SET_PEOPLE_EDITING,
	SET_PEOPLE_SELECTED
} from "../../../../store/modules/people/mutations.type"
export default {
	props:{
		dataIndex: {
			type: Number,
			required: true
		},
		disabled: {
			type: Boolean,
			required: true
		}
	},
	computed: {
		...mapGetters(['peopleSelected','editingPeople','phoneForms']),
		divId() {
			return `document-${this.dataIndex}`;
		}
	},
	data() {
		return {
			formLayout: 'horizontal',
			form: this.$form.createForm(this),
		}
	},
	methods: {
		handleSubmit () {
			return this.form;
		},
		onChangeInput(variable,value) {

		}
	}
}
</script>
<style lang="scss" scoped>

</style>

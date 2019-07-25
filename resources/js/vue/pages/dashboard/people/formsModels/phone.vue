<template>
	<div :id="divId">
		<a-form
			:layout="formLayout"
			:form="form"
			@submit="handleSubmit"
		>
			<a-form-item>
				<a-input
					v-decorator="[
						'id',
						{
							initialValue: getInternalDataIfNotNull(phoneData.id)
						}
					]"
					:disabled="disabled"
					@change="(value) => {
						this.onChangeInput('id',value);
					}"
					type="hidden"
				/>
			</a-form-item>
			<a-form-item
				label="Número"
			>
				<a-input
					v-decorator="[
						'number',
						{
							rules: [{ required: true, message: 'Por favor, digite número de telefone!' }],
							initialValue: getInternalDataIfNotNull(phoneData.number)
						}
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
		},
		peopleSelectedRef: {
			type: Object,
			required: false
		}
	},
	computed: {
		...mapGetters(['peopleSelected','editingPeople','phoneForms']),
		divId() {
			return `document-${this.dataIndex}`;
		},
		phoneData() {
			if(!this.isEmpty(this.peopleSelected.phone) && this.peopleSelected.phone.length){
				return this.peopleSelected.phone[this.dataIndex-1]
			} 
			return []
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

		},
		getInternalDataIfNotNull(data) {
			if (data) {
				return data;
			}
			return '';
		}
	}
}
</script>
<style lang="scss" scoped>

</style>

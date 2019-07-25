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
							initialValue: getInternalDataIfNotNull(documentData.id)
						}
					]"
					@change="(value) => {
						this.onChangeInput('id',value);
					}"
					type="hidden"
				/>
			</a-form-item>
			<a-form-item
				label="Tipo de documento"
			>
				<a-select
					v-decorator="[
						'doc_type',
						{
							rules: [{ required: true, message: 'por favor, selecione o tipo de documento!' }],
							initialValue: getInternalDataIfNotNull(documentData.doc_type)
						}
					]"
					placeholder="selecione um tipo"
					@change="(value) => {
						this.onChangeInput('doc_type',value);
					}"
					:disabled="disabled"
				>
					<a-select-option value="cnpj">
						CNPJ
					</a-select-option>
					<a-select-option value="cpf">
						CPF
					</a-select-option>
					<a-select-option value="cng">
						CNH
					</a-select-option>
				</a-select>
			</a-form-item>
			<a-form-item
				label="Número do documento"
			>
				<a-input
					v-decorator="[
						'number',
						{
							rules: [{ required: true, message: 'Por favor, digite o número do documento!' }],
							initialValue: getInternalDataIfNotNull(documentData.number)
						}
					]"
					:disabled="disabled"
					@change="(value) => {
						this.onChangeInput('number',value);
					}"
				/>
			</a-form-item>
			<a-form-item
				label="País"
			>
				<a-input
					v-decorator="[
						'country',
						{
							rules: [{ required: true, message: 'Por favor, digite o nome do país!' }],
							initialValue: getInternalDataIfNotNull(documentData.country)
						}
					]"
					:disabled="disabled"
					@change="(value) => {
						this.onChangeInput('country',value);
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
		...mapGetters(['peopleSelected','editingPeople']),
		divId() {
			return `document-${this.dataIndex}`;
		},
		documentData() {
			if(!this.isEmpty(this.peopleSelected.document) && this.peopleSelected.document.length > this.dataIndex-1){
				return this.peopleSelected.document[this.dataIndex-1]
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
		handleDocumentType(value) {

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

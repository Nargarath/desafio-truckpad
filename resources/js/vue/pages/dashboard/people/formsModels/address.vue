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
						initialValue: getInternalDataIfNotNull(addressData.id)
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
				label="Tipo de Endereço"
			>
				<a-select
					v-decorator="[
						'name',
						{
							rules: [{ required: true, message: 'por favor, selecione o tipo de endereço!' }],
							initialValue: getInternalDataIfNotNull(addressData.name)
						}
					]"
					placeholder="selecione um tipo"
					@change="(value) => {
						this.onChangeInput('name',value);
					}"
					style="width: 100%"
					:disabled="disabled"
				>
					<a-select-option value="billing_address">
						Endereço de cobrança
					</a-select-option>
					<a-select-option value="personal_address">
						Endereço Pessoal
					</a-select-option>
				</a-select>
			</a-form-item>
				<a-form-item
				label="CEP"
				:span="12"
				@change="(value) => {
						this.onChangeInput('postal_code',value);
					}"
			>
				<a-input-number
					:formatter="value => `${value}`.replace(/^([\d]{2})\.*([\d]{3})-*([\d]{3})/,'$1.$2-$3')"
					:parser="value => value.replace(/\$\s?|(,*)/g, '')"
					@change="onChangePostalCode"
					:disabled="disabled"
					v-decorator="[
						'postal_code',
						{
							rules: [{ required: true, message: 'Por favor, digite o cep!' }],
							initialValue: getInternalDataIfNotNull(addressData.postal_code)
						}
					]"
					style="width: 100%"
					:max="99999999"
				/>
			</a-form-item>


			<a-form-item
				label="Nome da rua"
				:span="12"
			>
				<a-input
					v-decorator="[
						'street_name',
						{
							rules: [{ required: true, message: 'Por favor, digite o nome da rua/avenida/logradouro!' }],
							initialValue: getInternalDataIfNotNull(addressData.street_name)
						}
					]"
					:disabled="disabled"
					@change="(value) => {
						this.onChangeInput('street_name',value);
					}"
				/>
			</a-form-item>
			<a-form-item
				label="Número"
				:span="12"
			>
				<a-input
					v-decorator="[
						'street_number',
						{
							rules: [{ required: true, message: 'Por favor, digite o numero do local!' }],
							initialValue: getInternalDataIfNotNull(addressData.street_number)
						}
					]"
					:disabled="disabled"
					@change="(value) => {
						this.onChangeInput('street_number',value);
					}"
				/>
			</a-form-item>
			<a-form-item
				label="Complemento"
				:span="12"
			>
				<a-input
					v-decorator="[
						'complement',
						{
							rules: [{ required: true, message: 'Por favor, digite o complemento!' }],
							initialValue: getInternalDataIfNotNull(addressData.complement)
						}
					]"
					:disabled="disabled"
					@change="(value) => {
						this.onChangeInput('complement',value);
					}"
				/>
			</a-form-item>
			<a-form-item
				label="Bairro"
				:span="12"
			>
				<a-input
					v-decorator="[
						'neighborhood',
						{
							rules: [{ required: true, message: 'Por favor, digite o bairro!' }],
							initialValue: getInternalDataIfNotNull(addressData.neighborhood)
						}
					]"
					:disabled="disabled"
					@change="(value) => {
						this.onChangeInput('neighborhood',value);
					}"
				/>
			</a-form-item>
			<a-form-item
				label="Estado"
				:span="12"
			>
				<a-input
					v-decorator="[
						'state',
						{
							rules: [{ required: true, message: 'Por favor, digite o estado!' }],
							initialValue: getInternalDataIfNotNull(addressData.state)
						}
					]"
					:disabled="disabled"
					@change="(value) => {
						this.onChangeInput('state',value);
					}"
				/>
			</a-form-item>
			<a-form-item
				label="Cidade"
				:span="12"
			>
				<a-input
					v-decorator="[
						'city',
						{
							rules: [{ required: true, message: 'Por favor, digite a cidade!' }],
							initialValue: getInternalDataIfNotNull(addressData.city)
						}
					]"
					:disabled="disabled"
					@change="(value) => {
						this.onChangeInput('city',value);
					}"
				/>
			</a-form-item>
			<a-form-item
				label="País"
				:span="12"
			>
				<a-input
					v-decorator="[
						'country',
						{
							rules: [{ required: true, message: 'Por favor, digite o país!' }],
							initialValue: getInternalDataIfNotNull(addressData.country)
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
import AddressService from "../../../../services/address.service"
import { mapGetters, mapMutations } from "vuex";
import {
	SET_PEOPLE_EDITING,
	SET_PEOPLE_SELECTED,
	SET_ADDRESS_FORM
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
		addressData() {
			if( !this.isEmpty(this.peopleSelected.address) && this.peopleSelected.address.length){
				return this.peopleSelected.address[this.dataIndex-1]
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
		handleAddressType(value) {

		},
		onChangePostalCode(value){
			if(value.toString().length === 8){
				AddressService.getByPostalCode(value)
				.then(
					({data}) => {
						const { cep, logradouro, bairro, localidade, uf } = data;

					}
				);
			}
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

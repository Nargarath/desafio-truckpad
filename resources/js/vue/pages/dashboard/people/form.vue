<template>
	<div>
		<a-row :gutter="24">
			<a-col
				:xs="26"
			>
				<a-alert :message="formReturn.message" :type="formReturn.type" showIcon :class="{'hidden': !formReturn.active}"/>
			</a-col>
		</a-row>
		<a-row :gutter="24">
			<a-col
				:xs="12"
			>
				<router-link :to="{ name: `dashboard.people.index`}">
						<a-button type="default" icon="rollback" class="goback-buttom">Voltar</a-button>
				</router-link>
			</a-col>
			<a-col
				:xs="12"
				align="end"
			>
				<a-button type="primary" icon="save" :disabled="disabledInput" @click="handlePeopleSubmit">Salvar</a-button>
			</a-col>
		</a-row>
		
		<div class="title">
			<a-icon type="user-add" :class="{'hidden':this.peopleSelected.name}" />
			<h1>{{this.peopleSelected.name || 'Nova pessoa'}}</h1>
			<a-button shape="circle" icon="edit" :type="editingButtonType" @click="toggleEditingPeople()" :class="{'hidden': isCreating}" />
		</div>
		<a-form
				:layout="formLayout"
				:form="form"
				@submit="handlePeopleSubmit"
			>
			<a-row :gutter="12">
				<a-col
					:xs="24"
					:md="12"
				>
					<a-form-item
						label="Nome"

					>
						<a-input
							v-decorator="[
								'name',
								{
									rules: [
										{ required: true, message: 'Por favor, digite seu nome!' }
									],
									initialValue: this.peopleSelected.name
								},
							]"
							:disabled="disabledInput"
						/>
					</a-form-item>
				</a-col>
				<a-col
					:xs="24"
					:md="12"
				>			
					<a-form-item
						label="Aniversário"
						:style="{ position: 'relative' }"
					>
						<a-date-picker
							style="width: 100%"
							:disabled="disabledInput"
							v-decorator="[
								'birth_date',
								{
									rules: [
										{ required: true, message: 'Por favor, selecione a data de seu aniversário!' }
									],
									initialValue: momentObject
								},
							]"
							/>
					</a-form-item>
				</a-col>
			</a-row>
		</a-form>
		<a-row :gutter="24">
			<a-col
				:span="26"
			>
				<div class="title">
					<a-icon type="paper-clip" />
					<h2>Documentos</h2>
					<a-button shape="circle" icon="plus" @click="addDocument()"/>
					<a-button shape="circle" type="danger" icon="minus" @click="removeDocument()" :class="{'hidden': !minDocument }"/>
				</div>
				<div class="forms">
					<div class="form-individual" v-for="index in documentNumber" :key="index">
						<h3>Documento <strong>{{index}}</strong></h3>
						<document-component ref="documentRef" :data-index="index" :disabled="disabledInput"></document-component>
					</div>
					
				</div>
			
			</a-col>
		</a-row>
		<a-row :gutter="24">
			<a-col
				:span="26"
			>
				<div class="title">
					<a-icon type="environment" />
					<h2>Endereços</h2>
					<a-button shape="circle" icon="plus" @click="addAddress()"/>
					<a-button shape="circle" type="danger" icon="minus" @click="removeAddress()" :class="{'hidden': !minAddress }"/>
				</div>
				<div class="forms">
					<div class="form-individual" v-for="index in addressNumber" :key="index">
						<h3>Endereço <strong>{{index}}</strong></h3>
						<address-component ref="addressRef" :data-index="index" :disabled="disabledInput" ></address-component>
					</div>
					
				</div>
			
			</a-col>
		</a-row>
		<a-row :gutter="24">
			<a-col
				:span="26"
			>
				<div class="title">
					<a-icon type="phone" />
					<h2>Telefones</h2>
					<a-button shape="circle" icon="plus" @click="addPhone()"/>
					<a-button shape="circle" type="danger" icon="minus" @click="removePhone()" :class="{'hidden': !minPhone }"/>
				</div>
				<div class="forms">
					<div class="form-individual" v-for="index in phoneNumber" :key="index">
						<h3>Telefone <strong>{{index}}</strong></h3>
						<phone-component ref="phoneRef" :data-index="index" :disabled="disabledInput" ></phone-component>
					</div>
					
				</div>
			
			</a-col>
		</a-row>
	</div>
</template>
<script>
import { mapGetters, mapMutations } from 'vuex';
import moment from 'moment';
import addressComponent from './formsModels/address'
import phoneComponent from './formsModels/phone'
import documentComponent from './formsModels/document'
import {
	SET_PEOPLE_EDITING,
	SET_PEOPLE_SELECTED
} from '../../../store/modules/people/mutations.type'
import ApiService from '../../../services/api.service'
export default {
	components:{
		addressComponent,
		phoneComponent,
		documentComponent
	},
	mounted() {
		this.startExtraDataValues();
	},
	computed: {
		...mapGetters(['peopleSelected','editingPeople']),
		disabledInput(){
			if(this.isCreating || this.editingPeople) {
				return false;
			}
			return true;
		},
		editingButtonType() {
			return this.editingPeople?'primary':'default';
		},
		momentObject() {
			return moment(this.peopleSelected.birth_date);
		},
		isCreating() {
			return this.isEmpty(this.peopleSelected);
		},
		minDocument(){
			return this.documentNumber>0;
		},
		minPhone(){
			return this.phoneNumber>0;
		},
		minAddress(){
			return this.addressNumber>0;
		}
	},
	data(){
		return {
			formLayout: 'vertical',
			form: this.$form.createForm(this),
			documentNumber: 0,
			phoneNumber: 0,
			addressNumber: 0,
			hasError: [],
			documents: [],
			phones: [],
			addresses: [],
			formReturn: {
				active: false,
				message: '',
				type: 'success'
			}
		}
	},
	methods: {
		handlePeopleSubmit (e) {
			e.preventDefault()
			this.hasError = []
			this.form.validateFields((err, values) => {

				this.validateDocumentsComponents()
				this.validateAddressesComponents()
				this.validatePhonesComponents()
				if(!err && !this.searchForErrors()) {
					const people = this.getPeopleMergeRelations(values);
					if (this.$route.params.id === 'create') {
						ApiService.post('people.post',people)
						.then(
							(data) => {
								this.formReturn.active = true
								this.formReturn.type = "success"
								this.formReturn.message = "Pessoa cadastrada com sucesso!"
								this[SET_PEOPLE_SELECTED](data);
							}
						);
					} else {
						ApiService.put('people.put',people , people.id)
						.then(
							(data) => {
								this.formReturn.active = true
								this.formReturn.type = "success"
								this.formReturn.message = "Pessoa atualizada com sucesso!"
							}
						);
					}
					
				}
			});
		},
		...mapMutations([SET_PEOPLE_EDITING,SET_PEOPLE_SELECTED]),
		toggleEditingPeople(status){
			if (this.editingPeople == true) {
				this[SET_PEOPLE_EDITING](false)
			} else {
				this[SET_PEOPLE_EDITING](true)
			}
		},
		addDocument() {
			this.documentNumber++
		},
		removeDocument() {
			this.documentNumber--
		},
		addAddress() {
			this.addressNumber++
		},
		removeAddress() {
			this.addressNumber--
		},
		addPhone() {
			this.phoneNumber++
		},
		removePhone() {
			this.phoneNumber--
		},
		searchForErrors(){
			for(const error of this.hasError){
				if(error) {
					return true
				}
			}
			return false
		},
		getPeopleMergeRelations(peopleLocal) {
			let people = this.peopleSelected
			people.name = peopleLocal.name
			if( peopleLocal.birth_date instanceof moment){
				people.birth_date = peopleLocal.birth_date.format('YYYY-MM-DD') 
			} else {
				people.birth_date = peopleLocal.birth_date
			}
			
			const documents = this.documents
			const addresses = this.addresses
			const phones = this.phones
		
			people.document = documents
			people.address = addresses
			people.phone = phones

			return people
		},
		validateDocumentsComponents() {
			this.documents = []
			if (this.$refs.documentRef) {
				for(let documentComp of this.$refs.documentRef) {
					documentComp.handleSubmit().validateFields((err, values) => {
						if(err){
							this.hasError.push(true);
						} else {
							this.documents.push(values);
						}
					});
				}
			}
		},
		validateAddressesComponents() {
			this.addresses = []
			if (this.$refs.addressRef) {
				for(let addressComp of this.$refs.addressRef) {
					addressComp.handleSubmit().validateFields((err, values) => {
						if(err){
							this.hasError.push(true);
						} else {
							this.addresses.push(values);
						}
					});
				}
			}
		},
		validatePhonesComponents() {
			this.phones = []
			if (this.$refs.phoneRef) {
				for(let phoneComp of this.$refs.phoneRef) {
					phoneComp.handleSubmit().validateFields((err, values) => {
						if(err){
							this.hasError.push(true);
						} else {
							this.phones.push(values);
						}
					});
				}
			}
		},
		startExtraDataValues() {
			if(this.peopleSelected.document) {
				this.documentNumber = this.peopleSelected.document.length
			}
			if(this.peopleSelected.phone) {
				this.phoneNumber = this.peopleSelected.phone.length
			}
			if(this.peopleSelected.address) {
				this.addressNumber = this.peopleSelected.address.length
			}
		},

	},
}
</script>
<style lang="scss">
 .hidden {
	 display: none;
 }
 .goback-buttom {
	 margin-bottom: 3rem;
 }
 .ant-layout-content {
	overflow-y: scroll;
 }
 .forms{
	 display: flex;
	 flex-wrap: wrap;
	  .form-individual{
			max-width: 320px;
			margin-right: 1rem;
			width: 100%;
		}
 }
 .ant-alert{
	 margin-bottom: 1rem;
 }

</style>

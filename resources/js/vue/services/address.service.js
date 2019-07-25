import ApiService from './api.service';

const AddressService = {

	getByPostalCode(postalCode) {
		return ApiService.get('address.find.external',{},postalCode).catch(error => {
				throw new Error(`[TRUCKPAD] AddressService ${error}`);
		});
	}

};

export default AddressService;

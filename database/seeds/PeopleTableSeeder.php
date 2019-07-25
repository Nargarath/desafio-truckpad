<?php

use Illuminate\Database\Seeder;

class PeopleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $people1 = \App\Models\People::create([
            'name' => 'teste',
            'birth_date' => '1997-10-13'
        ]);
        $people1->document()->create([
            'country' => 'brasil',
            'doc_type' => 'cpf',
            'number' => '99998899999'
        ]);
        $people1->address()->create([
            'name' => 'trabalho' ,
            'street_name' => 'rua do teste',
            'street_number' => '155',
            'complement' => 'complemento',
            'postal_code' => '99999999',
            'neighborhood' => 'teste',
            'state' => 'sp',
            'city' => 'sao paulo',
            'country' => 'brasil',
            'address_type' => \App\Models\Enums\AddressEnum::ADDRESS_TYPE_DELIVERY,
        ]);
        $people1->phone()->create([
            'number' => '11999999999'
        ]);
        $people2 = \App\Models\People::create([
            'name' => 'teste2',
            'birth_date' => '1997-10-10'
        ]);
        $people2->document()->create([
            'country' => 'Brasil',
            'doc_type' => 'cpf',
            'number' => '99997799999'
        ]);
        $people2->address()->create([
            'name' => 'casa' ,
            'street_name' => 'rua do teste',
            'street_number' => '155',
            'complement' => 'complemento',
            'postal_code' => '99999999',
            'neighborhood' => 'teste',
            'state' => 'sp',
            'city' => 'sao paulo',
            'country' => 'brasil',
            'address_type' => \App\Models\Enums\AddressEnum::ADDRESS_TYPE_BILLING,
        ]);
        $people2->phone()->create([
            'number' => '11999999999'
        ]);
        $people3 = \App\Models\People::create([
            'name' => 'teste3',
            'birth_date' => '1997-10-21'
        ]);
        $people3->document()->create([
            'country' => 'Brasil',
            'doc_type' => 'cpf',
            'number' => '99999995599'
        ]);
        $people3->address()->create([
            'name' => 'casa' ,
            'street_name' => 'rua do teste',
            'street_number' => '155',
            'complement' => 'complemento',
            'postal_code' => '99999999',
            'neighborhood' => 'teste',
            'state' => 'sp',
            'city' => 'sao paulo',
            'country' => 'brasil',
            'address_type' => \App\Models\Enums\AddressEnum::ADDRESS_TYPE_BILLING,
        ]);
        $people3->phone()->create([
            'number' => '11999999999'
        ]);
    }
}

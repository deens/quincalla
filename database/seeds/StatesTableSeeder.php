<?php

use Illuminate\Database\Seeder;
use Quincalla\States;

class StatesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('states')->delete();
        DB::table('states')->insert(
            array(
                array('name' => 'Alabama', 'code' => 'AL', 'country_id' => 840),
                array('name' => 'Alaska', 'code' => 'AK', 'country_id' => 840),
                array('name' => 'Arizona', 'code' => 'AZ', 'country_id' => 840),
                array('name' => 'Arkansas', 'code' => 'AR', 'country_id' => 840),
                array('name' => 'California', 'code' => 'CA', 'country_id' => 840),
                array('name' => 'Colorado', 'code' => 'CO', 'country_id' => 840),
                array('name' => 'Connecticut', 'code' => 'CT', 'country_id' => 840),
                array('name' => 'Delaware', 'code' => 'DE', 'country_id' => 840),
                array('name' => 'District of Columbia', 'code' => 'DC', 'country_id' => 840),
                array('name' => 'Florida', 'code' => 'FL', 'country_id' => 840),
                array('name' => 'Georgia', 'code' => 'GA', 'country_id' => 840),
                array('name' => 'Hawaii', 'code' => 'HI', 'country_id' => 840),
                array('name' => 'Idaho', 'code' => 'ID', 'country_id' => 840),
                array('name' => 'Illinois', 'code' => 'IL', 'country_id' => 840),
                array('name' => 'Indiana', 'code' => 'IN', 'country_id' => 840),
                array('name' => 'Iowa', 'code' => 'IA', 'country_id' => 840),
                array('name' => 'Kansas', 'code' => 'KS', 'country_id' => 840),
                array('name' => 'Kentucky', 'code' => 'KY', 'country_id' => 840),
                array('name' => 'Louisiana', 'code' => 'LA', 'country_id' => 840),
                array('name' => 'Maine', 'code' => 'ME', 'country_id' => 840),
                array('name' => 'Maryland', 'code' => 'MD', 'country_id' => 840),
                array('name' => 'Massachusetts', 'code' => 'MA', 'country_id' => 840),
                array('name' => 'Michigan', 'code' => 'MI', 'country_id' => 840),
                array('name' => 'Minnesota', 'code' => 'MN', 'country_id' => 840),
                array('name' => 'Mississippi', 'code' => 'MS', 'country_id' => 840),
                array('name' => 'Missouri', 'code' => 'MO', 'country_id' => 840),
                array('name' => 'Montana', 'code' => 'MT', 'country_id' => 840),
                array('name' => 'Nebraska', 'code' => 'NE', 'country_id' => 840),
                array('name' => 'Nevada', 'code' => 'NV', 'country_id' => 840),
                array('name' => 'New Hampshire', 'code' => 'NH', 'country_id' => 840),
                array('name' => 'New Jersey', 'code' => 'NJ', 'country_id' => 840),
                array('name' => 'New Mexico', 'code' => 'NM', 'country_id' => 840),
                array('name' => 'New York', 'code' => 'NY', 'country_id' => 840),
                array('name' => 'North Carolina', 'code' => 'NC', 'country_id' => 840),
                array('name' => 'North Dakota', 'code' => 'ND', 'country_id' => 840),
                array('name' => 'Ohio', 'code' => 'OH', 'country_id' => 840),
                array('name' => 'Oklahoma', 'code' => 'OK', 'country_id' => 840),
                array('name' => 'Oregon', 'code' => 'OR', 'country_id' => 840),
                array('name' => 'Pennsylvania', 'code' => 'PA', 'country_id' => 840),
                array('name' => 'Rhode Island', 'code' => 'RI', 'country_id' => 840),
                array('name' => 'South Carolina', 'code' => 'SC', 'country_id' => 840),
                array('name' => 'South Dakota', 'code' => 'SD', 'country_id' => 840),
                array('name' => 'Tennessee', 'code' => 'TN', 'country_id' => 840),
                array('name' => 'Texas', 'code' => 'TX', 'country_id' => 840),
                array('name' => 'Utah', 'code' => 'UT', 'country_id' => 840),
                array('name' => 'Vermont', 'code' => 'VT', 'country_id' => 840),
                array('name' => 'Virginia', 'code' => 'VA', 'country_id' => 840),
                array('name' => 'Washington', 'code' => 'WA', 'country_id' => 840),
                array('name' => 'West Virginia', 'code' => 'WV', 'country_id' => 840),
                array('name' => 'Wisconsin', 'code' => 'WI', 'country_id' => 840),
                array('name' => 'Wyoming', 'code' => 'WY', 'country_id' => 840)
            ));
    }
}

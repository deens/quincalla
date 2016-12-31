<?php

use Illuminate\Database\Seeder;

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
            [
                ['name' => 'Alabama', 'code' => 'AL', 'country_id' => 840],
                ['name' => 'Alaska', 'code' => 'AK', 'country_id' => 840],
                ['name' => 'Arizona', 'code' => 'AZ', 'country_id' => 840],
                ['name' => 'Arkansas', 'code' => 'AR', 'country_id' => 840],
                ['name' => 'California', 'code' => 'CA', 'country_id' => 840],
                ['name' => 'Colorado', 'code' => 'CO', 'country_id' => 840],
                ['name' => 'Connecticut', 'code' => 'CT', 'country_id' => 840],
                ['name' => 'Delaware', 'code' => 'DE', 'country_id' => 840],
                ['name' => 'District of Columbia', 'code' => 'DC', 'country_id' => 840],
                ['name' => 'Florida', 'code' => 'FL', 'country_id' => 840],
                ['name' => 'Georgia', 'code' => 'GA', 'country_id' => 840],
                ['name' => 'Hawaii', 'code' => 'HI', 'country_id' => 840],
                ['name' => 'Idaho', 'code' => 'ID', 'country_id' => 840],
                ['name' => 'Illinois', 'code' => 'IL', 'country_id' => 840],
                ['name' => 'Indiana', 'code' => 'IN', 'country_id' => 840],
                ['name' => 'Iowa', 'code' => 'IA', 'country_id' => 840],
                ['name' => 'Kansas', 'code' => 'KS', 'country_id' => 840],
                ['name' => 'Kentucky', 'code' => 'KY', 'country_id' => 840],
                ['name' => 'Louisiana', 'code' => 'LA', 'country_id' => 840],
                ['name' => 'Maine', 'code' => 'ME', 'country_id' => 840],
                ['name' => 'Maryland', 'code' => 'MD', 'country_id' => 840],
                ['name' => 'Massachusetts', 'code' => 'MA', 'country_id' => 840],
                ['name' => 'Michigan', 'code' => 'MI', 'country_id' => 840],
                ['name' => 'Minnesota', 'code' => 'MN', 'country_id' => 840],
                ['name' => 'Mississippi', 'code' => 'MS', 'country_id' => 840],
                ['name' => 'Missouri', 'code' => 'MO', 'country_id' => 840],
                ['name' => 'Montana', 'code' => 'MT', 'country_id' => 840],
                ['name' => 'Nebraska', 'code' => 'NE', 'country_id' => 840],
                ['name' => 'Nevada', 'code' => 'NV', 'country_id' => 840],
                ['name' => 'New Hampshire', 'code' => 'NH', 'country_id' => 840],
                ['name' => 'New Jersey', 'code' => 'NJ', 'country_id' => 840],
                ['name' => 'New Mexico', 'code' => 'NM', 'country_id' => 840],
                ['name' => 'New York', 'code' => 'NY', 'country_id' => 840],
                ['name' => 'North Carolina', 'code' => 'NC', 'country_id' => 840],
                ['name' => 'North Dakota', 'code' => 'ND', 'country_id' => 840],
                ['name' => 'Ohio', 'code' => 'OH', 'country_id' => 840],
                ['name' => 'Oklahoma', 'code' => 'OK', 'country_id' => 840],
                ['name' => 'Oregon', 'code' => 'OR', 'country_id' => 840],
                ['name' => 'Pennsylvania', 'code' => 'PA', 'country_id' => 840],
                ['name' => 'Rhode Island', 'code' => 'RI', 'country_id' => 840],
                ['name' => 'South Carolina', 'code' => 'SC', 'country_id' => 840],
                ['name' => 'South Dakota', 'code' => 'SD', 'country_id' => 840],
                ['name' => 'Tennessee', 'code' => 'TN', 'country_id' => 840],
                ['name' => 'Texas', 'code' => 'TX', 'country_id' => 840],
                ['name' => 'Utah', 'code' => 'UT', 'country_id' => 840],
                ['name' => 'Vermont', 'code' => 'VT', 'country_id' => 840],
                ['name' => 'Virginia', 'code' => 'VA', 'country_id' => 840],
                ['name' => 'Washington', 'code' => 'WA', 'country_id' => 840],
                ['name' => 'West Virginia', 'code' => 'WV', 'country_id' => 840],
                ['name' => 'Wisconsin', 'code' => 'WI', 'country_id' => 840],
                ['name' => 'Wyoming', 'code' => 'WY', 'country_id' => 840],
            ]);
    }
}

<?php

namespace Database\Seeders;

use App\Models\ReferenceData;
use App\Models\ReferenceDataType;
use App\Models\TextReport;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        ReferenceDataType::factory(1)->create();
        ReferenceData::factory(1)->create();
        TextReport::create([
            'report_code'=>'TERMS_AND_CONDITION_HEADER',
            'is_header'=>true,
            'is_footer'=>false,
            'report_content'=>'<p style="text-align:center;">
    <span style="color:#984806;"><span lang="EN-US" dir="ltr"><u>Trishodaya Micro Association</u></span></span><br/>
    <span lang="EN-US" dir="ltr">CIN: U85300DL2022NPL397760</span><br/>
    <span lang="EN-US" dir="ltr"><strong>Registered Office: F20, Street 1, Churriya Mohalla, Tuglakabad Village, New Delhi - 110044</strong></span><br/>
    <span lang="EN-US" dir="ltr">Email: trishyodaya.finance@gmail.com</span>
    </p>'
        ]);
        TextReport::create([
            'report_code'=>'TERMS_AND_CONDITION_FOOTER',
            'is_header'=>false,
            'is_footer'=>true,
            'report_content'=>'This is report FOOTER'
        ]);
        TextReport::factory(1)->create();
    }
}

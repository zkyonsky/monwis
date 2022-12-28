<?php

use Illuminate\Database\Seeder;
use App\Section;

class SectionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Section::create([
        	'source_id' => '1',
        	'name' => 'Pendidikan dan Pelatihan',
        ]);

        Section::create([
        	'source_id' => '1',
        	'name' => 'Pelaksanaan Dikjartih',
        ]);

        Section::create([
        	'source_id' => '1',
        	'name' => 'Evaluasi dan Pengembangan Diklat',
        ]);

        Section::create([
        	'source_id' => '1',
        	'name' => 'Pengembangan Profesi',
        ]);

        Section::create([
        	'source_id' => '1',
        	'name' => 'Penunjang Tugas Widyaiswara',
        ]);

        Section::create([
            'source_id' => '2',
            'name' => 'Kegiatan Lainnya',
        ]);
    }
}

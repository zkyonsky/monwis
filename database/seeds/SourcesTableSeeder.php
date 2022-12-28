<?php

use Illuminate\Database\Seeder;
use App\Source;

class SourcesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Source::create([
        	'name' => 'Perkalan No. 26 Tahun 2015'
        ]);

        Source::create([
            'name' => 'Undangan, Surat Tugas, Nota Dinas'
        ]);
    }
}

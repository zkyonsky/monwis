<?php

use App\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $admin = User::create([
        // 	'name' => 'Ahmad Zaky',
        // 	'email' => 'zkyonsky@gmail.com',
        // 	'password' => bcrypt('123456'),
        // 	'username' => 'azaky',
        // ]);

        // $role = Role::find(1);
        // $permissions = Permission::all();

        // $role->syncPermissions($permissions);

        // $admin->assignRole('admin');

        // $subbidtp = User::create([
        // 	'name' => 'Kusna Ari Kurniawan',
        // 	'email' => 'gudangqwwerty@gmail.com',
        // 	'password' => bcrypt('123456'),
        // 	'username' => 'tono',
        // ]);

        // $subbidtp->assignRole('subbidtp');

        // $subbidlain = User::create([
        // 	'name' => 'Yudhani Prawijaya',
        // 	'email' => 'prabusriwijaya@gmail.com',
        // 	'password' => bcrypt('123456'),
        // 	'username' => 'cengce',
        // ]);

        // $subbidlain->assignRole('subbidlain');

        // $wi1 = User::create([
        // 	'name' => 'Muhammad Taufiq Budiarto',
        // 	'email' => 'taufiqbudiarto@yahoo.com',
        // 	'password' => bcrypt('123456'),
        // 	'username' => 'TB',
        // ]);

        // $wi2 = User::create([
        //     'name' => 'Agung Darono',
        //     'email' => 'adarono@gmail.com',
        //     'password' => bcrypt('123456'),
        //     'username' => 'adar',
        // ]);

        // $wi3 = User::create([
        //     'name' => 'Anang Mury Kurniawan',
        //     'email' => 'anangmury@gmail.com',
        //     'password' => bcrypt('123456'),
        //     'username' => 'anang',
        // ]);

        // $wi4 = User::create([
        //     'name' => 'Arief Sultony',
        //     'email' => 'asultony@gmail.com',
        //     'password' => bcrypt('123456'),
        //     'username' => 'arief',
        // ]);

        // $wi5 = User::create([
        //     'name' => 'Bangkit Cahyono',
        //     'email' => 'bangkitchyn@gmail.com',
        //     'password' => bcrypt('123456'),
        //     'username' => 'bangkit',
        // ]);

        // $wi6 = User::create([
        //     'name' => 'Budi Harsono',
        //     'email' => 'budi.harsono8008@gmail.com',
        //     'password' => bcrypt('123456'),
        //     'username' => 'budhar',
        // ]);

        // $wi7 = User::create([
        //     'name' => 'Dani Ramdani',
        //     'email' => 'dani.ramdani2014@gmail.com',
        //     'password' => bcrypt('123456'),
        //     'username' => 'dani',
        // ]);

        // $wi8 = User::create([
        //     'name' => 'Didik Hery Santosa',
        //     'email' => 'didik.hersan@gmail.com',
        //     'password' => bcrypt('123456'),
        //     'username' => 'didik',
        // ]);

        // $wi9 = User::create([
        //     'name' => 'Endriko Pudjisaputro',
        //     'email' => 'endriko.pudjisaputro@gmail.com',
        //     'password' => bcrypt('123456'),
        //     'username' => 'riko',
        // ]);

        // $wi10 = User::create([
        //     'name' => 'Faisal Ahmad Chotib',
        //     'email' => 'faisalac96@gmail.com',
        //     'password' => bcrypt('123456'),
        //     'username' => 'faisal',
        // ]);

        // $wi11 = User::create([
        //     'name' => 'Heru Supriyanto',
        //     'email' => 'herusdarman@gmail.com',
        //     'password' => bcrypt('123456'),
        //     'username' => 'heru',
        // ]);

        // $wi12 = User::create([
        //     'name' => 'Hotmian Helena Samosir',
        //     'email' => 'hotmianhelenasamosir@yahoo.com',
        //     'password' => bcrypt('123456'),
        //     'username' => 'helen',
        // ]);

        // $wi13 = User::create([
        //     'name' => 'I Wayan Sukada',
        //     'email' => 'iwsukada@gmail.com',
        //     'password' => bcrypt('123456'),
        //     'username' => 'wayan',
        // ]);

        // $wi14 = User::create([
        //     'name' => 'Ida Zuraida',
        //     'email' => 'ida.zuraida2@gmail.com',
        //     'password' => bcrypt('123456'),
        //     'username' => 'idazur',
        // ]);

        // $wi15 = User::create([
        //     'name' => 'Ilhamsyah',
        //     'email' => 'ilhamsyah165@gmail.com',
        //     'password' => bcrypt('123456'),
        //     'username' => 'ilhamsyah',
        // ]);

        // $wi16 = User::create([
        //     'name' => 'Johannes Aritonang',
        //     'email' => 'joeartbdk@gmail.com',
        //     'password' => bcrypt('123456'),
        //     'username' => 'jo',
        // ]);

        // $wi17 = User::create([
        //     'name' => 'Listiyarko Wijito',
        //     'email' => 'listiyarkowijito@yahoo.com',
        //     'password' => bcrypt('123456'),
        //     'username' => 'arko',
        // ]);

        // $wi18 = User::create([
        //     'name' => 'Maulia Githa Ustadztama',
        //     'email' => 'mauliagitha@gmail.com',
        //     'password' => bcrypt('123456'),
        //     'username' => 'githa',
        // ]);

        // $wi19 = User::create([
        //     'name' => 'Mohammad Djufri',
        //     'email' => 'mhd.djufri@gmail.com',
        //     'password' => bcrypt('123456'),
        //     'username' => 'djufri',
        // ]); 

        // $wi20 = User::create([
        //     'name' => 'Muhammad Haniv',
        //     'email' => 'muhammad_haniv@yahoo.com',
        //     'password' => bcrypt('123456'),
        //     'username' => 'haniv',
        // ]);

        // $wi21 = User::create([
        //     'name' => 'Muhammad Hikmah',
        //     'email' => 'muh.hikmah@gmail.com',
        //     'password' => bcrypt('123456'),
        //     'username' => 'hikmah',
        // ]);

        // $wi22 = User::create([
        //     'name' => 'Rinaningsih',
        //     'email' => 'rinsih@gmail.com',
        //     'password' => bcrypt('123456'),
        //     'username' => 'rina',
        // ]);

        // $wi23 = User::create([
        //     'name' => 'Suwadi',
        //     'email' => 'suwadidoang@gmail.com',
        //     'password' => bcrypt('123456'),
        //     'username' => 'suwadi',
        // ]); 

        // $wi24 = User::create([
        //     'name' => 'Suwardi',
        //     'email' => 'masardi888@gmail.com',
        //     'password' => bcrypt('123456'),
        //     'username' => 'ardi',
        // ]);

        // $wi25 = User::create([
        //     'name' => 'Taufik Kurachman',
        //     'email' => 'taufik150396@gmail.com',
        //     'password' => bcrypt('123456'),
        //     'username' => 'TK',
        // ]); 

        // $wi26 = User::create([
        //     'name' => 'Trihadi Waluyo',
        //     'email' => 'trihadi.waluyo.ppns@gmail.com',
        //     'password' => bcrypt('123456'),
        //     'username' => 'trihadi',
        // ]); 

        // $wi27 = User::create([
        //     'name' => 'Yosep Poernomo',
        //     'email' => 'yoseppoernomo@gmail.com',
        //     'password' => bcrypt('123456'),
        //     'username' => 'yosep',
        // ]);   
        
        // $wi1->assignRole('wi');
        // $wi2->assignRole('wi');
        // $wi3->assignRole('wi');
        // $wi4->assignRole('wi');
        // $wi5->assignRole('wi');
        // $wi6->assignRole('wi');
        // $wi7->assignRole('wi');
        // $wi8->assignRole('wi');
        // $wi9->assignRole('wi');
        // $wi10->assignRole('wi');
        // $wi11->assignRole('wi');
        // $wi12->assignRole('wi');
        // $wi13->assignRole('wi');
        // $wi14->assignRole('wi');
        // $wi15->assignRole('wi');
        // $wi16->assignRole('wi');
        // $wi17->assignRole('wi');
        // $wi18->assignRole('wi');
        // $wi19->assignRole('wi');
        // $wi20->assignRole('wi');
        // $wi21->assignRole('wi');
        // $wi22->assignRole('wi');
        // $wi23->assignRole('wi');
        // $wi24->assignRole('wi');
        // $wi25->assignRole('wi');
        // $wi26->assignRole('wi');
        // $wi27->assignRole('wi');
    }
}

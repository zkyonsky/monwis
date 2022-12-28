<?php

use Illuminate\Database\Seeder;
use App\Activity;

class ActivitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Activity::create([
        	'section_id' => '1',
        	'name' => 'Mengikuti Formal / Sekolah dan Memperoleh Ijazah / Gelar : Doktor (S-3)',
        	'code' => '1',
        	'credit' => 200,
        	'unit' => 'Ijazah',
        ]);

        Activity::create([
        	'section_id' => '1',
        	'name' => 'Mengikuti Formal / Sekolah dan Memperoleh Ijazah / Gelar : Magister (S-2)',
        	'code' => '2',
        	'credit' => 150,
        	'unit' => 'Ijazah',
        ]);

        Activity::create([
        	'section_id' => '1',
        	'name' => 'Mengikuti Diklat Fungsional / Teknis yang Mendukung Tugas Widyaiswara dan Memperoleh Surat Tanda Tamat Pendidikan dan Pelatihan (STTPP) / Sertifikat (minimal 10 JP)',
        	'code' => '3',
        	'credit' => 0.25,
        	'unit' => 'Sertifikat/STTPP',
        ]);

        Activity::create([
        	'section_id' => '2',
        	'name' => 'Menyusun Bahan Diklat dalam Bentuk : Bahan Ajar',
        	'code' => '4',
        	'credit' => 0.60,
        	'unit' => 'Makalah',
        ]);

        Activity::create([
        	'section_id' => '2',
        	'name' => 'Menyusun Bahan Diklat dalam Bentuk : Bahan Tayang',
        	'code' => '5',
        	'credit' => 0.60,
        	'unit' => 'Bahan Tayang',
        ]);

        Activity::create([
        	'section_id' => '2',
        	'name' => 'Menyusun Bahan Diklat dalam Bentuk : Bahan Peraga',
        	'code' => '6',
        	'credit' => 0.60,
        	'unit' => 'Bahan Peraga',
        ]);

        Activity::create([
        	'section_id' => '2',
        	'name' => 'Menyusun Bahan Diklat dalam Bentuk : GBPP/RBPMD dan SAP/RP',
        	'code' => '7',
        	'credit' => 0.60,
        	'unit' => 'GBPP/SAP',
        ]);

        Activity::create([
        	'section_id' => '2',
        	'name' => 'Menyusun Soal/Materi Ujian Diklat Untuk : Pre Test - Post Test',
        	'code' => '8',
        	'credit' => 0.20,
        	'unit' => 'Naskah Soal',
        ]);

        Activity::create([
        	'section_id' => '2',
        	'name' => 'Menyusun Soal/Materi Ujian Diklat Untuk : Komprehensif Test',
        	'code' => '9',
        	'credit' => 0.20,
        	'unit' => 'Naskah Soal',
        ]);

        Activity::create([
        	'section_id' => '2',
        	'name' => 'Menyusun Soal/Materi Ujian Diklat Untuk : Kasus',
        	'code' => '10',
        	'credit' => 0.40,
        	'unit' => 'Naskah Kasus',
        ]);

        Activity::create([
        	'section_id' => '2',
        	'name' => 'Melaksanakan Tatap Muka Diklat (PNS): Sebagai Widyaiswara Ahli Pertama',
        	'code' => '11',
        	'credit' => 0.02,
        	'unit' => 'Jam Pelajaran',
        ]);

        Activity::create([
        	'section_id' => '2',
        	'name' => 'Melaksanakan Tatap Muka Diklat (PNS): Sebagai Widyaiswara Ahli Muda',
        	'code' => '12',
        	'credit' => 0.04,
        	'unit' => 'Jam Pelajaran',
        ]);

        Activity::create([
        	'section_id' => '2',
        	'name' => 'Melaksanakan Tatap Muka Diklat (PNS): Sebagai Widyaiswara Ahli Madya',
        	'code' => '13',
        	'credit' => 0.06,
        	'unit' => 'Jam Pelajaran',
        ]);

        Activity::create([
        	'section_id' => '2',
        	'name' => 'Melaksanakan Tatap Muka Diklat (PNS): Sebagai Widyaiswara Ahli Utama',
        	'code' => '14',
        	'credit' => 0.08,
        	'unit' => 'Jam Pelajaran',
        ]);

        Activity::create([
        	'section_id' => '2',
        	'name' => 'Melaksanakan Tatap Muka Diklat (Non ASN)',
        	'code' => '15',
        	'credit' => 0.02,
        	'unit' => 'Jam Pelajaran',
        ]);

        Activity::create([
        	'section_id' => '2',
        	'name' => 'Melaksanakan Pembimbingan',
        	'code' => '16',
        	'credit' => 0.03,
        	'unit' => 'Jam Pelajaran',
        ]);

        Activity::create([
        	'section_id' => '2',
        	'name' => 'Melaksanakan Pendampingan OL / PKL / Benchmarking',
        	'code' => '17',
        	'credit' => 0.50,
        	'unit' => 'Laporan',
        ]);

        Activity::create([
        	'section_id' => '2',
        	'name' => 'Melaksanakan Pendampingan Penulisan Kertas Kerja / Proyek Perubahan',
        	'code' => '18',
        	'credit' => 0.50,
        	'unit' => 'Kertas Kerja',
        ]);

        Activity::create([
        	'section_id' => '2',
        	'name' => 'Memeriksa Hasil Ujian Diklat Untuk : Pre Test - Post Test',
        	'code' => '19',
        	'credit' => 0.15,
        	'unit' => 'Laporan',
        ]);

        Activity::create([
        	'section_id' => '2',
        	'name' => 'Memeriksa Hasil Ujian Diklat Untuk : Komprehensif Test',
        	'code' => '20',
        	'credit' => 0.15,
        	'unit' => 'Laporan',
        ]);

        Activity::create([
        	'section_id' => '2',
        	'name' => 'Memeriksa Hasil Ujian Diklat Untuk : Kasus',
        	'code' => '21',
        	'credit' => 0.30,
        	'unit' => 'Laporan',
        ]);

        Activity::create([
        	'section_id' => '2',
        	'name' => 'Melakukan Coaching Pada Proses Penyelenggaraan Diklat',
        	'code' => '22',
        	'credit' => 2,
        	'unit' => 'Laporan/Program',
        ]);

        Activity::create([
        	'section_id' => '3',
        	'name' => 'Terlibat Dalam Mengevaluasi Penyelenggaraan Diklat Di Instansinya',
        	'code' => '23',
        	'credit' => 0.4,
        	'unit' => 'Laporan',
        ]);

        Activity::create([
        	'section_id' => '3',
        	'name' => 'Terlibat Dalam Pengevaluasian Kinerja Widyaiswara',
        	'code' => '24',
        	'credit' => 0.15,
        	'unit' => 'Laporan',
        ]);

        Activity::create([
        	'section_id' => '3',
        	'name' => 'Terlibat Dalam Pelaksanaan Analisis Kebutuhan Diklat (AKD)',
        	'code' => '25',
        	'credit' => 2.5,
        	'unit' => 'Laporan',
        ]);

        Activity::create([
        	'section_id' => '3',
        	'name' => 'Terlibat Dalam Penyusunan Kurikulum Diklat',
        	'code' => '26',
        	'credit' => 1.5,
        	'unit' => 'Laporan',
        ]);

        Activity::create([
        	'section_id' => '3',
        	'name' => 'Terlibat Dalam Penyusunan Modul Diklat',
        	'code' => '27',
        	'credit' => 5,
        	'unit' => 'Modul',
        ]);

        Activity::create([
        	'section_id' => '4',
        	'name' => 'Membuat Karya Tulis/Karya Ilmiah Dalam Bidang Spesialisasi Keahliannya dan Lingkup Kediklatan, Dalam Bentuk: Buku Dengan ISBN, Diterbitkan Secara Nasional',
        	'code' => '28',
        	'credit' => 25,
        	'unit' => 'Buku',
        ]);

        Activity::create([
        	'section_id' => '4',
        	'name' => 'Membuat Karya Tulis/Karya Ilmiah Dalam Bidang Spesialisasi Keahliannya dan Lingkup Kediklatan, Dalam Bentuk: Non Buku, Yang Dimuat Dalam Jurnal Ilmiah Internasional',
        	'code' => '29',
        	'credit' => 20,
        	'unit' => 'Artikel',
        ]);

        Activity::create([
        	'section_id' => '4',
        	'name' => 'Membuat Karya Tulis/Karya Ilmiah Dalam Bidang Spesialisasi Keahliannya dan Lingkup Kediklatan, Dalam Bentuk: Non Buku, Yang Dimuat Dalam Jurnal Ilmiah Nasional Terakreditasi',
        	'code' => '30',
        	'credit' => 10,
        	'unit' => 'Artikel',
        ]);

        Activity::create([
        	'section_id' => '4',
        	'name' => 'Membuat Karya Tulis/Karya Ilmiah Dalam Bidang Spesialisasi Keahliannya dan Lingkup Kediklatan, Dalam Bentuk: Non Buku, Yang Dimuat Dalam Jurnal Ilmiah Nasional Tidak Terakreditasi',
        	'code' => '31',
        	'credit' => 5,
        	'unit' => 'Artikel',
        ]);

        Activity::create([
        	'section_id' => '4',
        	'name' => 'Membuat Karya Tulis/Karya Ilmiah Dalam Bidang Spesialisasi Keahliannya dan Lingkup Kediklatan, Dalam Bentuk: Non Buku, Yang Dimuat Dalam Majalah Ilmiah',
        	'code' => '32',
        	'credit' => 2.5,
        	'unit' => 'Artikel',
        ]);

        Activity::create([
        	'section_id' => '4',
        	'name' => 'Membuat Karya Tulis/Karya Ilmiah Dalam Bidang Spesialisasi Keahliannya dan Lingkup Kediklatan, Dalam Bentuk: Non Buku, Yang Dimuat Dalam Buku Proceeding Internasional',
        	'code' => '33',
        	'credit' => 5,
        	'unit' => 'Artikel',
        ]);

        Activity::create([
        	'section_id' => '4',
        	'name' => 'Membuat Karya Tulis/Karya Ilmiah Dalam Bidang Spesialisasi Keahliannya dan Lingkup Kediklatan, Dalam Bentuk: Non Buku, Yang Dimuat Dalam Buku Proceeding Nasional',
        	'code' => '34',
        	'credit' => 2.5,
        	'unit' => 'Artikel',
        ]);

        Activity::create([
        	'section_id' => '4',
        	'name' => 'Membuat Karya Tulis/Karya Ilmiah Dalam Bidang Spesialisasi Keahliannya dan Lingkup Kediklatan, Dalam Bentuk: Non Buku, Yang Dimuat Dalam Buku Proceeding Instansi',
        	'code' => '35',
        	'credit' => 1,
        	'unit' => 'Artikel',
        ]);

        Activity::create([
        	'section_id' => '4',
        	'name' => 'Membuat Karya Tulis/Karya Ilmiah Dalam Bidang Spesialisasi Keahliannya dan Lingkup Kediklatan, Dalam Bentuk: Makalah Dalam Pertemuan Ilmiah Internasional',
        	'code' => '36',
        	'credit' => 5,
        	'unit' => 'Makalah',
        ]);

        Activity::create([
        	'section_id' => '4',
        	'name' => 'Membuat Karya Tulis/Karya Ilmiah Dalam Bidang Spesialisasi Keahliannya dan Lingkup Kediklatan, Dalam Bentuk: Makalah Dalam Pertemuan Ilmiah Nasional',
        	'code' => '37',
        	'credit' => 2.5,
        	'unit' => 'Makalah',
        ]);

        Activity::create([
        	'section_id' => '4',
        	'name' => 'Membuat Karya Tulis/Karya Ilmiah Dalam Bidang Spesialisasi Keahliannya dan Lingkup Kediklatan, Dalam Bentuk: Makalah Dalam Pertemuan Ilmiah Instansi',
        	'code' => '38',
        	'credit' => 1,
        	'unit' => 'Makalah',
        ]);

        Activity::create([
        	'section_id' => '4',
        	'name' => 'Menemukan Inovasi Yang Dipatenkan dan Telah Masuk Daftar Paten Sesuai Bidang Spesialisasi Keahliannya',
        	'code' => '39',
        	'credit' => 20,
        	'unit' => 'Sertifikat Paten',
        ]);

        Activity::create([
        	'section_id' => '4',
        	'name' => 'Menyusun Buku Pedoman / Ketentuan Pelaksanaan / Ketentuan Teknis Di Bidang Kediklatan',
        	'code' => '40',
        	'credit' => 0.5,
        	'unit' => 'Buku Pedoman',
        ]);

        Activity::create([
        	'section_id' => '4',
        	'name' => 'Melaksanakan orasi Ilmiah sesuai spesialisasinya',
        	'code' => '41',
        	'credit' => 5,
        	'unit' => 'BA, KTI, dan Sinopsis',
        ]);

        Activity::create([
        	'section_id' => '5',
        	'name' => 'Mengikuti Seminar/ Lokakarya/ Konferensi Di Bidang Kediklatan sebagai: Narasumber/ Pembahas/ Penyaji/ Ketua Panitia',
        	'code' => '42',
        	'credit' => 2,
        	'unit' => 'Per Kegiatan',
        ]);

        Activity::create([
        	'section_id' => '5',
        	'name' => 'Mengikuti Seminar/ Lokakarya/ Konferensi Di Bidang Kediklatan sebagai: Moderator / Peserta / Anggota Panitia',
        	'code' => '43',
        	'credit' => 1,
        	'unit' => 'Per Kegiatan',
        ]);

        Activity::create([
        	'section_id' => '5',
        	'name' => 'Menjadi Anggota Organisasi Profesi, sebagai : Pengurus',
        	'code' => '44',
        	'credit' => 1,
        	'unit' => 'Per Tahun',
        ]);

        Activity::create([
        	'section_id' => '5',
        	'name' => 'Menjadi Anggota Organisasi Profesi, sebagai : Anggota',
        	'code' => '45',
        	'credit' => 0.75,
        	'unit' => 'Per Tahun',
        ]);

        Activity::create([
        	'section_id' => '5',
        	'name' => 'Membimbing Widyaiswara Dibawah Jenjang Jabatannya',
        	'code' => '46',
        	'credit' => 0.25,
        	'unit' => 'Laporan',
        ]);

        Activity::create([
        	'section_id' => '5',
        	'name' => 'Menulis Artikel Di Surat Kabar : Nasional',
        	'code' => '47',
        	'credit' => 3,
        	'unit' => 'Artikel',
        ]);

        Activity::create([
        	'section_id' => '5',
        	'name' => 'Menulis Artikel Di Surat Kabar : Provinsi / Kabupaten / Kota',
        	'code' => '48',
        	'credit' => 1.5,
        	'unit' => 'Artikel',
        ]);

        Activity::create([
        	'section_id' => '5',
        	'name' => 'Menulis Artikel Di Website',
        	'code' => '49',
        	'credit' => 1,
        	'unit' => 'Artikel',
        ]);

        Activity::create([
        	'section_id' => '5',
        	'name' => 'Memperoleh Gelar Kesarjanaan Lainnya, Pada Program: Doktor (S-3)',
        	'code' => '50',
        	'credit' => 15,
        	'unit' => 'Ijazah',
        ]);

        Activity::create([
        	'section_id' => '5',
        	'name' => 'Memperoleh Gelar Kesarjanaan Lainnya, Pada Program: Pasca Sarjana (S-2)',
        	'code' => '51',
        	'credit' => 10,
        	'unit' => 'Ijazah',
        ]);

        Activity::create([
        	'section_id' => '5',
        	'name' => 'Memperoleh Gelar Kesarjanaan Lainnya, Pada Program: Sarjana (S-1)',
        	'code' => '52',
        	'credit' => 5,
        	'unit' => 'Ijazah',
        ]);

        Activity::create([
        	'section_id' => '5',
        	'name' => 'Memperoleh Penghargaan Satya Lencana Karya Satya, lamanya: 30 (tiga puluh) tahun',
        	'code' => '53',
        	'credit' => 3,
        	'unit' => 'Piagam',
        ]);

        Activity::create([
        	'section_id' => '5',
        	'name' => 'Memperoleh Penghargaan Satya Lencana Karya Satya, lamanya: 20 (dua puluh) tahun',
        	'code' => '54',
        	'credit' => 2,
        	'unit' => 'Piagam',
        ]);

        Activity::create([
        	'section_id' => '5',
        	'name' => 'Memperoleh Penghargaan Satya Lencana Karya Satya, lamanya: 10 (sepuluh) tahun',
        	'code' => '55',
        	'credit' => 1,
        	'unit' => 'Piagam',
        ]);

        Activity::create([
        	'section_id' => '5',
        	'name' => 'Memperoleh penghargaan lainnya dari pemerintah',
        	'code' => '56',
        	'credit' => 1,
        	'unit' => 'Piagam',
        ]);

        Activity::create([
        	'section_id' => '5',
        	'name' => 'Memperoleh gelar kehormatan akademis',
        	'code' => '57',
        	'credit' => 10,
        	'unit' => 'Gelar',
        ]);

        Activity::create([
            'section_id' => '6',
            'name' => 'Cuti',
        ]);

        Activity::create([
            'section_id' => '6',
            'name' => 'Narasumber Rapat/IHT/FGD/Konsinyiring/Knowledge Sharing/Open Class',
        ]);

        Activity::create([
            'section_id' => '6',
            'name' => 'Peserta Rapat/IHT/FGD/Konsinyiring/Knowledge Sharing/Open Class',
        ]);
    }
}

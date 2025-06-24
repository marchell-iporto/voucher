<?php

namespace Database\Seeders;

use App\Models\MasterVoucher;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MasterVoucherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('master_account')->truncate();

        $accounts = [
            // Assets (1-xxxxx)
            ['nomor_akun' => '1-10000', 'nama_akun' => 'Kas & Bank'],
            ['nomor_akun' => '1-10001', 'nama_akun' => 'Kas'],
            ['nomor_akun' => '1-10002', 'nama_akun' => 'Mandiri'],
            ['nomor_akun' => '1-10003', 'nama_akun' => 'BNI'],
            ['nomor_akun' => '1-10100', 'nama_akun' => 'Piutang Usaha'],
            ['nomor_akun' => '1-10101', 'nama_akun' => 'Piutang Usaha'],
            ['nomor_akun' => '1-10102', 'nama_akun' => 'Piutang yang Belum Ditagih'],
            ['nomor_akun' => '1-10103', 'nama_akun' => 'Cadangan Kerugian Piutang'],
            ['nomor_akun' => '1-10200', 'nama_akun' => 'Persediaan'],
            ['nomor_akun' => '1-10201', 'nama_akun' => 'Persediaan Barang'],
            ['nomor_akun' => '1-10300', 'nama_akun' => 'Piutang Lainnya'],
            ['nomor_akun' => '1-10301', 'nama_akun' => 'Piutang Karyawan'],
            ['nomor_akun' => '1-10302', 'nama_akun' => 'PPN Lebih Bayar'],
            ['nomor_akun' => '1-10400', 'nama_akun' => 'Dana Belum Disetor'],
            ['nomor_akun' => '1-10401', 'nama_akun' => 'Aset Lancar Lainnya'],
            ['nomor_akun' => '1-10402', 'nama_akun' => 'Biaya Dibayar Di Muka'],
            ['nomor_akun' => '1-10403', 'nama_akun' => 'Uang Muka'],
            ['nomor_akun' => '1-10500', 'nama_akun' => 'Pajak Masukan'],
            ['nomor_akun' => '1-10501', 'nama_akun' => 'Pajak Dibayar Di Muka - PPh 21'],
            ['nomor_akun' => '1-10502', 'nama_akun' => 'Pajak Dibayar Di Muka - PPh 23'],
            ['nomor_akun' => '1-10503', 'nama_akun' => 'Pajak Dibayar Di Muka - PPh 25'],
            ['nomor_akun' => '1-10504', 'nama_akun' => 'Pajak Dibayar Di Muka - PPh 4 ayat 2'],
            ['nomor_akun' => '1-10700', 'nama_akun' => 'Aset Tetap'],
            ['nomor_akun' => '1-10701', 'nama_akun' => 'Aset Tetap - Tanah'],
            ['nomor_akun' => '1-10702', 'nama_akun' => 'Aset Tetap - Bangunan'],
            ['nomor_akun' => '1-10703', 'nama_akun' => 'Aset Tetap - Building Improvements'],
            ['nomor_akun' => '1-10704', 'nama_akun' => 'Aset Tetap - Kendaraan'],
            ['nomor_akun' => '1-10705', 'nama_akun' => 'Aset Tetap - Mesin & Peralatan'],
            ['nomor_akun' => '1-10706', 'nama_akun' => 'Aset Tetap - Perlengkapan Kantor'],
            ['nomor_akun' => '1-10707', 'nama_akun' => 'Aset Tetap - Aset Sewa Guna Usaha'],
            ['nomor_akun' => '1-10708', 'nama_akun' => 'Aset Tak Berwujud'],
            ['nomor_akun' => '1-10750', 'nama_akun' => 'Akumulasi Penyusutan'],
            ['nomor_akun' => '1-10751', 'nama_akun' => 'Akumulasi Penyusutan - Bangunan'],
            ['nomor_akun' => '1-10752', 'nama_akun' => 'Akumulasi Penyusutan - Building Improvements'],
            ['nomor_akun' => '1-10753', 'nama_akun' => 'Akumulasi penyusutan - Kendaraan'],
            ['nomor_akun' => '1-10754', 'nama_akun' => 'Akumulasi Penyusutan - Mesin & Peralatan'],
            ['nomor_akun' => '1-10755', 'nama_akun' => 'Akumulasi Penyusutan - Perlengkapan Kantor'],
            ['nomor_akun' => '1-10756', 'nama_akun' => 'Akumulasi Penyusutan - Aset Sewa Guna Usaha'],
            ['nomor_akun' => '1-10757', 'nama_akun' => 'Akumulasi Amortisasi'],
            ['nomor_akun' => '1-10800', 'nama_akun' => 'Investasi'],

            // Liabilities (2-xxxxx)
            ['nomor_akun' => '2-20100', 'nama_akun' => 'Hutang Usaha'],
            ['nomor_akun' => '2-20101', 'nama_akun' => 'Hutang Usaha'],
            ['nomor_akun' => '2-20102', 'nama_akun' => 'Hutang yang Belum Ditagih'],
            ['nomor_akun' => '2-20200', 'nama_akun' => 'Hutang Lain Lain'],
            ['nomor_akun' => '2-20201', 'nama_akun' => 'Hutang Gaji'],
            ['nomor_akun' => '2-20202', 'nama_akun' => 'Hutang Deviden'],
            ['nomor_akun' => '2-20203', 'nama_akun' => 'Pendapatan Diterima Di Muka'],
            ['nomor_akun' => '2-20204', 'nama_akun' => 'Utang Investor'],
            ['nomor_akun' => '2-20301', 'nama_akun' => 'Sarana Kantor Terhutang'],
            ['nomor_akun' => '2-20302', 'nama_akun' => 'Bunga Terhutang'],
            ['nomor_akun' => '2-20399', 'nama_akun' => 'Biaya Terhutang Lainnya'],
            ['nomor_akun' => '2-20400', 'nama_akun' => 'Hutang Bank'],
            ['nomor_akun' => '2-20401', 'nama_akun' => 'Hutang Bank'],
            ['nomor_akun' => '2-20500', 'nama_akun' => 'Pajak Keluaran'],
            ['nomor_akun' => '2-20501', 'nama_akun' => 'Hutang Pajak - PPh 21'],
            ['nomor_akun' => '2-20502', 'nama_akun' => 'Hutang Pajak - PPh 23'],
            ['nomor_akun' => '2-20503', 'nama_akun' => 'Hutang Pajak - PPh 29'],
            ['nomor_akun' => '2-20504', 'nama_akun' => 'Hutang Pajak - PPh Pasal 4 Ayat 2'],
            ['nomor_akun' => '2-20599', 'nama_akun' => 'Hutang Pajak Lainnya'],
            ['nomor_akun' => '2-20600', 'nama_akun' => 'Hutang dari Pemegang Saham'],
            ['nomor_akun' => '2-20601', 'nama_akun' => 'Kewajiban Lancar Lainnya'],
            ['nomor_akun' => '2-20700', 'nama_akun' => 'Kewajiban Manfaat Karyawan'],

            // Equity (3-xxxxx)
            ['nomor_akun' => '3-30000', 'nama_akun' => 'Modal Saham'],
            ['nomor_akun' => '3-30001', 'nama_akun' => 'Modal Disetor'],
            ['nomor_akun' => '3-30002', 'nama_akun' => 'Tambahan Modal Disetor'],
            ['nomor_akun' => '3-30003', 'nama_akun' => 'Prive'],
            ['nomor_akun' => '3-30100', 'nama_akun' => 'Laba Ditahan'],
            ['nomor_akun' => '3-30101', 'nama_akun' => 'Laba Ditahan'],
            ['nomor_akun' => '3-30200', 'nama_akun' => 'Deviden'],
            ['nomor_akun' => '3-30201', 'nama_akun' => 'Deviden Interim'],
            ['nomor_akun' => '3-30300', 'nama_akun' => 'Pendapatan Komprehensif Lainnya'],
            ['nomor_akun' => '3-30999', 'nama_akun' => 'Ekuitas Saldo Awal'],

            // Revenue (4-xxxxx)
            ['nomor_akun' => '4-40000', 'nama_akun' => 'Pendapatan Jasa'],
            ['nomor_akun' => '4-40001', 'nama_akun' => 'Pendapatan Jasa'],
            ['nomor_akun' => '4-40002', 'nama_akun' => 'Diskon Penjualan'],
            ['nomor_akun' => '4-40003', 'nama_akun' => 'Pendapatan yang belum ditagih'],

            // Cost of Goods Sold (5-xxxxx)
            ['nomor_akun' => '5-50000', 'nama_akun' => 'Beban Pokok Pendapatan'],
            ['nomor_akun' => '5-50100', 'nama_akun' => 'Diskon Pembelian'],
            ['nomor_akun' => '5-50200', 'nama_akun' => 'Retur Pembelian'],
            ['nomor_akun' => '5-50201', 'nama_akun' => 'Biaya transportasi (Akomodasi)'],
            ['nomor_akun' => '5-50203', 'nama_akun' => 'Gaji (Proyek)'],
            ['nomor_akun' => '5-50204', 'nama_akun' => 'Bensin, Tol, dan Parkir (Penjualan)'],
            ['nomor_akun' => '5-50205', 'nama_akun' => 'Komisi, Fee dan Bonus (Proyek)'],
            ['nomor_akun' => '5-50206', 'nama_akun' => 'Uang Makan'],
            ['nomor_akun' => '5-50207', 'nama_akun' => 'Sewa Bangunan'],
            ['nomor_akun' => '5-50208', 'nama_akun' => 'Sewa - Kendaraan'],
            ['nomor_akun' => '5-50209', 'nama_akun' => 'Fee Percepatan  Pembayaran'],

            // Operating Expenses (6-xxxxx)
            ['nomor_akun' => '6-60000', 'nama_akun' => 'Biaya Pemasaran'],
            ['nomor_akun' => '6-60001', 'nama_akun' => 'Iklan & Promosi'],
            ['nomor_akun' => '6-60002', 'nama_akun' => 'Komisi & Fee'],
            ['nomor_akun' => '6-60003', 'nama_akun' => 'Bensin, Tol dan Parkir - Penjualan'],
            ['nomor_akun' => '6-60006', 'nama_akun' => 'Marketing Lainnya'],
            ['nomor_akun' => '6-60007', 'nama_akun' => 'Entertaint Makan & Minum'],
            ['nomor_akun' => '6-60100', 'nama_akun' => 'Beban Pegawai'],
            ['nomor_akun' => '6-60101', 'nama_akun' => 'Gaji'],
            ['nomor_akun' => '6-60102', 'nama_akun' => 'Upah'],
            ['nomor_akun' => '6-60103', 'nama_akun' => 'Makanan & Transportasi'],
            ['nomor_akun' => '6-60104', 'nama_akun' => 'Lembur'],
            ['nomor_akun' => '6-60105', 'nama_akun' => 'Pengobatan'],
            ['nomor_akun' => '6-60106', 'nama_akun' => 'THR & Bonus'],
            ['nomor_akun' => '6-60107', 'nama_akun' => 'BPJS Kesehatan & Ketenagakerjaan'],
            ['nomor_akun' => '6-60108', 'nama_akun' => 'Insentif'],
            ['nomor_akun' => '6-60109', 'nama_akun' => 'Pesangon'],
            ['nomor_akun' => '6-60110', 'nama_akun' => 'Manfaat dan Tunjangan Lain'],
            ['nomor_akun' => '6-60200', 'nama_akun' => 'Biaya Umum & Administratif'],
            ['nomor_akun' => '6-60201', 'nama_akun' => 'Hiburan'],
            ['nomor_akun' => '6-60202', 'nama_akun' => 'Bensin, Tol dan Parkir - Umum'],
            ['nomor_akun' => '6-60203', 'nama_akun' => 'Perbaikan & Pemeliharaan Kendaraan'],
            ['nomor_akun' => '6-60204', 'nama_akun' => 'Perjalanan Dinas - Umum'],
            ['nomor_akun' => '6-60205', 'nama_akun' => 'Makanan'],
            ['nomor_akun' => '6-60206', 'nama_akun' => 'Komunikasi - Umum'],
            ['nomor_akun' => '6-60207', 'nama_akun' => 'Iuran & Langganan'],
            ['nomor_akun' => '6-60208', 'nama_akun' => 'Asuransi'],
            ['nomor_akun' => '6-60209', 'nama_akun' => 'Legal & Profesional'],
            ['nomor_akun' => '6-60210', 'nama_akun' => 'Beban Manfaat Karyawan'],
            ['nomor_akun' => '6-60211', 'nama_akun' => 'Sarana & Prasarana Kantor'],
            ['nomor_akun' => '6-60212', 'nama_akun' => 'Pelatihan & Pengembangan'],
            ['nomor_akun' => '6-60213', 'nama_akun' => 'Beban Piutang Tak Tertagih'],
            ['nomor_akun' => '6-60214', 'nama_akun' => 'Pajak dan Perizinan'],
            ['nomor_akun' => '6-60215', 'nama_akun' => 'Denda'],
            ['nomor_akun' => '6-60217', 'nama_akun' => 'Listrik'],
            ['nomor_akun' => '6-60218', 'nama_akun' => 'Air'],
            ['nomor_akun' => '6-60219', 'nama_akun' => 'Biaya Perawatan dan Reparasi Mobil dan Truk'],
            ['nomor_akun' => '6-60220', 'nama_akun' => 'IPL'],
            ['nomor_akun' => '6-60221', 'nama_akun' => 'Langganan Software'],
            ['nomor_akun' => '6-60300', 'nama_akun' => 'Beban Umum Lainnya'],
            ['nomor_akun' => '6-60301', 'nama_akun' => 'Alat Tulis Kantor & Printing'],
            ['nomor_akun' => '6-60302', 'nama_akun' => 'Bea Materai'],
            ['nomor_akun' => '6-60303', 'nama_akun' => 'Keamanan dan Kebersihan'],
            ['nomor_akun' => '6-60304', 'nama_akun' => 'Biaya Adm Bank'],
            ['nomor_akun' => '6-60305', 'nama_akun' => 'Beban Pajak'],
            ['nomor_akun' => '6-60306', 'nama_akun' => 'Beban Pajak PPH Pasal 21'],
            ['nomor_akun' => '6-60307', 'nama_akun' => 'Fee Percepatan Pembayaran'],
            ['nomor_akun' => '6-60308', 'nama_akun' => 'Biaya Transportasi'],
            ['nomor_akun' => '6-60309', 'nama_akun' => 'Pembayaran Zakat'],
            ['nomor_akun' => '6-60310', 'nama_akun' => 'Biaya Pemeliharaan dan Perbaikan Kantor'],
            ['nomor_akun' => '6-60311', 'nama_akun' => 'Biaya Sewa - Bangunan'],
            ['nomor_akun' => '6-60312', 'nama_akun' => 'Biaya Sewa - Kendaraan'],
            ['nomor_akun' => '6-60313', 'nama_akun' => 'Biaya Sewa - Operasional'],
            ['nomor_akun' => '6-60314', 'nama_akun' => 'Biaya Sewa - Lain - lain'],
            ['nomor_akun' => '6-60315', 'nama_akun' => 'Penyusutan - Bangunan'],
            ['nomor_akun' => '6-60316', 'nama_akun' => 'Penyusutan - Perbaikan Bangunan'],
            ['nomor_akun' => '6-60317', 'nama_akun' => 'Penyusutan - Kendaraan'],
            ['nomor_akun' => '6-60318', 'nama_akun' => 'Penyusutan - Mesin & Peralatan'],
            ['nomor_akun' => '6-60319', 'nama_akun' => 'Penyusutan - Peralatan Kantor'],
            ['nomor_akun' => '6-60320', 'nama_akun' => 'Penyusutan - Aset Sewa Guna Usaha'],

            // Other Income (7-xxxxx)
            ['nomor_akun' => '7-70000', 'nama_akun' => 'Pendapatan Lainnya'],
            ['nomor_akun' => '7-70001', 'nama_akun' => 'Pendapatan Bunga - Bank'],
            ['nomor_akun' => '7-70002', 'nama_akun' => 'Pembulatan'],
            ['nomor_akun' => '7-70099', 'nama_akun' => 'Pendapatan Lain - lain'],

            // Other Expenses (8-xxxxx)
            ['nomor_akun' => '8-80000', 'nama_akun' => 'Beban Lainnya'],
            ['nomor_akun' => '8-80001', 'nama_akun' => 'Beban Bunga'],
            ['nomor_akun' => '8-80002', 'nama_akun' => '(Laba)/Rugi Pelepasan Aset Tetap'],
            ['nomor_akun' => '8-80004', 'nama_akun' => 'Kasbon Karyawan'],
            ['nomor_akun' => '8-80100', 'nama_akun' => 'Penyesuaian Persediaan'],
            ['nomor_akun' => '8-80999', 'nama_akun' => 'Beban Lain - lain'],

            // Tax Expenses (9-xxxxx)
            ['nomor_akun' => '9-90000', 'nama_akun' => 'Beban Pajak'],
            ['nomor_akun' => '9-90001', 'nama_akun' => 'Beban Pajak - Kini'],
        ];

        // Insert data using chunks for better performance
        $chunks = array_chunk($accounts, 50); // Process 50 records at a time
        
        foreach ($chunks as $chunk) {
            MasterVoucher::insert($chunk);
        }

        $this->command->info('Master Voucher seeder completed successfully!');
        $this->command->info('Total accounts seeded: ' . count($accounts));
    }
}
<?php

namespace Database\Seeders;

use App\Models\MasterVoucher;
use DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MasterVoucherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['nomor_akun' => '1-10000', 'nama_akun' => 'Kas & Bank'],
            ['nomor_akun' => '1-10001', 'nama_akun' => 'Kas'],
            ['nomor_akun' => '1-10002', 'nama_akun' => 'Mandiri'],
            ['nomor_akun' => '1-10003', 'nama_akun' => 'BNI'],
            ['nomor_akun' => '1-10100', 'nama_akun' => 'Piutang Usaha'],
            ['nomor_akun' => '1-10101', 'nama_akun' => 'Cadangan Piutang Tak Tertagih'],
            ['nomor_akun' => '1-10200', 'nama_akun' => 'Uang Muka Pembelian'],
            ['nomor_akun' => '1-10300', 'nama_akun' => 'Persediaan'],
            ['nomor_akun' => '1-10400', 'nama_akun' => 'Pajak Dibayar Dimuka'],
            ['nomor_akun' => '1-10500', 'nama_akun' => 'Biaya Dibayar Dimuka'],
            ['nomor_akun' => '1-20000', 'nama_akun' => 'Aktiva Tetap'],
            ['nomor_akun' => '1-20001', 'nama_akun' => 'Tanah'],
            ['nomor_akun' => '1-20002', 'nama_akun' => 'Bangunan'],
            ['nomor_akun' => '1-20003', 'nama_akun' => 'Kendaraan'],
            ['nomor_akun' => '1-20004', 'nama_akun' => 'Peralatan Kantor'],
            ['nomor_akun' => '1-20005', 'nama_akun' => 'Inventaris Kantor'],
            ['nomor_akun' => '1-20006', 'nama_akun' => 'Mesin'],
            ['nomor_akun' => '1-20007', 'nama_akun' => 'Akumulasi Penyusutan'],
            ['nomor_akun' => '1-20008', 'nama_akun' => 'Akumulasi Penyusutan Bangunan'],
            ['nomor_akun' => '1-20009', 'nama_akun' => 'Akumulasi Penyusutan Kendaraan'],
            ['nomor_akun' => '1-20010', 'nama_akun' => 'Akumulasi Penyusutan Peralatan Kantor'],
            ['nomor_akun' => '1-20011', 'nama_akun' => 'Akumulasi Penyusutan Inventaris Kantor'],
            ['nomor_akun' => '1-20012', 'nama_akun' => 'Akumulasi Penyusutan Mesin'],
            ['nomor_akun' => '1-30000', 'nama_akun' => 'Aktiva Lain-Lain'],
            ['nomor_akun' => '1-30001', 'nama_akun' => 'Aktiva Tidak Berwujud'],
            ['nomor_akun' => '1-30002', 'nama_akun' => 'Aktiva Pajak Tangguhan'],
            ['nomor_akun' => '2-10000', 'nama_akun' => 'Kewajiban Jangka Pendek'],
            ['nomor_akun' => '2-10001', 'nama_akun' => 'Hutang Usaha'],
            ['nomor_akun' => '2-10002', 'nama_akun' => 'Hutang Gaji'],
            ['nomor_akun' => '2-10003', 'nama_akun' => 'Hutang Pajak'],
            ['nomor_akun' => '2-10004', 'nama_akun' => 'Hutang Bank Jangka Pendek'],
            ['nomor_akun' => '2-10005', 'nama_akun' => 'Pendapatan Diterima Dimuka'],
            ['nomor_akun' => '2-10006', 'nama_akun' => 'Biaya Yang Masih Harus Dibayar'],
            ['nomor_akun' => '2-20000', 'nama_akun' => 'Kewajiban Jangka Panjang'],
            ['nomor_akun' => '2-20001', 'nama_akun' => 'Hutang Bank Jangka Panjang'],
            ['nomor_akun' => '2-20002', 'nama_akun' => 'Hutang Obligasi'],
            ['nomor_akun' => '2-20003', 'nama_akun' => 'Kewajiban Imbalan Kerja'],
            ['nomor_akun' => '3-10000', 'nama_akun' => 'Ekuitas'],
            ['nomor_akun' => '3-10001', 'nama_akun' => 'Modal Disetor'],
            ['nomor_akun' => '3-10002', 'nama_akun' => 'Tambahan Modal Disetor'],
            ['nomor_akun' => '3-10003', 'nama_akun' => 'Saldo Laba'],
            ['nomor_akun' => '3-10004', 'nama_akun' => 'Laba Ditahan'],
            ['nomor_akun' => '3-10005', 'nama_akun' => 'Laba Tahun Berjalan'],
            ['nomor_akun' => '4-10000', 'nama_akun' => 'Pendapatan Usaha'],
            ['nomor_akun' => '4-10001', 'nama_akun' => 'Penjualan Barang'],
            ['nomor_akun' => '4-10002', 'nama_akun' => 'Penjualan Jasa'],
            ['nomor_akun' => '4-10003', 'nama_akun' => 'Retur Penjualan'],
            ['nomor_akun' => '4-10004', 'nama_akun' => 'Potongan Penjualan'],
            ['nomor_akun' => '4-20000', 'nama_akun' => 'Pendapatan Lain-Lain'],
            ['nomor_akun' => '4-20001', 'nama_akun' => 'Pendapatan Bunga'],
            ['nomor_akun' => '4-20002', 'nama_akun' => 'Pendapatan Sewa'],
            ['nomor_akun' => '5-10000', 'nama_akun' => 'Harga Pokok Penjualan'],
            ['nomor_akun' => '5-10001', 'nama_akun' => 'Pembelian'],
            ['nomor_akun' => '5-10002', 'nama_akun' => 'Beban Angkut Pembelian'],
            ['nomor_akun' => '5-10003', 'nama_akun' => 'Retur Pembelian'],
            ['nomor_akun' => '5-10004', 'nama_akun' => 'Potongan Pembelian'],
            ['nomor_akun' => '6-10000', 'nama_akun' => 'Beban Usaha'],
            ['nomor_akun' => '6-10001', 'nama_akun' => 'Beban Gaji'],
            ['nomor_akun' => '6-10002', 'nama_akun' => 'Beban Sewa'],
            ['nomor_akun' => '6-10003', 'nama_akun' => 'Beban Listrik, Air, Telepon'],
            ['nomor_akun' => '6-10004', 'nama_akun' => 'Beban Perlengkapan'],
            ['nomor_akun' => '6-10005', 'nama_akun' => 'Beban Penyusutan'],
            ['nomor_akun' => '6-10006', 'nama_akun' => 'Beban Pemasaran'],
            ['nomor_akun' => '6-10007', 'nama_akun' => 'Beban Administrasi dan Umum'],
            ['nomor_akun' => '6-10008', 'nama_akun' => 'Beban Perbaikan dan Pemeliharaan'],
            ['nomor_akun' => '6-10009', 'nama_akun' => 'Beban Asuransi'],
            ['nomor_akun' => '6-10010', 'nama_akun' => 'Beban Transportasi'],
            ['nomor_akun' => '6-10011', 'nama_akun' => 'Beban Rupa-Rupa Usaha'],
            ['nomor_akun' => '7-10000', 'nama_akun' => 'Beban Lain-Lain'],
            ['nomor_akun' => '7-10001', 'nama_akun' => 'Beban Bunga'],
            ['nomor_akun' => '7-10002', 'nama_akun' => 'Kerugian Penjualan Aset'],
            ['nomor_akun' => '8-10000', 'nama_akun' => 'Pendapatan Non Usaha'],
            ['nomor_akun' => '8-10001', 'nama_akun' => 'Pendapatan Bunga Deposito'],
            ['nomor_akun' => '8-10002', 'nama_akun' => 'Keuntungan Penjualan Aset'],
            ['nomor_akun' => '9-10000', 'nama_akun' => 'Pajak Penghasilan'],
            ['nomor_akun' => '9-10001', 'nama_akun' => 'Beban Pajak Penghasilan']
        ];

        MasterVoucher::insert($data);
    }
}
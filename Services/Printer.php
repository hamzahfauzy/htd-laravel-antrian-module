<?php

namespace App\Modules\Antrian\Services;

use Illuminate\Support\Facades\Log;
use Mike42\Escpos\Printer as PosPrinter;

class Printer
{
    private $type = 'WINDOWS';
    private $connection_string = 'RP58 Printer';
    private $paper_size = 32;
    private $auto_cut = 'YES';

    public function printStruk($data)
    {
        if(in_array($this->type, ['WINDOWS','NETWORK','USB']))
        {
            return $this->directPrintStruk($data);
        }

        else if($this->type == 'ONLINE')
        {
            // $printString = $this->printString($data);
            // file_put_contents('print.txt', $printString);
            // $connectionString = $this->connection_string;
            // $connectionString = explode(':', $connectionString);
            
            // $host = $connectionString[0]; // Ganti dengan IP/host server socket
            // $port = $connectionString[1];                    // Ganti dengan port server socket
            // $uniqId = $connectionString[2];         // ID unik printer ini

            // $socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
            // if (!$socket) {
            //     die("Gagal membuat socket\n");
            // }

            // if (!socket_connect($socket, $host, $port)) {
            //     die("Gagal konek ke server\n");
            // }
            // // Kirim uniq_id untuk registrasi
            // socket_write($socket, '{"type":"print","uniq_id":"'.$uniqId.'"}'."\n");

            // socket_close($socket);
        }
    }

    public function directPrintStruk($data)
    {
        try {
            // Inisialisasi konektor sesuai tipe
            switch ($this->type) {
                case 'WINDOWS':
                    $connector = new \Mike42\Escpos\PrintConnectors\WindowsPrintConnector($this->connection_string);
                    break;
                case 'NETWORK':
                    $connector = new \Mike42\Escpos\PrintConnectors\NetworkPrintConnector($this->connection_string);
                    break;
                case 'USB':
                    $connector = new \Mike42\Escpos\PrintConnectors\FilePrintConnector($this->connection_string);
                    break;
                default:
                    throw new \Exception("Jenis koneksi printer tidak didukung.");
            }

            $printer = new PosPrinter($connector);
            $paperSize = $this->paper_size;

            // Header toko
            $printer->setJustification(PosPrinter::JUSTIFY_CENTER);
            $printer->setTextSize(2, 2);
            $printer->text("Sistem Antrian\n");
            $printer->setTextSize(1, 1);
            $printer->text($data['nama_opd']."\n");

            // Info transaksi
            $printer->setJustification(PosPrinter::JUSTIFY_LEFT);
            $printer->text(str_repeat("-", $paperSize) . "\n");
            $printer->text("Tanggal: " . (new \Carbon\Carbon($data['tanggal']))->format('d-m-Y H:i:s') . "\n");
            $printer->text(str_repeat("-", $paperSize) . "\n");

            $printer->setJustification(PosPrinter::JUSTIFY_CENTER);
            $printer->text("NOMOR\n\n");
            $printer->setTextSize(2, 2);
            $printer->text($data['nomor'] . "\n\n");
            $printer->setTextSize(1, 1);
            $printer->text('TERIMA KASIH');

            $printer->feed(1);
            if ($this->auto_cut == 'YES') {
                $printer->cut();
            }

            $printer->pulse();

            $printer->close();
        } catch (\Exception $e) {
            Log::error("Printer Error: " . $e->getMessage());
            echo $e->getMessage();
        }
    }
}
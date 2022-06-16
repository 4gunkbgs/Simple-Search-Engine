<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Str;

class BrowseController extends Controller
{
    public function index()
    {
        return view('search');
    }

    public function search(Request $request)
    {
        // contoh setelah dimasukin query ke solr
        // http://localhost:8983/solr/mal_core/select?indent=true&q.op=OR&q=title_txt_en%3A%20gintama

        // fungsi untuk mengubah spasi menjadi %20 
        // agar bisa dimasukkan ke query
        function convertSearchKey($key)
        {
            $key = (trim($key));
            $searchKey = '';
            if (Str::contains($key, ' ')) {
                $result = explode(' ', $key);
                foreach ($result as $res) {
                    $searchKey .= $res . "%20";
                }
                $searchKey = substr($searchKey, 0, -3);
                return $searchKey;
            }

            return $key;
        }

        // fungsi untuk menghitung banyak halaman
        function penghitungPaginate($banyakData, $perPage = 5)
        {
            return (int)(ceil($banyakData / $perPage));
        }

        // fungsi untung menampilkan halaman sesuai page yang dibuat
        function paginate($items, $perPage = 5, $page = 1)
        {
            // deklarasi variable item yang akan ditampilkan
            // sementara akan diisi seluruh item
            // kemudian nanti akan direplace dengan array_slice
            $itemToShow = $items;
            $currentPage = $page;
            //cek jika pagenya bukan page pertama
            //set posisi startnya
            if ($currentPage > 1) {
                $start = ($currentPage * $perPage) - $perPage;
            } else {
                $start = 0;
            }

            $itemToShow = array_slice($items, $start, $perPage);

            return $itemToShow;
        }

        // menggabungkan input user dengan url pada apache solr
        $url = "http://localhost:8983/solr/mal_core/select?indent=true&q.op=OR&q=title_txt_en%3A%20" . convertSearchKey($request->search);
        // supaya data yang tampil bisa lebih dari default = 10
        $url = $url . "&rows=50";

        // get kontennya
        $result = file_get_contents($url);

        // decode jsonnya jadi array
        $fixed_result = json_decode($result, true);

        // variable hasil menyimpan array dari hasil yang ditemukan
        $hasil = $fixed_result['response']['docs'];
        $banyakHalaman = 1;
        // set hasil yang akan tampil hanya 5
        $perPage = 5;
        // cek jika jumlah ditemukan pada solr > 5
        if ($fixed_result['response']['numFound'] > 5) {

            // hitung banyak halaman yang akan ditampilkan dari data yang ditemukan
            $banyakHalaman = penghitungPaginate($fixed_result['response']['numFound'], $perPage);
            // paginate halaman tersebut
            $hasil = paginate($hasil, $perPage, $request->halaman);
        }

        // simpan key yang tadi diketik ke dalam variable
        // untuk di pass ke view
        // cek link() di result.blade.php
        $previousSearch = convertSearchKey($request->search);


        return view('result', [
            'hasil' => $hasil,
            'banyakHalaman' => $banyakHalaman,
            'prevSearch' => $previousSearch,
        ]);
    }
}

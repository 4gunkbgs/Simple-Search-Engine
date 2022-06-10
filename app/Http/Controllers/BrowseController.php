<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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

        //fungsi untuk mengubah spasi menjadi %20 
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

        // menggabungkan input user dengan url pada apache solr
        $url = "http://localhost:8983/solr/mal_core/select?indent=true&q.op=OR&q=title_txt_en%3A%20" . convertSearchKey($request->search);

        // get kontennya
        $result = file_get_contents($url);

        // decode jsonnya jadi array
        $fixed_result = json_decode($result, true);

        return view('result', ['hasil' => $fixed_result]);
    }
}

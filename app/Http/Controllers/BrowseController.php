<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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

        // masukin request->search
        $url = "http://localhost:8983/solr/mal_core/select?indent=true&q.op=OR&q=title_txt_en%3A%20" . $request->search;

        // dapetin kontennya
        $result = file_get_contents($url);

        // decode kontennya jadi json
        $fixed_result = json_decode($result, true);

        return view('result', ['hasil' => $fixed_result]);
    }
}

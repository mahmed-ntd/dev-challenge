<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Http;

class ControllerDevChallenge extends Controller
{

    /**
     *
     */
    public function index()
    {
        return view('search-omdb');
    }

    public function data(Request $request)
    {
        $dataTable['data'] = [];
        $filter = $request->input('filter');
        if (empty($filter)) {
            echo json_encode($dataTable);
            die;
        }

        $response = Http::withOptions([
            'debug' => false,
        ])->get('https://www.omdbapi.com/?s=' . $filter . '&apikey=' . env('omdb'));
        $responseBody = json_decode($response->body());
        if ($responseBody->Response === "False") {
            echo json_encode($dataTable);
            die;
        }

        $responseBody->data = array_map(function($result) {
            $url = url('view', ['id' => $result->imdbID]);
            $result->action = "<a href={$url}>View</a>";
            return $result;
        }, $responseBody->Search);

        echo json_encode($responseBody);
    }

}

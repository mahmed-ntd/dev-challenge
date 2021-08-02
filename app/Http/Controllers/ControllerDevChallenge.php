<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\View\View;

class ControllerDevChallenge extends Controller
{

    /**
     * @return Application|Factory|View
     */
    public function index(Request $request)
    {
        return view('search-omdb', ['search' => $request->input('search')]);
    }

    /**
     * @param string $id
     * @param string $search
     * @return Application|Factory|View
     */
    public function view(string $id, string $search)
    {
        $response = Http::withOptions([
            'debug' => false,
        ])->get('https://www.omdbapi.com/?i=' . $id . '&apikey=' . env('omdb'));
        $record = json_decode($response->body(), true);
        $record['search'] = $search;
        $record['Title'] = $this->textHighlight($record['Title'], $search);

        return view('view', $record);
    }

    /**
     * data table
     *
     * @param Request $request
     */
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

        $responseBody->data = array_map(function($result) use ($filter) {
            $url = url('view', ['id' => $result->imdbID, 'search' => $filter]);
            $result->action = "<a href={$url}>View</a>";
            return $result;
        }, $responseBody->Search);

        echo json_encode($responseBody);
    }

    /**
     * search for matching
     *
     * @param string $haystack
     * @param string $needle
     * @return string
     */
    private function textHighlight(string $haystack, string $needle): string
    {
        return preg_replace("/($needle)/i","<span style='font-weight:900; font-size: 22px; background-color: yellow'>\${1}</span>",$haystack);
    }

}

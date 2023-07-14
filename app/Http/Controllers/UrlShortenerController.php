<?php

namespace App\Http\Controllers;

use App\Models\Url;
use Exception;
use Illuminate\Http\Request;


class UrlShortenerController extends Controller
{

    public function store(Request $request)
    {
        try {
            $longUrl = $request->get('url');
            $shortUrl = $request->get('shortlink');
            if ($longUrl != '' || $shortUrl != '') {

                $urlFound = Url::where('long_url', $longUrl)->orWhere('short_url', $longUrl)->get(['id', 'short_url'])->toArray();

                if (!empty($urlFound)) {

                    return $urlFound[0]['short_url'];

                } else {
                    $url = new Url;
                    $url->long_url = $longUrl;
                    $url->short_url = $shortUrl;
                    if ($url->save()) {
                        return $url->short_url;
                    }
                }
            }
        } catch (Exception $e) {
            dd($e);
        }
    }

    public function getURLs()
    {
        $urls = URL::orderBy('created_at', 'desc')->get();

        return response()->json(['urls' => $urls]);
    }

    public function topURLs()
    {
        $mostVisitedURLs = URL::orderBy('click_count', 'desc')->take(5)->get();

        return response()->json(['mostVisitedURLs' => $mostVisitedURLs]);
    }

    public function handle(Request $request, $url)
    {

        try {
            $uri = $_SERVER['REQUEST_URI'];
            if ($uri == '') {
                return abort(404);
            }

            $url = Url::where('short_url', 'like', '%' . $uri . '%');
            $url->firstOrFail()->increment('click_count');

            $link = $url->get('long_url');

            // dd($url);
            if ($link == '' || count($link) == 0) {
                return abort(404);
            } else {

                return redirect($link[0]['long_url']);
            }

        } catch (Exception $e) {
            dd($e);
        }
    }


}
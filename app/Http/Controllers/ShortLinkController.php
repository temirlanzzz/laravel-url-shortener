<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ShortLink;

class ShortLinkController extends Controller
{
    public function index()
    {
        $shortLinks = ShortLink::latest()->get();

        return view('shortenLink', compact('shortLinks'));
    }
    public function indexJson()
    {
        $shortLinks = ShortLink::latest()->get();

        return response()->json($shortLinks);
    }

    public function store(Request $request)
    {
        $request->validate([
            'link' => 'required|url'
        ]);

        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < 6; $i++) {
            $randomString .= $characters[random_int(0, $charactersLength - 1)];
        }
        $input['link'] = $request->link;
        $input['code'] = $randomString;

        ShortLink::create($input);

        return redirect('generate-shorten-link')->with('success', 'Shorten Link Generated Successfully!');

    }
    public function storeJson(Request $request)
    {
        $request->validate([
            'link' => 'required|url'
        ]);

        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < 6; $i++) {
            $randomString .= $characters[random_int(0, $charactersLength - 1)];
        }
        $input['link'] = $request->link;
        $input['code'] = $randomString;

        $shortLink = ShortLink::create($input);


        return response()->json($shortLink);
    }

    public function shortenLink($code)
    {
        $find = ShortLink::where('code', $code)->first();

        return redirect($find->link);

    }

    public function shortenLinkJson($code)
    {

        $find = ShortLink::where('code', $code)->first();

        return response()->json($find->link);
    }
}

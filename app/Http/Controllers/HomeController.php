<?php

namespace App\Http\Controllers;

use App\Models\CmsContent;

class HomeController extends Controller
{
    public function index()
    {

        return view(
            'welcome',
            [
                'content' => array_merge(...array_map(
                    function ($content) {
                        return [
                            $content['key'] => $content['content']
                        ];
                    },
                    CmsContent::where('key', 'like', 'home-%')->get()->toArray()
                ))
            ]
        );
    }
}

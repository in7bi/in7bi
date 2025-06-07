<?php

namespace App\Http\Controllers\Api\Web;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use App\Models\InvestorRelation;
use App\Models\Mitra;
use App\Models\OurTeam;
use App\Models\Project;
use App\Models\Service;
use App\Models\Social;
use App\Models\WebSettings;

class LandingPageController extends Controller
{
    public function index()
    {
        $data = [
            'settings' => WebSettings::first(),
            'social' => Social::first(),
            'faqs' => Faq::latest()->get(),
            'investor_relations' => InvestorRelation::latest()->get(),
            'mitras' => Mitra::latest()->get(),
            'teams' => OurTeam::latest()->get(),
            'projects' => Project::latest()->get(),
            'services' => Service::with('category')->latest()->get(),
        ];

        return response()->json($data);
    }
}

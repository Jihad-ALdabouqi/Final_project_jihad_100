<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Salon;
use App\Models\Service;
use App\Models\Offer;

class ServiceController extends Controller
{
    public function show(Salon $salon, Service $service)
    {
        
        $offer = Offer::where('service_id', $service->id)->where('is_active', true)->first();

        return view('user.pages.service', compact('salon', 'service', 'offer'));
    }
}
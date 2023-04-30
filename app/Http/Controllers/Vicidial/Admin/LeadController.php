<?php

namespace App\Http\Controllers\Vicidial\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Vicidial\Api\Wrapper\Admin\Client;

class LeadController extends Controller
{
    public function index(): View
    {
        return view('pages.vicidial.admin.lead');
    }

    public function store(Request $request): View
    {
        $vicidial = new Client(
            env('VICIDIAL_IP'),
            env('VICIDIAL_USER'),
            env('VICIDIAL_PASS'),
            source:'test',
        hasSSl: false
        );
        $data = $request->all();
        $vicidial->add_lead([
            'first_name' => $data['first-name'],
            'last_name' => $data['last-name'],
            'email' => $data['email'],
            'country' => $data['country'],
            'address1' => $data['street-address'],
            'city' => $data['city'],
            'state' => $data['region'],
            'postal_code' => $data['postal-code'],
            'phone_number' => $data['phone_number'],
        ]);

        return view('pages.vicidial.admin.success');
    }
}

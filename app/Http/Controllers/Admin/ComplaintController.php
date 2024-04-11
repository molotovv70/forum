<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\ComplaintResource;
use App\Models\Complaint;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ComplaintController extends Controller
{
    public function index()
    {
        $complaints = Complaint::all();
        $complaints = ComplaintResource::collection($complaints)->resolve();
        return Inertia::render('Admin/Complaint/Index', ['complaints' => $complaints]);
    }
}

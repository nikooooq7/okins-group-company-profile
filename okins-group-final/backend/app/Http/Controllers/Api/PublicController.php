<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\CompanyProfile;
use App\Models\CompanyMission;
use App\Models\CompanyDivision;
use Illuminate\Http\JsonResponse;
class PublicController extends Controller {
    public function index(): JsonResponse {
        return response()->json([
            'profile' => CompanyProfile::first(),
            'missions' => CompanyMission::orderBy('sort_order')->orderBy('id')->get(),
            'divisions' => CompanyDivision::orderBy('sort_order')->orderBy('id')->get(),
        ]);
    }
}

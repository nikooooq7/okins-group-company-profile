<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\AdminUser;
use App\Models\AdminToken;
use App\Models\CompanyProfile;
use App\Models\CompanyMission;
use App\Models\CompanyDivision;
use App\Models\ContactMessage;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminController extends Controller {
    public function login(Request $request): JsonResponse {
        $data = $request->validate(['email'=>['required','email'],'password'=>['required','string','max:200']]);
        $admin = AdminUser::where('email', $data['email'])->first();
        if (!$admin || !Hash::check($data['password'], $admin->password)) {
            return response()->json(['message'=>'Email atau password tidak sesuai.'], 422);
        }
        $plain = Str::random(64);
        AdminToken::create(['token_hash'=>hash('sha256',$plain),'expires_at'=>now()->addHours(8)]);
        return response()->json(['token'=>$plain,'admin'=>['name'=>$admin->name,'email'=>$admin->email]]);
    }
    public function logout(Request $request): JsonResponse {
        $request->attributes->get('admin_token')?->delete();
        return response()->json(['message'=>'Berhasil keluar.']);
    }
    public function dashboard(): JsonResponse {
        return response()->json([
            'profile'=>CompanyProfile::first(),
            'missions'=>CompanyMission::orderBy('sort_order')->orderBy('id')->get(),
            'divisions'=>CompanyDivision::orderBy('sort_order')->orderBy('id')->get(),
            'messages'=>ContactMessage::latest()->limit(100)->get(),
        ]);
    }
    public function updateProfile(Request $request): JsonResponse {
        $data=$request->validate([
            'name'=>['required','string','max:160'],
            'description'=>['nullable','string','max:5000'],
            'vision'=>['nullable','string','max:3000'],
            'address'=>['nullable','string','max:500'],
            'email'=>['nullable','email','max:180'],
            'phone'=>['nullable','string','max:50'],
        ]);
        $profile=CompanyProfile::first();
        if (!$profile) $profile=CompanyProfile::create($data); else $profile->update($data);
        return response()->json(['message'=>'Profil diperbarui.','profile'=>$profile]);
    }
    public function createMission(Request $request): JsonResponse {
        $data=$request->validate(['content'=>['required','string','max:1000']]);
        $data['sort_order']=(CompanyMission::max('sort_order') ?? 0)+1;
        return response()->json(CompanyMission::create($data),201);
    }
    public function deleteMission(CompanyMission $mission): JsonResponse {
        $mission->delete(); return response()->json(['message'=>'Misi dihapus.']);
    }
    public function createDivision(Request $request): JsonResponse {
        $data=$request->validate(['name'=>['required','string','max:160'],'description'=>['required','string','max:2000']]);
        $data['sort_order']=(CompanyDivision::max('sort_order') ?? 0)+1;
        return response()->json(CompanyDivision::create($data),201);
    }
    public function deleteDivision(CompanyDivision $division): JsonResponse {
        $division->delete(); return response()->json(['message'=>'Divisi dihapus.']);
    }
}

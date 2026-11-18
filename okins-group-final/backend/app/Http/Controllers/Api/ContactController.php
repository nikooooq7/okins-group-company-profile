<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
class ContactController extends Controller {
    public function store(Request $request): JsonResponse {
        $data = $request->validate([
            'name' => ['required','string','max:120'],
            'email' => ['required','email','max:180'],
            'message' => ['required','string','max:5000'],
        ]);
        ContactMessage::create($data);
        return response()->json(['message' => 'Pesan Anda berhasil dikirim. Terima kasih telah menghubungi Okins Group.'], 201);
    }
}

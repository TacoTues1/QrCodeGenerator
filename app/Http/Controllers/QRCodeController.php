<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DNS2D;

class QRCodeController extends Controller
{
    public function index()
    {
        // Clear any existing QR code data from the session
        session()->forget(['qrCode', 'url']);
        return view('qrcode.index');
    }

    public function generate(Request $request)
    {
        $request->validate([
            'url' => 'required|url'
        ]);

        $url = $request->input('url');
        
        // Generate QR code in SVG format
        $qrCode = DNS2D::getBarcodeSVG($url, 'QRCODE', 8, 8);
        
        // Add necessary attributes to the SVG
        $qrCode = str_replace('<svg', '<svg id="qrcode-svg" class="qrcode" xmlns="http://www.w3.org/2000/svg" width="200" height="200"', $qrCode);

        return response()->json([
            'qrCode' => $qrCode,
            'url' => $url,
            'generatedAt' => now()->format('M j, Y g:i A')
        ]);
    }
} 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR Code Generator</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        @keyframes gradient {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        /* Dark mode styles */
        .dark {
            color-scheme: dark;
        }

        .dark body {
            background-color: #1a1a1a;
            color: #ffffff;
        }

        .dark .glass-effect {
            background: rgba(17, 24, 39, 0.9);
            border-color: rgba(255, 255, 255, 0.1);
        }

        .dark .bg-gradient-to-br {
            background: linear-gradient(to bottom right, #1f2937, #111827);
        }

        .dark input {
            background-color: #374151;
            border-color: #4B5563;
            color: #ffffff;
        }

        .dark input::placeholder {
            color: #9CA3AF;
        }

        .dark .text-gray-700 {
            color: #E5E7EB;
        }

        .dark .text-gray-500 {
            color: #9CA3AF;
        }

        .dark .text-gray-900 {
            color: #F3F4F6;
        }

        .dark .text-gray-600 {
            color: #D1D5DB;
        }

        .dark .bg-white\/90 {
            background-color: rgba(17, 24, 39, 0.9);
        }

        .dark .shadow-md {
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.3);
        }

        /* Theme toggle button styles */
        .theme-toggle {
            position: relative;
            width: 60px;
            height: 30px;
            border-radius: 15px;
            background: #4f46e5;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 5px;
            transition: all 0.3s ease;
        }

        .theme-toggle::before {
            content: '';
            position: absolute;
            width: 24px;
            height: 24px;
            border-radius: 50%;
            background: white;
            transition: all 0.3s ease;
            left: 3px;
            z-index: 1;
        }

        .dark .theme-toggle::before {
            left: 33px;
            background: #1a1a1a;
        }

        .theme-toggle i {
            color: white;
            font-size: 14px;
            z-index: 2;
            transition: all 0.3s ease;
        }

        .theme-toggle .sun {
            margin-left: 5px;
        }

        .theme-toggle .moon {
            margin-right: 5px;
        }

        .dark .theme-toggle .sun {
            color: rgba(255, 255, 255, 0.5);
        }

        .dark .theme-toggle .moon {
            color: rgba(255, 255, 255, 1);
        }

        .theme-toggle .sun {
            color: rgba(255, 255, 255, 1);
        }

        .theme-toggle .moon {
            color: rgba(255, 255, 255, 0.5);
        }

        .gradient-bg {
            background: linear-gradient(-45deg, #4f46e5, #7c3aed, #2563eb, #3b82f6);
            background-size: 400% 400%;
            animation: gradient 15s ease infinite;
        }

        .hover-scale {
            transition: transform 0.2s ease-in-out;
        }

        .hover-scale:hover {
            transform: scale(1.02);
        }

        .fade-in {
            animation: fadeIn 0.5s ease-in;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .pulse {
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% { box-shadow: 0 0 0 0 rgba(79, 70, 229, 0.4); }
            70% { box-shadow: 0 0 0 10px rgba(79, 70, 229, 0); }
            100% { box-shadow: 0 0 0 0 rgba(79, 70, 229, 0); }
        }

        .card-hover {
            transition: all 0.3s ease;
        }

        .card-hover:hover {
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        /* Background styles */
        .animated-background {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            background: linear-gradient(45deg, #4f46e5, #7c3aed, #2563eb, #3b82f6);
            background-size: 400% 400%;
            animation: gradientBG 15s ease infinite;
            opacity: 0.1;
        }

        .animated-shapes {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            overflow: hidden;
        }

        .shape {
            position: absolute;
            border-radius: 50%;
            opacity: 0.1;
            animation: float 20s infinite;
            background: linear-gradient(45deg, #4f46e5, #7c3aed);
        }

        .shape:nth-child(1) {
            width: 300px;
            height: 300px;
            top: -150px;
            left: -150px;
            animation-delay: 0s;
            background: linear-gradient(45deg, #4f46e5, #7c3aed);
        }

        .shape:nth-child(2) {
            width: 200px;
            height: 200px;
            top: 50%;
            right: -100px;
            animation-delay: -5s;
            background: linear-gradient(45deg, #2563eb, #3b82f6);
        }

        .shape:nth-child(3) {
            width: 150px;
            height: 150px;
            bottom: -75px;
            left: 50%;
            animation-delay: -10s;
            background: linear-gradient(45deg, #7c3aed, #4f46e5);
        }

        .shape:nth-child(4) {
            width: 250px;
            height: 250px;
            top: 20%;
            left: 30%;
            animation: float2 25s infinite;
            animation-delay: -2s;
            background: linear-gradient(45deg, #3b82f6, #2563eb);
        }

        .shape:nth-child(5) {
            width: 180px;
            height: 180px;
            bottom: 30%;
            right: 20%;
            animation: float3 22s infinite;
            animation-delay: -7s;
            background: linear-gradient(45deg, #4f46e5, #7c3aed);
        }

        .shape:nth-child(6) {
            width: 120px;
            height: 120px;
            top: 70%;
            left: 10%;
            animation: float4 18s infinite;
            animation-delay: -4s;
            background: linear-gradient(45deg, #2563eb, #3b82f6);
        }

        .shape:nth-child(7) {
            width: 220px;
            height: 220px;
            top: 10%;
            right: 30%;
            animation: float5 28s infinite;
            animation-delay: -8s;
            background: linear-gradient(45deg, #7c3aed, #4f46e5);
        }

        .shape:nth-child(8) {
            width: 160px;
            height: 160px;
            bottom: 20%;
            left: 40%;
            animation: float6 24s infinite;
            animation-delay: -12s;
            background: linear-gradient(45deg, #3b82f6, #2563eb);
        }

        @keyframes gradientBG {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        @keyframes float {
            0% { transform: translate(0, 0) rotate(0deg); }
            33% { transform: translate(100px, 100px) rotate(120deg); }
            66% { transform: translate(-50px, 200px) rotate(240deg); }
            100% { transform: translate(0, 0) rotate(360deg); }
        }

        @keyframes float2 {
            0% { transform: translate(0, 0) rotate(0deg) scale(1); }
            25% { transform: translate(150px, -100px) rotate(90deg) scale(1.1); }
            50% { transform: translate(50px, 150px) rotate(180deg) scale(0.9); }
            75% { transform: translate(-100px, -50px) rotate(270deg) scale(1.2); }
            100% { transform: translate(0, 0) rotate(360deg) scale(1); }
        }

        @keyframes float3 {
            0% { transform: translate(0, 0) rotate(0deg) scale(1); }
            33% { transform: translate(-120px, 80px) rotate(120deg) scale(0.8); }
            66% { transform: translate(80px, -120px) rotate(240deg) scale(1.2); }
            100% { transform: translate(0, 0) rotate(360deg) scale(1); }
        }

        @keyframes float4 {
            0% { transform: translate(0, 0) rotate(0deg); }
            25% { transform: translate(80px, 80px) rotate(90deg); }
            50% { transform: translate(-80px, 80px) rotate(180deg); }
            75% { transform: translate(-80px, -80px) rotate(270deg); }
            100% { transform: translate(0, 0) rotate(360deg); }
        }

        @keyframes float5 {
            0% { transform: translate(0, 0) rotate(0deg) scale(1); }
            20% { transform: translate(100px, 0) rotate(72deg) scale(1.1); }
            40% { transform: translate(100px, 100px) rotate(144deg) scale(0.9); }
            60% { transform: translate(0, 100px) rotate(216deg) scale(1.2); }
            80% { transform: translate(-100px, 0) rotate(288deg) scale(0.8); }
            100% { transform: translate(0, 0) rotate(360deg) scale(1); }
        }

        @keyframes float6 {
            0% { transform: translate(0, 0) rotate(0deg) scale(1); }
            33% { transform: translate(-100px, -100px) rotate(120deg) scale(1.2); }
            66% { transform: translate(100px, 100px) rotate(240deg) scale(0.8); }
            100% { transform: translate(0, 0) rotate(360deg) scale(1); }
        }

        .glass-effect {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .content-wrapper {
            position: relative;
            z-index: 1;
        }
    </style>
</head>
<body class="min-h-screen flex flex-col">
    <!-- Animated background elements -->
    <div class="animated-background"></div>
    <div class="animated-shapes">
        <div class="shape"></div>
        <div class="shape"></div>
        <div class="shape"></div>
        <div class="shape"></div>
        <div class="shape"></div>
        <div class="shape"></div>
        <div class="shape"></div>
        <div class="shape"></div>
    </div>

    <!-- Navigation Bar -->
    <nav class="bg-white/90 backdrop-blur-md shadow-md">
        <div class="container mx-auto px-4">
            <div class="flex items-center justify-between h-16">
                <div class="flex items-center">
                    <a href="#" class="flex items-center space-x-2">
                        <i class="fas fa-qrcode text-2xl text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 to-purple-600"></i>
                        <span class="text-xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 to-purple-600">QR Code Generator</span>
                    </a>
                </div>
                <div class="flex items-center">
                    <a href="https://github.com/TacoTues1/QrCodeGenerator.git" target="_blank" class="mr-4 text-gray-600 hover:text-indigo-600 transition-colors duration-300">
                        <i class="fab fa-github text-2xl"></i>
                    </a>
                    <button id="themeToggle" class="theme-toggle" aria-label="Toggle dark mode">
                        <i class="fas fa-sun sun"></i>
                        <i class="fas fa-moon moon"></i>
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <div class="content-wrapper flex-grow">
        <div class="container mx-auto px-4 py-8">
            <div class="max-w-4xl mx-auto">
                <!-- URL Input Form -->
                <div class="glass-effect rounded-xl shadow-lg p-6 mb-8 card-hover hover-scale">
                    <form id="qrForm" class="space-y-4">
                        @csrf
                        <div class="flex gap-4">
                            <div class="flex-1">
                                <label for="url" class="block text-sm font-medium text-gray-700">Enter URL</label>
                                <div class="mt-1 relative rounded-md shadow-sm">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fas fa-link text-gray-400"></i>
                                    </div>
                                    <input type="url" name="url" id="url" 
                                           class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                                           placeholder="https://example.com"
                                           required>
                                </div>
                                <p id="urlError" class="mt-1 text-sm text-red-600 hidden"></p>
                            </div>
                            <div class="flex items-end">
                                <button type="submit" 
                                        class="bg-indigo-600 text-white py-2 px-6 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 flex items-center gap-2">
                                    <i class="fas fa-qrcode"></i>
                                    Generate QR Code
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

                <div id="qrCodeContainer" class="fade-in">
                    <!-- Combined QR Code and Details Card -->
                    <div class="glass-effect rounded-xl shadow-lg overflow-hidden card-hover">
                        <div class="p-6">
                            <div class="flex flex-col md:flex-row gap-8">
                                <!-- QR Code Display -->
                                <div class="flex-1">
                                    <div class="mb-4">
                                        <h2 class="text-xl font-semibold text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 to-purple-600 flex items-center gap-2">
                                            <i class="fas fa-qrcode text-indigo-600"></i>
                                            QR Code
                                        </h2>
                                    </div>
                                    <div class="bg-gradient-to-br from-gray-50 to-gray-100 p-6 rounded-lg flex justify-center pulse" id="qrCodeDisplay">
                                        <div class="text-center text-gray-500">
                                            <i class="fas fa-qrcode text-4xl mb-2"></i>
                                            <p>Enter a URL above to generate QR code</p>
                                        </div>
                                    </div>
                                </div>

                                <!-- QR Code Info -->
                                <div class="md:w-80">
                                    <div class="mb-4">
                                        <h2 class="text-lg font-semibold text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 to-purple-600 flex items-center gap-2">
                                            <i class="fas fa-info-circle text-indigo-600"></i>
                                            Details
                                        </h2>
                                    </div>
                                    <div class="space-y-3">
                                        <div class="bg-gradient-to-br from-gray-50 to-gray-100 rounded-lg p-3 hover-scale">
                                            <div class="flex items-start gap-2">
                                                <i class="fas fa-link text-indigo-500 mt-1 text-sm"></i>
                                                <div>
                                                    <h3 class="text-xs font-medium text-gray-500">URL</h3>
                                                    <p class="mt-0.5 text-xs text-gray-900 break-all" id="qrUrl">-</p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="bg-gradient-to-br from-gray-50 to-gray-100 rounded-lg p-3 hover-scale">
                                            <div class="flex items-start gap-2">
                                                <i class="fas fa-clock text-indigo-500 mt-1 text-sm"></i>
                                                <div>
                                                    <h3 class="text-xs font-medium text-gray-500">Generated</h3>
                                                    <p class="mt-0.5 text-xs text-gray-900" id="generatedTime">-</p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="bg-gradient-to-br from-gray-50 to-gray-100 rounded-lg p-3 hover-scale">
                                            <div class="flex items-start gap-2">
                                                <i class="fas fa-qrcode text-indigo-500 mt-1 text-sm"></i>
                                                <div>
                                                    <h3 class="text-xs font-medium text-gray-500">Format</h3>
                                                    <ul class="mt-0.5 space-y-0.5 text-xs text-gray-600">
                                                        <li>• Type: URL</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="bg-gradient-to-br from-gray-50 to-gray-100 rounded-lg p-3 hover-scale">
                                            <div class="flex items-start gap-2">
                                                <i class="fas fa-download text-indigo-500 mt-1 text-sm"></i>
                                                <div class="w-full">
                                                    <h3 class="text-xs font-medium text-gray-500">Download</h3>
                                                    <div class="mt-1.5">
                                                        <button onclick="downloadQR()" class="w-full bg-gradient-to-r from-indigo-500 to-purple-500 hover:from-indigo-600 hover:to-purple-600 text-white py-1.5 px-3 rounded text-xs flex items-center justify-center gap-1.5 transition-all duration-300 transform hover:scale-105">
                                                            <i class="fas fa-file-image text-xs"></i>
                                                            Download QR Code
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="py-3 bg-gradient-to-r from-indigo-600 to-purple-600 text-white mt-auto">
        <div class="container mx-auto px-4">
            <div class="flex items-center justify-center space-x-4 text-sm">
                <span>© 2024 QR Code Generator. All rights reserved.</span>
                <span>•</span>
                <span>v2025 AppDev Final Project</span>
                <span>•</span>
                <span>Developed by: Alfonz Perez, Christian Earl Siong, Rico Jay Manaban</span>
            </div>
        </div>
    </footer>

    <script>
        // Theme switching functionality
        const themeToggle = document.getElementById('themeToggle');
        const prefersDarkScheme = window.matchMedia('(prefers-color-scheme: dark)');
        
        // Check for saved theme preference or use system preference
        const currentTheme = localStorage.getItem('theme') || 
            (prefersDarkScheme.matches ? 'dark' : 'light');
        
        // Apply the theme
        if (currentTheme === 'dark') {
            document.documentElement.classList.add('dark');
        }

        // Theme toggle click handler
        themeToggle.addEventListener('click', () => {
            if (document.documentElement.classList.contains('dark')) {
                document.documentElement.classList.remove('dark');
                localStorage.setItem('theme', 'light');
            } else {
                document.documentElement.classList.add('dark');
                localStorage.setItem('theme', 'dark');
            }
        });

        // Add animation to the submit button
        document.querySelector('button[type="submit"]').classList.add('hover-scale');
        
        // Add loading animation
        function showLoading() {
            const submitButton = document.querySelector('button[type="submit"]');
            submitButton.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Generating...';
            submitButton.classList.add('opacity-75');
        }

        function hideLoading() {
            const submitButton = document.querySelector('button[type="submit"]');
            submitButton.innerHTML = '<i class="fas fa-qrcode"></i> Generate QR Code';
            submitButton.classList.remove('opacity-75');
        }

        // Update the fetch call to use the new loading functions
        document.getElementById('qrForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const url = document.getElementById('url').value;
            const urlError = document.getElementById('urlError');
            
            urlError.classList.add('hidden');
            showLoading();
            
            fetch('{{ route("qrcode.generate") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ url: url })
            })
            .then(response => response.json())
            .then(data => {
                if (data.error) {
                    urlError.textContent = data.error;
                    urlError.classList.remove('hidden');
                } else {
                    document.getElementById('qrCodeDisplay').innerHTML = data.qrCode;
                    document.getElementById('qrUrl').textContent = data.url;
                    document.getElementById('generatedTime').textContent = data.generatedAt;
                }
            })
            .catch(error => {
                console.error('Error:', error);
                urlError.textContent = 'An error occurred while generating the QR code.';
                urlError.classList.remove('hidden');
            })
            .finally(() => {
                hideLoading();
            });
        });

        function downloadQR() {
            const qrCodeElement = document.getElementById('qrcode-svg');
            
            if (!qrCodeElement) {
                console.error('QR code element not found');
                alert('Error: QR code element not found. Please try generating the QR code again.');
                return;
            }

            try {
                // Get the SVG data
                const svgData = new XMLSerializer().serializeToString(qrCodeElement);
                
                // Create a canvas element
                const canvas = document.createElement('canvas');
                const ctx = canvas.getContext('2d');
                
                // Set canvas size
                canvas.width = 200;
                canvas.height = 200;

                // Create an image
                const img = new Image();
                
                img.onload = function() {
                    // Fill white background
                    ctx.fillStyle = 'white';
                    ctx.fillRect(0, 0, canvas.width, canvas.height);
                    
                    // Draw the QR code
                    ctx.drawImage(img, 0, 0, canvas.width, canvas.height);
                    
                    // Convert to PNG and download
                    const pngData = canvas.toDataURL('image/png');
                    const downloadLink = document.createElement('a');
                    downloadLink.href = pngData;
                    downloadLink.download = 'qrcode.png';
                    document.body.appendChild(downloadLink);
                    downloadLink.click();
                    document.body.removeChild(downloadLink);
                };

                img.onerror = function() {
                    console.error('Error loading QR code image');
                    alert('Error loading QR code image. Please try again.');
                };

                // Convert SVG to base64
                const svgBlob = new Blob([svgData], {type: 'image/svg+xml;charset=utf-8'});
                const url = URL.createObjectURL(svgBlob);
                img.src = url;

            } catch (error) {
                console.error('Error in download process:', error);
                alert('Error downloading QR code. Please try again.');
            }
        }
    </script>
</body>
</html> 
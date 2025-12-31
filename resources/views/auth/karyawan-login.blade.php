<!-- resources/views/auth/karyawan-login.blade.php -->
<!DOCTYPE html>
<html lang="id">
<head>
    <title>Login Karyawan | PT Saitama Juara Dunia</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="min-h-screen flex bg-white">

<!-- LEFT SECTION -->
<div class="w-1/2 bg-[#173A67] text-white flex flex-col justify-between p-10">
    <div>
        <div class="flex items-center gap-3">
            <img src="{{ asset('images/logo-saitama.png') }}" class="h-10">
            <div>
                <p class="font-semibold">PT SAITAMA</p>
                <p class="text-xs">JUARA MENDUNIA</p>
            </div>
        </div>

        <p class="text-center mt-10 text-sm">Informasi</p>

        <div class="mt-6 bg-white rounded-2xl overflow-hidden">
            <img src="{{ asset('images/sensei-class.jpg') }}" class="w-full h-72 object-cover">
        </div>
    </div>

    <div class="text-xs text-gray-300">
        <p class="font-semibold">Saitama Grup</p>
        <ul class="mt-2 space-y-1">
            <li>LPK Saitama</li>
            <li>Ayaka Josei Center</li>
        </ul>

        <div class="mt-4">
            <p class="font-semibold">Kontak Kami:</p>
            <p class="mt-1">Jl. Pahlawan Jl. Prajenan No.9, Manguan, Mertoyudan,<br>Kabupaten Magelang, Jawa Tengah 56172</p>
        </div>

        <p class="mt-6 text-[10px]">Copyright © PT Saitama Juara Mendunia</p>
    </div>
</div>

<!-- RIGHT SECTION -->
<div class="w-1/2 flex items-center justify-center">
    <div class="w-[420px] text-center">

        <img src="{{ asset('images/logo-saitama.png') }}" class="h-16 mx-auto mb-6">

        <p class="font-semibold mb-2">Masuk Sebagai:</p>
        <div class="flex justify-center gap-8 mb-6">
            <label class="flex items-center gap-2">
                <input type="radio" name="role" value="guru" checked class="accent-red-500">
                <span>Guru</span>
            </label>
            <label class="flex items-center gap-2">
                <input type="radio" name="role" value="karyawan" class="accent-red-500">
                <span>Karyawan</span>
            </label>
        </div>

        @if ($errors->any())
            <div class="mb-4 text-left text-sm text-red-600">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('karyawan.login.post') }}" class="space-y-4">
            @csrf
            <input name="email" type="email" value="{{ old('email') }}" placeholder="Email" required class="w-full bg-[#0396D6] text-white placeholder-white px-5 py-3 rounded-full focus:outline-none">
            <input name="password" type="password" placeholder="Password" required class="w-full bg-[#0396D6] text-white placeholder-white px-5 py-3 rounded-full focus:outline-none">

            <div class="flex items-center justify-between text-sm">
                <label class="flex items-center gap-2">
                    <input type="checkbox" name="remember" class="accent-red-500">
                    <span>Ingat saya</span>
                </label>
                <a href="#" class="text-blue-600 font-semibold">Lupa password?</a>
            </div>

            <button type="submit" class="mt-4 bg-[#D85B63] hover:bg-[#c44f56] text-white px-10 py-2 rounded-full">Masuk</button>
        </form>

        <p class="mt-6 text-sm">Belum punya akun? <a href="{{ route('karyawan.register') }}" class="text-blue-600 font-semibold">Daftar</a></p>

    </div>
</div>

</body>
</html>

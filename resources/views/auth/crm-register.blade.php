<!-- resources/views/auth/crm-register.blade.php -->
<!DOCTYPE html>
<html lang="id">
<head>
    <title>Registrasi CRM | PT Saitama Juara Dunia</title>
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

        @if ($errors->any())
            <div class="mb-4 text-left text-sm text-red-600">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('crm.register.store') }}" class="space-y-4">
            @csrf
            <input name="name" type="text" value="{{ old('name') }}" placeholder="Nama" required class="w-full bg-[#0396D6] text-white placeholder-white px-5 py-3 rounded-full focus:outline-none">
            <input name="email" type="email" value="{{ old('email') }}" placeholder="Email" required class="w-full bg-[#0396D6] text-white placeholder-white px-5 py-3 rounded-full focus:outline-none">
            <div class="flex gap-3">
                <input name="password" type="password" placeholder="Password" required class="w-1/2 bg-[#0396D6] text-white placeholder-white px-5 py-3 rounded-full focus:outline-none">
                <input name="password_confirmation" type="password" placeholder="Konfirmasi Password" required class="w-1/2 bg-[#0396D6] text-white placeholder-white px-5 py-3 rounded-full focus:outline-none">
            </div>

            <div class="space-y-2">
                <p class="font-semibold text-gray-700">Daftar Sebagai:</p>
                <div class="flex justify-center gap-8 mb-6">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="radio" name="role" value="guru" {{ old('role', 'guru') == 'guru' ? 'checked' : '' }} class="accent-red-500 w-4 h-4">
                        <span class="text-sm">Guru</span>
                    </label>
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="radio" name="role" value="karyawan" {{ old('role') == 'karyawan' ? 'checked' : '' }} class="accent-red-500 w-4 h-4">
                        <span class="text-sm">Karyawan</span>
                    </label>
                </div>
            </div>
            
            <button type="submit" class="mt-4 bg-[#D85B63] hover:bg-[#c44f56] text-white px-10 py-2 rounded-full">Daftar</button>
        </form>

        <p class="mt-6 text-sm">Sudah punya akun? <a href="{{ route('crm.login') }}" class="text-blue-600 font-semibold">Login</a></p>

    </div>
</div>

</body>
</html>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CircleHub - Profile</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</head>
<body class="bg-[#121316] text-slate-200 flex min-h-screen font-sans antialiased" x-data="{ openProfileModal: false, openPasswordModal: false, openDeleteModal: false }">

    <!-- Komponen Sidebar -->
    <x-sidebar />

    <!-- Main Content Area -->
    <main class="flex-1 p-8 overflow-y-auto bg-[#0E1017]">
        <h1 class="text-2xl font-semibold text-white mb-8">Pengaturan Akun</h1>

        <!-- Notifikasi Sukses -->
        @if (session('status') === 'profile-updated')
            <div class="mb-6 p-4 bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 rounded-xl text-sm">
                Profil berhasil diperbarui.
            </div>
        @elseif (session('status') === 'password-updated')
            <div class="mb-6 p-4 bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 rounded-xl text-sm">
                Password berhasil diubah.
            </div>
        @endif

        <!-- Pesan Error Validasi global jika ada -->
        @if ($errors->any())
            <div class="mb-6 p-4 bg-rose-500/10 border border-rose-500/20 text-rose-400 rounded-xl text-sm space-y-1">
                @foreach ($errors->all() as $error)
                    <p>• {{ $error }}</p>
                @endforeach
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 max-w-6xl">
            
            <!-- Card Utama (Kiri: Foto, Username, Email, Bio, Password) -->
            <div class="lg:col-span-2 bg-[#2B2D31] rounded-2xl p-6 shadow-xl space-y-6 border border-slate-700/40">
                
                <!-- Avatar Circle -->
                <div class="flex items-center justify-between">
                    <div class="w-24 h-24 rounded-full bg-[#E0E0E0] text-[#121316] flex items-center justify-center font-bold text-4xl shadow-md">
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    </div>
                    <button type="button" @click="openProfileModal = true" class="text-slate-400 hover:text-white transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 210.3H3v-3.572L16.732 3.732z"></path></svg>
                    </button>
                </div>

                <!-- Username -->
                <div class="flex items-center justify-between pt-2 border-t border-slate-700/30">
                    <div>
                        <p class="text-xs text-slate-400 font-medium">Username</p>
                        <p class="text-base text-white font-medium mt-0.5">{{ $user->name }}</p>
                    </div>
                    <button type="button" @click="openProfileModal = true" class="text-slate-400 hover:text-white transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 210.3H3v-3.572L16.732 3.732z"></path></svg>
                    </button>
                </div>

                <!-- Email -->
                <div class="flex items-center justify-between pt-2 border-t border-slate-700/30">
                    <div>
                        <p class="text-xs text-slate-400 font-medium">Email</p>
                        <p class="text-base text-white font-medium mt-0.5">{{ $user->email }}</p>
                    </div>
                    <button type="button" @click="openProfileModal = true" class="text-slate-400 hover:text-white transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 210.3H3v-3.572L16.732 3.732z"></path></svg>
                    </button>
                </div>

                <!-- Bio -->
                <div class="flex items-center justify-between pt-2 border-t border-slate-700/30">
                    <div>
                        <p class="text-xs text-slate-400 font-medium">Bio</p>
                        <p class="text-base text-white font-medium mt-0.5">{{ $user->bio ?? 'Gaming sleep repeat everyday' }}</p>
                    </div>
                    <button type="button" @click="openProfileModal = true" class="text-slate-400 hover:text-white transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 210.3H3v-3.572L16.732 3.732z"></path></svg>
                    </button>
                </div>

                <!-- Password -->
                <div class="flex items-center justify-between pt-2 border-t border-slate-700/30">
                    <div>
                        <p class="text-xs text-slate-400 font-medium">Password</p>
                        <p class="text-base text-white font-medium mt-0.5">********</p>
                    </div>
                    <button type="button" @click="openPasswordModal = true" class="text-slate-400 hover:text-white transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 210.3H3v-3.572L16.732 3.732z"></path></svg>
                    </button>
                </div>

            </div>

            <!-- Card Kanan (Samping: ID, Role, Join Date, Danger Zone) -->
            <div class="space-y-6">
                
                <!-- Info Tambahan -->
                <div class="bg-[#2B2D31] rounded-2xl p-6 shadow-xl space-y-4 border border-slate-700/40">
                    <div>
                        <p class="text-xs text-slate-400 font-medium">ID Pengguna</p>
                        <p class="text-lg text-white font-semibold mt-0.5">{{ $user->id }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-slate-400 font-medium">Role</p>
                        <p class="text-lg text-white font-semibold mt-0.5">{{ ucfirst($user->role ?? 'User') }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-slate-400 font-medium">Join at</p>
                        <p class="text-lg text-white font-semibold mt-0.5">{{ $user->created_at ? $user->created_at->format('Y-m-d') : '-' }}</p>
                    </div>
                </div>

                <!-- Danger Zone (Hapus Akun) -->
                <div class="bg-[#2B2D31] rounded-2xl p-6 shadow-xl space-y-4 border border-slate-700/40">
                    <p class="text-sm font-semibold text-slate-200">Danger Zone</p>
                    <button type="button" @click="openDeleteModal = true" class="w-full py-2.5 px-4 bg-[#7A2B2B] hover:bg-red-700 text-white font-medium rounded-xl text-sm transition shadow-lg cursor-pointer text-center">
                        Hapus Akun
                    </button>
                </div>

            </div>

        </div>
    </main>

    <!-- Modal Edit Profil -->
    <div x-show="openProfileModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black/70 backdrop-blur-sm" x-cloak>
        <div class="bg-[#2B2D31] border border-slate-700/50 rounded-2xl p-6 w-full max-w-md shadow-2xl">
            <h2 class="text-lg font-semibold text-white mb-4">Edit Profil</h2>
            <form method="POST" action="{{ route('profile.update') }}" class="space-y-4">
                @csrf
                @method('patch')

                <div>
                    <label class="block text-xs font-medium text-slate-400 mb-1">Username</label>
                    <input type="text" name="name" value="{{ old('name', $user->name) }}" required class="w-full px-3 py-2 bg-[#121316] border border-slate-700 rounded-xl text-white text-sm focus:outline-none focus:border-indigo-500">
                </div>

                <div>
                    <label class="block text-xs font-medium text-slate-400 mb-1">Email</label>
                    <input type="email" name="email" value="{{ old('email', $user->email) }}" required class="w-full px-3 py-2 bg-[#121316] border border-slate-700 rounded-xl text-white text-sm focus:outline-none focus:border-indigo-500">
                </div>

                <div>
                    <label class="block text-xs font-medium text-slate-400 mb-1">Bio</label>
                    <textarea name="bio" rows="3" class="w-full px-3 py-2 bg-[#121316] border border-slate-700 rounded-xl text-white text-sm focus:outline-none focus:border-indigo-500">{{ old('bio', $user->bio) }}</textarea>
                </div>

                <div class="flex justify-end space-x-3 pt-3">
                    <button type="button" @click="openProfileModal = false" class="px-4 py-2 bg-slate-700 hover:bg-slate-600 text-white text-sm rounded-xl transition">Batal</button>
                    <button type="submit" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-500 text-white text-sm rounded-xl transition font-medium">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Ubah Password -->
    <div x-show="openPasswordModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black/70 backdrop-blur-sm" x-cloak>
        <div class="bg-[#2B2D31] border border-slate-700/50 rounded-2xl p-6 w-full max-w-md shadow-2xl">
            <h2 class="text-lg font-semibold text-white mb-4">Ubah Password</h2>
            <form method="POST" action="{{ route('profile.password.update') }}" class="space-y-4">
                @csrf
                @method('put')

                <div>
                    <label class="block text-xs font-medium text-slate-400 mb-1">Password Saat Ini</label>
                    <input type="password" name="current_password" required class="w-full px-3 py-2 bg-[#121316] border border-slate-700 rounded-xl text-white text-sm focus:outline-none focus:border-indigo-500">
                </div>

                <div>
                    <label class="block text-xs font-medium text-slate-400 mb-1">Password Baru</label>
                    <input type="password" name="password" required class="w-full px-3 py-2 bg-[#121316] border border-slate-700 rounded-xl text-white text-sm focus:outline-none focus:border-indigo-500">
                </div>

                <div>
                    <label class="block text-xs font-medium text-slate-400 mb-1">Konfirmasi Password Baru</label>
                    <input type="password" name="password_confirmation" required class="w-full px-3 py-2 bg-[#121316] border border-slate-700 rounded-xl text-white text-sm focus:outline-none focus:border-indigo-500">
                </div>

                <div class="flex justify-end space-x-3 pt-3">
                    <button type="button" @click="openPasswordModal = false" class="px-4 py-2 bg-slate-700 hover:bg-slate-600 text-white text-sm rounded-xl transition">Batal</button>
                    <button type="submit" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-500 text-white text-sm rounded-xl transition font-medium">Ubah Password</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Konfirmasi Hapus Akun -->
    <div x-show="openDeleteModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black/70 backdrop-blur-sm" x-cloak>
        <div class="bg-[#2B2D31] border border-slate-700/50 rounded-2xl p-6 w-full max-w-md shadow-2xl">
            <h2 class="text-lg font-semibold text-white mb-2">Hapus Akun</h2>
            <p class="text-xs text-slate-400 mb-4">Apakah Anda yakin ingin menghapus akun? Semua data akan dihapus secara permanen. Masukkan password Anda untuk mengonfirmasi.</p>
            
            <form method="POST" action="{{ route('profile.destroy') }}" class="space-y-4">
                @csrf
                @method('delete')

                <div>
                    <input type="password" name="password" placeholder="Password Anda" required class="w-full px-3 py-2 bg-[#121316] border border-slate-700 rounded-xl text-white text-sm focus:outline-none focus:border-red-500">
                </div>

                <div class="flex justify-end space-x-3 pt-2">
                    <button type="button" @click="openDeleteModal = false" class="px-4 py-2 bg-slate-700 hover:bg-slate-600 text-white text-sm rounded-xl transition">Batal</button>
                    <button type="submit" class="px-4 py-2 bg-red-700 hover:bg-red-600 text-white text-sm rounded-xl transition font-medium">Hapus Permanen</button>
                </div>
            </form>
        </div>
    </div>

</body>
</html>
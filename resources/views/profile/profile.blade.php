<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CircleHub - Pengaturan Akun</title>

    <script>
        if (localStorage.getItem('theme') === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style> body { font-family: 'Inter', sans-serif; } </style>
</head>
<body class="bg-gray-100 text-zinc-900 dark:bg-[#000816] dark:text-zinc-100 h-screen w-screen overflow-hidden flex flex-col m-0 p-0 transition-colors duration-200">

    <x-navbar />

    <div class="flex flex-1 w-full overflow-hidden relative">
        <x-sidebar />

        <main class="flex-1 relative overflow-y-auto p-8 transition-colors duration-200 bg-slate-50 dark:bg-[#000816]">

            <button id="theme-toggle" type="button" class="fixed top-20 right-8 z-50 p-3 rounded-full bg-white dark:bg-zinc-800 text-zinc-800 dark:text-zinc-200 border border-zinc-200 dark:border-zinc-700 shadow-md hover:scale-105 transition-all cursor-pointer">
                <svg id="theme-toggle-light-icon" class="hidden w-5 h-5 fill-current" viewBox="0 0 20 20">
                    <path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4.22 2.78a1 1 0 011.415 0l.707.707a1 1 0 01-1.414 1.414l-.707-.707a1 1 0 010-1.414zm2.78 4.22a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zm-4.22 5.657a1 1 0 010 1.415l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 0zM10 16a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM4.78 14.22a1 1 0 010-1.414l.707.707a1 1 0 011.414 1.414l.707.707a1 1 0 01-1.414 0zM2 10a1 1 0 011-1h1a1 1 0 110 2H3a1 1 0 01-1-1zm2.78-5.657a1 1 0 011.414 0l.707.707a1 1 0 11-1.414 1.414l-.707-.707a1 1 0 010-1.414zM10 6a4 4 0 100 8 4 4 0 000-8z" />
                </svg>
                <svg id="theme-toggle-dark-icon" class="hidden w-5 h-5 fill-current" viewBox="0 0 20 20">
                    <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z" />
                </svg>
            </button>

            <a href="{{ route('users.show', Auth::id()) }}"
               class="inline-flex items-center gap-1.5 text-xs font-semibold text-zinc-500 dark:text-zinc-400 hover:text-indigo-600 dark:hover:text-white transition mb-2">
                <svg class="w-4 h-4" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd"/>
                </svg>
                Kembali ke Profil
            </a>

            <h2 class="text-2xl font-bold mb-6 text-zinc-900 dark:text-white transition-colors duration-200">Pengaturan Akun</h2>

            @if (session('status') === 'profile-updated')
                <div class="max-w-6xl mb-4 p-4 rounded-xl bg-green-500/10 border border-green-500/20 text-green-600 dark:text-green-400 text-sm">
                    Profil berhasil diperbarui!
                </div>
            @endif

            @if (session('status') === 'password-updated')
                <div class="max-w-6xl mb-4 p-4 rounded-xl bg-green-500/10 border border-green-500/20 text-green-600 dark:text-green-400 text-sm">
                    Password berhasil diperbarui!
                </div>
            @endif

            @if ($errors->any())
                <div class="max-w-6xl mb-4 p-4 rounded-xl bg-red-500/10 border border-red-500/20 text-red-600 dark:text-red-400 text-sm">
                    <ul class="list-disc list-inside space-y-0.5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 max-w-6xl">

                <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="lg:col-span-2 bg-white dark:bg-[#212529] p-6 rounded-2xl border border-zinc-200 dark:border-zinc-800 space-y-6 transition-colors duration-200 shadow-sm">
                    @csrf
                    @method('patch')

                    <div class="flex items-center justify-between pb-4 border-b border-zinc-100 dark:border-zinc-800">
                        <div class="relative group">
                            <div class="w-20 h-20 rounded-full overflow-hidden bg-indigo-600 text-white dark:bg-zinc-300 dark:text-zinc-900 font-bold text-3xl flex items-center justify-center select-none transition-colors duration-200 border-2 border-transparent relative">
                                @if ($user->avatar)
                                    <img id="avatar-preview" src="{{ asset('storage/' . $user->avatar) }}" alt="{{ $user->name }}" class="w-full h-full object-cover">
                                @else
                                    <img id="avatar-preview" src="" alt="{{ $user->name }}" class="w-full h-full object-cover hidden">
                                    <span id="avatar-initial">{{ strtoupper(substr($user->name, 0, 1)) }}</span>
                                @endif

                                <label for="avatar-input" id="avatar-overlay" class="hidden absolute inset-0 bg-black/50 items-center justify-center cursor-pointer transition-opacity">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                </label>
                            </div>

                            <input type="file" id="avatar-input" name="avatar" accept="image/*" class="hidden" disabled>
                        </div>

                        <button type="button" id="edit-toggle-btn" title="Edit Profil" class="p-2 text-zinc-500 dark:text-zinc-400 hover:text-indigo-600 dark:hover:text-white transition cursor-pointer">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                            </svg>
                        </button>
                    </div>

                    <div class="pb-4 border-b border-zinc-100 dark:border-zinc-800">
                        <label for="name" class="text-xs text-zinc-500 dark:text-zinc-400 block mb-1">Username</label>
                        <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" readonly required class="editable-field w-full bg-transparent border-none p-0 font-semibold text-zinc-900 dark:text-white text-base focus:ring-0 cursor-default">
                        @error('name')
                            <p class="text-xs text-rose-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="pb-4 border-b border-zinc-100 dark:border-zinc-800">
                        <label for="email" class="text-xs text-zinc-500 dark:text-zinc-400 block mb-1">Email</label>
                        <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" readonly required class="editable-field w-full bg-transparent border-none p-0 font-semibold text-zinc-900 dark:text-white text-base focus:ring-0 cursor-default">
                        @error('email')
                            <p class="text-xs text-rose-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="bio" class="text-xs text-zinc-500 dark:text-zinc-400 block mb-1">Bio</label>
                        <textarea id="bio" name="bio" rows="2" readonly class="editable-field w-full bg-transparent border-none p-0 font-semibold text-zinc-900 dark:text-white text-base focus:ring-0 cursor-default resize-none">{{ old('bio', $user->bio) }}</textarea>
                        @error('bio')
                            <p class="text-xs text-rose-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div id="save-button-wrapper" class="hidden justify-end pt-2">
                        <button type="submit" class="px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl text-sm font-medium transition cursor-pointer">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>

                <div class="space-y-6">

                    <div class="bg-white dark:bg-[#212529] p-6 rounded-2xl border border-zinc-200 dark:border-zinc-800 space-y-4 transition-colors duration-200 shadow-sm">
                        <div>
                            <span class="text-xs text-zinc-500 dark:text-zinc-400 block mb-1">Role</span>
                            <p class="font-semibold text-zinc-900 dark:text-white text-base">{{ ucfirst($user->role ?? 'Member') }}</p>
                        </div>

                        <div>
                            <span class="text-xs text-zinc-500 dark:text-zinc-400 block mb-1">Join at</span>
                            <p class="font-semibold text-zinc-900 dark:text-white text-base">{{ $user->created_at?->format('Y-m-d') ?? '-' }}</p>
                        </div>
                    </div>

                    <div class="bg-white dark:bg-[#212529] p-6 rounded-2xl border border-zinc-200 dark:border-zinc-800 space-y-3 transition-colors duration-200 shadow-sm">
                        <h3 class="text-sm font-semibold text-zinc-900 dark:text-white mb-2">Danger Zone</h3>

                        <button type="button" onclick="openPasswordModal()" class="w-full py-2.5 px-4 bg-zinc-700 hover:bg-zinc-800 text-white text-sm font-medium rounded-xl transition cursor-pointer text-center">
                            Ubah Password
                        </button>

                        <form action="{{ route('profile.destroy') }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus akun ini secara permanen?');">
                            @csrf
                            @method('delete')
                            <button type="submit" class="w-full py-2.5 px-4 bg-red-600 hover:bg-red-700 dark:bg-red-900/80 dark:hover:bg-red-800 text-white dark:text-red-200 text-sm font-medium rounded-xl transition cursor-pointer text-center">
                                Hapus Akun
                            </button>
                        </form>
                    </div>

                </div>

            </div>
        </main>
    </div>

    <div id="password-modal" class="hidden fixed inset-0 z-50 bg-black/50 backdrop-blur-sm">
        <div class="flex items-center justify-center h-full p-4">
            <div class="bg-white dark:bg-[#212529] rounded-2xl max-w-md w-full p-6 border border-zinc-200 dark:border-zinc-800 shadow-2xl max-h-[90vh] overflow-y-auto">

                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-zinc-900 dark:text-white">Ubah Password</h3>
                    <button type="button" onclick="closePasswordModal()" class="p-1.5 rounded-lg text-zinc-500 dark:text-zinc-400 hover:bg-zinc-100 dark:hover:bg-zinc-800 hover:text-zinc-800 dark:hover:text-white transition cursor-pointer" aria-label="Tutup">
                        <svg class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                        </svg>
                    </button>
                </div>

                <form action="{{ route('profile.password.update') }}" method="POST" class="space-y-4">
                    @csrf
                    @method('PUT')

                    <div>
                        <label for="current_password" class="text-xs text-zinc-500 dark:text-zinc-400 block mb-1">Password Saat Ini</label>
                        <input type="password" id="current_password" name="current_password" required autocomplete="current-password"
                               class="w-full bg-zinc-50 dark:bg-zinc-800/60 border border-zinc-300 dark:border-zinc-700 p-2.5 rounded-lg focus:ring-2 focus:ring-indigo-500 text-zinc-900 dark:text-white text-sm font-medium focus:outline-none transition">
                        @error('current_password')
                            <p class="text-xs text-rose-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="password" class="text-xs text-zinc-500 dark:text-zinc-400 block mb-1">Password Baru</label>
                        <input type="password" id="password" name="password" required autocomplete="new-password"
                               class="w-full bg-zinc-50 dark:bg-zinc-800/60 border border-zinc-300 dark:border-zinc-700 p-2.5 rounded-lg focus:ring-2 focus:ring-indigo-500 text-zinc-900 dark:text-white text-sm font-medium focus:outline-none transition">
                        @error('password')
                            <p class="text-xs text-rose-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="password_confirmation" class="text-xs text-zinc-500 dark:text-zinc-400 block mb-1">Konfirmasi Password Baru</label>
                        <input type="password" id="password_confirmation" name="password_confirmation" required autocomplete="new-password"
                               class="w-full bg-zinc-50 dark:bg-zinc-800/60 border border-zinc-300 dark:border-zinc-700 p-2.5 rounded-lg focus:ring-2 focus:ring-indigo-500 text-zinc-900 dark:text-white text-sm font-medium focus:outline-none transition">
                    </div>

                    <div class="flex items-center justify-end gap-2 pt-2 border-t border-zinc-100 dark:border-zinc-800">
                        <button type="button" onclick="closePasswordModal()"
                                class="px-4 py-2 bg-zinc-100 dark:bg-zinc-800 hover:bg-zinc-200 dark:hover:bg-zinc-700 text-zinc-700 dark:text-zinc-300 rounded-xl text-sm font-medium transition cursor-pointer">
                            Batal
                        </button>
                        <button type="submit"
                                class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl text-sm font-medium transition cursor-pointer">
                            Simpan Password
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <script>
        const editBtn = document.getElementById('edit-toggle-btn');
        const editableFields = document.querySelectorAll('.editable-field');
        const saveBtnWrapper = document.getElementById('save-button-wrapper');
        const avatarInput = document.getElementById('avatar-input');
        const avatarOverlay = document.getElementById('avatar-overlay');
        const avatarPreview = document.getElementById('avatar-preview');
        const avatarInitial = document.getElementById('avatar-initial');
        let isEditing = false;

        function toggleEditMode() {
            isEditing = !isEditing;

            editableFields.forEach(field => {
                if (isEditing) {
                    field.removeAttribute('readonly');
                    field.classList.remove('bg-transparent', 'border-none', 'p-0', 'focus:ring-0', 'cursor-default');
                    field.classList.add('bg-zinc-50', 'dark:bg-zinc-800/60', 'border', 'border-zinc-300', 'dark:border-zinc-700', 'p-2.5', 'rounded-lg', 'focus:ring-indigo-500');
                } else {
                    field.setAttribute('readonly', 'readonly');
                    field.classList.add('bg-transparent', 'border-none', 'p-0', 'focus:ring-0', 'cursor-default');
                    field.classList.remove('bg-zinc-50', 'dark:bg-zinc-800/60', 'border', 'border-zinc-300', 'dark:border-zinc-700', 'p-2.5', 'rounded-lg', 'focus:ring-indigo-500');
                }
            });

            if (isEditing) {
                avatarInput.removeAttribute('disabled');
                avatarOverlay.classList.remove('hidden');
                avatarOverlay.classList.add('flex');
                saveBtnWrapper.classList.remove('hidden');
                saveBtnWrapper.classList.add('flex');
                document.getElementById('name').focus();
            } else {
                avatarInput.setAttribute('disabled', 'disabled');
                avatarOverlay.classList.add('hidden');
                avatarOverlay.classList.remove('flex');
                saveBtnWrapper.classList.add('hidden');
                saveBtnWrapper.classList.remove('flex');
            }
        }

        editBtn.addEventListener('click', toggleEditMode);

        avatarInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    avatarPreview.src = e.target.result;
                    avatarPreview.classList.remove('hidden');
                    if (avatarInitial) {
                        avatarInitial.classList.add('hidden');
                    }
                }
                reader.readAsDataURL(file);
            }
        });

        function openPasswordModal() {
            document.getElementById('password-modal').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closePasswordModal() {
            document.getElementById('password-modal').classList.add('hidden');
            document.body.style.overflow = '';
        }

        document.getElementById('password-modal').addEventListener('click', function(e) {
            if (e.target === this) closePasswordModal();
        });

        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') closePasswordModal();
        });

        @if ($errors->has('current_password') || $errors->has('password'))
            openPasswordModal();
        @endif

        @if ($errors->has('name') || $errors->has('email') || $errors->has('bio') || $errors->has('avatar'))
            toggleEditMode();
        @endif

        const themeToggleDarkIcon = document.getElementById('theme-toggle-dark-icon');
        const themeToggleLightIcon = document.getElementById('theme-toggle-light-icon');
        const themeToggleBtn = document.getElementById('theme-toggle');

        if (document.documentElement.classList.contains('dark')) {
            themeToggleLightIcon.classList.remove('hidden');
        } else {
            themeToggleDarkIcon.classList.remove('hidden');
        }

        themeToggleBtn.addEventListener('click', function() {
            themeToggleDarkIcon.classList.toggle('hidden');
            themeToggleLightIcon.classList.toggle('hidden');

            if (document.documentElement.classList.contains('dark')) {
                document.documentElement.classList.remove('dark');
                localStorage.setItem('theme', 'light');
            } else {
                document.documentElement.classList.add('dark');
                localStorage.setItem('theme', 'dark');
            }
        });
    </script>
</body>
</html>

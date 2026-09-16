<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CircleHub - Posts</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-[#18181b] text-zinc-100 h-screen w-screen overflow-hidden flex flex-col m-0 p-0">

    <x-navbar />

    <div class="flex flex-1 w-full overflow-hidden relative">

        <x-sidebar />

        <main class="flex-1 relative bg-[#000816] overflow-y-auto flex flex-col items-center p-6">

            <div class="relative z-10 w-full max-w-xl space-y-4">
                @forelse ($posts as $post)
                    <x-post-card
                        :username="$post->user->name ?? 'Anonim'"
                        :time="$post->created_at->diffForHumans()"
                        :title="$post->title"
                        :content="$post->content"
                        :image="$post->image"
                        :likes="$post->likes_count ?? 0"
                        :comments="$post->comments_count ?? 0"
                    />
                @empty
                    <div class="p-6 text-center text-zinc-400 bg-zinc-900/60 rounded-xl backdrop-blur-sm border border-zinc-800">
                        Belum ada postingan saat ini.
                    </div>
                @endforelse
            </div>
        </main>
    </div>

</body>
</html>

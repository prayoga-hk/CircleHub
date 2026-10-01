<?php

namespace App\Notifications;

use App\Models\Post;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class PostLiked extends Notification
{
    use Queueable;

    public function __construct(
        public Post $post,
        public User $actor,
    ) {}

    public function via($notifiable): array
    {
        return ['database'];
    }

    public function toArray($notifiable): array
    {
        return [
            'type'    => 'like',
            'message' => "{$this->actor->name} menyukai postingan Anda",
            'url'     => route('pages.posts.show', $this->post->id),
            'actor'   => [
                'id'     => $this->actor->id,
                'name'   => $this->actor->name,
            ],
        ];
    }
}

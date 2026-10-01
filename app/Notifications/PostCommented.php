<?php

namespace App\Notifications;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class PostCommented extends Notification
{
    use Queueable;

    public function __construct(
        public Post $post,
        public User $actor,
        public Comment $comment,
    ) {}

    public function via($notifiable): array
    {
        return ['database'];
    }

    public function toArray($notifiable): array
    {
        return [
            'type'    => 'comment',
            'message' => "{$this->actor->name} mengomentari postingan Anda",
            'preview' => \Str::limit($this->comment->body, 50),
            'url'     => route('pages.posts.show', $this->post->id),
            'actor'   => [
                'id'   => $this->actor->id,
                'name' => $this->actor->name,
            ],
        ];
    }
}

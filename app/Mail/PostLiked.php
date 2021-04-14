<?php

namespace App\Mail;

use App\Models\Post;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

// create mail class and email markdown
// php artisan make:mail PostLiked --markdown=emails.posts.post_liked
class PostLiked extends Mailable
{
    use Queueable, SerializesModels;

    public $liker;
    public $post;

    public function __construct(User $liker, Post $post)
    {
        // make variable available to the template specified in the "build" method
        $this->liker = $liker;
        $this->post = $post;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.posts.post_liked')
            ->subject('Someone liked your post');
    }
}

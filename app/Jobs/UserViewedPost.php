<?php

namespace App\Jobs;

use App\Models\Post;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class UserViewedPost implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $user;

    public $post;

    /**
     * Create a new job instance.
     *
     * @param User $user
     * @param Post $post
     */
    public function __construct(User $user, Post $post)
    {
        $this->user = $user;
        $this->post = $post;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $viewed = $this->user->viewedPosts;

        if($viewed->contains($this->post)){
            //if user viewed post: then increment view count
            $viewed->where('id', $this->post->id)->first()->pivot->increment('count');
            return;
        }

        //if not viewed: insert initial view record
        $this->user->viewedPosts()->attach($this->post, [
            'count' => 1,
        ]);
    }
}

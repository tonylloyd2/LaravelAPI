<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Jobs\SendEmailJob;
use App\Models\Post;
use App\Jobs\SendEmailJob;

class SendEmailsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-emails-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send new posts to subscribers';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $posts = Post::where('is_sent', false)->get();

        foreach ($posts as $post) {
            SendEmailJob::dispatch($post);

            $post->is_sent = true;
            $post->save();
        }

        $this->info('Emails sent successfully!');
    }
}
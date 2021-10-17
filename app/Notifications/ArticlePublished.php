<?php

namespace App\Notifications;

use App\Models\Article;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ArticlePublished extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(protected Article $article)
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('"' . $this->article->title . '" is published by ' . $notifiable->name)
                    ->action('Read the article', route('articles.show', [$this->article->id, $this->article->slug]))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'id' => $this->article->id,
            'title' => '"' . $this->article->title . '" is published by ' . $notifiable->name . ' <a href="' . route('articles.show', [$this->article->id, $this->article->slug]) . '">click here</a>',
            'slug' => $this->article->slug,
            'details' => $this->article->details,
            'updated_at' => $this->article->updated_at,
            'user_name' => $notifiable->name,
        ];
    }
}

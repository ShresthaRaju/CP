<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\BroadcastMessage;

use App\Models\Discussion;
use App\User;

class DiscussionFavorited extends Notification
{
    use Queueable;
    public $discussion;
    public $user;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Discussion $discussion, User $user)
    {
        $this->discussion=$discussion;
        $this->user=$user;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database','broadcast'];
    }

    /**
     * Get the database representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toDatabase($notifiable)
    {
        return [
          'discussion'=>[
            'title'=>$this->discussion->title,
            'slug'=>$this->discussion->slug,
          ],
          'user'=>[
            'username'=>$this->user->username,
            'display_image'=>$this->user->display_image,
          ],
        ];
    }

    /**
 * Get the broadcastable representation of the notification.
 *
 * @param  mixed  $notifiable
 * @return BroadcastMessage
 */
    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
          'discussion'=>[
            'title'=>$this->discussion->title,
            'slug'=>$this->discussion->slug,
          ],
          'user'=>[
            'username'=>$this->user->username,
            'display_image'=>$this->user->display_image,
          ],
    ]);
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
            //
        ];
    }
}

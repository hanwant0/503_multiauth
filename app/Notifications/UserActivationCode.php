<?php

    namespace App\Notifications;

    use Illuminate\Bus\Queueable;
    use Illuminate\Notifications\Notification;
    use Illuminate\Contracts\Queue\ShouldQueue;
    use Illuminate\Notifications\Messages\MailMessage;

    class UserActivationCode extends Notification implements ShouldQueue
    {

        /**
         * The password reset token.
         *
         * @var string
         */
        use Queueable;

        public $token;

        /**
         * Create a new notification instance.
         *
         * @param $token
         */
        public function __construct($token)
        {
            $this->token = $token;
        }

        /**
         * Get the notification's delivery channels.
         *
         * @param  mixed  $notifiable
         * @return array
         */
        public function via($notifiable)
        {
            return ['mail'];
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
                    ->line('Please activate your account')
                    ->action('Activate Account', url('user/activation', $this->token))
                    ->line('If you did not activate your account, no further action is required.');
        }

    }
    
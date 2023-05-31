<?php
namespace App\Notifications;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Lang;

class customResetPasswordUserNotification extends Notification 
{
    use Queueable;
    public $token;
    /**
     * Create a new notification instance.
     *
     * @return void
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
            ->subject(Lang::get('Thông báo thay đổi mật khẩu'))
            ->line(Lang::get('Bạn nhận được email này vì chúng tôi đã nhận được yêu cầu đặt lại mật khẩu cho tài khoản của bạn.'))
            ->action(Lang::get('Thay đổi mật khẩu'), url(route('password.reset', ['token' => $this->token, 'email' => $notifiable->getEmailForPasswordReset()], false)))
            ->line(Lang::get('Liên kết đặt lại mật khẩu sẽ hết hạn trong :count phút nữa.', ['count' => config('auth.passwords.'.config('auth.defaults.passwords').'.expire')]))
            ->line(Lang::get('Nếu bạn không yêu cầu đặt lại mật khẩu thì không cần thực hiện thêm hành động nào.'));
            
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
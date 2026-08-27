<?php

namespace App\Notifications;

use App\Models\SparePart;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class LowStockNotification extends Notification
{
    use Queueable;

    public function __construct(public SparePart $sparePart)
    {
    }

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Alerte stock : ' . $this->sparePart->name)
            ->greeting('Alerte stock SAV Manager')
            ->line('Une pièce de rechange a atteint ou dépassé le stock minimum.')
            ->line('Pièce : ' . $this->sparePart->name)
            ->line('Référence : ' . $this->sparePart->reference_code)
            ->line('Quantité en stock : ' . $this->sparePart->quantity_in_stock)
            ->line('Stock minimum : ' . $this->sparePart->minimum_stock)
            ->salutation('Cordialement, SAV Manager');
    }
}

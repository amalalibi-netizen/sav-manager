<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class RepairCreatedNotification extends Notification
{
    use Queueable;

    public function __construct(
        public string $reference,
        public string $status,
        public string $clientName = 'Client'
    ) {
    }

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Une intervention SAV a été ouverte')
            ->greeting('Bonjour ' . $this->clientName . ',')
            ->line('Une intervention a été enregistrée pour votre dossier SAV.')
            ->line('Référence : ' . $this->reference)
            ->line('Statut de l’intervention : ' . $this->status)
            ->line('Nous vous tiendrons informé des prochaines étapes.')
            ->salutation('Cordialement, SAV Manager');
    }
}

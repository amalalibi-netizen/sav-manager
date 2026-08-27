<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class StatusChangedNotification extends Notification
{
    use Queueable;

    public function __construct(
        public string $type,
        public string $reference,
        public string $oldStatus,
        public string $newStatus,
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
            ->subject('Mise à jour de votre dossier SAV')
            ->greeting('Bonjour ' . $this->clientName . ',')
            ->line('Le statut de votre ' . $this->type . ' a été modifié.')
            ->line('Référence : ' . $this->reference)
            ->line('Ancien statut : ' . $this->oldStatus)
            ->line('Nouveau statut : ' . $this->newStatus)
            ->line('Merci de votre confiance.')
            ->salutation('Cordialement, SAV Manager');
    }
}
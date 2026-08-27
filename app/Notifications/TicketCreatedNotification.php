<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TicketCreatedNotification extends Notification
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
            ->subject('Votre ticket SAV a été créé')
            ->greeting('Bonjour ' . $this->clientName . ',')
            ->line('Votre demande de service après-vente a bien été enregistrée.')
            ->line('Référence : ' . $this->reference)
            ->line('Statut : ' . $this->status)
            ->line('Nous vous tiendrons informé de l’avancement de votre dossier.')
            ->salutation('Cordialement, SAV Manager');
    }
}

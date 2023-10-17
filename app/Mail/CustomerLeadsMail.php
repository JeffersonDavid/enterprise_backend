<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Contracts\IDinamicJobs;
use Illuminate\Support\Facades\Mail;
use App\Events\EmailSent; 

class CustomerLeadsMail extends Mailable implements IDinamicJobs 
{
    use Queueable, SerializesModels;

    protected \App\Models\MailNotifications $mailNotification;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct( \App\Models\MailNotifications $mailNotification )
    {
        $this->mailNotification = $mailNotification;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function execution()
    {
       // $this->subject('Asunto personalizado test');
        $customer_data = $this->mailNotification->customer_data; 
        $customer_mail = $customer_data->email;
        $mail_to = $customer_mail;

        $this->execution = Mail::to( $mail_to )->send( $this );

        return event(new EmailSent( $this->mailNotification ));
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {       
        return $this->view('mail.default')
        ->with(['mailNotification' => $this->mailNotification,
        ])->subject($this->setSubject());
    }

    public function setSubject(){
        
        $customer_data = $this->mailNotification->customer_data;
        
        switch ($this->mailNotification->transaction_type) {
            case 1:

                $subject = 'Hola '.$customer_data->name. ', tu pedido de compra ha sido notificado correctamente';
                return $subject;
                break;

            case 2:

                $subject = 'Hola '.$customer_data->name. ', tu pedido de compra ha sido notificado correctamente';
                return $subject;
                break;

            default:
                return $subject = 'predefined mgs';
                break;
        }
    }
}

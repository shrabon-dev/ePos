<?php

namespace App\Http\Livewire;

use App\Events\SendEmailEvent;
use App\Events\SendEmailsEvent;
use App\Models\User;
use Livewire\Component;

class EmailSend extends Component
{
    public $users;
    public $message;

    public function emailSend($id){
        $this->message = 'Your email has been sent successfully!';
        session()->flash('livewire_notification_message', $this->message);
        session()->put('sendForToday_'.$id,'sended',now()->addDay());
        event(new SendEmailEvent([$id]));
        $this->dispatchBrowserEvent('disableButton');
    }
    public function emailSendAllUser(){
        $allIds = User::pluck('id')->toArray();
        $this->message = 'Your email has been sent successfully!';
        session()->flash('livewire_notification_message', $this->message);
        event(new SendEmailEvent($allIds));
    }
    public function clearNotification()
    {
        session()->forget('livewire_notification_message');
    }
    public function render()
    {
        return view('livewire.email-send');
    }

}

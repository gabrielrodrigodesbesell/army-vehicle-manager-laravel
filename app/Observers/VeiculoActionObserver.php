<?php

namespace App\Observers;

use App\Models\Veiculo;
use App\Notifications\DataChangeEmailNotification;
use Illuminate\Support\Facades\Notification;

class VeiculoActionObserver
{
    public function created(Veiculo $model)
    {
        $data  = ['action' => 'created', 'model_name' => 'Veiculo'];
        $users = \App\Models\User::whereHas('roles', function ($q) { return $q->where('title', 'Admin'); })->get();
        //Notification::send($users, new DataChangeEmailNotification($data));
    }

    public function updated(Veiculo $model)
    {
        $data  = ['action' => 'updated', 'model_name' => 'Veiculo'];
        $users = \App\Models\User::whereHas('roles', function ($q) { return $q->where('title', 'Admin'); })->get();
        //Notification::send($users, new DataChangeEmailNotification($data));
    }

    public function deleting(Veiculo $model)
    {
        $data  = ['action' => 'deleted', 'model_name' => 'Veiculo'];
        $users = \App\Models\User::whereHas('roles', function ($q) { return $q->where('title', 'Admin'); })->get();
        //Notification::send($users, new DataChangeEmailNotification($data));
    }
}

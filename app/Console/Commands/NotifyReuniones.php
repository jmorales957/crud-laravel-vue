<?php

namespace App\Console\Commands;

use App\models\Prospectos;
use App\models\Reuniones;
use App\Notifications\NotificationReunion;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Notification;

class NotifyReuniones extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notify:reuniones';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'notificacion para recordar 15 min antes la reunion';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        $reuniones = Reuniones::all();
        foreach ($reuniones as $reunion) {
            if (Carbon::now()->addMinute(15)->format("d-m-Y H:i") <= Carbon::parse($reunion->fecha_hora)->format("d-m-Y H:i")) {
                $prospecto = Prospectos::where('id', $reunion->prospectos_id)->first();
                $reunion->nombre = $prospecto->nombre;
                Notification::route('mail', $prospecto->email)->notify(new NotificationReunion($reuniones));
            }

        }
    }
}

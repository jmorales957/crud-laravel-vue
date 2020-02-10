<?php

namespace App\Console\Commands;

use App\models\Llamadas;
use App\models\Prospectos;
use App\Notifications\NotificationLlamada;
use Illuminate\Console\Command;
use Notification;
use Carbon\Carbon;

class NotifyLlamada extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notify:llamadas';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $llamadas = Llamadas::all();
        foreach ($llamadas as $llamada) {
            if (Carbon::now()->addMinute(15)->format("d-m-Y H:i") <= Carbon::parse($llamada->fecha_hora)->format("d-m-Y H:i")) {
                $prospecto = Prospectos::where('id', $llamada->prospectos_id)->first();
                $llamada->nombre = $prospecto->nombre;
                Notification::route('mail', $prospecto->email)->notify(new NotificationLlamada($llamada));
            }

        }
    }
}

<?php


namespace App\Tasks;


use App\Appointment;

class AppointmentDeleteUpdate
{
    // Invokable function (the only function) called on creation of a new task instance
    public function __invoke()
    {
        //Fetching appointment data that is active=1 but not used so it can be deleted
        $appointments = Appointment::where('active', 1)->where('end_time', '<', date('H:i:s'))->orderBy('start_time')->get();

        foreach ($appointments as $appointment)
        {
            $appointment->active = 0;
            $appointment->save();
        }
    }
}

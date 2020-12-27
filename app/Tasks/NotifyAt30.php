<?php


namespace App\Tasks;

use App\Appointment;
use App\Notifications\AppointmentReminderNotification;
use App\Notifications\UserCredentialsUpdateNotification;
use App\User;
use Illuminate\Support\Facades\Auth;

class NotifyAt30
{
    public function __invoke()
    {
        // Fetching the cutoff time for notifications (if start_time of an Appointment is after the cutoff_time, User doesn't need to be notified)
        $cutoff_time = date("H:i:s", strtotime("30 minutes"));
        // Fetching the current date
        $current_date = date("Y-m-d");

        // Fetching all the Appointments that satisfy all the criteria
        $not_notified_appointments_30_min = Appointment::whereIn('appointment_type', [1, 2])
            ->where('date', $current_date)
            ->where('start_time', '<=', $cutoff_time)
            ->where('active', true)
            ->where('notified_at_30', false)
            ->with('user')
            ->with('store')
            ->get();

        // Iterating through fetched Appointments
        foreach ($not_notified_appointments_30_min as $appointment)
        {
            //Logging the notification
            $appointment->notified_at_30 = true;
            $appointment->save();

            //Sending the notification to the user
            $appointment->user->notify(new AppointmentReminderNotification($appointment->user, $appointment->store, $appointment));
        }
    }
}

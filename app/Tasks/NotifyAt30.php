<?php

namespace App\Tasks;

use App\Appointment;
use App\Notifications\AppointmentReminderNotification;

class NotifyAt30
{

    // Invokable function (the only function) called on creation of a new task instance
    public function __invoke()
    {
        // Notification triggering time window
        $window = strtotime("30 minutes");

        // Fetching the cutoff time for notifications (if start_time of an Appointment is after the cutoff_time, User still doesn't need to be notified)
        $cutoff_time = date("H:i:s", $window);
        // Fetching the current date
        $current_date = date("Y-m-d");

        // Fetching all the Appointments that satisfy all the criteria
        // Both queue entries and reservations (all application-using customers)
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
            //Sending the notification to the user
            $appointment->user->notify(new AppointmentReminderNotification($appointment->user, $appointment->store, $appointment));

            //Logging the notification
            $appointment->notified_at_30 = true;
            $appointment->save();
        }
    }
}

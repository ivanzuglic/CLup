export default class Timeline {

    // Function that generates the timeline from a timeline array
    static generateTimeline (timelineArray) {
        console.log("Updating");
        var frontDeleteCounter = 0;
        var backDeleteCounter = 0;
        var frontDeleteCounterFlag = true;
        var i;

        timelineArray.forEach(function(item, index) {
            var timeSlot = document.getElementById("time-slot-" + (index + 1));
            if (item == 0) {
                backDeleteCounter++;
                if (timeSlot) {
                    timeSlot.classList.add("unavailable-timeslot");
                    timeSlot.firstElementChild.classList.add("unavailable-timeslot");
                }
            }
            else {
                frontDeleteCounterFlag = false;
                backDeleteCounter = 0;

                if (timeSlot) {
                    timeSlot.addEventListener('click', () => markAsActive())
                    const markAsActive = () => {
                        if (!timeSlot.classList.contains('active-timeslot')) {
                            var activeTimeslots = document.getElementsByClassName("active-timeslot");

                            if (activeTimeslots.length >= 2) {
                                Timeline.resetActiveSlots();
                            }

                            timeSlot.classList.add('active-timeslot');

                            if (activeTimeslots.length == 2) {
                                var activeIDs = [];
                                activeIDs[0] = activeTimeslots[0].id.split("-")[2];
                                activeIDs[1] = activeTimeslots[1].id.split("-")[2];
                                activeIDs.sort(function(a, b){return a - b});
                                var authenticationCounter = 0;
                                for (i = (parseInt(activeIDs[0]) + 1); i <= activeIDs[1]; i++) {
                                    var inBetweenTimeslot = document.getElementById("time-slot-" + i);
                                    if (inBetweenTimeslot) {
                                        if (inBetweenTimeslot.classList.contains("unavailable-timeslot")) {
                                            break;
                                        }
                                        else {
                                            authenticationCounter++;
                                        }   
                                    }
                                }
                                if (authenticationCounter == (activeIDs[1] - activeIDs[0])) {
                                    for (i = (parseInt(activeIDs[0]) + 1); i < activeIDs[1]; i++) {
                                        var inBetweenTimeslot = document.getElementById("time-slot-" + i);
                                        if (inBetweenTimeslot) {
                                            inBetweenTimeslot.classList.add("active-in-between");
                                        }
                                    }

                                    var startTimeInput =  document.getElementById("reservation_start_time");
                                    var endTimeInput =  document.getElementById("reservation_end_time");

                                    if (startTimeInput) {
                                        startTimeInput.value = activeTimeslots[0].firstElementChild.innerHTML.trim().replace(/&nbsp;/g,'');
                                    }

                                    if (endTimeInput) {
                                        endTimeInput.value = activeTimeslots[1].firstElementChild.innerHTML.trim().replace(/&nbsp;/g,'');
                                    }
                                }
                                else {
                                    Timeline.resetActiveSlots();
                                }
                            }
                        }
                    }
                }
            }

            if(frontDeleteCounterFlag) {
                frontDeleteCounter++;
            }
        });

        frontDeleteCounter = Math.trunc(frontDeleteCounter / 30) * 30;
        backDeleteCounter = Math.trunc(backDeleteCounter / 30) * 30;

        for (i = 0; i <= frontDeleteCounter; i++) {
            var timeSlot = document.getElementById("time-slot-" + i);
            if (timeSlot && (i != (frontDeleteCounter))) {
                timeSlot.style.display = "none";
            }
            if (i % 30 == 0) {
                var timeLabel = document.getElementById("time-label-" + ((i / 30) - 1));
                if (timeLabel) {
                    timeLabel.style.display = "none";
                }
            }
        }

        for (i = 720; i >= (720 - backDeleteCounter); i--) {
            var timeSlot = document.getElementById("time-slot-" + i);
            if (timeSlot && (i != (720 - backDeleteCounter))) {
                timeSlot.style.display = "none";
            }
            if (i % 30 == 0) {
                var timeLabel = document.getElementById("time-label-" + ((i / 30) + 1));
                if (timeLabel) {
                    timeLabel.style.display = "none";
                }
            }
        }

        for (i = 0; i <= 25; i++) {
            var timeSlot = document.getElementById("time-slot-" + (i * 30));
            if (timeSlot) {
                timeSlot.style.backgroundColor = "#3d3d3d";
            }
        }
    }

    // Function that deletes all active timeslots
    static resetActiveSlots () {
        var Timeslots = document.getElementsByClassName("time-slot-marker");
        var i;
        for (i = 0; i < Timeslots.length; i++) {
            Timeslots[i].classList.remove("active-timeslot", "active-in-between");
        }
    }
}

/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

var Chart = require('chart.js');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// Vue.component('example-component', require('./components/ExampleComponent.vue'));

// const app = new Vue({
//     el: '#app'
// });

//Chart rendering
Chart.defaults.global.responsive = true;

var graphDiv = document.getElementById("myChart");
var graphLargeDiv = document.getElementById("myLargeChart");

if (graphDiv) {
    var graphContainer = graphDiv.getContext("2d");
}

if (graphLargeDiv) {
    var graphLargeContainer = graphLargeDiv.getContext("2d");
}

if (typeof chartOccupancyData !== 'undefined') {
    var chartData = {
        labels : ["6:00", "7:00", "8:00", "9:00", "10:00", "11:00", "12:00", "13:00", "14:00", "15:00", "16:00", "17:00", "18:00", "19:00", "20:00", "21:00", "22:00", "23:00"],
        datasets : [{
            label: 'Occupancy',
            fill: true,
            lineTension: 0.1,
            backgroundColor: "#0ca7ff",
            borderColor: "#0ca7ff",
            borderCapStyle: 'butt',
            borderDash: [],
            borderDashOffset: 0.0,
            borderJoinStyle: 'miter',
            pointBorderColor: "rgba(75,192,192,1)",
            pointBackgroundColor: "#fff",
            pointBorderWidth: 1,
            pointHoverRadius: 5,
            pointHoverBackgroundColor: "rgba(75,192,192,1)",
            pointHoverBorderColor: "rgba(220,220,220,1)",
            pointHoverBorderWidth: 2,
            pointRadius: 1,
            pointHitRadius: 10,
            categoryPercentage: .8,
            data : chartOccupancyData
        }]
    };

    var chartOptions = {
        responsive: true,
        aspectRatio: 4,
        legend: {
            display: false,
        },
        hover: {
            mode: 'index'
        },
        scales: {
            xAxes: [{
                gridLines: {
                    color: "rgba(0, 0, 0, 0)",
                }
            }],
            yAxes: [{
                ticks: {
                    display: false
                }
            }]
        }
    };

    var chartLargeOptions = {
        responsive: true,
        legend: {
            display: false,
        },
        hover: {
            mode: 'index'
        },
        scales: {
            xAxes: [{
                gridLines: {
                    color: "rgba(0, 0, 0, 0)",
                }
            }],
            yAxes: [{
                ticks: {
                    display: false
                }
            }]
        }
    };
    
    if (graphContainer) {
        var myChart = new Chart(graphContainer, {
            type: 'bar',
            data: chartData,
            options: chartOptions
        });
    }

    if (graphLargeContainer) {
        var myLargeChart = new Chart(graphLargeContainer, {
            type: 'bar',
            data: chartData,
            options: chartLargeOptions
        });
    }
}

// Generates mockup data for testing
// var availabilityData = [];
// for (i = 0; i <= 720; i++) {
//     if (i > 300 && i < 359) {
//         availabilityData.push(1);
//     }
//     else if (i > 360 && i < 440) {
//         availabilityData.push(0);
//     }
//     else if (i > 441 && i < 500) {
//         availabilityData.push(1);
//     }
//     else {
//         availabilityData.push(0);
//     }
// }

// var frontDeleteCounter = 0;
// var backDeleteCounter = 0;
// var frontDeleteCounterFlag = true;

// availabilityData.forEach(function(item, index, array) {
//     var timeSlot = document.getElementById("time-slot-" + (index + 1));
//     if (item == 0) {
//         backDeleteCounter++;
//         if (timeSlot) {
//             timeSlot.classList.add("unavailable-timeslot");
//             timeSlot.firstElementChild.classList.add("unavailable-timeslot");
//         }
//     }
//     else {
//         frontDeleteCounterFlag = false;
//         backDeleteCounter = 0;
//         if (timeSlot && !timeSlot.classList.contains("unavailable-timeslot")) {
//             timeSlot.addEventListener('click', () => markAsActive())
//             const markAsActive = () => {
//                 if (!timeSlot.classList.contains('active-timeslot')) {
//                     var activeTimeslots = document.getElementsByClassName("active-timeslot");
//                     if (activeTimeslots.length >= 2) {
//                         var activeIDs = [];
//                         activeIDs[0] = activeTimeslots[0].id.split("-")[2];
//                         activeIDs[1] = activeTimeslots[1].id.split("-")[2];
//                         activeIDs.sort(function(a, b){return a - b});
//                         for (i = (parseInt(activeIDs[0]) + 1); i < activeIDs[1]; i++) {
//                             var inBetweenTimeslot = document.getElementById("time-slot-" + i);
//                             if (inBetweenTimeslot) {
//                                 inBetweenTimeslot.classList.remove("active-in-between");
//                             }
//                         }

//                         activeTimeslots[0].classList.remove("active-timeslot");
//                         activeTimeslots[0].classList.remove("active-timeslot");
//                     }
//                     timeSlot.classList.add('active-timeslot');
//                     if (activeTimeslots.length == 2) {
//                         var activeIDs = [];
//                         activeIDs[0] = activeTimeslots[0].id.split("-")[2];
//                         activeIDs[1] = activeTimeslots[1].id.split("-")[2];
//                         activeIDs.sort(function(a, b){return a - b});
//                         var authenticationCounter = 0;
//                         for (i = (parseInt(activeIDs[0]) + 1); i <= activeIDs[1]; i++) {
//                             var inBetweenTimeslot = document.getElementById("time-slot-" + i);
//                             if (inBetweenTimeslot) {
//                                 if (inBetweenTimeslot.classList.contains("unavailable-timeslot")) {
//                                     break;
//                                 }
//                                 else {
//                                     authenticationCounter++;
//                                 }   
//                             }
//                         }
//                         if (authenticationCounter == (activeIDs[1] - activeIDs[0])) {
//                             for (i = (parseInt(activeIDs[0]) + 1); i < activeIDs[1]; i++) {
//                                 var inBetweenTimeslot = document.getElementById("time-slot-" + i);
//                                 if (inBetweenTimeslot) {
//                                     inBetweenTimeslot.classList.add("active-in-between");
//                                 }
//                             }

//                             var startTimeInput =  document.getElementById("reservation_start_time");
//                             var endTimeInput =  document.getElementById("reservation_end_time");

//                             if (startTimeInput) {
//                                 startTimeInput.value = activeTimeslots[0].firstElementChild.innerHTML.trim().replace(/&nbsp;/g,'');
//                             }

//                             if (endTimeInput) {
//                                 endTimeInput.value = activeTimeslots[1].firstElementChild.innerHTML.trim().replace(/&nbsp;/g,'');
//                             }
//                         }
//                         else {
//                             activeTimeslots[0].classList.remove("active-timeslot");
//                             if (activeTimeslots[0]) {
//                                 activeTimeslots[0].classList.remove("active-timeslot");
//                             }
//                         }
//                     }
//                 }
//             }
//         }
//     }
//     if(frontDeleteCounterFlag) {
//         frontDeleteCounter++;
//     }
// });

// frontDeleteCounter = Math.trunc(frontDeleteCounter / 30) * 30;
// backDeleteCounter = Math.trunc(backDeleteCounter / 30) * 30;

// for (i = 0; i <= frontDeleteCounter; i++) {
//     var timeSlot = document.getElementById("time-slot-" + i);
//     if (timeSlot && (i != (frontDeleteCounter))) {
//         timeSlot.style.display = "none";
//     }
//     if (i % 30 == 0) {
//         var timeLabel = document.getElementById("time-label-" + ((i / 30) - 1));
//         if (timeLabel) {
//             timeLabel.style.display = "none";
//         }
//     }
// }

// for (i = 720; i >= (720 - backDeleteCounter); i--) {
//     var timeSlot = document.getElementById("time-slot-" + i);
//     if (timeSlot && (i != (720 - backDeleteCounter))) {
//         timeSlot.style.display = "none";
//     }
//     if (i % 30 == 0) {
//         var timeLabel = document.getElementById("time-label-" + ((i / 30) + 1));
//         if (timeLabel) {
//             timeLabel.style.display = "none";
//         }
//     }
// }

// for (i = 0; i <= 25; i++) {
//     var timeSlot = document.getElementById("time-slot-" + (i * 30));
//     if (timeSlot) {
//         timeSlot.style.backgroundColor = "#3d3d3d";
//     }
// }

;(() => {
    const menu = document.querySelector('#nav')
    const body = document.querySelector('body')

    const menuToggleButton = document.querySelector('#toggle-nav')
    if (menuToggleButton) {
        menuToggleButton.addEventListener('click', () => menuShow())
        const menuShow = () => {
            if (menu.classList.contains('active')) {
                menu.classList.remove('active')
                menuToggleButton.classList.remove('active')
                menuToggleButton.style.backgroundImage = 'url("/images/bars-solid.svg")'
                body.classList.remove('nav-active')
            } else {
                menu.classList.add('active')
                menuToggleButton.classList.add('active')
                menuToggleButton.style.backgroundImage = 'url("/images/arrow-left-solid.svg")'
                body.classList.add('nav-active')
            }
        }
    }

    const uploadFileButton = document.querySelector('#upload-file-button')
    if (uploadFileButton) {
        uploadFileButton.addEventListener('click', (event) => uploadImage())
        const uploadImage = () => {
            document.getElementById("file-input").click()
        }
    }

    const filterToggleButton = document.querySelector('#filter-toggle')
    if (filterToggleButton) {
        filterToggleButton.addEventListener('click', (event) => toggleFilterActive())
        const toggleFilterActive = () => {
            var filterElement = document.getElementById("search-bar-filters")
            if (filterElement) {
                filterElement.classList.toggle("active");
            }
        }
    }
})()

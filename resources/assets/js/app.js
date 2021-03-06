
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import Timeline from './timeline.js';

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

$.ajaxSetup({
    headers:{
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
})
$.ajax({
    url: '/ajax/timeline',
    method: 'POST',
    data: {
        store_id: $("input[name=store_id]").val(),
        date: $("input[name=reservation_date]").val()
    },
    success: function(data){
        var timelineArray = data.timeline_array;
        Timeline.generateTimeline(timelineArray);
        console.log($("input[name=store_id]").val());
        console.log($("input[name=reservation_date]").val());
        console.log(timelineArray);
    }
})

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

    const inputDay = document.querySelector('#reservation_date')
    if (inputDay) {
        inputDay.addEventListener('change', (event) => refreshTimeline())
        const refreshTimeline = () => {
            event.preventDefault();
            console.log('DEFAULT PREVENTED');
            $.ajaxSetup({
                headers:{
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            })
            $.ajax({
                url: '/ajax/timeline',
                method: 'POST',
                data: {
                    store_id: $("input[name=store_id]").val(),
                    date: $("input[name=reservation_date]").val()
                },
                success: function(data){
                    var timelineArray = data.timeline_array;
                    Timeline.resetEntireTimeline();
                    Timeline.generateTimeline(timelineArray);
                    console.log($("input[name=store_id]").val());
                    console.log($("input[name=reservation_date]").val());
                    console.log(timelineArray);
                }
            })
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

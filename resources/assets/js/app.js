
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

var timeline_json = generateDailyTimeline();
window.timeline = new TL.Timeline('timeline-embed', timeline_json);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// Vue.component('example-component', require('./components/ExampleComponent.vue'));

// const app = new Vue({
//     el: '#app'
// });

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
            document.getElementById("file-input").click();
        }
    }
})()
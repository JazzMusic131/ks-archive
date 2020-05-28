/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

/* const app = new Vue({
    el: '#app',
}); */

// Custom JS
$(function() {

    // Check it out!
    var clip = document.getElementById("checkitout");

    // Popover for episode descriptions
    $('[data-toggle="hover"]').popover({
        trigger: 'hover'
    });

    // Year filter
    $('.year-filter .btn').click(function() {
        $('.btn.reset').fadeIn(200);
        var year = $(this).data('year');
        $('.table tbody tr').each(function () {
            var text = $(this).find('.date').text().toLowerCase();
            if (text.includes(year)) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
    });

    // Episode type filter
    $('.type-filter .btn').click(function() {
        $('.btn.reset').fadeIn(200);
        var type = $(this).data('type');
        $('.table tbody tr').each(function () {
            if ($(this).hasClass(type)) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
    });

    // Episode search
    $('#tableSearch').keyup(function () {
        $('.btn.reset').fadeIn(200);
        var valThis = $(this).val().toLowerCase();
        if (valThis == '') { $('.btn.reset').fadeOut(200); }
		$('.table tbody tr').each(function () {
			var text = $(this).text().toLowerCase();
			if (text.includes(valThis)) {
				$(this).show();
			} else {
				$(this).hide();
			}
		});
    });
    
    // Reset search
    $('.btn.reset').click(function() {
        $('.btn.reset').fadeOut(200);
        $('.table tbody tr').each(function () {
			$(this).show();
		});
    });

    // Dark/Light mode toggle
    $('.dark-mode-toggle').click(function() { 

        if ($('body.home').hasClass('dark')) {

            // Toggle Light Mode
            $('body.home').removeClass('dark');
            $('.table thead').removeClass('thead-light');
            $('.table thead').addClass('thead-dark');
            $('.table').removeClass('table-dark');
            $('.table tbody tr td .btn').removeClass('btn-light');
            $('.table tbody tr td .btn').addClass('btn-dark');
            $('.dark-mode-toggle').text('Dark Mode');

        } else {

            // Toggle Dark Mode
            $('body.home').addClass('dark');
            $('.table thead').removeClass('thead-dark');
            $('.table thead').addClass('thead-light');
            $('.table').addClass('table-dark');
            $('.table tbody tr td .btn').removeClass('btn-dark');
            $('.table tbody tr td .btn').addClass('btn-light');
            $('.dark-mode-toggle').text('Light Mode');

        }
        clip.play();
    });

});
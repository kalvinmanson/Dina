/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

//Vue.component('example-component', require('./components/ExampleComponent.vue'));

const app = new Vue({
    el: '#app'
});

/*
$( ".ckfile" ).click(function() {
  var id = $(this).attr('id');
  openKCFinder(id);
  function openKCFinder(field) {
      window.KCFinder = {
          callBack: function(url) {
              $( "#"+id ).val(url);
              window.KCFinder = null;
          }
      };
      window.open('/editor/kcfinder/browse.php?type=images&dir=files/public', 'kcfinder_textbox',
          'status=0, toolbar=0, location=0, menubar=0, directories=0, ' +
          'resizable=1, scrollbars=0, width=800, height=600'
      );
  }
});

$(".tr_addField").click( function () {
  var newField = $("#new_config").val();
  $('#tableTarget tr:last').after('<tr><td>'+newField+'</td><td><input type="text" name="config['+newField+']" value="" class="form-control"></td></tr>');
});

$("[data-fancybox]").fancybox({
  // Options will go here
});

$(".tr_name_field").dblclick( function() {
  $( this ).replaceWith( "<input type='text' class='form-control' name='name' required>" );
});
$(".tr_format_field").dblclick( function() {
  $( this ).replaceWith( "<input type='text' class='form-control' name='format' required>" );
});*/

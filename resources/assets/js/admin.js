try {
    window.$ = window.jQuery = require('jquery');

    require('bootstrap');
    require('@fancyapps/fancybox');
} catch (e) {}

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
});

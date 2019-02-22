(function ($) {
  'use strict';
  $(function () {
    $('#order-listing').DataTable({
      "aLengthMenu": [
        [5, 10, 15, -1],
        [5, 10, 15, "All"]
      ],
      "scrollY": 310,
      "iDisplayLength": 10,
      "bLengthChange": false,
      "language": {
        search: "Sort By :"
      }
    });
    $('#order-listing').each(function () {
      var datatable = $(this);
      // SEARCH - Add the placeholder for Search and Turn this into in-line form control
      var search_input = datatable.closest('.dataTables_wrapper').find('div[id$=_filter] input');
      search_input.attr('placeholder', 'Sort');
      // search_input.removeClass('form-control-sm');
      var s = datatable.closest('.dataTables_wrapper').find(".dataTables_filter").append('<button type="button" class="btn btn-primary ml-2">New Record</button>');
    });
  });
})(jQuery);
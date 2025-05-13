/*
Template Name: Minia - Admin & Dashboard Template
Author: Themesbrand
Website: https://themesbrand.com/
Contact: themesbrand@gmail.com
File: Datatables Js File
*/

$(document).ready(function() {
    $('#datatable-contacts').DataTable();

    //Buttons examples
    var table = $('#datatable-buttons-contacts').DataTable({
        responsive: false,
        lengthChange: true,
        lengthMenu: [
            [100],
            [100],
        ],
        buttons: ['copy', 'excel', 'pdf', 'colvis'],
        stateSave: true,
        colReorder: true,
        "pageLength":100
    });
    table.on( 'column-reorder', function ( e, settings, details ) {
        var headerCell = $( table.column( details.to ).header() );

        headerCell.addClass( 'reordered' );

        setTimeout( function () {
            headerCell.removeClass( 'reordered' );
        }, 2000 );
    } );
    table.buttons().container()
        .appendTo('#datatable-buttons_wrapper .col-md-6:eq(0)');
    $(".dataTables_length select").addClass('form-select form-select-sm');
});

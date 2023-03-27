$(document).ready(function() {
    
    var buttons =
    [
        {
            extend: 'csv',
            text: '<i class="fa fa-file-csv" aria-hidden="true"></i> csv',
            className: 'btn-sm',
            exportOptions: {
                columns: ':visible',
            },
        },
        {
            extend: 'excel',
            text: '<i class="fa fa-file-excel" aria-hidden="true"></i> excel',
            className: 'btn-sm',
            exportOptions: {
                columns: ':visible',
            },
        },
        {
            extend: 'pdf',
            text: '<i class="fa fa-file-pdf" aria-hidden="true"></i> pdf',
            className: 'btn-sm',
            exportOptions: {
                columns: ':visible',
            },
        },
        {
            extend: 'print',
            text: '<i class="fa fa-print" aria-hidden="true"></i> print',
            className: 'btn-sm',
            exportOptions: {
                columns: ':visible',
                stripHtml: true,
            },
        },
        {
            extend: 'colvis',
            text: '<i class="fa fa-columns" aria-hidden="true"></i> column visibilty',
            className: 'btn-sm',
        },

    ];

    // var pdf_btn = {
    //     extend: 'pdf',
    //     text: '<i class="fa fa-file-pdf" aria-hidden="true"></i> pdf',
    //     className: 'btn-sm',
    //     exportOptions: {
    //         columns: ':visible',
    //     },
    //     footer: true,
    // };


    // buttons.push(pdf_btn);


    $.extend(true, $.fn.dataTable.defaults, {
        searching: true,
        ordering: false,
        responsive: true,
        dom:
            '<"row margin-bottom-20 text-center"<"col-sm-2"l><"col-sm-7 pt-3"B><"col-sm-3"f> r>tip',
        buttons: buttons,
    });
});
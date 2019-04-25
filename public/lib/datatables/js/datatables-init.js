$(document).ready(function() {
        $('#admin-activity-table').DataTable();
        $('#admin-deals-table').DataTable();
        $('#admin-auctions-table').DataTable();
    });
    $('#example23').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    });

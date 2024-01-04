<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Display</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
</head>
<body data-bs-theme="dark" style="font-size:12px;">
    <div id="app" class="container mt-5 pl-5 pr-5">
        <div class="row">
            <div class="col">
                <h1>IT Asset Management</h1>
                <hr />
            </div>
        </div>
        <button onclick="handleCreate()" class="btn btn-primary mb-3"><i class="fas fa-plus"></i> Create</button>
        <div class="row">
            <div class="col border border-light rounded pt-3 pb-3">
                <table id="dataTable" class="table table-dark table-striped">
                    <thead>
                        <tr>
                            <th>System Name</th>
                            <th>Related Teams</th>
                            <th>Production Server IP</th>
                            <th>Production System URL</th>
                            <th>Development Server IP</th>
                            <!-- <th>Development System URL</th> -->
                            <th>Edit</th> <!-- Added Edit column -->
                        </tr>
                        <tr>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <!-- <th></th> -->
                            <th></th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            var table = $('#dataTable').DataTable({
                searching: false, // Enable searching/filtering
                ordering: false,
                serverSide: true, // Enable server-side processing
                responsive: true,
                paging: false,
                ajax: {
                    url: './assets/get_data', // URL to fetch data from server
                    type: 'POST',
                    dataSrc: 'data' // Property name of the data array in the response
                },
                columns: [
                    { data: 'system_name' }, // System Name
                    { data: 'related_teams' }, // Related Teams
                    { data: 'production_server_ip' }, // Production Server IP
                    { data: 'production_system_url' }, // Production System URL
                    { data: 'development_server_ip' }, // Development Server IP
                    //{ data: 'development_system_url' }, // Development System URL
                    { data: null, render: function(data, type, row) {
                        return ' \
                            <button onclick="handleView(' + row.id + ')" class="btn btn-sm btn-secondary"><i class="fas fa-eye"></i></button> \
                            <button onclick="handleEdit(' + row.id + ')" class="btn btn-sm btn-secondary"><i class="fas fa-edit"></i></button> \
                        ';
                    }} // Edit column
                ],
                "columnDefs": [
                    { 
                    targets: 3,
                    "data": "production_system_url",
                    "render": function ( data, type, row, meta ) {
                        return '<a target="_blank" href="'+data+'">'+data+'</a>';
                    }
                    },
                ],
                order: [[ 0, "asc" ]] // Initial sort column and order
            }).search(""); // Initialize search functionality

            // Setup - add a select dropdown to each header cell
            var dbtablecols = [
                'system_name',
                'related_teams',
                'production_server_ip',
                'production_system_url',
                'development_server_ip',
                //'development_system_url',
            ]
            $('#dataTable thead tr:eq(1) th').each( function (i) {
                if (i < dbtablecols.length) {
                    var select = $('<select class="filter"><option value="">All</option></select>')
                        .appendTo($(this).empty())
                        .on('change', function () {
                            if (table.column(i).search() !== this.value) {
                                table
                                    .column(i)
                                    .search(this.value)
                                    .draw();
                            }
                        });

                    $.ajax({
                        url: './assets/get_distinct_values', // URL to fetch distinct values from server
                        type: 'GET',
                        data: {
                            column: dbtablecols[i]
                        },
                        success: function(data) {
                            var jsonData = JSON.parse(data);
                            Object.keys(jsonData).forEach(function(key) {
                                Object.keys(jsonData[key]).forEach(function(key2) {
                                    // console.log(jsonData[key]);
                                    // console.log(table.column(i).data());
                                    select.append('<option value="' + jsonData[key][key2].id + '">' + jsonData[key][key2][dbtablecols[i]] + '</option>');
                                });
                            });
                        }
                    });
                }
            });
        });

        function handleCreate() {
            window.location.href = "./assets/addnew";
        }

        function handleEdit(id) {
            window.location.href = "./assets/edit/" + id;
        }

        function handleView(id) {
            window.location.href = "./assets/view/" + id;
        }
    </script>
</body>
</html>
<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body style="font-size:12px;" data-bs-theme="dark">
    <div id="app" class="container">
        <div class="row">
            <div class="col">
                <h1>Edit Asset</h1>
            </div>
            <div class="col text-end">
                <a href="<?= base_url() ?>assets" class="btn btn-primary">Back</a>
            </div>
        </div>
        <form id="myForm" action="<?=base_url()?>assets/update_asset" method="POST">
            <input type="hidden" id="id" name="id" value="<?= $asset->id ?>">
            <div class="form-group">
                <label for="system_name">System Name:</label>
                <input type="text" id="system_name" name="system_name" required class="form-control" value="<?= $asset->system_name ?>">
            </div>

            <div class="form-group">
                <label for="system_desc">System Description:</label>
                <textarea id="system_desc" name="system_desc" required class="form-control"><?= $asset->system_desc ?></textarea>
            </div>

            <div class="form-group">
                <label for="related_teams">Related Teams:</label>
                <input type="text" id="related_teams" name="related_teams" required class="form-control" value="<?= $asset->related_teams ?>">
            </div>

            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="vendor">Vendor:</label>
                        <input type="text" id="vendor" name="vendor" class="form-control" value="<?= $asset->vendor ?>">
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="annual_maintenance_cost">Annual Maintenance Cost:</label>
                        <input type="text" id="annual_maintenance_cost" name="annual_maintenance_cost" class="form-control" value="<?= $asset->annual_maintenance_cost ?>">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="project_document">Project Document:</label>
                <input type="text" id="project_document" name="project_document" class="form-control" value="<?= $asset->project_document ?>">
            </div>

            <div class="form-group"><hr /></div>

            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="production_server_ip">Production Server IP:</label>
                        <input type="text" id="production_server_ip" name="production_server_ip" class="form-control" value="<?= $asset->production_server_ip ?>">
                    </div>

                    <div class="form-group">
                        <label for="production_system_url">Production System URL:</label>
                        <input type="text" id="production_system_url" name="production_system_url" class="form-control" value="<?= $asset->production_system_url ?>">
                    </div>

                    <div class="form-group">
                        <label for="production_document_path">Production Document Path:</label>
                        <input type="text" id="production_document_path" name="production_document_path" class="form-control" value="<?= $asset->production_document_path ?>">
                    </div>
                </div>

                <div class="col">
                    <div class="form-group">
                        <label for="development_server_ip">Development Server IP:</label>
                        <input type="text" id="development_server_ip" name="development_server_ip" class="form-control" value="<?= $asset->development_server_ip ?>">
                    </div>

                    <div class="form-group">
                        <label for="development_system_url">Development System URL:</label>
                        <input type="text" id="development_system_url" name="development_system_url" class="form-control" value="<?= $asset->development_system_url ?>">
                    </div>

                    <div class="form-group">
                        <label for="development_document_path">Development Document Path:</label>
                        <input type="text" id="development_document_path" name="development_document_path" class="form-control" value="<?= $asset->development_document_path ?>">
                    </div>
                </div>
            </div>

            <div class="form-group"><hr /></div>
            
            <div class="form-group" id="footprint">
                <h4>Footprint</h4>
                <div class="row">
                    <div class="col">Action Content</div>
                    <div class="col">Action Date</div>
                    <div class="col">Issuer</div>
                    <div class="col">Assigned To</div>
                    <div class="col"></div>
                </div>
                <div class="row">
                    <div class="col">
                        <input type="text" name="action_content" class="form-control">
                    </div>
                    <div class="col">
                        <input type="date" name="action_date" class="form-control">
                    </div>
                    <div class="col">
                        <input type="text" name="issuer" class="form-control">
                    </div>
                    <div class="col">
                        <input type="text" name="assigned_to" class="form-control">
                    </div>
                    <div class="col">
                        <button class="btn btn-primary" id="add_footprint">Create</button>
                    </div>
                </div>
                <div id="existing_footprints">
                    <!-- Existing footprints will be loaded here -->
                </div>
            </div>

            <div class="form-group"><hr /></div>

            <div class="form-group">
                <label for="remarks">Remarks:</label>
                <textarea id="remarks" name="remarks" class="form-control" rows="10"><?= $asset->remarks ?></textarea>
            </div>

            <style>
                .sticky-button {
                    position: fixed;
                    bottom: 0;
                    left: 0;
                    width: 100%;
                    padding: 10px;
                    background-color: rgba(100,100,100,0.5);
                    text-align: center;
                }
                #app {
                    padding-bottom: 100px;
                }
                #footprint .row {
                    padding-bottom: 10px;
                }
                #existing_footprints {
                    font-size:14px;
                }
            </style>

            <div class="sticky-button">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
    $(document).ready(function() {
        $('#add_footprint').click(function() {
            var action_content = $('#action_content').val();
            var action_date = $('#action_date').val();
            var issuer = $('#issuer').val();
            var assigned_to = $('#assigned_to').val();

            $.ajax({
                url: '<?=base_url()?>assets/save_footprints'+$('#id').val(), // replace with the path to your PHP script
                method: 'POST',
                data: {
                    action_content: action_content,
                    action_date: action_date,
                    issuer: issuer,
                    assigned_to: assigned_to
                },
                success: function(response) {
                    // Refresh the "Existing Footprints" div
                    $('#existing_footprints').html(response);
                }
            });
        });

        $('.delete-footprint').click(function() {
            var id = $(this).data('id');

            $.ajax({
                url: '<?=base_url()?>assets/delete_footprints'+$('#id').val(), // replace with the path to your PHP script
                method: 'POST',
                data: {
                    id: id
                },
                success: function(response) {
                    // Refresh the "Existing Footprints" div
                    $('#existing_footprints').html(response);
                }
            });
        });

        // Load existing footprints
        $.ajax({
            url: '<?=base_url()?>assets/get_footprints/'+$('#id').val(), // replace with the path to your PHP script
            method: 'GET',
            success: function(response) {
                // Refresh the "Existing Footprints" div
                $('#existing_footprints').html(response);
            }
        });
    });
    </script>
</body>

</html>
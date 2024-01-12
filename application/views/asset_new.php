<!DOCTYPE html>
<html lang="en">

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
                <h1>New Asset</h1>
            </div>
            <div class="col text-end">
                <a href="<?= base_url() ?>assets" class="btn btn-primary float-right">Back</a>
            </div>
        </div>

        <form id="myForm" action="../assets/save_assets" method="POST">
            <div class="form-group">
                <label for="system_name">System Name:</label>
                <input type="text" id="system_name" name="system_name" required class="form-control">
            </div>

            <div class="form-group">
                <label for="system_desc">System Description:</label>
                <textarea id="system_desc" name="system_desc" required class="form-control"></textarea>
            </div>

            <div class="form-group">
                <label for="related_teams">Related Teams:</label>
                <input type="text" id="related_teams" name="related_teams" required class="form-control">
            </div>

            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="vendor">Vendor:</label>
                        <input type="text" id="vendor" name="vendor" class="form-control">
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="annual_maintenance_cost">Annual Maintenance Cost:</label>
                        <input type="text" id="annual_maintenance_cost" name="annual_maintenance_cost" class="form-control">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="project_document">Project Document:</label>
                <input type="text" id="project_document" name="project_document" required class="form-control">
            </div>

            <div class="form-group"><hr /></div>

            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="production_server_ip">Production Server IP:</label>
                        <input type="text" id="production_server_ip" name="production_server_ip" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="production_system_url">Production System URL:</label>
                        <input type="text" id="production_system_url" name="production_system_url" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="production_document_path">Production Document Path:</label>
                        <input type="text" id="production_document_path" name="production_document_path" class="form-control">
                    </div>
                </div>

                <div class="col">
                    <div class="form-group">
                        <label for="development_server_ip">Development Server IP:</label>
                        <input type="text" id="development_server_ip" name="development_server_ip" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="development_system_url">Development System URL:</label>
                        <input type="text" id="development_system_url" name="development_system_url" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="development_document_path">Development Document Path:</label>
                        <input type="text" id="development_document_path" name="development_document_path"d class="form-control">
                    </div>
                </div>
            </div>

            <div class="form-group"><hr /></div>

            <div class="form-group">
                <label for="remarks">Remarks:</label>
                <textarea id="remarks" name="remarks" class="form-control" rows="20"></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
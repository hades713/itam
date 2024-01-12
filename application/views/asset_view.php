<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body data-bs-theme="dark">
    <div id="app" class="container-fluid">
        <div class="row">
            <div class="col">
                <h1>View Asset</h1>
            </div>
            <div class="col text-end">
                <a href="<?= base_url() ?>assets" class="btn btn-primary">Back</a>
            </div>
        </div>
        <div class="row">
            <!-- <div class="col-4">
                <iframe src="https://drive.google.com/embeddedfolderview?id=1LmLeB8ne5rHdELB5WFKRPSEqT9aDAijO#list" style="width:100%; height:600px; border:0;"></iframe>
            </div> -->
            <div class="col">
                <form id="myForm" action="<?=base_url()?>assets/update_asset" method="POST">
                    <input type="hidden" name="id" value="<?= $asset->id ?>">
                    <div class="form-group">
                        <label for="system_name">System Name:</label>
                        <?= $asset->system_name ?>
                    </div>

                    <div class="form-group">
                        <label for="system_desc">System Description:</label>
                        <?= $asset->system_desc ?>
                    </div>

                    <div class="form-group">
                        <label for="related_teams">Related Teams:</label>
                        <?= $asset->related_teams ?>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="vendor">Vendor:</label>
                                <?= $asset->vendor ?>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="annual_maintenance_cost">Annual Maintenance Cost:</label>
                                <?= $asset->annual_maintenance_cost ?>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="project_document">Project Document:</label>
                        <a href="<?= $asset->project_document ?>" target="_blank"><?= $asset->project_document ?></a>
                    </div>

                    <div class="form-group"><hr /></div>

                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="production_server_ip">Production Server IP:</label>
                                <?= $asset->production_server_ip ?>
                            </div>

                            <div class="form-group">
                                <label for="production_system_url">Production System URL:</label>
                                <a href="<?= $asset->production_system_url ?>" target="_blank"><?= $asset->production_system_url ?></a>
                            </div>

                            <div class="form-group">
                                <label for="production_document_path">Production Document Path:</label>
                                <?= $asset->production_document_path ?>
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-group">
                                <label for="development_server_ip">Development Server IP:</label>
                                <?= $asset->development_server_ip ?>
                            </div>

                            <div class="form-group">
                                <label for="development_system_url">Development System URL:</label>
                                <a href="<?= $asset->development_system_url ?>" target="_blank"><?= $asset->development_system_url ?></a>
                            </div>

                            <div class="form-group">
                                <label for="development_document_path">Development Document Path:</label>
                                <?= $asset->development_document_path ?>
                            </div>
                        </div>
                    </div>

                    <div class="form-group"><hr /></div>

                    <div class="form-group">
                        <label for="remarks">Remarks:</label>
                        <?= nl2br($asset->remarks) ?>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
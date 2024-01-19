<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Assets extends CI_Controller {
    
    public function index() {
        $this->display_assets();
    }

    public function display_assets() {
        // Retrieve assets from the database
        $this->load->model('model_assets');
        $assets = $this->model_assets->get_all_assets();
        
        // Prepare data for display in the view
        $data['assets'] = $assets;
        
        // Load the view and pass the data
        $this->load->view('assets', $data);
    }

    public function addnew() {
        $this->load->view('asset_new');
    }

    public function edit($id) {
        $this->load->model('model_assets');
        $data['asset'] = $this->model_assets->get_asset($id);
        $this->load->view('asset_edit', $data);
    }

    public function view($id) {
        $this->load->model('model_assets');
        $data['asset'] = $this->model_assets->get_asset($id);
        $this->load->view('asset_view', $data);
    }
    
    public function save_assets() {
        // Get asset details from the request
        $data['system_name'] = $this->input->post('system_name');
        $data['system_desc'] = $this->input->post('system_desc');
        $data['related_teams'] = $this->input->post('related_teams');
        $data['production_server_ip'] = $this->input->post('production_server_ip');
        $data['production_system_url'] = $this->input->post('production_system_url');
        $data['production_document_path'] = $this->input->post('production_document_path');
        $data['development_server_ip'] = $this->input->post('development_server_ip');
        $data['development_system_url'] = $this->input->post('development_system_url');
        $data['development_document_path'] = $this->input->post('development_document_path');
        $data['vendor'] = $this->input->post('vendor');
        $data['annual_maintenance_cost'] = $this->input->post('annual_maintenance_cost');
        $data['remarks'] = $this->input->post('remarks');
        
        
        // Save asset details to the database
        $this->load->model('model_assets');
        $this->model_assets->save_asset($data);
        
        // Redirect to the assets page or show a success message
        redirect('./assets');
    }

    public function update_asset() {
        // Get asset details from the request
        $id = $this->input->post('id');
        $asset_data['system_name'] = $this->input->post('system_name');
        $asset_data['system_desc'] = $this->input->post('system_desc');
        $asset_data['related_teams'] = $this->input->post('related_teams');
        $asset_data['production_server_ip'] = $this->input->post('production_server_ip');
        $asset_data['production_system_url'] = $this->input->post('production_system_url');
        $asset_data['production_document_path'] = $this->input->post('production_document_path');
        $asset_data['development_server_ip'] = $this->input->post('development_server_ip');
        $asset_data['development_system_url'] = $this->input->post('development_system_url');
        $asset_data['development_document_path'] = $this->input->post('development_document_path');
        $asset_data['vendor'] = $this->input->post('vendor');
        $asset_data['annual_maintenance_cost'] = $this->input->post('annual_maintenance_cost');
        $asset_data['remarks'] = $this->input->post('remarks');

        // Get footprint details from the request
        $footprint_data['action_content'] = $this->input->post('action_content');
        $footprint_data['action_date'] = $this->input->post('action_date');
        $footprint_data['issuer'] = $this->input->post('issuer');
        $footprint_data['assigned_to'] = $this->input->post('assigned_to');

        // Save asset and footprint details to the database
        $this->load->model('model_assets');
        $this->model_assets->update_asset($id, $asset_data);
        $this->model_assets->save_footprint($footprint_data);

        // Redirect to the assets page or show a success message
        redirect('./assets');
    }

    public function get_data() {
        // Load the model
        $this->load->model('model_assets');

        try {
            // Get the assets from the database with search, paging, and sorting support
            $assets = $this->model_assets->get_all_assets();

            // Prepare the data for DataTables
            $response = array(
                "draw" => intval($this->input->post('draw')),
                "recordsTotal" => count($assets),
                "recordsFiltered" => count($assets),
                "data" => $assets
            );

            // Convert the response to JSON and send it back to DataTables
            echo json_encode($response);
        } catch (Exception $e) {
            // Handle any exceptions and return an error response
            $response = array(
                "draw" => intval($this->input->post('draw')),
                "error" => $e->getMessage()
            );

            // Convert the response to JSON and send it back to DataTables
            echo json_encode($response);
        }
    }

    public function get_distinct_values() {
        // Load the model
        $this->load->model('model_assets');

        try {
            // Get the distinct values from the database
            $values = $this->model_assets->get_distinct_values( $this->input->get('column'));

            // Prepare the data for DataTables
            $response = array(
                "data" => $values
            );

            // Convert the response to JSON and send it back to DataTables
            echo json_encode($response);
        } catch (Exception $e) {
            // Handle any exceptions and return an error response
            $response = array(
                "error" => $e->getMessage()
            );

            // Convert the response to JSON and send it back to DataTables
            echo json_encode($response);
        }
    }

    public function get_footprints($id) {
        // Load the model
        $this->load->model('model_assets');

        try {
            // Get the footprints from the database
            $footprints = $this->model_assets->get_footprints($id);

            // Prepare the HTML response
            $response = '';
            foreach ($footprints as $footprint) {
                $response .= '<div class="row">';
                $response .= '<div class="col">' . $footprint->action_content . '</div>';
                $response .= '<div class="col">' . $footprint->action_date . '</div>';
                $response .= '<div class="col">' . $footprint->issuer . '</div>';
                $response .= '<div class="col">' . $footprint->assigned_to . '</div>';
                $response .= '<div class="col"><button class="btn btn-danger delete-footprint" data-id="' . $footprint->id . '">Delete</button></div>';
                $response .= '</div>';
            }

            // Send the HTML response
            echo $response;
        } catch (Exception $e) {
            // Handle any exceptions and return an error response
            $response = array(
                "error" => $e->getMessage()
            );

            // Convert the response to JSON and send it back to DataTables
            echo json_encode($response);
        }
    }
}

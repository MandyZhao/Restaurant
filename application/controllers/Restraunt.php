<?php
/**
 * Description of RestrauntController
 *
 * @author mandy
 */
class Restraunt extends CI_Controller {

    //put your code here
    private function load_form($form_action, $a_values = array()) {
        // Loading the form helper
        $this->load->helper('form');

        // Loading the form_validation library
        $this->load->library('form_validation');

        $view_params['form']['newqty']['field'] = array(
            'name' => 'newqty[]',
            'id' => 'newqty',
//            'value' => isset($a_values['newqty']) ? $a_values['newqty'] : '',
            'maxlength' => '100',
            'size' => '30',
            'class' => 'input'
        );


        $config_form_rules = array(
            array('field' => 'newqty[]', 'rules' => 'trim|required|integer')
        );
        $this->form_validation->set_rules($config_form_rules);

        return $view_params;
    }

    public function index() {
        // Loading the url helper
        $this->load->helper('url');

        // Manualy loading the database
        $this->load->database();

        // Loading the model class
        $this->load->model('RestrauntModel');
        $this->load->helper('form');

        $cat = $this->input->get('cat');
        if (!isset($cat)) {
            $cat = 1;
        }
        // Calling the model to retrieve the computers from the database
        $view_params['categories'] = $this->RestrauntModel->get_categories();
        $view_params['food_list'] = $this->RestrauntModel->get_food_list($cat);
        $view_params['categoryName'] = $this->RestrauntModel->get_category_name($cat);
        $this->load->view('domain_view', $view_params);
    }

    public function cart() {
        // Loading the url helper
        $this->load->helper('url');
        $this->load->library('session');
        // Manualy loading the database
        $this->load->database();

        // Loading the model class
        $this->load->model('CartModel');

        $a_post_values = $this->input->post();
        $view_params = $this->load_form('http://localhost:8000/Restraunt/cart', $a_post_values);

        $empty_cart = $this->input->get('action');
        if ($empty_cart == 'empty_cart') {
            $this->CartModel->empty_cart();
        }

        if (isset($a_post_values['action'])) {
            $action = $a_post_values['action'];
            // Validating the form
            if ($action == 'Update Cart') {
                if ($this->form_validation->run() == TRUE) { // VAlidation failed
                    foreach ($a_post_values['newqty'] as $food_id => $new_qty) {
                        $this->CartModel->update_food($food_id, $new_qty);
                    }
                }
            } else if ($action == 'add_food') {
                redirect('http://localhost:8000/Restraunt');
                return;
            }
        }
        $view_params['subtotal'] = $this->CartModel->get_subtotal();
//        $view_params['cart'] = $this->session->cart;
        $this->load->view('cart_view', $view_params);
    }

    public function add() {
        // Loading the url helper
        $this->load->helper('url');
        $this->load->library('session');

        // Manualy loading the database
        $this->load->database();

        // Loading the model class
        $this->load->model('CartModel');

        $a_post_values = $this->input->post();

        $view_params = $this->load_form('http://localhost:8000/Restraunt/add', $a_post_values);

        $data = $a_post_values;
        array_pop($data);
        $this->CartModel->add_food($data['food_id'], $data['foodqty']);
        $view_params['subtotal'] = $this->CartModel->get_subtotal();
//        $view_params['cart'] = $this->CartModel->get_cart();
        redirect('http://localhost:8000/Restraunt/cart');
    }

}

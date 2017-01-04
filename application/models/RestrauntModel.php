<?php
/**
 * Description of RestrauntModel
 *
 * @author mandy
 */
class RestrauntModel extends CI_Model {

    public function __construct() {
        // Call the Model constructor
        parent::__construct();
    }

    public function get_categories() {
        $query = $this->db->get('categories');

        return $query->result();
    }

    public function get_food_list($categoryID) {
        $this->db->select('*');
        $this->db->from('foods');
        $this->db->where('categoryID', $categoryID);

        $query = $this->db->get();

        return $query->result();
    }

    public function get_category_name($categoryID) {
        $this->db->select('categoryName');
        $this->db->from('categories');
        $this->db->where('categoryID', $categoryID);

        $query = $this->db->get();

        return $query->result();
    }

}

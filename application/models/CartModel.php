<?php

/**
 * Description of CartModel
 *
 * @author mandy
 */
class CartModel extends CI_Model {

    public function __construct() {
        // Call the Model constructor
        parent::__construct();
        $this->load->library('session');
    }

    public function add_food($food_id, $quantity) {
        $this->db->select('*');
        $this->db->from('foods');
        $this->db->where('foodID', $food_id);

        $query = $this->db->get();

        $foodsa = $query->row();
        if ($quantity < 1)
            return;

        // If book already exists in cart, update quantity
        if (isset($_SESSION['cart'][$food_id])) {
            $quantity += $_SESSION['cart'][$food_id]['qty'];
            $this->update_food($food_id, $quantity);
            return;
        }

        // Add book
        $price = $foodsa->foodPrice;
        $total = $price * $quantity;
        $food = array(
            'foodName' => $foodsa->foodName,
            'price' => $price,
            'qty' => $quantity,
            'total' => $total
        );
        $_SESSION['cart'][$food_id] = $food;
    }

// Update an book in the cart
    public function update_food($food_id, $quantity) {
        $quantity = (int) $quantity;
        if (isset($_SESSION['cart'][$food_id])) {
            if ($quantity <= 0) {
                unset($_SESSION['cart'][$food_id]);
            } else {
                $_SESSION['cart'][$food_id]['qty'] = $quantity;
                $total = $_SESSION['cart'][$food_id]['price'] *
                        $_SESSION['cart'][$food_id]['qty'];
                $_SESSION['cart'][$food_id]['total'] = $total;
            }
        }
    }

// Get cart subtotal
    public function get_subtotal() {
        $subtotal = 0;
        foreach ($_SESSION['cart'] as $food) {
            $subtotal += $food['total'];
        }
        $subtotal = number_format($subtotal, 2);
        return $subtotal;
    }
//    private function get_food($food_id) {
//        $this->db->select('*');
//        $this->db->from('foods');
//        $this->db->where('foodID', $food_id);
//
//        $query = $this->db->get();
//
//        return $query->row();
//    }
//    
//    public function get_cart() {
//        $result = array();
//        foreach ($_SESSION['cart'] as $food_id => $food) {
//            $foodInfo = $this->get_food($food_id);
//                        $price = $foodInfo->foodPrice;
//                        $total = $price * $quantity;
//                        $result[] = array(
//                            'foodName' => $foodsa->foodName,
//                            'price' => $price,
//                            'qty' => $quantity,
//                            'total' => $total
//                        );
//                        $_SESSION['cart'][$food_id] = $food;
//        }
//        return $result;
//    }

    public function empty_cart() {
        $_SESSION['cart'] = array();
    }

}

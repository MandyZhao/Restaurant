<!DOCTYPE html>
<!--/* 
 * Student Info: Name=Xiaolei Zhao, ID=16117 
 * Subject: CS526A_HW4_Fall_2016 
 * Author: mandy
 * Filename: cart_view.php
 * Date and Time: Dec 12, 2016 9:05:23 PM
 * Project Name: Xiaolei_16117_CS526A_HW4
 */-->
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="../../style.css" />
        <title>My Restaurant</title>
    </head>
    <body>

        <?php if (validation_errors()) : ?>
            <?php echo validation_errors(); ?>
        <?php endif; ?>

        <header>
            <h1>My Restaurant</h1>
        </header>
        <section id="main">

            <h1>Your Cart</h1>
            <?php if (!isset($_SESSION['cart']) || count($_SESSION['cart']) == 0) : ?>
                <p>There is nothing in your cart.</p>
            <?php else: ?>

                <?php
                echo form_open('http://localhost:8000/Restraunt/cart');
                ?>
                <table>
                    <tr id="cart_header">
                        <th>Food</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                    </tr>
                    <?php
                    foreach ($_SESSION['cart'] as $food_id => $food) :
                        $price = number_format($food['price'], 2);
                        $total = number_format($food['total'], 2);
                        ?>
                        <tr>
                            <td>
                                <?php echo $food['foodName']; ?>
                            </td>
                            <td>
                                $<?php echo $price; ?>
                            </td>
                            <td>
                                <?php echo form_input("newqty[".$food_id. "]", $food['qty']); ?>
                            </td>
                            <td>
                                $<?php echo $total; ?>
                            </td>
                        </tr>
                        <?php echo form_hidden('food_id[]', $food_id); ?>
                    <?php endforeach; ?>
                    <tr>
                        <td colspan="3"><b>Subtotal</b></td>
                        <td>$<?php echo $subtotal ?></td>
                    </tr>
                    <tr>
                        <td colspan="4">
                            <input type="submit" name="action" value="Update Cart">
                        </td>
                    </tr>
                </table>

                <p>Click "Update Cart" to update quantities in your
                    cart. Enter a quantity of 0 to remove a book.
                </p>
                <?php echo form_close(); ?>    
            <?php endif; ?>
            <p><a href="cart?action=empty_cart">Empty Cart</a></p>
            <p><a href=".?action=add_food">Add Food</a></p>
        </section>

    </body>
</html>

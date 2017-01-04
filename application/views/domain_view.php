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
        <title>My Restaurant</title>
        <link rel="stylesheet" type="text/css" href="../../style.css" />
    </head>
    <body>
        <h1>Order Foods</h1>
        <div id="sidebar">
            <h2>Categories</h2>
            <?php foreach ($categories as $category) : ?>
                <ul>
                    <li>
                        <a href="?cat=<?php echo $category->categoryID; ?>">
                            <?php echo $category->categoryName; ?>
                        </a>
                    </li>
                </ul>
            <?php endforeach; ?>
        </div>
        <div id="main">
            <h2><?php echo $categoryName[0]->categoryName ?></h2>
            <table>
                <tr>
                    <th>Food Name</th>
                    <th>Image</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Add</th>
                </tr>
                <?php foreach ($food_list as $food) : ?>
                    <?php
                    echo form_open('http://localhost:8000/Restraunt/add');
                    echo form_hidden('food_id', $food->foodID);
                    ?>
                    <tr>
                        <td><?php echo $food->foodName; ?></td>
                        <td><img src=' ../../<?php echo $food->imagePath ?>' height=100 width=130 /></td>
                        <td><?php echo $food->foodPrice; ?></td>
                        <td>
                            <select name="foodqty">
                                <?php for ($i = 1; $i <= 10; $i++) : ?>
                                    <option value="<?php echo $i; ?>">
                                        <?php echo $i; ?>
                                    </option>
                                <?php endfor; ?>
                            </select><br />
                        </td>
                        <td>
                            <?php echo form_hidden('food_id', $food->foodID); ?>
                            <input type="submit" name='action' value="Add to cart" />
                            <?php echo form_close(); ?>   
                        </td>

                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </body>
</html>


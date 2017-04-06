/**
 * Created by PhpStorm.
 * User: apprenant
 * Date: 06/04/17
 * Time: 15:31
 */

<h2><?php echo $todo['Item']['item_name']?></h2>

<a class="big" href="../../../items/delete/<?php echo $todo['Item']['id']?>">
    <span class="item">
    Delete this item
    </span>
</a>
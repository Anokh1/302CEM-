<?php

// php cart class
class Cart
{
    public $db = null;

    public function __construct(DBController $db)
    {
        if (!isset($db->con)) return null;
        $this->db = $db;
    }

    // insert into cart table
    public function insertIntoCart($params = null, $table = "cart"){
        if ($this->db->con != null){
            if ($params != null){
                // "Insert into cart(user_id) values (0)"
                // get table columns
                $columns = implode(',', array_keys($params));

                $values = implode(',' , array_values($params));

                // create sql query
                $query_string = sprintf("INSERT INTO %s(%s) VALUES(%s)", $table, $columns, $values);
                                    //   INSERT INTO cart(user_id) VALUES (1);  

                // execute query
                $result = $this->db->con->query($query_string);
                return $result;
            }
        }
    }

    // to get user_id and barcodeNumber and insert into cart table
    public  function addToCart($userid, $barcode_Number, $carttotal){
        if (isset($userid) && isset($barcode_Number)){
            $params = array(
                "user_id" => $userid,
                "barcodeNumber" => $barcode_Number,
                "cart_total" => $carttotal
            );

            // insert data into cart
            $result = $this->insertIntoCart($params);
            if ($result){
                // Reload Page
                header("Location: " . $_SERVER['PHP_SELF']);
            }
        }
    }

    // delete cart item using cart barcodeNumber (_cart-template.php, line 52)
    public function deleteCart($barcodeNumber = null, $table = 'cart'){
        if($barcodeNumber != null){
            $result = $this->db->con->query("DELETE FROM {$table} WHERE barcodeNumber={$barcodeNumber}");
            if($result){
                header("Location:" . $_SERVER['PHP_SELF']);
            }
            return $result;
        }
    }

    // clear cart item using cart id
    public function clearCart($cart_id = null, $table = 'cart'){
        if($cart_id != null){
            $result = $this->db->con->query("DELETE FROM {$table} WHERE cart_id={$cart_id}");
        }
    }

    // calculate sum of the order
    public function getSum($arr){
        if(isset($arr)){
            $sum = 0;
            foreach ($arr as $item){
                $sum += floatval($item[0]);
            }
            return sprintf('%.2f' , $sum); // 2 decimal places
        }
    }

    // get item_id of shopping cart list to remove duplicate entry of the same product in the shopping cart 
    public function getCartId($cartArray = null, $key = "barcodeNumber"){
        if ($cartArray != null){
            $cart_id = array_map(function ($value) use($key){
                return $value[$key];
            }, $cartArray);
            return $cart_id;
        }
    }

    // Save for later
    // public function saveForLater($item_id = null, $saveTable = "wishlist", $fromTable = "cart"){
    //     if ($item_id != null){
    //         $query = "INSERT INTO {$saveTable} SELECT * FROM {$fromTable} WHERE item_id={$item_id};";
    //         $query .= "DELETE FROM {$fromTable} WHERE item_id={$item_id};";

    //         // execute multiple query
    //         $result = $this->db->con->multi_query($query);

    //         if($result){
    //             header("Location :" . $_SERVER['PHP_SELF']);
    //         }
    //         return $result;
    //     }
    // }


}
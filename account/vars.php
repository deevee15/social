<?
        $query = "SELECT * FROM `users` WHERE (`id` = '".$id."' OR `changed_id` = '".$id."')";
        $openedUser = array();
        $result = mysqli_query($mysqli, $query);
        while ($row = mysqli_fetch_assoc($result)) {
            $openedUser=$row;
        }
        $login=$openedUser['email'];
        $name=$openedUser['name'];$surname=$openedUser['surname'];
?>
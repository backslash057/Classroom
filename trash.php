<?php

$conn = null;

try {
    this->conn = new mysqli($host, $username, $pwd, $dbname);
} catch(Exception e){
    echo "Database connection failed";
}

namespace dbManager {
    function save_user($user) {
        echo "saved";
    }
    
}




?>
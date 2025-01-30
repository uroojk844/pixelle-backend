<?php
    //$serverdata => The data getting submitted to server [associated array]
    //$fields = > Fields your app has [array]

    function validateInput($serverData,$fields){
        foreach($fields as $field ){
            if(!isset($serverData[$field]) || trim($serverData[$field]==='')){
                return false;
            }
        }
        return true;
    }
?>
  
                
        <?php
                $presMessage = "Prescription Uploaded Successfully";
                function exampleFunction() {
                    // To access the global variable inside this function, use the global keyword
                     header('location:index.php');
                    global $presMessage;
                    echo $presMessage;
                }
?>
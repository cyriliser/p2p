<!-- packages Selection -->

<section id="package-selection" >
        <div ></div>

        <div >
                <!-- <h1>Package Selection</h1> -->

                <div >
                        <h4 > Select Investment Amount</h4>
                        <!-- package Selection form -->
                        <form id="SelectForm" action=""  method="post" >
                                <!-- row 1 -->
                                <div >
                                        <table>
                                                <?php
                                                echo "<input type=\"hidden\" name=\"user_id\" value=\"$user_id\">";
                                                $sql_query = "SELECT * FROM packages";
                                                $packages_result = mysqli_query($db_connection,$sql_query);
                                                if(!$packages_result){
                                                        log_alert(mysqli_error($db_connection));
                                                }
                                                $num=0;
                                                echo"<select name=\"selected_package\" class='dropbtn'>";
                                                echo"<div class='dropdown-content'>";
                                              
                                                while ($package = mysqli_fetch_assoc($packages_result)) {
                                                        
                                                    
                                                        echo "
                                                               
                                                             <option name=\"selected_package\"  value=\"$package[id]\"> R$package[amount]     
                                                              
                                                        ";
 
                                                }
                                                // echo"<\select> ";
                                                
                                        ?>
                                        </table>
                                </div>
                                </div>

                                <button type="submit" class="btn btn-primary mb-2">Submit</button>
                        </form>
                        <section class="w-100 mt-3 text-center">


                                <!-- ..................Share_ref_link.php................... -->
   
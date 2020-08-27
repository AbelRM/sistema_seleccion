<?php

// Insert the content of connection.php file
include('connection.php');

// Update data into the database
if(ISSET($_POST['updateData']))
{   
    $id = $_POST['updateId'];
    $firstname = $_POST['updateFirstname'];
    $lastname = $_POST['updateLastname'];
    $address = $_POST['updateAddress'];
    $skills = $_POST['updateSkills'];
    $designation = $_POST['updateDesignation'];

    $sql = "UPDATE expe_4puntos SET lugar='$firstname',
                                    cargo='$lastname', 
                                    fecha_inicio='$address',
                                    fecha_fin=' $skills'
                                    WHERE id_4puntos='$id'";

    $result = mysqli_query($conn, $sql);

    if($result)
    {
        echo '<script> alert("Data Updated Successfully."); </script>';
        header("Location:http://www.php.egavilanmedia.com/PHPCRUD/");
    }
    else
    {
        echo '<script> alert("Data Not Updated"); </script>';
    }
}
?>
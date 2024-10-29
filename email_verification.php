<?php
    include 'connect.php';

    if (isset($_GET['email']) && isset($_GET['v_code']))
    {
        $query = "SELECT * FROM `users` WHERE `Email`='$_GET[email]' AND `verification_code` = '$_GET[v_code]'";
        $result = mysqli_query($conn, $query);
        if ($result)
        {
            if(mysqli_num_rows($result) == 1)
            {
                $result_fetch = mysqli_fetch_assoc($result);
                if($result_fetch['is_verified'] == 0)
                {
                    $update = "UPDATE `users` SET `is_verified` = '1' WHERE `Email` = '$result_fetch[Email]'";
                    if(mysqli_query($conn, $update))
                    {
                        echo "<script>alert('Verification successful! You can now login to your Account.'); window.location.href='login.php';</script>";
                    }
                    else
                    {
                        echo "Error: " . $conn->error;
                    }
                }
                else
                {
                    echo "<script>alert('Email already verified!'); window.location.href='login.php';</script>";
                }
            }
        }
        else
        {
            echo "Error: " . $conn->error;
        }
    }
?>
<?php

 include 'connection.php';

  if(isset($_GET['email']) && isset($_GET['v_code']))
  {
    $query="SELECT * FROM `students` WHERE `email`='$_GET[email]' AND `verification_code`='$_GET[v_code]'";
    $result = mysqli_query($connect, $query);
    if($result)
    {
      if(mysqli_num_rows($result)==1)
      {
        $result_fetch=mysqli_fetch_assoc($result);
            if($result_fetch['is_verified']==0)
            {
              $update="UPDATE `students` SET `is_verified`='1' WHERE `email`='$result_fetch[email]'";
              if(mysqli_query($connect,$update)){
                echo"
                  <script>  
                   alert('Email Verification Successful');
                    window.location.href='login.php';
                    </script>  
                    ";
              }
              else{
                echo"
                <script>  
                 alert('Cannot run query');
                  window.location.href='register.php';
                  </script>  
                  ";
              }
            }
            else{
              echo"
              <script>  
               alert('Email already verified!!');
                window.location.href='register.php';
                </script>  
                ";
            }
      }
        
    }else{
      echo"
      <script>  
       alert('Cannot run query');
        window.location.href='register.php';
        </script>  
        ";
    }

  }

  ?>
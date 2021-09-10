 <?php
                  if (isset($_POST['submitForm']))
                  {
                     if ($status=='success')
                     {
                       
                        $content = "<div class='alert alert-success alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                          <strong>".$msg."</strong></div>";

                     }
                     else if ($status=='error')
                     {
                         
                          $content = "<div class='alert alert-danger alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                          <strong>".$msg."</strong></div>";
                     }
                     else if ($status=='warning')
                     {

                          $content = "<div class='alert alert-warning   alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                          <strong>".$msg."</strong></div>";
                     }


                     echo $content;
                  }
?>

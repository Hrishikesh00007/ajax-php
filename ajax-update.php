<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>Document</title>
    <style>
        #success-message{
            background:#DEF1D8;
            color:green;
            padding:10px;
            margin:10px;
            display:none;
            position:absolute;
            right:15px;
            top:15px;
        }
        #error-message{
            background:#EFDCDD;
            color:red;
            padding:10px;
            margin:10px;
            display:none;
            position:absolute;
            right:15px;
            top:15px;
        }
        #modal{
            background: rgba(0,0,0,0.7);
            position:fixed;
            left:0;
            right:0;
            top:0;
            width: 100%;
            height: 100%;
            z-index:100;
            display:none;
        }
        #modal-form{
            background: #fff;
            width: 30%;
            position:relative;
            top:25%;
            left: calc(50% - 15%);
            padding: 15px;
            border-radius:4px;
        }
        #close-btn{
            background: red;
            color: white;
            width: 30px;
            height:30px;
            line-height:30px;
            text-align:center;
            border-radius:50%;
            position:absolute;
            top:-15px;
            right:-15px;
            cursor:pointer
        }

    </style>
   
</head>
<body>
<?php 
$con=mysqli_connect("localhost","root","","forthtest") or die("connection Failed");

$sql1="SELECT * FROM `customers` WHERE `id`='".$_POST['id']."'   ";
$result1=mysqli_query($con,$sql1) or die("sql query failed");
$output1="";
if(mysqli_num_rows($result1) > 0 ){
    while($row=mysqli_fetch_assoc($result1)){
 $output1 .="
 <div id='modal-form'>
        <h2>Edit Form</h2>  
  <div >
      <label for='name'>name:</label>
      <input type='text' class='form-control' id='edit-name' placeholder='Enter name' value='{$row["name"]}'>
      <input type='text' class='form-control' id='edit-id' placeholder='Enter name' hidden value='{$row["id"]}'>

    </div>
    <div >
      <label for='email'>Email:</label>
      <input type='email' class='form-control' id='edit-email' placeholder='Enter email'  value='{$row["email"]}'>
    </div>
    <div >
      <label for='mobile'>mobile:</label>
      <input type='text' class='form-control' id='edit-mobile' placeholder='Enter mobile'  value='{$row["mobile"]}'>
    </div>
    <div >
      <label for='city'>city:</label>
      <input type='text' class='form-control' id='edit-city' placeholder='Enter city'  value='{$row["city"]}'>
    </div>

    <button type='submit' class='btn btn-primary' id='edit-submit'>Submit</button>

<div id='close-btn'>X</div>
</div>
   
                    ";

    }
    mysqli_close($con);
    echo $output1;
}else{
    echo "<h1>No Records Found</h1>";
} 
?>


<script type="text/javascript">
$(document).ready(function() {


    function loadTable(){
        $.ajax({
            url : "ajax-load.php",
            type : "POST",
            success : function(data){
                $("#table-data").html(data);
            }
        });
    }
    //loadTable();

             $('#close-btn').on('click', function() {
               // alert();
                $("#modal").hide();
             });


             $('#edit-submit').on('click', function() {
              var id = $("#edit-id").val();
              var name = $("#edit-name").val();
              var email = $("#edit-email").val();
              var mobile = $("#edit-mobile").val();
              var city = $("#edit-city").val();

              $.ajax({
            url : "ajax-update-page.php",
            type : "POST",
            data : {id,name,email,mobile,city},
            success : function(data){
                //alert(data);
               // $("#modal").hide();
                //loadTable();  
               if(data == 1){
                $("#modal").hide();
                loadTable(); 
               }
            }
        });

             });


});
</script>


</body>
</html>
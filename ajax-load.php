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

$sql="SELECT * FROM customers ";
$result=mysqli_query($con,$sql) or die("sql query failed");
$output="";
if(mysqli_num_rows($result) > 0 ){
    $output = '<table cellpadding="40px">
    
    <tr>
    <th>id</th>
    <th>Name</th>
    <th>Email</th>
    <th>Mobile</th> 
    <th>City</th>
    <th>Delete</th>
    <th>Update</th>
    </tr>';
    while($row=mysqli_fetch_assoc($result)){
        $output .= "<tr>
                    <td>{$row["id"]}</td>
                    <td>{$row["name"]}</td>
                    <td>{$row["email"]}</td>
                    <td>{$row["mobile"]}</td>
                    <td>{$row["city"]}</td>
                    <td><button  class='delete-button btn btn-danger'  data-id='{$row["id"]}'>Delete</button></td>
                    <td><button  class='update-button btn btn-warning'  data-id='{$row["id"]}'>Update</button></td>                 
                    </tr>
                    
                 <div id='modal'>
                 
              
                    </div>

                    ";
    }
    //$output .= "</table>";
    mysqli_close($con);
    echo $output;
}else{
    echo "<h1>No Records Found</h1>";
} 
?>
<script type="text/javascript">
$(document).ready(function() {

    $('.delete-button').on('click', function() {
        if(confirm("do you delete this record?")){

        
            var studentId = $(this).data('id');
              var element = this;
              $.ajax({
                url : "ajax-delete.php",
                type : "POST",
                data : {id : studentId},
                success : function(data){
                    if(data == 1){
                        $(element).closest("tr").fadeOut();
                        $("#success-message").html("Data deleted Successfully").slideDown();
                        $("#error-message").slideUp();
                    }else{
                        $("#error-message").html("can't delete record").slideDown();
                        $("#success-message").slideUp();
                    }
                }
              })
            }
             });


             $('.update-button').on('click', function() {
                $("#modal").show();
            var studentId = $(this).data('id');
            alert(studentId);
              var element = this;
              $.ajax({
                url : "ajax-update.php",
                type : "POST",
                data : {id : studentId},
                success : function(data){ 
                    $("#modal").html(data);
                   
                }
              })
            
             });

});
</script>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Latest compiled and minified CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <title>Document</title>
</head>
<body>
    <div class="container">
    <h1>This is Home page</h1>
    <button type="button" class="btn btn-info" id="load-button">Info</button>
   
    <table>
       
        
            <td id="table-data">

            </td>
      
    </table>

<script type="text/javascript" src="JS/jquery.js"></script>
<script type="text/javascript">
$(document).ready(function(){
    
    $("#load-button").on("click",function(e){
       // alert("1");
        $.ajax({
            url : "ajax-load.php",
            type : "POST",
            success : function(data){
               // alert(data);
                $("#table-data").html(data);
            }
        });
    });
});

</script>

</body>
</html>
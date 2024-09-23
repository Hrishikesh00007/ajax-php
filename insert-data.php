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
            width: 100%;
            height: 100%;
            z-index:100;
            display:none;
        }
        #modal-form{
            background: #fff;
            width: 30%;
            position:relative;
            top:20%;
            left: calc(50% - 15%);
            padding: 15px;
            border-radius:4px;
        }
    </style>

</head>
<body>
    
<div class="container">
  <h2>Insert data</h2>
  <table>
  <form id="addFrom">
        <div class="form-group">
      <label for="name">name:</label>
      <input type="text" class="form-control" id="name" placeholder="Enter name" name="name">
        </div>
        <div class="form-group">
      <label for="email">Email:</label>
      <input type="email" class="form-control" id="email" placeholder="Enter email" name="email">
       </div>
        <div class="form-group">
      <label for="mobile">mobile:</label>
      <input type="text" class="form-control" id="mobile" placeholder="Enter name" name="mobile">
        </div>
        <div class="form-group">
      <label for="city">city:</label>
      <input type="text" class="form-control" id="city" placeholder="Enter name" name="city">
         </div>
         <button type="submit" class="btn btn-primary" id="save-button">Submit</button>
  </form>
        <div id="search-bar">
            <label>Search</label>
            <input type="text" id="search" autocomplete="off">
        </div>
             <td id="table-data">
            </td>
  </table>
</div>
<div id="error-message"></div>
<div id="success-message"></div>



<script type="text/javascript" src="JS/jquery.js"></script>
<script type="text/javascript">
$(document).ready(function(){

    function loadTable(){
        $.ajax({
            url : "ajax-load.php",
            type : "POST",
            success : function(data){
                $("#table-data").html(data);
            }
        });
    }
    loadTable();
  

    $("#save-button").on("click",function(e){
       e.preventDefault();
       var name = $("#name").val();
       var email = $("#email").val();
       var mobile = $("#mobile").val();
       var city = $("#city").val();

        if(name == " " || email == " "){
            $("#error-message").html("All fildes are required").slideDown();
            $("#success-message").slideUp();
        }else{

            $.ajax({
            url : "ajax-insert.php",
            type : "POST",
            data : {name,email,mobile,city},
            success : function(data){
               if(data == 1){
                loadTable();
                $("#addFrom").trigger("reset");
                $("#success-message").html("Data insert Successfully").slideDown();
                $("#error-message").slideUp();
               }else{
                $("#error-message").html("can't save records").slideDown();
            $("#success-message").slideUp();
               }
            }
        });
        }
    });

    

    $("#search").on("keyup",function(){
        var search_tearm = $(this).val();

        $.ajax({
            url:"live-search.php",
            type: "POST",
            data:{search:search_tearm},
            success: function(data){
                //alert(data);
                $("#table-data").html(data);
            }
        })
    });


});



</script>
</body>
</html>
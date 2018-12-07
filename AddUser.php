<!DOCTYPE html>

<html>
    <head>
        <title>Add User</title>
        <meta charset="utf-8">
        <script src="http://code.jquery.com/jquery-1.5.js"></script>
        <style>
            .sidenav {
                height: 100%; /* 100% Full-height */
                width: 0; /* 0 width - change this with JavaScript */
                position: fixed; /* Stay in place */
                z-index: 1; /* Stay on top */
                top: 0; /* Stay at the top */
                left: 0;
                background-color: #111; /* Black*/
                overflow-x: hidden; /* Disable horizontal scroll */
                padding-top: 60px; /* Place content 60px from the top */
                transition: 0.5s; /* 0.5 second transition effect to slide in the sidenav */
            }

            .sidenav a {
                padding: 8px 8px 8px 32px;
                text-decoration: none;
                font-size: 25px;
                color: #818181;
                display: block;
                transition: 0.3s;
            }
            
            .sidenav a:hover {
                color: #f1f1f1;
            }

            .sidenav .closebtn {
                position: absolute;
                top: 0;
                right: 25px;
                font-size: 36px;
                margin-left: 50px;
            }

            body{
                background:  #66c2ff;
            }
            #title{
                font-family: Arial, Helvetica, sans-serif;
                font-weight: bold;
                font-size: 6vw;
                text-align: center;
            }
            input[type=text]{
                width: 100%;
                padding: 12px 20px;
                margin: 8px 0;
                box-sizing: border-box;           
            }
            input[type=submit]{
                width: 100%;
                padding: 16px 32px;
                border: none;
            }
            #form
            {
                margin: 0 auto;
                text-align: center;
                width: 40%;
            }
            #selectorStyle {
                width: 100%;
                padding: 12px 20px;
                margin: 8px 0;
                box-sizing: border-box; 
            }
            #Incorrect
            {
                margin: 0 auto;
                width: 40%;
                font-size: 25px;
                display : none;
            }
            #msg {
                font-family: Arial, Helvetica, sans-serif;
                font-weight: bold;
                font-size: 3vw;
                text-align: center;
            }
        </style>
        <script>

        </script>

    </head>

    <body>

        <div id="mySidenav" class="sidenav">
            <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
            <a href="splashpage.php">List</a>
            <a href="search.php">Search</a>
            <a href="Warehouse.html">Map</a>
            <a href="AddUser.php">Add User</a>
            <a href="logout.php">Logout</a>
        </div>
        <span style="font-size:30px;cursor:pointer" onclick="openNav()"> &#9776;</span>

        <h1 id="title">
            Add User to Location
        </h1>
        
        <p id="msg">Make sure to fill out all fields</p>

        <div>

        <!--
            data will be sent in the form of
            - Username
            - Password
            - Store ID
            - Store Name
            - Position held by new user (the values are already strings set to manager and emplyee)
        -->

        <form id="form">

                <label for="user"></label>
                <input id="user" class="form-field" type="text" name="username" placeholder="New Username" maxlength="15">

                <label for="pass"></label>
                <input id="pass" class="form-field" type="text" name="password" placeholder="New Password">

                <label for="pass"></label>
                <input id="pass" class="form-field" type="text" name="storeID" placeholder="Desired store ID">

                <label for="pass"></label>
                <input id="pass" class="form-field" type="text" name="storeName" placeholder="Desired Store Name">

                <label for="user"></label>
                <select id="selectorStyle" class="form-field" name = "selectorName">
                    <option value="manager">Manager</option>
                    <option value="employee" selected>Employee</option>
                </select>

            <div id="submit">
                <input type="submit" value="Add New User">
            </div>
           
        </form>
        <div id="Incorrect">Can't add this user</div>
        </div>

        <script>

            $(document).ready(function(){ 

                function validateForm() {
                    var isValid = true;
                    $('.form-field').each(function() {
                        if ( $(this).val() === '' )
                            isValid = false;
                    });
                    return isValid;
                }

            $('#form').submit(function(event){

                var filledFields = validateForm();

                if(filledFields == false) {
                    $('#Incorrect').html("Please fill all the fields");
                    return;
                }
                
                var post_data = $('#form').serialize();
                $.post('AddUserPHP.php', post_data, function(data) {
                        $.ajax({
                        type: "POST",
                        async: false,
                        url: "AddUserPHP.php",
                        data: post_data,
                            
                        success:function(data) {
                            if(!$.trim(data)){
                            $('#Incorrect').css({
                            'display' : 'block'
                            }); 
                            $('#Incorrect').html("Error");
                            return;
                            }
                            else{

                            $('#Incorrect').css({
                            'display' : 'block'
                            }); 
                            $('#Incorrect').html("Successfully added " + $('#user').val());
                            $('#form').trigger("reset");
                            return;
                            }
                                },
                            error: function(data) {
                                
                                $('#Incorrect').html("Failed to Connect");
                                
                            },
                            
                                }) 
                                
                            });
                    event.preventDefault();
                    });

                /* Set the width of the side navigation to 250px */
                function openNav() {
                    document.getElementById("mySidenav").style.width = "250px";
                }

                /* Set the width of the side navigation to 0 */
                function closeNav() {
                    document.getElementById("mySidenav").style.width = "0";
                }

            });       

        </script>
    </body>

</html>
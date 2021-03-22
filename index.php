<!-- USER AUTHENTICATION CHECK -->
<?PHP
    session_start();
    $auth = false;
    if ( isset($_SESSION['authenticated']) ) {
        if($_SESSION['authenticated'] == true) {
            $auth = true;
        }   
    }
    $auth = true;
?>

<!DOCTYPE html>
<html">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Origins</title> 
        <link href="css/style.css" rel="stylesheet">
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet"> 
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link href="https://unpkg.com/material-components-web@latest/dist/material-components-web.min.css" rel="stylesheet">               
    </head>
    <body>
        <div class="container-fluid">
            <!-- APP TOP -->
            <div class="row">
                <div class="col-xs-1">
                    <div class="row margin-none padding-none">
                    <img src="logo.svg" height="16" class="logo-icon img-responsive pull-left"></img>                    
                    <h3 class="text-left">Origins</h3>
                    </div>
                </div>
                <div class="col-xs-4">
                    <!-- SEARCH BOX -->
                    <?php if($auth) echo'<input id="searchbox" placeholder="Ticket number to search" class="searchbox input-lg margin-top-md" value="" name="search" type="text" style="border: medium none; padding: 0px; height:auto; width:100%; ">';
                    else echo'<input placeholder="Please login" class="searchbox input-lg margin-top-md" value="" name="search" type="text" style="border: medium none; padding: 0px; height:auto; width:100%; ">';
                    ?>
                    </div>
                <div class="col-xs-7">
                    <!-- LOGIN / REGISTER ROW-->
                    <?PHP
                    echo '<div class="form-inline row margin-top-md" action="">';
                    if(!$auth) {
                    echo' <div class="form-group">';
                    echo' <label for="username">Username:</label>';
                    echo' <input class="input-sm margin-right-sm" type="text" class="form-control" id="username">';
                    echo' </div>';
                    echo' <div class="form-group margin-right-md">';
                    echo' <label for="password">Password:</label>';
                    echo' <input class="input-sm" type="password" class="form-control" id="password">';
                    echo' </div>';
                    echo' </div>';
                    } else {
                        echo '<div class="col-xs-7 text-right">';
                        echo '<h3> Welcome! </h3>'     ;   
                        echo' </div></div>';                        
                    }
                    ?>
                </div>
            </div>
            <div class="row margin-none padding-none">
                <!-- HR ROW -->
                <div class="col-xs-12 padding-none"><hr class="hr-dark"></div>
            </div>    
            <div class="row">
                <div class="col-xs-1">
                    <!-- SIDEBAR -->
                    <div class="row margin-none">
                        <!-- NEW TICKET BUTTON -->
                        <?php
                        if($auth){
                            echo'<button id="newTicket" class="mdc-button mdc-button--raised" onclick="openForm()">';
                            echo'<div class="mdc-button__ripple"></div>';
                            echo'<i class="material-icons mdc-button__icon" aria-hidden="true">add</i>';
                            echo'<span class="mdc-button__label">New Ticket</span>';
                            echo'</button>';
                        }                        
                        ?>
                    </div>

                </div>
                <!-- CHECK AUTHENTICATION BEFORE DISPLAYING DATA -->
                <?PHP
                if($auth) {
                echo'<div class="col-xs-8 margin-none">';
                echo'<!-- MAIN SCREEN -->';
                echo'<div class="row">';
                echo'  <!-- GRID HEADER -->';
                echo'  <div class="col-xs-1"><h5>In/Out</h5></div>';
                echo'  <div class="col-xs-1"><h5>Ticket#</h5></div>';
                echo'  <div class="col-xs-1"><h5>Date</h5></div>';
                echo'  <div class="col-xs-1"><h5>Branch</h5></div>';
                echo'  <div class="col-xs-1"><h5>Customer</h5></div>';
                echo'  <div class="col-xs-2"><h5>Commodity</h5></div>';
                echo'  <div class="col-xs-2"><h5>Position</h5></div>';
                echo'  <div class="col-xs-2"><h5>Pounds</h5></div>';
                echo'</div> <!--/. grid-header -->';
                    
                echo'<!-- TICKET DATA GRID ROW APPEND HERE --><div id=tickets></div>';
                echo'</div>';
                } else {
                    echo'<div class="col-xs-8 margin-none"><h3>Please login/regiser!</h3>';
                    echo' <div class="form-group">';
                    echo' <button id="register" data-toggle="modal" data-target="#ModalLoginForm" class="mdc-button mdc-button--raised">';
                    echo' <div class="mdc-button__ripple"></div>';
                    echo' <span class="mdc-button__label">register</span>';
                    echo' </button>';
                    echo' </div></div>';
                }
                ?> 
            </div>
        </div> <!-- END APP CONTAINER--> 

        <!-- TICKET WINDOW -->
        <div class="ticket-window panel panel-default" id="myForm">
                <div class="panel-heading">
                    <label class="control-label" for="ticketnumber">Ticket:<input type="text" id="ticketnumber" name="ticketnumber" readonly></label>
                    <button id="closeTicket" onclick="closeForm()" type="button" class="pull-right mdc-button"><i class="material-icons mdc-button__icon">close</i></button>            
                </div>
                <div class="panel-body">
                    <form action="" class="form-horizontal">
                        <div class="form-group">
                            <label class="radio-inline" for="inCheck"><input type="radio" id="inCheck"  name="radios" Checked>IN</label>
                            <label class="radio-inline" for="outCheck"><input type="radio" id="outCheck" name="radios">OUT</label>
                            <label for="ticketDate"><input  class="pull-right" type="date" id="ticketDate" value="">Ticket Date</label>
                        </div>
                        
                        <div class="form-group">
                            <label class="control-label" for="branch">Branch<input type="text" id="branch" name="branch"></label>
                            <label class="control-label" for="customer">Customer<input type="text" id="customer" name="customer"></label>
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="commodity">Commodity<input type="text" id="commodity" name="commodity"></label>
                            <label class="control-label" for="position">Position<input type="text" id="position" name="position"></label>
                        </div>

                        <div class="form-group row">
                            <label class="control-label" for="pounds">Pounds<input type="text" id="pounds" name="pounds"></label>
                        </div>
                        
                        <div class="form-group">
                            <button id="saveBtn" type="button">Save</button>
                            <button id="updBtn" type="button">Update</button>
                            <button id="cancelBtn" type="button" onclick="closeForm()">Cancel</button>
                    </form>
                </div>
                </div class="panel-footer">
                </div>
            </div>
        </div> <!-- /. TICKET WINDOW -->

        <!-- LOGIN/REGISTER MODAL -->
        <div id="ModalLoginForm" class="modal fade">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title">Login</h1>
                    </div>
                    <div class="modal-body">
                        <form role="form">
                            <input type="hidden" name="_token" value="">
                            <div class="form-group">
                                <label class="control-label">Username</label>
                                <div>
                                    <input type="text" class="form-control input-lg" name="username" id="musername" value="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Password</label>
                                <div>
                                    <input type="password" class="form-control input-lg" name="password" id="mpassword">
                                </div>
                            </div>
                            <div class="form-group">
                                <div>
                                    <button type="button" id="mlogin" class="btn btn-success">Login</button>
                                </div>
                            </div>
                        </form>
                        <h1>Register</h1>
                        <form role="form">
                            <input type="hidden" name="_token" value="">
                            <div class="form-group">
                                <label class="control-label">Username</label>
                                <div>
                                    <input id="rusername" type="text" class="form-control input-lg" name="name" value="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Password</label>
                                <div>
                                    <input id="rpassword" type="password" class="form-control input-lg" name="password">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Confirm Password</label>
                                <div>
                                    <input id="rpassword2" type="password" class="form-control input-lg" name="password_confirmation">
                                </div>
                            </div>
                            <div class="form-group">
                                <div>
                                    <button id="register2" type="button" class="btn btn-success">Register</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->   

        <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>
        <script src="https://unpkg.com/material-components-web@latest/dist/material-components-web.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/handlebars@latest/dist/handlebars.js"></script>
        <script src="js/app.js"></script>
    </body>
</html>

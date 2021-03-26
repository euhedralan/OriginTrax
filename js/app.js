
    var $tickets;
    //Ticket Form Fields
    var $ticketnumber;
    var $direction;
    var $outCheck;
    var $date;
    var $branch;
    var $customer;
    var $commodity;
    var $position;
    var $pounds;
    //Main login form
    var $username;
    var $password;
    //Modular login form
    var $musername;
    var $mpassword;
    //Modular register form
    var $rusername;
    var $rpassword;
    var $rpassword2;

$(function (){
    
    $tickets = $('#tickets');
    //Ticket Form Fields
    $ticketnumber = $('#ticketnumber');
    $direction = $('#inCheck');
    $outCheck = $('#outCheck');
    $date = $('#ticketDate');
    $branch = $('#branch');
    $customer = $('#customer');
    $commodity = $('#commodity');
    $position = $('#position');
    $pounds = $('#pounds');
    //Main login form
    $username = $('#username');
    $password = $('#password');
    //Modular login form
    $musername = $('#musername');
    $mpassword = $('#mpassword');
    //Modular register form
    $rusername = $('#rusername');
    $rpassword = $('#rpassword');
    $rpassword2 = $('#rpassword2');

    //Main app button effects
    mdc.ripple.MDCRipple.attachTo(document.querySelector('.mdc-button--raised'));

    //Function to add a ticket row
    function addTicket(ticket){
            
        $tickets.append('<div id="' + ticket.ticketNumber + '" class="gridrow row bg-shade margin-sm">' +
            '<div id="rowdirection" class="col-xs-1"><h5 class="ticketCol">' + ticket.direction + '</h5></div>' +
            '<div id="ticknum" class="col-xs-1"><h5 class="ticketCol">' + ticket.ticketNumber + '</h5></div>' +
            '<div id="rowdate" class="col-xs-1"><h5 class="ticketCol">' + ticket.date + '</h5></div>' +
            '<div id="rowbranch" class="col-xs-1"><h5 class="ticketCol">' + ticket.branch + '</h5></div>' +
            '<div id="rowcustomer" class="col-xs-1"><h5 class="ticketCol">' + ticket.customer + '</h5></div>' +
            '<div id="rowcommodity" class="col-xs-2"><h5 class="ticketCol">' + ticket.commodity + '</h5></div>' +
            '<div id="rowposition" class="col-xs-2"><h5 class="ticketCol">' + ticket.position + '</h5></div>' +
            '<div id="rowpounds" class="col-xs-1"><h5 class="ticketCol">' + ticket.pounds + '</h5></div>' +
            '<div class="col-xs-1"><button name="' + ticket.ticketNumber + '" id="viewticket" type="button"><i class="material-icons mdc-button__icon" aria-hidden="true">zoom_in</i></button></div>' +
            '<div class="col-xs-1"><button name="' + ticket.ticketNumber + '" id="deleteticket" type="button"><i class="material-icons mdc-button__icon" aria-hidden="true">delete</i></button></div>' +
            '</div>'
        );
    };

    //Populate the list of tickets
    $.ajax({
        type: 'POST',
        url: 'gettickets.php',       
        success: function(tickets) {
            $.each(JSON.parse(tickets), function(i, ticket){
                addTicket(ticket);});
        },
        error: function() {
            alert('error populate');
        }
    });
    
    //Ticket search function
    $('#searchbox').onEnter(function(e){
        $tickets.html("");
        var id = $(this).val();
        
        if(id>0){
            var ticketnumber = {
                id: id,
            };

            $.ajax({
                type: 'POST',
                url: 'searchtickets.php',
                data: ticketnumber,
                success: function(ticket) {
                addTicket(JSON.parse(ticket));
                },
                error: function() {
                    alert('error search');
                }
            });
        } else {
            $.ajax({
                type: 'POST',
                url: 'gettickets.php',
                success: function(tickets) {
                    $.each(JSON.parse(tickets), function(i, ticket){
                        addTicket(ticket);
                });
                },
                error: function() {
                    alert('error get');
                }
            });                    
        }
    });


    //New ticket window Save button
    $('#saveBtn').click(function() {
        var dirSelect = "OUT"
        if($('#inCheck').is(':checked')) dirSelect = "IN";

        var newTicket = {
            direction: dirSelect,
            date: $date.val(),
            branch: $branch.val(),
            customer: $customer.val(),
            commodity: $commodity.val(),
            position: $position.val(),
            pounds: $pounds.val()
        };
            
        $.ajax({
            type: 'POST',
            url: 'newticket.php',
            data: newTicket,
            success: function(outputTicket)
            {
                if(outputTicket != null){
                    addTicket(JSON.parse(outputTicket));
                    closeForm();
                } else {
                    alert('null error');
                }
            }, error: function()
            {
                alert('error newticket');
            }
        });
    });

    //Ticket window update button
    $('#updBtn').click(function() {
        var dirSelect = "OUT"
        if($('#inCheck').is(':checked')) dirSelect = "IN";

        var newTicket = {
            ticketnumber: $ticketnumber.val(),
            direction: dirSelect,
            date: $date.val(),
            branch: $branch.val(),
            customer: $customer.val(),
            commodity: $commodity.val(),
            position: $position.val(),
            pounds: $pounds.val()
        };
            
        $.ajax({
            type: 'POST',
            url: 'updateticket.php',
            data: newTicket,
            success: function(outputTicket)
            {
                if(outputTicket != null){
                    closeForm();
                    window.location.reload(false);
                } else {
                    alert('null error');
                }
            }, error: function()
            {
                alert('error update');
            }
        });
    });

    //Enter in password field to login
    $('#password').onEnter(function() {
        var credentials = {
            username: $username.val(),
            password: $password.val(),
        };

        $.ajax({
            type: 'POST',
            url: 'login.php',
            data: credentials,
            success: function(success){
                window.location.reload(false);
            }
        })
    });
    
    //Login button on modular form
    $('#mlogin').click(function() {
        var credentials = {
            username: $musername.val(),
            password: $mpassword.val(),
        };

        $.ajax({
            type: 'POST',
            url: 'login.php',
            data: credentials,
            success: function(success){
                window.location.reload(false);
            }
        })
    });

    //Register button on modular form
    $('#register2').click(function() {
        var credentials = {
            rusername: $rusername.val(),
            rpassword: $rpassword.val(),
        };

        if($rpassword.val() == $rpassword2.val()){
            $.ajax({
                type: 'POST',
                url: 'register.php',
                data: credentials,
                success: function(success){
                    window.location.reload(false);
                }
            })
        }
    }); 

    //View button on each ticket row
    $('body').on('click', '#viewticket', function(e){
        var id = $(this).attr('name');
        
        var data = {
            id: id
        };

        $.ajax({
            type: 'POST',
            url: 'getticket.php',
            data: data,
            success: function(ticket){
                var ticket = new Array();
                ticket = JSON.parse(ticket);
                
                if(ticket.ticketnumber){
                    openForm();
                    $direction.prop('checked', false);
                    $outCheck.prop('checked', false);
                    if(ticket.direction == "OUT") $outCheck.prop('checked', true);
                    else $direction.prop('checked', true);
                    $ticketnumber.val(ticket.ticketnumber);
                    $date.val(ticket.date);
                    $branch.val(ticket.branch);
                    $customer.val(ticket.customer);
                    $commodity.val(ticket.commodity);
                    $position.val(ticket.position);
                    $pounds.val(ticket.pounds);
                    $('#saveBtn').hide();
                    $('#updBtn').show();
                }  
                
            }
        })
    });

        //Delete ticket button on each row
        $('body').on('click', '#deleteticket', function(e){
            var id = $(this).attr('name');
            
            var data = {
                id: id
            };
    
            $.ajax({
                type: 'POST',
                url: 'deleteticket.php',
                data: data,
                success: function(ticket){
                    window.location.reload(false);
                }
            })
        });
});

//Open the ticket window
function openForm() {
    document.getElementById("myForm").style.display = "block";
}

//Close the ticket window
function closeForm() {
    $('#saveBtn').show();
    $('#updBtn').hide();
    document.getElementById("myForm").style.display = "none";
    $direction.prop('checked', false);
    $outCheck.prop('checked', false);   
    $ticketnumber.val('');
    $date.val(new Date().toDateInputValue());
    $branch.val('');
    $customer.val('');
    $commodity.val('');
    $position.val('');
    $pounds.val('');
}

//Utility function to set today's date
Date.prototype.toDateInputValue = (function() {
    var local = new Date(this);
    local.setMinutes(this.getMinutes() - this.getTimezoneOffset());
    return local.toJSON().slice(0,10);
});

//Utility function for onEnter events
(function($) {
    $.fn.onEnter = function(func) {
        this.bind('keypress', function(e) {
            if (e.keyCode == 13) func.apply(this, [e]);    
        });               
        return this; 
     };
})(jQuery);
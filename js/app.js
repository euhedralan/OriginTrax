$(document).ready(function(){
$('#submitBB').click(function(){
    var transaction = $('#transaction').val();
    var branch = $('#branch').val();
    var gross = $('#gross').val();
    var ticket = $('#ticket').val();
    var customer = $('#customer').val();
    var tare = $('#tare').val();
    var reference = $('#reference').val();
    var outCustomer = $('#outCustomer').val();
    var net = $('#net').val();
    var commodity = $('#commodity').val();
    var ticketDate = $('#ticketDate').val();
    var postDate = $('#postDate').val();
    var position = $('#position').val();
    var disperse = $('#disperse').val();
    var factors0 = $('#factors0').val();
    var factors1 = $('#factors1').val();
    var factors2 = $('#factors2').val();
    var factors3 = $('#factors3').val();
    var factors4 = $('#factors4').val();
    var factors5 = $('#factors5').val();
    var factors6 = $('#factors6').val();

    var newDiv = $("<div class='row-fluid margin-y-xs'>" + ticketDate + " - " + commodity + " - " + gross + " LBS - " + disperse + "</div>");
    $('#log').append(newDiv);

    if(disperse == "Limited Storage") {
        a = $('#lstorage').val();
        b = parseInt(gross);
        if (a == "") $('#lstorage').val(b);
        else {
            a = parseInt(a);
            a = a + b;
            $('#lstorage').val(a);
        }
        
    }
    if(disperse == "Holding") {
        a = $('#holding').val();
        b = parseInt(gross);
        if (a == "") $('#holding').val(b);
        else {
            a = parseInt(a);
            a = a + b;
            $('#holding').val(a);
        }
    }
    if(disperse == "Open Storage") {
        a = $('#ostorage').val();
        b = parseInt(gross);
        if (a == "") $('#ostorage').val(b);
        else {
            a = parseInt(a);
            a = a + b;
            $('#ostorage').val(a);
        }
    }
    if(disperse == "Grain Bank") {
        a = $('#bank').val();
        b = parseInt(gross);
        if (a == "") $('#bank').val(b);
        else {
            a = parseInt(a);
            a = a + b;
            $('#bank').val(a);
        }
    }
    if(disperse == "No Storage") {
        a = $('#nostorage').val();
        b = parseInt(gross);
        if (a == "") $('#nostorage').val(b);
        else {
            a = parseInt(a);
            a = a + b;
            $('#nostorage').val(a);
        }
    }
    if(disperse == "Company Owned") {
        a = $('#owned').val();
        b = parseInt(gross);
        if (a == "") $('#owned').val(b);
        else {
            a = parseInt(a);
            a = a + b;
            $('#owned').val(a);
        }
    }
});
});

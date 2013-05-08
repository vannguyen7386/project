

/**
 * @description Show confirm dialog
 * @param {string} message
 * @param {function} fn
 * @returns
 */
function confirmDialog(message, fn){
    if (message === null || message === ''){
        message = "Do you want to perform this task?";
    }
    fn = fn || (function() {});
    var confirm_div = "<div id='dialog-confirm' title='Confirm dialog'></div>";
    $("body").append(confirm_div);
    $( "#dialog-confirm" ).dialog(
    {
        modal: true,
        buttons: {
            "Ok": function(){
                $("div#dialog-confirm").remove();
                $(this).dialog("close");
                fn.call();
            },
            "Cancel": function(){
                $("div#dialog-confirm").remove();
                $(this).dialog("close");
            }
        },
        close: function(){
            $("div#dialog-confirm").remove();
        }
    }).html(message);
}

function show_dialog(title, message, url){
    var fn = arguments[3];
    fn = fn || function(){};
    var dialog_div = "<div id='dialog-modal' title='" + title + "'></div>";
    $(dialog_div).appendTo('body');
    if (url !== '' && url !== null){
        
        $.ajax({
            type: 'GET',
            url: url,
            success: function(html){
                $("#dialog-modal").html(html);
            }
        });
    }
    $( "#dialog-modal" ).dialog({
        modal: true,
        show: {
            effect: "Transfer",
            duration: 200
        },
        hide: {
            effect: "explode",
            duration: 200
        },
        close: function(){
            $("div#dialog-modal").remove();
            fn.call();
        }
    }).html(message); 
}

function show_alert(){
    
}



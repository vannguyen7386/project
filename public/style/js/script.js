/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

var pathname = location.pathname;
var baseURL = pathname.substr(0, pathname.indexOf('/', 1));
function check_and_uncheck_all(id) {
    var _class = '.' + id + '_item';
    id = "#" + id;
    var checked = $(id).prop('checked');
    $(_class).attr('checked', checked);
}

function update(data) {
    for (var x in data) {
        switch (x) {
            case "alert":
                var msg = data[x];
                delete data[x];
                show_dialog('Error', msg, null);
                return;
            default:
                break;
        }
    }

}
(function($) {
    $(document).ready(function() {
        var frm = $('.ajax-form');
        frm.submit(function(event) {
            event.preventDefault();
            $.ajax({
                type: frm.attr('method'),
                url: frm.attr('action'),
                data: frm.serialize(),
                dataType: 'text',
                success: function(data) {
                    try {
                        var json_data = $.parseJSON(data);
                    } catch (e) {
                        show_dialog('Error', data, null, function() {
                            parent.location.href = baseURL + "/user/index";
                        });

                    }
                }
            });
        });
    });
})(jQuery);


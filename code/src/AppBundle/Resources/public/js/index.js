/**
 * Created by raymond on 5/02/2016.
 */
var addNewTaskForm = function() {
    $('#task_new_btn').hide();
    $('#task_new_form').slideDown(500);
};

var closeNewTaskForm = function() {
    $('#task_new_btn').show();
    $('#task_new_form').slideUp(500);
};

var createTask = function() {
    var form_var = $('#task_new_form form');
    var createUrl = form_var.attr('action');
    var form_method = form_var.attr('method');
    var form_data = form_var.serialize();
    $.ajax({
        url: createUrl,
        type: form_method,
        data: form_data,
        dataType: 'json',
        beforeSend: function() {
            $('#loading').removeClass('hide');
        },
        success: function(data) {
            $('#loading').addClass('hide');
            console.log(data);
            $('#task_table_list').append('<tr id="task_list_tr_' + data.id + '"><td>' +
                '<input id="task_' + data.id + '" type="checkbox"  ' + data.checked + ' value="' +  data.status + '" onclick="updateTaskStatus(\'' + data.updateStatusUrl + '\', ' + data.id + '); return false;" /> </td><td>' + data.id + '</td><td>' + data.name + '</td><td>' + data.tag + '</td>' +
                '<td><a href="#" onclick="deleteTask(\'' + data.removeUrl + '\'); return false;" >Remove</a></td></tr>');
            $('#task_new_form form').trigger("reset");
            return false;
        },
        error: function(e) {
            console.log(e);
        }
    });
    return false;
};

var deleteTask = function(deleteUrl) {
    var conf = confirm('Are you sure DELETE this item?');
    if (conf) {
        console.log(deleteUrl);

        $.ajax({
            url: deleteUrl,
            type: 'POST',
            dataType: 'json',
            beforeSend: function() {
                $('#loading').removeClass('hide');
            },
            success: function(data) {
                $('#loading').addClass('hide');
                console.log('#task_list_tr_'+ data.id);
                $('#task_list_tr_'+ data.id).remove();
                return false;
            },
            error: function(e) {
                console.log(e);
            }
        });
    }
    return false;
};

var updateTaskStatus = function(updateUrl, id) {
    var status = $('#task_' + id).val() == 1 ? 0 : 1;
    $.ajax({
        url: updateUrl,
        type: 'POST',
        data: {id: id, status: status},
        dataType: 'json',
        beforeSend: function() {
            $('#loading').removeClass('hide');
        },
        success: function(data) {
            $('#loading').addClass('hide');
            if (status == 1) {
                $('#task_' + data.id).prop('checked', true);
            } else {
                $('#task_' + data.id).prop('checked', false);
            }
            $('#task_' + id).val(status);
            return false;
        },
        error: function(e) {
            console.log(e);
        }
    });
};
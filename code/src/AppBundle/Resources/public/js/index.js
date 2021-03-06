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
    console.log(form_data);
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
            $('#task_table_list').append('<tr><td><input type="checkbox" ' + data.checked + ' value="' +  data.status + '" /> </td><td>' + data.id + '</td><td>' + data.name + '</td><td>' + data.tag + '</td><td>Remove</td></tr>');
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
        $.ajax({
            url: deleteUrl,
            type: 'POST',
            data: '',
            dataType: 'json',
            beforeSend: function() {
                $('#loading').removeClass('hide');
            },
            success: function(data) {
                $('#loading').addClass('hide');
                console.log(data.id);
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

var updateTaskStatus = function(updateUrl) {
    $.ajax({
        url: updateUrl,
        type: 'POST',
        dataType: 'json',
        beforeSend: function() {
            $('#loading').removeClass('hide');
        },
        success: function(data) {
            $('#loading').addClass('hide');
            console.log(data.id);
            $('#task_list_tr_'+ data.id + 'input:checkbox');
            return false;
        },
        error: function(e) {
            console.log(e);
        }
    });
};
/**
 * Created by raymond on 5/02/2016.
 */
var addNewTaskForm = function() {
    $('#task_new_btn').hide();
    $('#task_new_form').slideDown(500);
}

var closeNewTaskForm = function() {
    $('#task_new_btn').show();
    $('#task_new_form').slideUp(500);
}
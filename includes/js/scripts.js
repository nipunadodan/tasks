var icons = {
    'success' : 'la la-check-circle',
    'danger' : 'la la-times-circle',
    'info' : 'la la-info-circle',
    'warning' : 'la la-exclamation-triangle'
};

function responseModal(status, message){
    $('#response-modal .modal-content').attr('class','modal-content border-0 bg-'+status);
    $('#response-modal #response-modal-title').html(status);
    $('#response-modal #response-modal-icon').attr('class', icons[status]);
    $('#response-modal .modal-body').html("<span class=''>"+message.replace(/!/g, "")+"</span>");
    $('#response-modal').modal('toggle');
    if(debug === true)
        console.log(icons[status]);
}

function ajaxDirect(func, serialized, silent='No', method='post', process=func+'-process'){
    if(debug === true)
        console.log('ajax-init~'+process);
    if(silent==='No'){
        var spinner = ' <i class="la la-circle-o-notch la-spin" id="spinner"></i>';
        $('.nav-title').after(spinner);
        $('button, input[type="submit"]').attr('disabled','true');
    }

    $.ajax({
        data: serialized,
        type: method,
        url: site_url + 'ajax.php?process=' + process,
        success: function (response) {
            if(debug === true)
                console.log(response);
            try {
                var json = JSON.parse(response);
            } catch (e) {
                var json = response;
            }
            if(json.status === 'sessionexpired'){
                location.reload();
                return;
            }
            //console.log(func);
            after_functions[func](json);
            if(silent === 'No'){
                $('button, input[type="submit"]').prop("disabled", false);
                $('#spinner').remove();
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            //console.log('AJAX call failed.');
            //console.log(textStatus + ': ' + errorThrown);
        },
        complete: function () {
            //console.log('AJAX call completed');
        }
    });

    return false;
}

/*========================================================================*/

$(document).ready(function () {
    $('#action-menu-wrap').on('click', 'a', function (event) {
        event.preventDefault();

        var thisMenuElem = $(this);
        var menuFunc = thisMenuElem.data('menu-button');
        console.log('menu-action-'+menuFunc+'-triggered');
        before_functions[menuFunc](menuFunc);
    });

    $('form.ajax').on('submit', function (event) {
        event.preventDefault();
        const process = $(this).data('process'); //php process to run
        const callback = $(this).data('callback'); //function to run after the process
        const serializedForm = $(this).serialize();
        const method = $(this).attr('method');
        ajaxDirect(process, serializedForm);
    });
});

/*===================================================*/
var validate = [];
var before_functions = [];
var after_functions = [];

validate['functionNameHere'] = function () {

};

before_functions['functionNameHere'] = function (){

};

after_functions['weather'] = function (json){
    console.log(json);
    $('#weather .api-response').html(json.message);
};

after_functions['login'] = function (json){
    if(json.status == 'success')
        location.reload();
    else
        responseModal('danger', 'Login not successful. lease login again.')
};

after_functions['tasks-list'] = function (json){
    //console.log(json);
    if(json.status == 'success'){
        let tasks = JSON.parse(json.message);
        let table = '';
        $.each(tasks, function (key,val){
            table += '<tr '+val.ID+'>';
            table += '<td>'+val.ID+'</td>';
            table += '<td>'+val.title+'</td>';
            table += '<td>'+val.description+'</td>';
            table += '<td>'+val.category+'</td>';
            table += '<td>'+val.priority+'</td>';
            table += '<td>'+val.status+'</td>';
            table += '<td>'+val.username+'</td>';
            table += '</tr>';
        });
        $('#tasks-list tbody').html(table);
    }else{
        responseModal('danger','No records found');
    }
}

after_functions['task-add'] = function (json){
    if(json.status === 'success'){
        $('.modal').modal('hide')
        responseModal('success',json.message);
        ajaxDirect('tasks-list',{},'No','post','tasks-get-process');
    }else{
        responseModal('danger',json.message);
    }
}
/*=========================================================*/

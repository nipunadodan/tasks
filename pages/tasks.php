<h1 class="">Title</h1>
<button class="btn btn-warning mt-3" id="task-new-btn"><i class="la la-plus"></i> New</button>
<button class="btn btn-sm btn-light mt-3 float-right"><i class="la la-refresh"></i> Refresh</button>

<div class="table-responsive mt-4">
    <table id="tasks-list" class="table table-sm table-hover table-striped text-small">
        <thead>
            <th>ID</th>
            <th>Title</th>
            <th>Description</th>
            <th>Category</th>
            <th>Priority</th>
            <th>Status</th>
            <th>Created by</th>
        </thead>
        <tbody></tbody>
    </table>
</div>

<div id="task-new" style="display: none;">
    <label for="title">Title</label>
    <input name="title" id="title" placeholder="Title" />
    <label for="description">Description</label>
    <textarea name="description" id="description" placeholder="Description"></textarea>
    <label for="category">Category</label>
    <select name="category" id="category">
        <option value="0">Select a category</option>
    </select>
    <label for="type">Type</label>
    <select name="type" id="type">
        <option value="0">Select a type</option>
        <option value="1" selected>Task</option>
        <option value="2">Issue</option>
        <option value="3">Bug</option>
    </select>
    <label for="priority">Priority</label>
    <select name="priority" id="priority">
        <option value="1">Very High</option>
        <option value="2" selected>High</option>
        <option value="3">Low</option>
        <option value="4">Very Low</option>
    </select>
</div>

<script>
ajaxDirect('tasks-list',{},'No','post','tasks-get-process');

$('#task-new-btn').on('click',function (){
    $('div#task-new').appendTo('#formModal .modal-body');
    $('form.modal-form').attr({
        'id': 'task-add',
        'name': 'task-add-form',
        'method': 'post',
        'data-process': 'task-add',
        'data-validation': 'yes'
    });
    $('#formModal #form-modal-title').html('New task');
    $('div#task-new').show();
    $('#formModal').modal('show');
});

</script>

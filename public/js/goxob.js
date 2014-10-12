function submitbutton(pressbutton) {
    $form = jQuery('form[name="adminForm"]' ).first();
    if (pressbutton) {
        $task = $form.find('input[name="task"]').first();
        if($task)
        {
            $task.val(pressbutton);
        }
    }
    if(!!$.prototype.valid)
    {
        if($form.valid())
        {
            $form.submit();
        }
    }
    else{
        $form.submit();
    }
}

function submitForm(selector, url)
{
    $form = $(selector);
    if(url){
        $form.attr('action', url);
    }
    $form.submit();
}

function setLocation(url)
{
    window.location = url;
}

function goBack()
{
    window.history.back();
}

function initMCE(selector)
{
    tinymce.init({
        selector: selector,
        theme: "modern",
        plugins: [
        "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
        "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
        "save table contextmenu directionality emoticons template paste textcolor"
        ],
        'relative_urls': false,
        //content_css: "css/content.css",
        toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | print preview media fullpage | forecolor backcolor emoticons",
        style_formats: [
        {title: 'Bold text', inline: 'b'},
            {title: 'Red text', inline: 'span', styles: {color: '#ff0000'}},
            {title: 'Red header', block: 'h1', styles: {color: '#ff0000'}},
            {title: 'Example 1', inline: 'span', classes: 'example1'},
            {title: 'Example 2', inline: 'span', classes: 'example2'},
            {title: 'Table styles'},
            {title: 'Table row 1', selector: 'tr', classes: 'tablerow1'}
    ]
    });
}

function getProductSource(query, process)
{
    $.ajax({
        url: '/products/ajax-search/'+query,
        type: 'GET',
        dataType: 'JSON',
        success: function(data) {
            items = [];
            map = {};
            $.each(data, function (i, item) {
                items.push(item.name);
                map[item.name] = item;
            });
            process(items);
        }
    });
}

function getCategorySource(query, process)
{
    $.ajax({
        url: '/categories/ajax-search/'+query,
        type: 'GET',
        dataType: 'JSON',
        success: function(data) {
            items = [];
            map = {};
            $.each(data, function (i, item) {
                items.push(item.name);
                map[item.name] = item;
            });
            process(items);
        }
    });
}

function customerSuggestion(inputField, valueField)
{
    $('#'+inputField).typeahead({
        source: function (query, process) {
            $.ajax({
                url: '/admin/customer/customer/ajax-search',
                type: 'GET',
                dataType: 'JSON',
                data: 'term=' + query,
                success: function(data) {
                    items = [];
                    map = {};
                    $.each(data, function (i, item) {
                        var name = item.first_name + ' ' + item.last_name;
                        items.push(name);
                        map[name] = item;
                    });
                    process(items);
                }
            });
        },
        updater: function (item) {
            var customer_id = map[item].customer_id;
            $('#'+valueField).val(customer_id);
            return item;
        }
    });
}

function updateOrderStatus(status)
{
    if(isItemChecked())
    {
        jQuery('#params').val(status);
        submitbutton('updateStatus');
    }
}

function checkAll(checkbox, stub) {
    if (!stub) {
        stub = 'cb';
    }
    if (checkbox.form) {
        var c = 0;
        for (var i = 0, n = checkbox.form.elements.length; i < n; i++) {
            var e = checkbox.form.elements[i];
            if (e.type == checkbox.type) {
                if ((stub && e.id.indexOf(stub) == 0) || !stub) {
                    e.checked = checkbox.checked;
                    c += (e.checked == true ? 1 : 0);
                }
            }
        }
        if (checkbox.form.boxchecked) {
            checkbox.form.boxchecked.value = c;
        }
        return true;
    } else {
        // The old way of doing it
        var f = document.adminForm;
        var c = f.toggle.checked;
        var n = checkbox;
        var n2 = 0;
        for (var i = 0; i < n; i++) {
            var cb = f[stub+''+i];
            if (cb) {
                cb.checked = c;
                n2++;
            }
        }
        if (c) {
            document.adminForm.boxchecked.value = n2;
        } else {
            document.adminForm.boxchecked.value = 0;
        }
    }
}

function isItemChecked()
{
    var n = jQuery( "input[name=cid\\[\\]]:checked" ).length;
    if (n==0){
        alert('Please first make a selection from the list');
        return false;
    }else{
        return true;
    }
}

function deleteItems()
{
    if(isItemChecked())
    {
        if(!confirm("Do you want to delete all selected records?"))
        {
            return false;
        }
        submitbutton('delete');
    }
}

function publishItems()
{
    if(isItemChecked())
    {
        jQuery('#params').val(1);
        submitbutton('publish');
    }
}

function unPublishItems()
{
    if(isItemChecked())
    {
        jQuery('#params').val(0);
        submitbutton('publish');
    }
}

function gridSort(orderBy, orderDir){
    $('#filter_order').val(orderBy);
    $('#filter_order_dir').val(orderDir);
    submitbutton('setFilter');
}

//for grid publish
function listItemTask(id, task, value) {
    var f = document.adminForm;
    var cb = f[id];
    if (cb) {
        for (var i = 0; true; i++) {
            var cbx = f['cb'+i];
            if (!cbx)
                break;
            cbx.checked = false;
        } // for
        cb.checked = true;
        f.boxchecked.value = 1;
        f.params.value = value;
        submitbutton(task);
    }
    return false;
}

function saveSortOrder(task, count)
{
    jQuery('input[name=toggle]').eq(0).trigger('click');
    checkAll(count);

    submitbutton(task);
}



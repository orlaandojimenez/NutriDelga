$(document).ready(function(evt) {
    //Date picker
    if ($.fn.datepicker) {
        $(document).on("click", '[data-rol="datepicker"]', function() {
            $('[data-rol="datepicker"]').datepicker({
                autoclose: true,
                format: "yyyy/mm/dd",
                language: "es"
            });
            $('[data-rol="datepicker"]').attr("autocomplete", "off");
            $('[data-rol="datepicker"]').datepicker('show');
        });
    }
    if ($.fn.DataTable) {
        $('[id^=datatable_]').DataTable({
            paging: true,
            responsive: true,
            lengthChange: false,
            searching: true,
            ordering: true,
            info: true,
            autoWidth: false,
            aoColumnDefs: [{
                bSortable: false,
                aTargets: []
            }]
        });
    }
    $(document).bind("hidden.bs.tab", 'a[data-toggle="tab"]', function(evt) {
        var $tabsContainer = $(evt.target).parent().parent();
        var id = $tabsContainer.attr("id");
        if (id.search("tab_form") > -1) grayap.tabHideForm($(evt.target).attr('href'), $(evt.relatedTarget).attr('href'));
    });
    $(document).on("click", "a[id^=modal_],button[id^=modal_]", function(evt) {
        evt.preventDefault();
        $element = $(this);
        grayap.openModal($element);
    });
    $(document).on("submit", "form[id^=form_modal]", function(evt) {
        evt.preventDefault();
        var $form = $(this);
        grayap.formModal($form);
    });
    $(document).on("click", "a[id^=btn_submit_ajax],button[id^=btn_submit_ajax]", function(evt) {
        evt.preventDefault();
        var $form = $(this).parents("form");
        grayap.submitFormAjax($form);
    });
    $(document).on("click", 'button[data-ingrediente-remove="yes"]', function(evt) {
        evt.preventDefault();
        $(this).parent().parent().fadeOut('500', function() {
            $(this).remove();
            grayap.reindexTableIngredientes();
        });
    });
    $(document).on("click", 'a[data-platillo-remove]', function(evt) {
        evt.preventDefault();
        $(this).parent().fadeOut('500', function() {
            $(this).remove();
            grayap.reindexTablePlatillos();
        });
    });
    $(document).on("click", 'button[data-ingrediente-add]', function(evt) {
        evt.preventDefault();
        var $btnAlimento = $(this);
        var columns = $btnAlimento.parent().parent().find("td");
        var id_alimento = $btnAlimento.attr('data-ingrediente-add');
        var nombre = $(columns[0]).text();
        var kcal = $(columns[1]).text();
        var unidad = $(columns[2]).text();
        grayap.showModalAddIngrediente(id_alimento, nombre, kcal, unidad);
    });
    $(document).on("click", 'button[data-platillo-add]', function(evt) {
        evt.preventDefault();
        var $btnAlimento = $(this);
        var columns = $btnAlimento.parent().parent().find("td");
        var id_platillo = $btnAlimento.attr('data-platillo-add');
        var nombre = $(columns[0]).text();
        var cantidad = $(columns[1]).text();
        var cantidad_calorica = $(columns[2]).text();
        grayap.showModalAddPlatillo(id_platillo, nombre, cantidad, cantidad_calorica);
    });
    $(document).on("submit", "#form_create_update_paciente", function(evt) {
        evt.preventDefault();
        var $form = $(this);
        var dataForm = grayap.getDataForm($form);
        var action = $form.attr('action');
        $.ajax(action, {
            data: dataForm,
            method: 'post'
        }).success(function(response) {
            $modal = $form.parents(".modal.in");
            $modal = $($modal.length != undefined && $modal.length > 0 ? $modal[0] : $modal);
            $modal.empty();
            $modal.append(response);
        });
    });
});
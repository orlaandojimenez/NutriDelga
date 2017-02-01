var grayap = {
    graficas:{},
    params: {
        tabFormError: false
    },
    initChartIntern: function(){
        var $charts = $("div[data-chart]");
        for (var i = 0,char; char = $charts[i]; i++) {
            var $char = $(char);
            var id = $char.attr('id');
            var obj = $char.attr('data-object');
            var type = $char.attr('data-type');
            var chartParams = this.graficas[obj];
            switch(type){
                case 'line' : new Morris.Line(chartParams); break;
                default : new Morris.Line(chartParams);
            }
        }
    },
    initCharts : function(modal=false){
        if(modal){
            setTimeout(function(){grayap.initChartIntern();},500);
        }else{
            this.initChartIntern();
        }
    },
    init: function(params) {
        $(document).on("click", 'button#modalIngredienteEditSave',function(evt){
            evt.preventDefault();
            var $modal = $("#modalIngredienteEdit");
            var id_alimento = $($modal.find("input[name^='PlatilloAlimento['][name$='][id_alimento]']")[0]).val();
            var nombre = $($modal.find("input[name^='PlatilloAlimento['][name$='][nombre]']")[0]).val();
            var kcal = $($modal.find("input[name^='PlatilloAlimento['][name$='][kcal]']")[0]).val();
            var cantidad = $($modal.find("input[name^='PlatilloAlimento['][name$='][cantidad]']")[0]).val();
            var cantidad_calorica = $($modal.find("input[name^='PlatilloAlimento['][name$='][cantidad_calorica]']")[0]).val();
            grayap.tableAddIngrediente(id_alimento, nombre, kcal, cantidad);
            $modal.modal('hide');
        });
        $(document).on("click", 'button#modalPlatilloEditSave',function(evt){
            evt.preventDefault();
            var $modal = $("#modalPlatilloEdit");
            var id_platillo = $($modal.find("input[name^='Dieta['][name$='][id_platillo]']")[0]).val();
            var nombre = $($modal.find("input[name^='Dieta['][name$='][nombre]']")[0]).val();
            var cantidad = $($modal.find("input[name^='Dieta['][name$='][cantidad]']")[0]).val();
            var cantidad_calorica = $($modal.find("input[name^='Dieta['][name$='][cantidad_calorica]']")[0]).val();
            var tipo = $($modal.find("select[name^='Dieta['][name$='][tipo]']")[0]).val();
            var dia = $($modal.find("select[name^='Dieta['][name$='][dia]']")[0]).val();
            grayap.tableAddPlatillo(id_platillo, nombre, cantidad, cantidad_calorica, tipo, dia);
            $modal.modal('hide');
        });
        $(document).on("keyup", "#modalIngredienteEdit input[name^='PlatilloAlimento['][name$='][cantidad]']",function(){
            var $modal = $("#modalIngredienteEdit");
            var kcal = $($modal.find("input[name^='PlatilloAlimento['][name$='][kcal]']")[0]).val();
            var cantidad = $($modal.find("input[name^='PlatilloAlimento['][name$='][cantidad]']")[0]).val();
            var cantidad_calorica = kcal * cantidad;
            $($modal.find("input[name^='Plati3lloAlimento['][name$='][cantidad_calorica]']")[0]).val(cantidad_calorica);
        });
    },
    getDataForm: function($form) {
        var dataForm = {};
        var fields = $form.find("[name]");
        var fields = $form.find("[name]");
        $.each(fields, function(key, field) {
            var $field = $(field);
            var name = $field.attr("name");
            if ($field.is('[type="checkbox"],[type="radiobutton"]')) {
                dataForm[name] = $field.prop('checked');
            } else {
                dataForm[name] = $field.val();
            }
        });
        return dataForm;
    },
    formModal: function($form) {
        var container = $form.attr('data-container');
        $.ajax($form.attr('action'), {
            data: this.getDataForm($form),
            method: 'post'
        }).success(function(response) {
            var $parent = container === undefined ? $form.parent() : $(container);
            $parent.empty();
            $parent.append(response);
        });
    },
    formTab: function($form, targetId, relatedTargetId) {
        if (grayap.params.tabFormError) {
            grayap.params.tabFormError = false;
            return;
        }
        $.ajax($form.attr('action'), {
            data: this.getDataForm($form),
            method: 'post'
        }).success(function(response) {
            var $parent = $form.parent();
            $parent.empty();
            $parent.append(response.html);
            grayap.params.tabFormError = response.error;
            if (response.error) {
                $('[href="' + targetId + '"]').tab('show');
            }
        });
    },
    submitFormAjax: function($form) {
        var container = $form.attr('data-container');
        $.ajax($form.attr('action'), {
            data: this.getDataForm($form),
            method: 'post'
        }).success(function(response) {
            console.log(response);
            var $parent = container === undefined ? $form.parent() : $(container);
            $parent.empty();
            $parent.append(response.html);
        });
    },
    openModal: function($element) {
        var target_modal = "#" + ($element.is('[data-target-modal]') ? $element.attr("data-target-modal") : "modalDefault");
        var url = $element[0].tagName == 'A' ? $element.attr("href") : $element.attr("data-href");
        var size = $element.attr("data-size");
        $target = $(target_modal);
        //$target.empty();
        $target.load(url, function() {
            $target.modal({
                backdrop: "static",
                show: true
            });
            $modalDialog = $target.children();
            if(size == 'lg') $modalDialog.removeClass("modal-sm").addClass("modal-lg");
            else if(size == 'sm') $modalDialog.removeClass("modal-lg").addClass("modal-sm");
            else $modalDialog.removeClass("modal-lg").removeClass("modal-sm");
        });
        //$.ajax(url).success(function(response){
        //    $target.append(response);
        //    $target.modal('show');
        //});
    },
    tabShowForm: function(targetId, relatedTargetId) {
        var $target_tab = $(targetId);
        var $relatedTarget_tab = $(relatedTargetId);
        var $form_target = $target_tab.find("form");
        var $form_relatedTarget = $relatedTarget_tab.find("form");
        this.formTab($form_relatedTarget, tardetId, relatedTargetId);
    },
    tabHideForm: function(targetId, relatedTargetId) {
        var $target_tab = $(targetId);
        var $relatedTarget_tab = $(relatedTargetId);
        var $form_target = $target_tab.find("form");
        var $form_relatedTarget = $relatedTarget_tab.find("form");
        this.formTab($form_target, targetId, relatedTargetId);
    },
    tableAddIngrediente: function(id_alimento, nombre, kcal, cantidad) {
        var $tbodyIngredientes = $("tbody#ingredientes");
        var cantidad_calorica = cantidad * kcal;
        if($tbodyIngredientes.find('tr[data-platillo-alimento="'+id_alimento+'"]').length > 0){
            var $row = $($tbodyIngredientes.find('tr[data-platillo-alimento="'+id_alimento+'"]')[0]);
            var $columns = $row.find("td");
            $($row.find("input[name^='PlatilloAlimento['][name$='][cantidad]']")[0]).val(cantidad);
            $($row.find("input[name^='PlatilloAlimento['][name$='][cantidad_calorica]']")[0]).val(cantidad_calorica);
            $($columns[1]).text(cantidad);
            $($columns[2]).text(cantidad_calorica);
        }else{
            var template =
            '<tr data-platillo-alimento="'+id_alimento+'" style="display:none;">'+
            '    <td>'+
            '       <input type="hidden" value="'+id_alimento+'" name="PlatilloAlimento[0][id_alimento]"/>'+
            '       <input type="hidden" value="'+cantidad+'" name="PlatilloAlimento[0][cantidad]"/>'+
            '       <input type="hidden" value="'+cantidad_calorica+'" name="PlatilloAlimento[0][cantidad_calorica]"/>'+
            '       '+nombre+
            '    </td>'+
            '    <td>'+cantidad+'</td>'+
            '    <td>'+cantidad_calorica+'</td>'+
            '    <td><button type="button" class="btn btn-danger btn-xs" data-ingrediente-remove="yes"><span class="glyphicon glyphicon-remove"></span></button></td>'+
            '</tr>';
            $tbodyIngredientes.append(template);
            $('tr[data-platillo-alimento="'+id_alimento+'"]').fadeIn('500');
            
            //Proceso que suma el numero de calorias de los ingredientes agregados
            var numIngredientesActualesEnTabla = $("#ingredientes").children().length;
            var sumaKal = 0, auxKal = 0;
            $("#ingredientes td:nth-child(3)").each(function(index){
                auxKal = parseFloat($(this).text());
                sumaKal += auxKal;
                }
            );
            
            //Actualiza el codigo de la tabla para que se actualice el numero de calorias
            $( "td#sumaKal" ).replaceWith( "<td id='sumaKal'>"+sumaKal+"</td>" );
            this.reindexTableIngredientes();
        }
    },
    tableAddPlatillo : function (id_platillo, nombre, cantidad, cantidad_calorica, tipo, dia){
        var cells = $("tbody#platillos>tr:nth-child("+(tipo*1+1)+")>td");
        var template = 
        ' <span class="label label-default">'+
        '   <input type="hidden" value="'+id_platillo+'" name="Dieta[0][id_platillo]"/>'+
        '   <input type="hidden" value="'+tipo+'" name="Dieta[0][tipo]"/>'+
        '   <input type="hidden" value="'+dia+'" name="Dieta[0][dia]"/>'+
        '   <input type="hidden" value="'+nombre+'" name="Dieta[0][nombre]"/>'+
        '   <a href="#" data-platillo-remove>'+
        '       <i class="remove glyphicon glyphicon-remove-sign glyphicon-white"></i>'+
        '   </a>'+
        '   '+nombre+
        '</span>';
        $(cells[dia]).append(template);
        
        this.reindexTablePlatillos();
    },
    reindex: function(inputs,index){
        for (var j = 0, input; input = inputs[j]; j++) {
            var name = $(input).attr("name");
            name = name.replace(/\[\d?\]/g, "[" + index + "]");
            $(input).attr("name", name);
        }
    },
    reindexTable: function($rows, array_path, byCells = false) {
        var cByCells = 0;
        for (var i = 0, row; row = $rows[i]; i++) {
            if(byCells){
                var cells = $(row).find("td");
                for (var j = 0, cell; cell = cells[j]; j++) {
                    var inputs = $(cell).find('[name^=' + array_path + ']');
                    if(inputs.length > 0)
                        this.reindex(inputs,cByCells++);
                }
            }else{
                var inputs = $(row).find('[name^=' + array_path + ']');
                this.reindex(inputs,i);
            }
        }
    },
    reindexTableIngredientes: function() {
        var $rows = $("tr[data-platillo-alimento]");
        var array_path = "PlatilloAlimento";
        this.reindexTable($rows, array_path);
    },
    reindexTablePlatillos: function() {
        var $rows = $("#platillos>tr");
        var array_path = "Dieta";
        this.reindexTable($rows, array_path, true);
    },
    showModalAddIngrediente : function(id_alimento,nombre,kcal){
        var $modal = $("#modalIngredienteEdit");
        var $tbodyIngredientes = $("tbody#ingredientes");
        var cantidad = 1, cantidad_calorica = kcal * 1;
        if($tbodyIngredientes.find('tr[data-platillo-alimento="'+id_alimento+'"]').length > 0){
            var $columns = $tbodyIngredientes.find('tr[data-platillo-alimento="'+id_alimento+'"] td');
            cantidad = $($columns[1]).text();
            cantidad_calorica = kcal * cantidad;
        }
        var inputs = $modal.find("input[name^=PlatilloAlimento]");
        $($modal.find("input[name^='PlatilloAlimento['][name$='][id_alimento]']")[0]).val(id_alimento);
        $($modal.find("input[name^='PlatilloAlimento['][name$='][nombre]']")[0]).val(nombre);
        $($modal.find("input[name^='PlatilloAlimento['][name$='][kcal]']")[0]).val(kcal);
        $($modal.find("input[name^='PlatilloAlimento['][name$='][cantidad]']")[0]).val(cantidad);
        $($modal.find("input[name^='PlatilloAlimento['][name$='][cantidad_calorica]']")[0]).val(cantidad_calorica);
        $modal.modal({backdrop: "static", show:true});
    },
    showModalAddPlatillo : function(id_platillo, nombre, cantidad, cantidad_calorica){
        var $modal = $("#modalPlatilloEdit");
        var $tbodyIngredientes = $("tbody#platillos");
        $($modal.find("input[name^='Dieta['][name$='][id_platillo]']")[0]).val(id_platillo);
        $($modal.find("input[name^='Dieta['][name$='][nombre]']")[0]).val(nombre);
        $($modal.find("input[name^='Dieta['][name$='][cantidad]']")[0]).val(cantidad);
        $($modal.find("input[name^='Dieta['][name$='][cantidad_calorica]']")[0]).val(cantidad_calorica);

        $modal.modal({backdrop: "static", show:true});
    }
};
grayap.init();
$(document).ready(function (evt) {
	//Date picker
	if($.fn.datepicker){
        $(document).on("click",'[data-rol="datepicker"]',function(){
            $('[data-rol="datepicker"]').datepicker({
              autoclose: true,
              format : "yyyy/mm/dd",
              language: "es"
            });
            $('[data-rol="datepicker"]').attr("autocomplete","off");
            $('[data-rol="datepicker"]').datepicker('show');
        });
	}
	if($.fn.DataTable){
		$('[id^=table_]').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "aoColumnDefs": [{
                'bSortable': false,
                'aTargets': []
			}]
        });
        console.log("DataTable loaded");
	}
    $(document).on("click", "a[id^=modal_],button[id^=modal_]", function(evt){
        evt.preventDefault();
        $element = $(this);
        var target_modal = "#" + ($element.is('[data-target-modal]') ? $element.attr("data-target-modal") : "modalDefault");
        var url = $element[0].tagName == 'A' ? $element.attr("href") : $element.attr("data-href");
        console.log(url);
        $target = $(target_modal);
        //$target.empty();
        $target.load(url,function(){ $target.modal({backdrop: "static", show : true}); });
        //$.ajax(url).success(function(response){
        //    $target.append(response);
        //    $target.modal('show');
        //});
    });

    function getDataForm($form){
        var dataForm = {};
        var fields = $form.find("[name]");
        var fields = $form.find("[name]");
        $.each(fields,function(key,field){            
            var $field = $(field);
            var name = $field.attr("name");
            if($field.is('[type="checkbox"],[type="radiobutton"]')){
                dataForm[name] = $field.prop('checked');
            }else{
                dataForm[name] = $field.val();    
            }
        });
        return dataForm;
    }

    $(document).on("submit","form[id^=form_modal]", function(evt){
        evt.preventDefault();
        var $form = $(this);
        var dataForm = getDataForm($form);
        var action = $form.attr('action');
        $.ajax(action,{
            data : dataForm,
            method : 'post'
        }).success(function(response){
            var $parent = $form.parent();
            $parent.empty();
            $parent.append(response);
        });
    });

    $(document).on("submit","#form_create_update_paciente", function(evt){
        evt.preventDefault();
        var $form = $(this);
        var dataForm = getDataForm($form);
        var action = $form.attr('action');
        $.ajax(action,{
            data : dataForm,
            method : 'post'
        }).success(function(response){
            $modal = $form.parents(".modal.in");
            $modal = $($modal.length != undefined && $modal.length > 0 ? $modal[0] : $modal);
            $modal.empty();
            $modal.append(response);
        });
    });
});
$(function() {
	$('#save').click(function() {
		$('#action').val('save');
		$('#form1').submit();
	});
	
	$('#cancel').click(function() {
		$('#action').val('cancel');
		$('#form2').submit();
	});
	
	$('#cat').change(function() {
		$.getJSON('getSubCat?id='+$('#cat option:selected').val(),
			function(data) {
				var items = [];
				$.each(data, function(key, obj) {
					items.push('<option value="' + obj.id + '">' + obj.name + '</option>');
				});
				$('#subcat').html(items.join(''));
				$('#subcat').change();
			}
		);
	});
	
	$('#subcat').change(function() {
		//$.post('getMC?catId='+$('#cat option:selected').val()+'&subCatId='+$('#subcat option:selected').val(),
		$('#CheckListDetailForm_newCatId').val($('#cat option:selected').val());
		$('#CheckListDetailForm_newSubCatId').val($('#subcat option:selected').val());
		$.get('getMC', $('#form1').serialize(),
			function(data) {
				$('#detail_content').html(data);
				
				$('#checklist_detail_tailor_make_table tr:last input[name="handMakeMC[question][]"]').click(function() {
					$(this).unbind('click');
					addRow();
				});

				bindCheckbox();
				toggle();
			}
		);
	});
	
	$('#checklist_detail_tailor_make_table tr:last input[name="handMakeMC[question][]"]').click(function() {
		$(this).unbind('click');
		addRow();
	});

	bindCheckbox();
	toggle();
});

function addRow() {
	elem = $('#checklist_detail_tailor_make_table tr:last');
	id = elem.children('td:first').html() * 1 + 1;
	elem.after('<tr>' + elem.html() + '</tr>');
	$('#checklist_detail_tailor_make_table tr:last td:first').html(id); // set row id
	$('#checklist_detail_tailor_make_table tr:last input[name="handMakeMC[question][]"]').click(function() {
		$(this).unbind('click');
		addRow();
	});
}

function toggle() {
	if ($('input:checkbox[name="mc[]"]:not(:checked)').length > 0) {
		$('#checkallmc').attr('checked', false);
	}
	else {
		$('#checkallmc').attr('checked', true);
	}
}

function selectAll() {
	if ($('#checkallmc:checked').length > 0) {
		$('input:checkbox[name="mc[]"]').attr('checked', true);
	}
	else {
		$('input:checkbox[name="mc[]"]').attr('checked', false);
	}
}

function bindCheckbox() {
	$('input:checkbox[name="mc[]"]').click(function() {
		toggle();
	});
}

function goToPage(url) {
	$.get(url+'&'+$('#criteriaForm').serialize(), function(data) {
		$('#pagingDiv').html(data);
		tb_init('a.thickbox, area.thickbox, input.thickbox');
	});
}

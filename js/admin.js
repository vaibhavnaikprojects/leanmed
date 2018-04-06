$(document).ready(function () {
	$("#usersjqGrid").jqGrid({
		styleUI : 'Bootstrap',
		datatype: 'json',
		mtype: 'GET',
		url : 'admin/users',
		editurl: 'admin/editUser',
		colModel: [
		{ label: 'email Id', name: 'emailId', key: true, editable: true, width: 200,editrules : { required: true},edittype:"text"},
		{ label: 'User Name', name: 'userName', editable: true,editrules : { required: true},edittype:"text"},
		{ label: 'User Type', name: 'userType', formatter: statusFormatter},
		{ label: 'status', name: 'status'}
		],
		viewrecords: true,
		height: 300,
		rowNum: 20,
		loadonce: false,
		multiselect: true,
		width: null,
		shrinkToFit: true,
		pager: "#usersjqGridPager"
	});
	function statusFormatter(cellvalue, options, rowObject){
		   if (cellvalue == 1) 
		   	return 'Admin';
		   else if (cellvalue == 2)
		    return 'User';
	}
	$('#usersjqGrid').navGrid('#usersjqGridPager',
		{ edit: true, add: true, del: true, search: true, refresh: false, view: false, position: "left", cloneToTop: true },
		{
			editCaption: "Edit Record",
			recreateForm: true,
			checkOnUpdate : true,
			checkOnSubmit : true,
			closeAfterEdit: true,
			errorTextFormat: function (data) {
				return 'Error: ' + data.responseText
			}
		},
		{
			closeAfterAdd: true,
			recreateForm: true,
			errorTextFormat: function (data) {
				return 'Error: ' + data.responseText
			}
		},
		{
			errorTextFormat: function (data) {
				return 'Error: ' + data.responseText
			}
		});
});
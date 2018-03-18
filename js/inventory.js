$(document).ready(function () {
	$("#itemsjqGrid").jqGrid({
		styleUI : 'Bootstrap',
		datatype: "local",
		editurl: 'editItem',
		colModel: [
		{ label: 'Item Id', name: 'itemId', key: true, width: 200 },
		{ label: 'Item Name', name: 'itemName', editable: true,editrules : { required: true},edittype:"text"},
		{ label: 'Item Type', name: 'itemType', editable: true,editrules : { required: true},edittype:"text"},
		{ label:'Storage', name: 'storage', editable: true,editrules : { required: true},edittype: "text"},
		{ label: 'Room', name: 'room', editable: true,editrules : { required: true},edittype:"text"},
		{ label: 'User Name', name: 'userName', editable: true,editrules : { required: true},edittype:"text"}
		],
		viewrecords: true,
		height: 300,
		rowNum: 20,
		loadonce: true,
		width: null,
		shrinkToFit: true,
		pager: "#itemsjqGridPager"
	});
	$('#itemsjqGrid').navGrid('#itemsjqGridPager',
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

	$("#storagejqGrid").jqGrid({
		styleUI : 'Bootstrap',
		datatype: "local",
		editurl: 'editStorage',
		colModel: [
		{ label: 'Storage Id', name: 'storageId', key: true},
		{ label: 'Storage Name', name: 'storageName',editable: true,editrules : { required: true},edittype:"text"},
		{ label: 'Room', name: 'room',editable: true,editrules : { required: true},edittype:"text"}
		],
		viewrecords: true,
		height: 300,
		rowNum: 20,
		loadonce: true,
		width: null,
		shrinkToFit: true,
		pager: "#storagejqGridPager"
	});
	$('#storagejqGrid').navGrid('#storagejqGridPager',
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

	$("#roomsjqGrid").jqGrid({
		styleUI : 'Bootstrap',
		datatype: "local",
		editurl: 'editRoom',
		colModel: [
		{ label: 'Room Id', name: 'roomId', key: true, width: 300 },
		{ label: 'Room Name', name: 'roomName', width: 300 ,editable: true,editrules : { required: true},edittype:"text"},
		{ label: 'Room Description', name: 'roomDesc', width: 300 ,editable: true,editrules : { required: true},edittype:"text"}
		],
		viewrecords: true,
		height: 300,
		rowNum: 20,
		loadonce: true,
		width: null,
		shrinkToFit: true,
		pager: "#roomsjqGridPager"
	});
	$('#roomsjqGrid').navGrid('#roomsjqGridPager',
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
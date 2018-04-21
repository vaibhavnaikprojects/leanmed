$(document).ready(function () {
	frequentCall();
	$("#search").autocomplete({
      source: "home/getActiveItems",
      minLength: 2,
      focus: function( event, ui ) {
            $( "#search" ).val( ui.item.itemName );
            return false;
      },
      select: function( event, ui ) {
      	$('#searchResults').show();
        $( "#itemName" ).html( ui.item.itemName );
        $( "#itemType" ).html( ui.item.itemType );
        $( "#itemDesc" ).html( ui.item.itemDesc );
        $( "#storageLoc" ).html( ui.item.storageName );
        $( "#roomName" ).html( ui.item.roomName );
        $( "#updatedBy" ).html( ui.item.userName );
        $.ajax({
		type: "get",
		url: "home/addFrequency?itemId="+ui.item.itemId,
		success: function(data){
		}
		});
        return false;
      }
    }).autocomplete( "instance" )._renderItem = function( ul, item ) {
      return $( "<li>" )
        .append( "<div><b> Item Name: " + item.itemName + "</b><br> Location: " + item.storageName + ", "+item.roomName+"</div>" )
        .appendTo( ul );
    };
    setInterval( frequentCall, 10000 );
});

function frequentCall(){
	$('#spinner').show();
	$.ajax({
		type: "get",
		url: "home/frequentItems",
		success: function(data){
			$('#spinner').hide();
			$('#frequentDiv').html('');
			console.log(data);
			for(var i=0;i<data.length;i++){
				var row='<div class="panel panel-primary"><div class="panel-heading"><b>'+data[i].itemName+'</b> ('+data[i].itemType+' item)</div><div class="panel-body">'+
					'<div class="row">'+
						'<div class="col-sm-12"><b>Item Description :</b> '+data[i].itemDesc+'</div>'+
					'</div>'+
					'<div class="row">'+
						'<div class="col-sm-12"><b>Item Location :</b> '+data[i].storageName+', '+data[i].roomName+'</div>'+
					'</div>'+
					'<div class="row">'+
						'<div class="col-sm-12"><b>Updated By :</b> '+data[i].userName+'</div>'+
					'</div>'+
				'</div></div>';
				$('#frequentDiv').append(row);
			}
		}
	});
}
$('#refresh').on('click',function(){
	frequentCall();
});


<div class="container-fluid">
	<div class="row">
		<div class="col-lg-12">
			<ul class="nav nav-tabs nav-justified">
				<li role="presentation" class="active"><a  data-toggle="tab" href="#items">Items</a></li>
				<li role="presentation"><a data-toggle="tab" href="#storage">Storage</a></li>
				<li role="presentation"><a data-toggle="tab" href="#rooms">Rooms</a></li>
			</ul>
			<div class="tab-content">
				<div id="items" class="tab-pane fade in active">
					<div class="panel panel-primary">
						<div class="panel-body">
							<table id="itemsTable" class="table table-striped table-bordered" style="width:100%">
								<thead>
						            <tr>
						                <th>User Name</th>
						                <th>Email ID</th>
						                <th>Actions</th>
						            </tr>
						        </thead>
						        <tbody>
						        	<tr>
						        		<td></td>
						        		<td></td>
						        		<td></td>
						        	</tr>
						        </tbody>
							</table>
						</div>
					</div>
				</div>
				<div id="storage" class="tab-pane fade">
					<div class="panel panel-primary">
						<div class="panel-body">
							<table id="storageTable" class="table table-striped table-bordered" style="width:100%">
								<thead>
						            <tr>
						                <th>User Name</th>
						                <th>Email ID</th>
						                <th>Actions</th>
						            </tr>
						        </thead>
						        <tbody>
						        	<tr>
						        		<td></td>
						        		<td></td>
						        		<td></td>
						        	</tr>
						        </tbody>
							</table>
						</div>
					</div>
				</div>
				<div id="rooms" class="tab-pane fade">
					<div class="panel panel-primary">
						<div class="panel-body">
							<table id="roomsTable" class="table table-striped table-bordered" style="width:100%">
								<thead>
						            <tr>
						                <th>User Name</th>
						                <th>Email ID</th>
						                <th>Actions</th>
						            </tr>
						        </thead>
						        <tbody>
						        	<tr>
						        		<td></td>
						        		<td></td>
						        		<td></td>
						        	</tr>
						        </tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
	<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery-3.3.1.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>js/bootstrap.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>js/datatables.min.js"></script>
	<script type="text/javascript">
        $(function() {
          var hash = document.location.hash;
          if (hash) {
            $('.nav-tabs a[href='+hash+']').tab('show');
          }
          $('a[data-toggle="tab"]').on('show.bs.tab', function (e) {
            window.location.hash = e.target.hash;
          });
        });
        $(document).ready(function() {
		    $('#itemsTable').DataTable();
		    $('#storageTable').DataTable();
		    $('#roomsTable').DataTable();
		    $(".nav").find(".nav-active").removeClass("nav-active");
			$('#inventoryHeader').addClass("nav-active");
		});
    </script>
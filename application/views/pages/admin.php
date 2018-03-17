<div class="container-fluid">
	<div class="row">
		<div class="col-lg-12">
			<ul class="nav nav-tabs nav-justified">
				<li role="presentation" class="active"><a  data-toggle="tab" href="#approvals">Manage Approvals</a></li>
				<li role="presentation"><a data-toggle="tab" href="#users">Manage Users</a></li>
			</ul>
			<div class="tab-content">
				<div id="approvals" class="tab-pane fade in active">
					<div class="panel panel-primary">
						<div class="panel-body">
							<table id="approvalsTable" class="table table-striped table-bordered" style="width:100%">
								<thead>
						            <tr>
						                <th>Item</th>
						                <th>Storage Place</th>
						                <th>Room</th>
						                <th>Updated By</th>
						                <th>Actions</th>
						            </tr>
						        </thead>
						        <tbody>
						        	<tr>
						        		<td></td>
						        		<td></td>
						        		<td></td>
						        		<td></td>
						        		<td></td>
						        	</tr>
						        </tbody>
							</table>
						</div>
					</div>
				</div>
				<div id="users" class="tab-pane fade">
					<div class="panel panel-primary">
						<div class="panel-body">
							<table id="usersTable" class="table table-striped table-bordered" style="width:100%">
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
		    $('#usersTable').DataTable();
		    $('#approvalsTable').DataTable();
		    $(".nav").find(".nav-active").removeClass("nav-active");
			$('#adminHeader').addClass("nav-active");
		});
    </script>
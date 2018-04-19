<div class="container-fluid">
	<div class="row">
		<div class="col-sm-8 col-md-8  col-lg-8">
			<div class="panel panel-primary">
				<div class="panel-body">
					<div class="ui-widget">
						<input class="form-control" id="search" name="search" placeholder="Search Item" />
					</div>
				</div>
			</div>
			<div id="searchResults" class="panel panel-primary" style="display: none;">
				<div class="panel-heading">Search Results</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-sm-3"><b>Item Name :</b></div>
						<div id="itemName" class="col-sm-9"></div>
					</div>
					<div class="row">
						<div class="col-sm-3"><b>Item Type :</b></div>
						<div id="itemType" class="col-sm-9"></div>
					</div>
					<div class="row">
						<div class="col-sm-3"><b>Item Description :</b></div>
						<div id="itemDesc" class="col-sm-9"></div>
					</div>
					<div class="row">
						<div class="col-sm-3"><b>Item Location :</b></div>
						<div id="storageLoc" class="col-sm-9"></div>
					</div>
					<div class="row">
						<div class="col-sm-3"><b>Room Name :</b></div>
						<div id="roomName" class="col-sm-9"></div>
					</div>
					<div class="row">
						<div class="col-sm-3"><b>Updated By :</b></div>
						<div  id="updatedBy" class="col-sm-9"></div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-sm-4 col-md-4 col-lg-4">
			<div class="panel panel-primary" style="height: 480px; overflow-y: auto;">
				<div class="panel-heading" style="padding-bottom: 0px;padding-top: 0px;">
				<div class="row">
					<div class="col-sm-9 col-md-9 col-lg-9" style="padding-top: 8px;">Frequent Results <span id="spinner" style="display: none;"> Loading</span></div>
					<div class="col-sm-3 col-md-3 col-lg-3" style="padding: 0px; text-align: right;"><button type="button" class="btn btn-default" id="refresh"><span class="glyphicon glyphicon-refresh" aria-hidden="true"></span></button></div>
				</div>
				</div>
				<div id="frequentDiv" class="panel-body">
				</div>
			</div>
		</div>
	</div>
</div>
	<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery-3.3.1.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery-ui.min.js"></script>	
	<script type="text/javascript" src="<?php echo base_url(); ?>js/bootstrap.min.js"></script>	

	<script type="text/javascript">
        $(document).ready(function() {
		    $(".nav").find(".nav-active").removeClass("nav-active");
			$('#lookupHeader').addClass("nav-active");
		});
    </script>
    <script type="text/javascript" src="<?php echo base_url(); ?>js/home.js"></script>
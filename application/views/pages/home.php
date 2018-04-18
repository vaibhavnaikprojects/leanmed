<div class="container-fluid">
	<div class="row">
		<div class="col-sm-12 col-md-8 col-md-offset-2 col-lg-8 col-lg-offset-2">
			<div class="panel panel-primary">
				<div class="panel-body">
					<form class="form-horizontal" method="post" action="home/searchItem">
						<div class="col-md-10">
							<input list="items" class="form-control" id="search" name="search" placeholder="Search Item" />
						</div>
							<button class="btn btn-primary" type="submit" name="searchBtn" id="searchBtn" value="Search">Search</button>
					</form>
				</div>
			</div>
			<div class="panel panel-primary">
				<div class="panel-heading">Search Results</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-sm-6">Item Name :</div>
						<div class="col-sm-6"><?php echo $this->session->flashdata('ItemName'); ?></div>
					</div>
					<div class="row">
						<div class="col-sm-6">Item Type :</div>
						<div class="col-sm-6"><?php echo $this->session->flashdata('ItemType'); ?></div>
					</div>
					<div class="row">
						<div class="col-sm-6">Item Description :</div>
						<div class="col-sm-6"><?php echo $this->session->flashdata('ItemDesc'); ?></div>
					</div>
					<div class="row">
						<div class="col-sm-6">Item Location :</div>
						<div class="col-sm-6"><?php echo $this->session->flashdata('ItemLoc'); ?></div>
					</div>
					<div class="row">
						<div class="col-sm-6">Room Name :</div>
						<div class="col-sm-6"><?php echo $this->session->flashdata('RoomName'); ?></div>
					</div>
					<div class="row">
						<div class="col-sm-6">Updated By :</div>
						<div class="col-sm-6"><?php echo $this->session->flashdata('UpdatedBy'); ?></div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery-3.3.1.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>js/bootstrap.min.js"></script>	
	<script type="text/javascript">
        $(document).ready(function() {
		    $(".nav").find(".nav-active").removeClass("nav-active");
			$('#lookupHeader').addClass("nav-active");
		});
    </script>
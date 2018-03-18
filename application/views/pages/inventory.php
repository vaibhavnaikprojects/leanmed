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
							<table id="itemsjqGrid"></table>
		    				<div id="itemsjqGridPager"></div>
						</div>
					</div>
				</div>
				<div id="storage" class="tab-pane fade">
					<div class="panel panel-primary">
						<div class="panel-body">
							<table id="storagejqGrid"></table>
		    				<div id="storagejqGridPager"></div>
						</div>
					</div>
				</div>
				<div id="rooms" class="tab-pane fade">
					<div class="panel panel-primary">
						<div class="panel-body">
							<table id="roomsjqGrid"></table>
		    				<div id="roomsjqGridPager"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
	<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery-3.3.1.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>js/bootstrap.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>js/grid.locale-en.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.jqGrid.js"></script>
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
		    $.jgrid.defaults.width = '100%';
		    $(".nav").find(".nav-active").removeClass("nav-active");
			$('#inventoryHeader').addClass("nav-active");
		});
    </script>
    <script type="text/javascript" src="<?php echo base_url(); ?>js/inventory.js"></script>
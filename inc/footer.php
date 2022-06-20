<!-- Footer_Open -->
<section class="last" style="text-align: center; padding-top: 10px; background: green; ">
     
    <div class="footer-widget">
			<div class="container-fluid">
				<div class="row">
					<div class="col-sm-5">
						<div class="single-widget">
                            <h2>Administrator</h2>
                            <?php 
                                $user = new User;
                                $all_user = $user->getUserByType('admin');
                                if($all_user){
                                    foreach($all_user as $key=>$value){
                                        ?>                     
                                      
                                            <ul class="nav nav-pills nav-stacked">
                                                
                                                    <li><i class="fa fa-user">&nbsp;<?php echo $value->full_name ?></i></li>
                                                    <li>&nbsp;&nbsp;</li>   
                                                    <li><i class="fa fa-envelope">&nbsp;<?php echo $value->email ?></i></li>                                            
                                                
                                		    </ul>
                                                                                      
                                      
                                                                              
                                        <?php
                                    }
                                }
                            ?>
							
						</div>
					</div>
					<div class="col-sm-4">
						<div class="single-widget">
							<h2>Reporter</h2>
							<?php 
                                $user = new User;
                                $all_user = $user->getUserByType('reporter');
                                if($all_user){
                                    foreach($all_user as $key=>$value){
                                        ?>                     
                                      
                                            <ul class="nav nav-pills nav-stacked">
                                                
                                                    <li><i class="fa fa-user">&nbsp;<?php echo $value->full_name ?></i></li>
                                                    <li>&nbsp;&nbsp;</li>   
                                                    <li><i class="fa fa-envelope">&nbsp;<?php echo $value->email ?></i></li>                                            
                                                
                                		    </ul>
                                                                                      
                                      
                                                                              
                                        <?php
                                    }
                                }
                            ?>
						</div>
					</div>
					
					<div class="col-sm-3">
						<div class="single-widget">
							<h2 class="text-center">About Us</h2>
							<ul class="nav nav-pills nav-stacked">
                                <li>@SunauloKhabar.com</li>
                                <li><i class="fa fa-envelope"></i>sunaulokhabar@gmail.com</li>
                                <li>@Bngalachuli-5, Dang</li>
							</ul>
						</div>
					</div>
										
				</div>
			</div>
		</div>	
		
    </div>
		



    
    <div class="container pt-2 " style="padding-bottom: 10px;">
        copyright© <?php echo date('Y') ?> SunauloKhabar.com©BSc.CSIT Group 
    </div>
</section>
<!-- Footer_Closed -->


<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="<?php echo JS_URL; ?>/jquery-3.3.1.min.js" ></script>
<script src="<?php echo JS_URL; ?>/popper.js" ></script>
<script src="<?php echo JS_URL; ?>/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo JS_URL; ?>/script.js"></script>
<script src="<?php echo JS_URL; ?>/wow.min.js"></script>

<script>
    new WOW().init();
</script>

<!-- Go to www.addthis.com/dashboard to customize your tools -->
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5e43cbed40c74044"></script>

</body>

</html>
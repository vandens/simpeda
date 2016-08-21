
									<div class="col-sm-8">
										<h3 class="header smaller lighter red">Kegiatan</h3>
										
										    <!-- Carousel ================================================== -->
											    <div id="myCarousel" class="carousel slide" data-ride="carousel">
											      <!-- Indicators -->
											      <ol class="carousel-indicators">
											        <li data-target="#myCarousel" data-slide-to="1" class="active"></li>
											        <li class="" data-target="#myCarousel" data-slide-to="2"></li>
											        <li class="" data-target="#myCarousel" data-slide-to="3"></li>
											      </ol>
											      <div class="carousel-inner" role="listbox">


											      	<?php 
											      	$no = 1;
											      	$English = array('1'=>'first','2'=>'second','3'=>'third','4'=>'forth','5'=>'fifth');
											      	foreach ($album as $key){
											      	$aktif = ($no ==1) ? 'active' : ''; 
											      	?>
              
											      	
											        <div class="item <?php echo $aktif; ?>">
											          <img class="<?php echo $English[$no]; ?>-slide" src="<?php echo base_url('media/album/'.$key->alb_id.'/'.$key->alb_filename); ?>" alt="<?php echo $key->alb_desc; ?>">
											          <div class="container">
											            <div class="carousel-caption">
											              <p><?php echo $key->alb_desc; ?></p>
											            </div>
											          </div>
											        </div>
											        <?php
											        $no++;
											        } ?>
											        


											        
											      <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
											        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
											        <span class="sr-only">Previous</span>
											      </a>
											      <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
											        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
											        <span class="sr-only">Next</span>
											      </a>
											    </div><!-- /.carousel -->
											</div>

									</div><!-- /.col -->

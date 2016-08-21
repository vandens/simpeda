				<div class="widget-box transparent">
					<div class="widget-header widget-header-small">
					<h4 class="widget-title smaller">
						<i class="ace-icon fa fa-users bigger-110"></i>
							<?php echo $sub; ?>
					</h4>

					<div class='pull-right'>	
						<a data-rel='tooltip' href='javascript:history.back()' class='btn btn-success btn-white btn-round btn-sm fa fa-arrow-left'  title='Kembali' data-placement='bottom'></a>
						<a data-rel='tooltip' href='<?php echo base_url('keluarga/cetak/'.$this->uri->segment(3)); ?>' target='_blanks' class='btn btn-success btn-white btn-round btn-sm fa fa-print'  title='Cetak Kartu Keluarga Sementara' data-placement='left'></a>
					</div>
					</div>
					<div class="widget-body">
						<div class="widget-main">		
							<table class="table display responsive " cellspacing="0" width="100%">
								<thead>
									<tr>
										<th>Nama Lengkap</th>
										<th>No KTP</th>
										<th>L/P</th>
										<th>Peran</th>
										<th>Tempat, Tgl Lahir</th>
										<th>Agama</th>
										<th>Pendidikan</th>	
										<th>Pekerjaan </th>	
									</tr>
									<?php 
									if(count($card) > 0){
										foreach($card as $row){ ?>
										<tr>
											<td><?php echo $row->resident_name; ?></td>
											<td><?php echo $row->resident_no; ?></td>
											<td><?php echo $row->resident_sex; ?></td>
											<td><?php echo $row->resident_fm_role; ?></td>
											<td><?php echo $row->resident_bplace.', '.date('d M Y',strtotime($row->resident_bday)); ?></td>
											<td><?php echo $row->resident_religion; ?></td>
											<td><?php echo $row->resident_education; ?></td>	
											<td><?php echo $row->resident_job; ?></td>	
										</tr>
										<?php } 
									}else{
										echo '<tr><td colspan="7">No Data</td></tr>';
									}?>
								</thead>
							</table>		
								
						</div>
					</div>
				</div>				
				
				
				
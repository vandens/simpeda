<div class="widget-box transparent">
	<div class="widget-header widget-header-flat widget-header-small">
		<h4 class="widget-title blue smaller">
			<i class="ace-icon fa fa-info-circle orange"></i>
			<?php echo $title; ?>
		</h4>
        <!--
		<div class="widget-toolbar action-buttons">													
			<a data-action="collapse" href="#">
				<i class="ace-icon fa fa-chevron-up"></i>
			</a>
		</div>
    -->
	</div>
	<div class="widget-body">
	<div class="widget-main padding-12">
		<?php 
        if($sql->num_rows() > 0){

        echo "<div class='row'>";
            foreach ($sql->result() as $info) {
                $c  = str_replace('"', "'", $info->info_content);
                $content = preg_replace("/<img[^>]+\>/i", "(image) ", $info->info_content);             

                echo "<div class='col-sm-3'><img src='../media/album/2/1434190827-Penyaluran-dan-Penggunaan-Dana-Desa.jpg' width='225px' height='125px'></div>";
                echo "<div class='col-sm-9' style='text-align:justify'>";
                echo "<a href='".base_url('admin/info/'.$info->info_id)."'><b>".$info->info_title."</b></a>";
                echo substr($content,0,300).'... <a href="'.base_url('admin/info/'.$info->info_id).'">Selengkapnya</a>';
                echo "<br><br></div>";

            }
        echo "</div>";

        }else{
            echo '<h4 class="center">=== Tidak Ada Informasi Terbaru ===</h4>';
        }
        ?>
	</div>
	</div>
</div>

<script>

function cek_img(str){
   // var post = "<div>This is an image <img src='abcd.jpg' /> and this is a paragraph <p>hi there</p> Here we have another image <img src='pqrs.jpg' /></div>";
    var firstimg = $(str).find('img:first').attr('src');
    alert(firstimg);
}
</script>
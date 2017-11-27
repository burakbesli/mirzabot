<?php
error_reporting(7);
set_time_limit(0);
require("../wp-config.php");
$db = new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
$db->set_charset(DB_CHARSET);
require("config.php");
?>
<!DOCTYPE html>
<html lang="tr-TR">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>MirzaBot</title>
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/starter-template.css" rel="stylesheet">
  </head>
  <body>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
      <a class="navbar-brand" href="index.php">MirzaBot</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <a class="nav-link" href="index.php?bot=webtekno">Webtekno</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="index.php?bot=pchocasi">PC Hocası</a>
		  </li>
		  <li class="nav-item">
            <a class="nav-link" href="index.php?bot=sd">ShiftDelete</a>
          </li>
           <li class="nav-item">
            <a class="nav-link" href="index.php?bot=teknolojioku">Teknoloji Oku</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="index.php?bot=chip">Chip Online TR</a>
          </li>
        </ul>
      </div>
    </nav>
    <div class="container">
    <div class="starter-template">

	<?php
	switch($_GET['bot']){
	default;
		echo '<div class="alert alert-secondary" role="alert"><h1>MirzaBot Teknoloji Haber Botu</h1></div>';
		echo "<p class='lead'></p>";
	?>
		<div class="row">
				<div class="col-md-2">
				<div class="card text-white bg-secondary mb-3">
				  <div class="card-header">MirzaBot</div>
				  <div class="card-body">
				    <p class="card-text">Basitçe tüm metinleri sitenize çekin ya da api entegre ederek özgünleştirin.</p>
				  </div>
				</div>	
			</div>
			<div class="col-md-2">
				<div class="card text-white bg-danger mb-3">
				  <div class="card-header">Webtekno</div>
				  <div class="card-body">
				    <h4 class="card-title">Haber Botu</h4>
				  </div>
				</div>	
			</div>
			<div class="col-md-2">
				<div class="card text-white bg-primary mb-3">
				  <div class="card-header">PC Hocası</div>
				  <div class="card-body">
				     <h4 class="card-title">Haber Botu</h4>
				  </div>
				</div>	
			</div>
			<div class="col-md-2">
				<div class="card text-white bg-warning mb-3">
				  <div class="card-header">ShiftDelete</div>
				  <div class="card-body">
				     <h4 class="card-title">Haber Botu</h4>
				  </div>
				</div>	
			</div>
			<div class="col-md-2">
				<div class="card text-white bg-info mb-3">
				  <div class="card-header">Teknoloji Oku</div>
				  <div class="card-body">
				     <h4 class="card-title">Haber Botu</h4>
				  </div>
				</div>	
			</div>
			<div class="col-md-2">
				<div class="card text-white bg-dark mb-3">
				  <div class="card-header">Chip Online</div>
				  <div class="card-body">
				     <h4 class="card-title">Haber Botu</h4>

				  </div>
				</div>	
			</div>
		</div>
	<?php		

	break;

	case "webtekno";

		echo '<div class="alert alert-danger" role="alert"><h1>MirzaBot Teknoloji Haber Botu / webtekno.com</h1></div>';
		echo '<form  action="index.php?bot=webtekno" method="get">';
		echo '<label for="basic-url">Çekeceğiniz Haberin Urlsini Giriniz</label>';
		echo '<div class="input-group">';
	  	echo '<span class="input-group-addon" id="basic-addon3">https://www.webtekno.com/link.html gibi ...</span>';
	  	echo '<input type="text" class="form-control" id="url" name="url" aria-describedby="basic-addon3" />';
	  	echo '<input type="hidden" name="bot" value="webtekno" />';
		echo '</div>';
		echo '<br />';
		echo '<button type="submit" class="btn btn-danger">Haberi Çek</button>';
		echo '</form>';
		echo '<br />';
		echo '<br />';

		if(isset($_GET['url']))
		{

			$Url = $_GET['url'];
			$sql = array();
			$bot = $fnc->b0t($Url);

			$resim = $fnc->prego('<meta name="twitter:image" content="','"',$bot);
			$resim = strip_tags($resim);
			$resim = $fnc->temizlik($resim);

			$baslik = $fnc->prego('<meta property="og:title" content="','"',$bot);
			$baslik = strip_tags($baslik);
			$baslik = $fnc->temizlik($baslik);


			$icerik = $fnc->prego('<div class="content-body__detail" itemprop="articleBody">','<div class="bottom-new-video"></div>',$bot);

			$gereksiz = $fnc->prego("<script type='text/javascript'>", "</script>", $icerik);
			$gereksiz2 = $fnc->prego("<script>", "</script>", $icerik);

			$icerik = str_replace([$gereksiz,$gereksiz2,"(",")"],"",$icerik);
			$icerik = strip_tags($icerik);
			$icerik = $fnc->temizlik($icerik);


			$etiket = $fnc->prego('<b>Etiketler: </b>','</div>',$bot);
			$etiket = strip_tags($etiket);
			$etiket = $fnc->temizlik($etiket);
			
			echo " <strong>Konu :</strong>  {$baslik}  <hr/>";
			echo " <strong>Resim :</strong>  {$resim}  <hr/>";
			echo " <strong>İçerik :</strong> {$icerik} <hr/> ";
			echo " <strong>Etiket :</strong> {$etiket} <hr/> ";
			
	        $resim = str_replace("https://","http://",$resim);
			$resimName = time()."-".rand(123456,98765).".jpg";

	        $content = file_get_contents($resim);
	        $fp = fopen(ABSPATH . "wp-content/uploads/2017/11/".$resimName, "w");
	        fwrite($fp, $content);
	        fclose($fp);

			$filename = ABSPATH . "wp-content/uploads/2017/11/$resimName";


	        $my_post = array();
	        $my_post['post_title'] = $baslik;
	        $my_post['post_content'] = $icerik;
	        $my_post['post_status'] = 'publish';
	        $my_post['post_author'] = 1;
	        $my_post['post_category'] = array(1);
	        $my_post['tags_input'] = $etiket;

	        remove_filter('content_save_pre', 'wp_filter_post_kses');
	        remove_filter('content_filtered_save_pre', 'wp_filter_post_kses');

	        $post_id = wp_insert_post( $my_post);

	        $parent_post_id = $post_id;
	        $filetype = wp_check_filetype( basename( $filename ), null );
	        $wp_upload_dir = wp_upload_dir();

	        $attachment = array(
	            'guid'           => $wp_upload_dir['url'] . '/' . basename( $filename ),
	            'post_mime_type' => $filetype['type'],
	            'post_title'     => preg_replace( '/\.[^.]+$/', '', basename( $filename ) ),
	            'post_content'   => '',
	            'post_status'    => 'inherit'
	        );

	        $attach_id = wp_insert_attachment( $attachment, $filename, $parent_post_id );
	        require_once( ABSPATH . 'wp-admin/includes/image.php' );
	        $attach_data = wp_generate_attachment_metadata( $attach_id, $filename );
	        wp_update_attachment_metadata( $attach_id, $attach_data );
	        set_post_thumbnail( $parent_post_id, $attach_id );

	        $attach_id = get_post_meta($post_id, "_thumbnail_id", true);
	        add_post_meta($post_id, '_thumbnail_id', $attach_id);
			
	

		}
	break;

	case "pchocasi";

		echo '<div class="alert alert-primary" role="alert"><h1>MirzaBot Teknoloji Haber Botu / pchocasi.com.tr</h1></div>';
		echo '<form  action="index.php?bot=pchocasi" method="get">';
		echo '<label for="basic-url">Çekeceğiniz Haberin Urlsini Giriniz</label>';
		echo '<div class="input-group">';
	  	echo '<span class="input-group-addon" id="basic-addon3">https://www.pchocasi.com.tr/link gibi ...</span>';
	  	echo '<input type="text" class="form-control" id="url" name="url" aria-describedby="basic-addon3" />';
	  	echo '<input type="hidden" name="bot" value="pchocasi" />';
		echo '</div>';
		echo '<br />';
		echo '<button type="submit" class="btn btn-primary">Haberi Çek</button>';
		echo '</form>';
		echo '<br />';
		echo '<br />';

		if(isset($_GET['url']))
		{

			$Url = $_GET['url'];
			$sql = array();
			$bot = $fnc->b0t($Url);

			$resim = $fnc->prego('<meta name="twitter:image" content="','"',$bot);
			$resim = strip_tags($resim);
			$resim = $fnc->temizlik($resim);

			$baslik = $fnc->prego('<meta property="og:title" content="','"',$bot);
			$baslik = strip_tags($baslik);
			$baslik = $fnc->temizlik($baslik);


			$icerik = $fnc->prego('<!--.singlereklam-->','<!--.singlepage4-->',$bot);
			$icerik = strip_tags($icerik);
			$icerik = $fnc->temizlik($icerik);

			$etiket = $fnc->prego('<div class="singlex2-etiketler">','</div>',$bot);
			$etiket = str_replace("</a>",",",$etiket);
			$etiket = strip_tags($etiket);
			$etiket = $fnc->temizlik($etiket);


			$etiketcek = " ".$isim." oyna, ".$isim." online oyna, ".$isim." hack, ".$isim." skins, ".$isim." hile, ".$isim." hile oyna, ".$isim." mod";
			
			echo " <strong>Konu :</strong>  {$baslik}  <hr/>";
			echo " <strong>Resim :</strong>  {$resim}  <hr/>";
			echo " <strong>İçerik :</strong> {$icerik} <hr/> ";
			echo " <strong>Etiketler :</strong> {$etiket} <hr/> ";
			
 			$resim = str_replace("https://","http://",$resim);
			$resimName = time()."-".rand(123456,98765).".jpg";

	        $content = file_get_contents($resim);
	        $fp = fopen(ABSPATH . "wp-content/uploads/2017/11/".$resimName, "w");
	        fwrite($fp, $content);
	        fclose($fp);

			$filename = ABSPATH . "wp-content/uploads/2017/11/$resimName";


	        $my_post = array();
	        $my_post['post_title'] = $baslik;
	        $my_post['post_content'] = $icerik;
	        $my_post['post_status'] = 'publish';
	        $my_post['post_author'] = 1;
	        $my_post['post_category'] = array(1);
	        $my_post['tags_input'] = $etiket;

	        remove_filter('content_save_pre', 'wp_filter_post_kses');
	        remove_filter('content_filtered_save_pre', 'wp_filter_post_kses');

	        $post_id = wp_insert_post( $my_post);

	        $parent_post_id = $post_id;
	        $filetype = wp_check_filetype( basename( $filename ), null );
	        $wp_upload_dir = wp_upload_dir();

	        $attachment = array(
	            'guid'           => $wp_upload_dir['url'] . '/' . basename( $filename ),
	            'post_mime_type' => $filetype['type'],
	            'post_title'     => preg_replace( '/\.[^.]+$/', '', basename( $filename ) ),
	            'post_content'   => '',
	            'post_status'    => 'inherit'
	        );

	        $attach_id = wp_insert_attachment( $attachment, $filename, $parent_post_id );
	        require_once( ABSPATH . 'wp-admin/includes/image.php' );
	        $attach_data = wp_generate_attachment_metadata( $attach_id, $filename );
	        wp_update_attachment_metadata( $attach_id, $attach_data );
	        set_post_thumbnail( $parent_post_id, $attach_id );

	        $attach_id = get_post_meta($post_id, "_thumbnail_id", true);
	        add_post_meta($post_id, '_thumbnail_id', $attach_id);

		}


	break;

	case "sd";

		echo '<div class="alert alert-warning" role="alert"><h1>MirzaBot Teknoloji Haber Botu / shiftdelete.net</h1></div>';
		echo '<form  action="index.php?bot=sd" method="get">';
		echo '<label for="basic-url">Çekeceğiniz Haberin Urlsini Giriniz</label>';
		echo '<div class="input-group">';
	  	echo '<span class="input-group-addon" id="basic-addon3">https://shiftdelete.net/link gibi ...</span>';
	  	echo '<input type="text" class="form-control" id="url" name="url" aria-describedby="basic-addon3" />';
	  	echo '<input type="hidden" name="bot" value="sd" />';
		echo '</div>';
		echo '<br />';
		echo '<button type="submit" class="btn btn-warning">Haberi Çek</button>';
		echo '</form>';
		echo '<br />';
		echo '<br />';

		if(isset($_GET['url']))
		{

			$Url = $_GET['url'];
			$sql = array();
			$bot = $fnc->b0t($Url);

			$resim = $fnc->prego('<meta name="twitter:image" content="','"',$bot);
			$resim = strip_tags($resim);
			$resim = $fnc->temizlik($resim);

			$baslik = $fnc->prego('<meta property="og:title" content="','"',$bot);
			$baslik = strip_tags($baslik);
			$baslik = $fnc->temizlik($baslik);


			$icerik = $fnc->prego('<div id="post_detail_content">','<div class="desc">',$bot);
			$icerik = strip_tags($icerik);
			$icerik = $fnc->temizlik($icerik);

			$etiket = $fnc->prego('<meta name="news_keywords" content="','"',$bot);

			$etiket = strip_tags($etiket);
			$etiket = $fnc->temizlik($etiket);	
	
			echo " <strong>Konu :</strong>  {$baslik}  <hr/>";
			echo " <strong>Resim :</strong>  {$resim}  <hr/>";
			echo " <strong>İçerik :</strong> {$icerik} <hr/> ";
			echo " <strong>Etiketler :</strong> {$etiket} <hr/> ";
			
 			$resim = str_replace("https://","http://",$resim);
			$resimName = time()."-".rand(123456,98765).".jpg";

	        $content = file_get_contents($resim);
	        $fp = fopen(ABSPATH . "wp-content/uploads/2017/11/".$resimName, "w");
	        fwrite($fp, $content);
	        fclose($fp);

			$filename = ABSPATH . "wp-content/uploads/2017/11/$resimName";

	        $my_post = array();
	        $my_post['post_title'] = $baslik;
	        $my_post['post_content'] = $icerik;
	        $my_post['post_status'] = 'publish';
	        $my_post['post_author'] = 1;
	        $my_post['post_category'] = array(1);
	        $my_post['tags_input'] = $etiket;

	        remove_filter('content_save_pre', 'wp_filter_post_kses');
	        remove_filter('content_filtered_save_pre', 'wp_filter_post_kses');

	        $post_id = wp_insert_post( $my_post);

	        $parent_post_id = $post_id;
	        $filetype = wp_check_filetype( basename( $filename ), null );
	        $wp_upload_dir = wp_upload_dir();

	        $attachment = array(
	            'guid'           => $wp_upload_dir['url'] . '/' . basename( $filename ),
	            'post_mime_type' => $filetype['type'],
	            'post_title'     => preg_replace( '/\.[^.]+$/', '', basename( $filename ) ),
	            'post_content'   => '',
	            'post_status'    => 'inherit'
	        );

	        $attach_id = wp_insert_attachment( $attachment, $filename, $parent_post_id );
	        require_once( ABSPATH . 'wp-admin/includes/image.php' );
	        $attach_data = wp_generate_attachment_metadata( $attach_id, $filename );
	        wp_update_attachment_metadata( $attach_id, $attach_data );
	        set_post_thumbnail( $parent_post_id, $attach_id );

	        $attach_id = get_post_meta($post_id, "_thumbnail_id", true);
	        add_post_meta($post_id, '_thumbnail_id', $attach_id);

		}


	break;

	case "teknolojioku";

		echo '<div class="alert alert-info" role="alert"><h1>MirzaBot Teknoloji Haber Botu / teknolojioku.com</h1></div>';
		echo '<form  action="index.php?bot=teknolojioku" method="get">';
		echo '<label for="basic-url">Çekeceğiniz Haberin Urlsini Giriniz</label>';
		echo '<div class="input-group">';
	  	echo '<span class="input-group-addon" id="basic-addon3">http://www.teknolojioku.com/link.html gibi ...</span>';
	  	echo '<input type="text" class="form-control" id="url" name="url" aria-describedby="basic-addon3" />';
	  	echo '<input type="hidden" name="bot" value="teknolojioku" />';
		echo '</div>';
		echo '<br />';
		echo '<button type="submit" class="btn btn-info">Haberi Çek</button>';
		echo '</form>';
		echo '<br />';
		echo '<br />';

		if(isset($_GET['url']))
		{

			$Url = $_GET['url'];
			$sql = array();
			$bot = $fnc->b0t($Url);

			$resim = $fnc->prego('<link rel="image_src" href="','"',$bot);
			$resim = strip_tags($resim);
			$resim = $fnc->temizlik($resim);

			$baslik = $fnc->prego('<meta property="og:title" content="','"',$bot);
			$baslik = strip_tags($baslik);
			$baslik = $fnc->temizlik($baslik);


			$icerik = $fnc->prego('<div itemprop="articleBody">','</article>',$bot);
			$icerik = strip_tags($icerik);
			$icerik = $fnc->temizlik($icerik);

			$etiket = $fnc->prego('<meta name="keywords" content="','"',$bot);

			$etiket = strip_tags($etiket);
			$etiket = $fnc->temizlik($etiket);
			
			echo " <strong>Konu :</strong>  {$baslik}  <hr/>";
			echo " <strong>Resim :</strong>  {$resim}  <hr/>";
			echo " <strong>İçerik :</strong> {$icerik} <hr/> ";
			echo " <strong>Etiketler :</strong> {$etiket} <hr/> ";
			
 			$resim = str_replace("https://","http://",$resim);
			$resimName = time()."-".rand(123456,98765).".jpg";

	        $content = file_get_contents($resim);
	        $fp = fopen(ABSPATH . "wp-content/uploads/2017/11/".$resimName, "w");
	        fwrite($fp, $content);
	        fclose($fp);

			$filename = ABSPATH . "wp-content/uploads/2017/11/$resimName";


	        $my_post = array();
	        $my_post['post_title'] = $baslik;
	        $my_post['post_content'] = $icerik;
	        $my_post['post_status'] = 'publish';
	        $my_post['post_author'] = 1;
	        $my_post['post_category'] = array(1);
	        $my_post['tags_input'] = $etiket;

	        remove_filter('content_save_pre', 'wp_filter_post_kses');
	        remove_filter('content_filtered_save_pre', 'wp_filter_post_kses');

	        $post_id = wp_insert_post( $my_post);

	        $parent_post_id = $post_id;
	        $filetype = wp_check_filetype( basename( $filename ), null );
	        $wp_upload_dir = wp_upload_dir();

	        $attachment = array(
	            'guid'           => $wp_upload_dir['url'] . '/' . basename( $filename ),
	            'post_mime_type' => $filetype['type'],
	            'post_title'     => preg_replace( '/\.[^.]+$/', '', basename( $filename ) ),
	            'post_content'   => '',
	            'post_status'    => 'inherit'
	        );

	        $attach_id = wp_insert_attachment( $attachment, $filename, $parent_post_id );
	        require_once( ABSPATH . 'wp-admin/includes/image.php' );
	        $attach_data = wp_generate_attachment_metadata( $attach_id, $filename );
	        wp_update_attachment_metadata( $attach_id, $attach_data );
	        set_post_thumbnail( $parent_post_id, $attach_id );

	        $attach_id = get_post_meta($post_id, "_thumbnail_id", true);
	        add_post_meta($post_id, '_thumbnail_id', $attach_id);
		}


	break;

	case "chip";

		echo '<div class="alert alert-dark" role="alert"><h1>MirzaBot Teknoloji Haber Botu / chip.com.tr</h1></div>';
		echo '<form  action="index.php?bot=chip" method="get">';
		echo '<label for="basic-url">Çekeceğiniz Haberin Urlsini Giriniz</label>';
		echo '<div class="input-group">';
	  	echo '<span class="input-group-addon" id="basic-addon3">https://www.chip.com.tr/haber/link.html gibi ...</span>';
	  	echo '<input type="text" class="form-control" id="url" name="url" aria-describedby="basic-addon3" />';
	  	echo '<input type="hidden" name="bot" value="chip" />';
		echo '</div>';
		echo '<br />';
		echo '<button type="submit" class="btn btn-dark">Haberi Çek</button>';
		echo '</form>';
		echo '<br />';
		echo '<br />';

		if(isset($_GET['url']))
		{

			$Url = $_GET['url'];
			$sql = array();
			$bot = $fnc->b0t($Url);

			$resim = $fnc->prego('<meta property="twitter:image:src" content="','"',$bot);
			$resim = strip_tags($resim);
			$resim = $fnc->temizlik($resim);

			$baslik = $fnc->prego('<meta property="twitter:title" content="','"',$bot);
			$baslik = strip_tags($baslik);
			$baslik = $fnc->temizlik($baslik);


			$icerik = $fnc->prego('<div class="articleContent row" id="linkscontainer" itemprop="articleBody">','<aside class="npnews">',$bot);
			$icerik = strip_tags($icerik);
			$icerik = $fnc->temizlik($icerik);

			$etiket = $fnc->prego('<meta itemprop="keywords" content="','"',$bot);

			$etiket = strip_tags($etiket);
			$etiket = $fnc->temizlik($etiket);

			echo " <strong>Konu :</strong>  {$baslik}  <hr/>";
			echo " <strong>Resim :</strong>  {$resim}  <hr/>";
			echo " <strong>İçerik :</strong> {$icerik} <hr/> ";
			echo " <strong>Etiketler :</strong> {$etiket} <hr/> ";
			
 			$resim = str_replace("https://","http://",$resim);
			$resimName = time()."-".rand(123456,98765).".jpg";

	        $content = file_get_contents($resim);
	        $fp = fopen(ABSPATH . "wp-content/uploads/2017/11/".$resimName, "w");
	        fwrite($fp, $content);
	        fclose($fp);

			$filename = ABSPATH . "wp-content/uploads/2017/11/$resimName";


	        $my_post = array();
	        $my_post['post_title'] = $baslik;
	        $my_post['post_content'] = $icerik;
	        $my_post['post_status'] = 'publish';
	        $my_post['post_author'] = 1;
	        $my_post['post_category'] = array(1);
	        $my_post['tags_input'] = $etiket;

	        remove_filter('content_save_pre', 'wp_filter_post_kses');
	        remove_filter('content_filtered_save_pre', 'wp_filter_post_kses');

	        $post_id = wp_insert_post( $my_post);

	        $parent_post_id = $post_id;
	        $filetype = wp_check_filetype( basename( $filename ), null );
	        $wp_upload_dir = wp_upload_dir();

	        $attachment = array(
	            'guid'           => $wp_upload_dir['url'] . '/' . basename( $filename ),
	            'post_mime_type' => $filetype['type'],
	            'post_title'     => preg_replace( '/\.[^.]+$/', '', basename( $filename ) ),
	            'post_content'   => '',
	            'post_status'    => 'inherit'
	        );

	        $attach_id = wp_insert_attachment( $attachment, $filename, $parent_post_id );
	        require_once( ABSPATH . 'wp-admin/includes/image.php' );
	        $attach_data = wp_generate_attachment_metadata( $attach_id, $filename );
	        wp_update_attachment_metadata( $attach_id, $attach_data );
	        set_post_thumbnail( $parent_post_id, $attach_id );

	        $attach_id = get_post_meta($post_id, "_thumbnail_id", true);
	        add_post_meta($post_id, '_thumbnail_id', $attach_id);

		}
	break;
		
}
?>
	</div>
    </div>
    <hr>
	<footer class="container">
      <p>&copy; <a href="https://www.burakbesli.com.tr">Burak Beşli</a> 2017, tüm hakları gizli ve saklıdır. Soru istek ve görüşleriniz için lütfen " burak@burakbesli.com.tr " adresi ile eposta gönderiniz.</p>
    </footer>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="assets/js/vendor/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>

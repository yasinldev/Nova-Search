<?php

	require 'baglan.php';
	if(isset($_POST['tema'])){

		// TEMA İŞLEMİ KAYITSIZ & ARKAPLAN İŞLEMİ KAYITSIZ

		$renk = $_POST['tema'];
		$name = $_SESSION['isim'];
		$bg = $_POST['bg_link'];

		if(!isset($_SESSION['isim'])){
			if($renk == "dark"){
				$_SESSION['dark'] = true;
				unset($_SESSION['light']);
				header('Location: index.php');
			}elseif($renk == "light"){
				$_SESSION['light'] = true;
				unset($_SESSION['dark']);
				header('Location: index.php');
			}
			if($bg!=""){
				$_SESSION['bg'] = $bg;
			}
		}
		if(isset($_SESSION['isim'])){
			$ekle = $db->prepare("UPDATE tarayici_kayit SET uye_tema = '$renk' WHERE uye_kadi = '$name'");
			$ekle->execute(array());
			if($ekle != true){
				echo '
                <div class="alert alert-danger alert-dismissible fade show col-md-12" role="alert">
                   <strong>Hata!</strong> Beklenmedik bir hata meydana geldi!
                   <code>Hata kodu: Tema - 40</code>
                  <button type="button" class="btn-close" data-mdb-dismiss="alert" aria-label="Close"></button>
                </div>';
			}else{
				echo '
                <div class="alert alert-info alert-dismissible fade show col-md-12" role="alert">
                  <strong>Başarlı!</strong> Tema değiştirme işlemi başarılı!
                  <button type="button" class="btn-close" data-mdb-dismiss="alert" aria-label="Close"></button>
                </div>';
			}

			// TEMA İŞLEMİ

			if($bg != ""){
				$sorgu = $db->prepare("UPDATE tarayici_kayit SET uye_bg = ? WHERE uye_kadi = '$name'");
				$sorgu->execute(array($bg));
				if($sorgu = true){
					echo '<div class="alert alert-info">Arkaplanının başarıyla kaydedilmiştir. sayfa yenileniyor...</div>';
					echo '<meta http-equiv="refresh" content="3;url=index.php">';
				}else{
					echo '<div class="alert alert-danger">Bir hata meydana geldi lütfen hatanızı bildiriniz!</div>';
				}
			}
		}
		$kontrol = $db->prepare("SELECT * FROM tarayici_kayit WHERE uye_kadi = '$name'");
		$kontrol->execute();
		$veri = $kontrol->fetch(PDO::FETCH_ASSOC);
		$veri_renk = $veri['uye_tema'];
		if($veri_renk == 'dark'){
			$_SESSION['dark'] = true;
			unset($_SESSION['light']);
			header('Location: index.php');
		}elseif($veri_renk == 'light'){
			$_SESSION['light'] = true;
			unset($_SESSION['dark']);
			header('Location: index.php');
		}



	}

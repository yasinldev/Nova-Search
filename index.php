<?php
session_start();
require 'php/baglan.php';
?>
<!doctype html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Nova Search</title>
    <link rel="stylesheet" href="css/style.css" type="text/css" />
    <?php
        if(isset($_SESSION['light'])){
            echo '<link  rel="stylesheet" type="text/css" href="css/tema-light.css">';
        }elseif(isset($_SESSION['dark'])){
            echo '<link rel="stylesheet" type="text/css" href="css/tema-dark.css" />';
        }
    ?>
    <link rel="stylesheet" href="css/mdb.min.css" type="text/css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100&family=Quicksand:wght@300&family=Zen+Kaku+Gothic+Antique:wght@300&display=swap" rel="stylesheet">
    <style>
        .fontlu{
            font-family: 'Quicksand', sans-serif;
        }
    </style>
</head>
<?php
@$isim = $_SESSION['isim'];
$bgsorgu = $db->prepare("SELECT * FROM tarayici_kayit WHERE uye_kadi = '$isim'");
$bgsorgu->execute(array());
$c = $bgsorgu->fetch(PDO::FETCH_ASSOC);
?>
<body style="background-repeat: no-repeat; background-attachment: fixed; background-size: cover; <?php if(isset($c['uye_bg'])){echo 'background: url('.$c['uye_bg'].') no-repeat';}elseif(isset($_SESSION['bg'])){echo 'background: url('.$_SESSION['bg'].') no-repeat';}else{echo 'background-color: #333333';}?>">
    <!--Nova Search, Artado Project bünyesinde M. Yasin Özkaya tarafından tasarlanıp kodlanmıştır-->
    <div style="margin-top: 10px"></div>
    <div class="container">
        <?php
            if(isset($_SESSION['isim'])){
                echo '<div class="dropdown"><div class="btn btn-outline-primary mx-1" id="dropdownMenuButton" data-mdb-toggle="dropdown"><i class="bi-person"></i></div>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <li><a class="dropdown-item bg-light" href="#">'.$_SESSION['isim'].'</a></li>
                        <li><hr class="dropdown-divider" /></li>
                        <li><a class="dropdown-item" href="#">Hesabım</a></li>
                        <li><a class="dropdown-item" href="#">İletişim</a></li>
                        <li><a class="dropdown-item" href="php/logout.php">Çıkış</a></li>
                      </ul>';
            }
            elseif(!isset($_SESSION['isim'])){
                echo '<div class="btn btn-outline-info" data-ripple-color="dark" data-bs-toggle="modal" data-bs-target="#modalKayit">Kayıt - Giriş</div>';
            }
        ?>

        <button class="btn btn-outline-success f-right mx-1 h-25" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" data-ripple-color="dark" aria-controls="offcanvasRight"><i class="bi-list"></i></button>
        <a href="https://www.artadosearch.com/Donate"><div class="btn btn-outline-warning f-right" data-ripple-color="dark">Bağış Yap</div></a>
        <?php
            require 'php/istemci.php';
            require 'php/tema.php';
        ?>
        <div class="offcanvas offcanvas-end" style="max-width: 300px" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
            <style>
                ::-webkit-scrollbar {
                    width: 4px;
                    color: #3c3c3c;
                }
            </style>
            <div class="offcanvas-header">
                <h5 id="offcanvasRightLabel">Kontrol Panel</h5>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
               <br>
                <form method="post">
                    <select class="form-select mb-3" aria-label="Default temalar" name="tema">
                        <option selected disabled>Temalar</option>
                        <option value="dark">Default: Gece</option>
                        <option value="light">Aydınlık</option>
                    </select>
                    <select class="form-select mb-3" aria-label="Disabled diller" disabled>
                        <option selected disabled>Diller</option>
                        <option value="1">İngilizce</option>
                        <option value="2">Türkçe</option>
                        <option value="3">Japonca</option>
                    </select>
                    <input class="form-control mb-3" placeholder="Arkaplan bakımda" disabled type="url" name="bg_link">
                    <button class="btn btn-outline-info" name="s" type="submit">Kaydet!</button>
                </form>
                <hr class="ince">
                <a class="btn btn-outline-dark mb-3" data-ripple-color="dark" href="https://github.com/YasinSenpai/Nova-Search/">Github</a><br>
                <a class="btn btn-outline-secondary mb-3" data-ripple-color="dark" href="Nova-Search.php">Hakkımızda</a><br>
                <a class="btn btn-outline-primary mb-3" data-ripple-color="dark" href="Nova-Search.php">Manifesto'muz</a>
                <a class="btn btn-outline-success mb-3" data-ripple-color="dark" href="Nova-Search.php">Güncelleme notları</a><br>
                <hr class="ince">
                <div class="col-md-12">
                    <h3 class="text-center fontlu">Nova Search</h3>
                    <p class="text-center mb-3">Nova Search'te aramalarınız kaydedilmez. Kimse sizin kim olduğunuzu bilemez. Nova Search ile tamamen anonim olarak internetin sınırlarını keşfedebilirsiniz!</p>
                </div>
            </div>
        </div>
        <!--Arama input + icon-->
    <div class="container">
        <div class="row d-flex justify-content-center align-items-center" style="margin-top: 30px">
            <div class="col-md-6">
                <div class="text-center">
                    <img src="images/artado_but_anime.png" style="width: 300px;" class="img-fluid mb-3 ">
                </div>
                <div class="form">
                    <form method="get" action="sonuc.php">
                        <i class="bi-search"></i>
                        <input type="text" class="form-control form-input" aria-label="Search" aria-describedby="basic-addon2" autofocus name="q" id="q" value="" target="_blank" placeholder="Herhangi birşey aratın..." required>
                        <span class="sol-taraf">
                            <a href="#" class="text-black" data-mdb-container="body" data-mdb-toggle="popover" data-mdb-placement="right" data-mdb-trigger="focus" data-mdb-content="Sayın kullanıcımız bu özellik şuanda kullanılmamaktadır"><i class="bi-mic"></i></a>
                        </span>
                    </form>
                </div>
            </div>
        </div>
        <script>

        </script>
        <div class="row mt-5 text-center">
            <script>
                $(document).ready(function(){
                    $("#card1").css("center-block")
                });

            </script>
            <!--Tarih - Saat card-->
            <div class="col-md-2" style="margin-left: -20px;"></div>
            <div class="col-sm-4 mb-2" id="card1">
                <div class="card index-card" style="background-color: #3c3c3c; color: #FFFFFF; border: 1px solid #FFFFFF">
                    <div class="card-body">
                        <h1 class="card-text fontlu" style="text-transform: uppercase;" id="time"></h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-4 mb-2">
                <div class="card index-card" style="background-color: #3c3c3c; color: #FFFFFF; border: 1px solid #FFFFFF   ">
                    <div class="card-body">
                        <h1 class="card-text fontlu"><?php echo date('d/m/Y'); ?></h1>
                    </div>
                </div>
            </div>
        </div>
        <?php
        if(isset($_SESSION['isim'])){
            echo '<div class="row align-items-center justify-content-center">
            <div class="alert alert-info alert-dismissible fade show col-md-9 text-center" role="alert">
            <i class="bi bi-info-square"></i> Sayın kullanıcımız güvenlik protokollerimiz sebebiyle bilgileriniz sunucularımızda (Session) tutulmaktadır eğer ki mevcut tarayıcı kapatılırsa hesap bilgilerinizi girerek tekrardan giriş yapmanız gerekmektedir (Bilgileriniz silinmez yanlızca oturumunuz kapanır) Anlayışınız için teşekkürler
                              <button type="button" class="btn-close" data-mdb-dismiss="alert" aria-label="Close"></button>
                            </div>
                    </div> ';
        }
        ?>
    </div>

        <!--Kayit - Giriş modal-->
        <div class="modal fade" id="modalKayit" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <button type="button" class="btn-close f-right" data-bs-dismiss="modal" aria-label="Close"></button><br>
                        <ul class="nav nav-pills nav-justified mb-3" id="ex1" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a
                                        class="nav-link active"
                                        id="tab-login"
                                        data-mdb-toggle="pill"
                                        href="#pills-login"
                                        role="tab"
                                        aria-controls="pills-login"
                                        aria-selected="true"
                                >Giriş Yap</a
                                >
                            </li>
                            <li class="nav-item" role="presentation">
                                <a
                                        class="nav-link"
                                        id="tab-register"
                                        data-mdb-toggle="pill"
                                        href="#pills-register"
                                        role="tab"
                                        aria-controls="pills-register"
                                        aria-selected="false"
                                >Kayıt Ol</a
                                >
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="pills-login" role="tabpanel" aria-labelledby="tab-login">
                                <form method="post">
                                    <div class="text-center mb-3">
                                        <p>Şunlar ile giriş yap:</p>
                                        <button type="button" class="btn btn-primary btn-floating mx-1" disabled>
                                            <i class="bi-facebook"></i>
                                        </button>

                                        <button type="button" class="btn btn-primary btn-floating mx-1" disabled>
                                            <i class="bi-google"></i>
                                        </button>

                                        <button type="button" class="btn btn-primary btn-floating mx-1" disabled>
                                            <i class="bi-twitter"></i>
                                        </button>

                                        <button type="button" class="btn btn-primary btn-floating mx-1" disabled>
                                            <i class="bi-github"></i>
                                        </button>
                                        <br>
                                        <small class="text-muted">Bu özellik şuan kullanılmamaktadır</small>
                                    </div>

                                    <p class="text-center">Ya da:</p>

                                    <div class="form-outline mb-4">
                                        <input type="text" name="g-kadi" id="loginName" class="form-control" />
                                        <label class="form-label" for="loginName">Kullanıcı Adınız</label>
                                    </div>

                                    <div class="form-outline mb-4">
                                        <input type="password" name="g-pass" id="loginPassword" class="form-control" />
                                        <label class="form-label" for="loginPassword">Şifreniz</label>
                                    </div>

                                    <div class="row mb-4">
                                        <div class="col-md-6 d-flex justify-content-center">
                                            <div class="form-check mb-3 mb-md-0">
                                                <input class="form-check-input" name="g-hatirla" type="checkbox" value="" id="loginCheck" checked />
                                                <label class="form-check-label" for="loginCheck">Beni Hatırla </label>
                                            </div>
                                        </div>
                                        <div class="col-md-6 d-flex justify-content-center">
                                            <a href="#!">Şifrenizi mi unuttunuz?</a>
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-primary btn-block mb-4" name="g">Giriş yap</button>
                                </form>
                            </div>
                            <div class="tab-pane fade" id="pills-register" role="tabpanel" aria-labelledby="tab-register">
                                <form method="post">
                                    <div class="text-center mb-3">
                                        <p>Şunlar ile kayıt ol:</p>
                                        <button type="button" class="btn btn-primary btn-floating mx-1" disabled>
                                            <i class="bi-facebook"></i>
                                        </button>

                                        <button type="button" class="btn btn-primary btn-floating mx-1" disabled>
                                            <i class="bi-google"></i>
                                        </button>

                                        <button type="button" class="btn btn-primary btn-floating mx-1" disabled>
                                            <i class="bi-twitter"></i>
                                        </button>

                                        <button type="button" class="btn btn-primary btn-floating mx-1" disabled>
                                            <i class="bi-github"></i>
                                        </button>
                                        <br>
                                        <small class="text-muted">Bu özellik şuan kullanılmamaktadır</small>
                                    </div>

                                    <p class="text-center">Ya da:</p>

                                    <div class="form-outline mb-4">
                                        <input type="text" name="k-kadi" id="registerName" class="form-control" />
                                        <label class="form-label" for="registerName">Kullanıcı Adınız</label>
                                    </div>

                                    <div class="form-outline mb-4">
                                        <input type="text" id="registerUsername" name="k-email" class="form-control" />
                                        <label class="form-label" for="registerUsername">Email Adrresiniz</label>
                                    </div>

                                    <div class="form-outline mb-4">
                                        <input type="password" id="registerPassword" name="k-pass" class="form-control" />
                                        <label class="form-label" for="registerPassword">Şifreniz</label>
                                    </div>

                                    <div class="form-outline mb-4">
                                        <input type="password" id="registerRepeatPassword" name="k-pass-again" class="form-control" />
                                        <label class="form-label" for="registerRepeatPassword">Tekrardan Şifreniz</label>
                                    </div>

                                    <div class="form-check d-flex justify-content-center mb-4">
                                        <input
                                                class="form-check-input me-2"
                                                type="checkbox"
                                                value=""
                                                id="registerCheck"
                                                required
                                                aria-describedby="registerCheckHelpText"
                                        />
                                        <label class="form-check-label" for="registerCheck">
                                            Kullanım koşullarını kabul ediyorum
                                        </label>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-block mb-3" name="k">Kayıt Ol</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.1/moment.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="js/main.js"></script>
    <script src="js/mdb.min.js"></script>
    <script>
        function realtime() {
            let time = moment().format('h:mm:ss a');
            document.getElementById('time').innerHTML = time;

            setInterval(() => {
                time = moment().format('h:mm:ss a');
                document.getElementById('time').innerHTML = time;
            }, 1000)

        }
        realtime();
    </script>

</body>
</html>
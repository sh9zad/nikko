<?php
/**
 * Created by PhpStorm.
 * User: sh.hasanzadeh
 * Date: 8/20/14
 * Time: 3:09 PM
 */
include_once 'common/header.tmpl.php';
if (!isset($_SESSION)){session_start();}
//print_r($_SESSION);
if (!$_SESSION['member']->CheckLogin())
{
    header('Location: ../index.php?control=main&action=enter');
}
?>
<!-- Role Section -->
<ol class="breadcrumb hidden-xs">
    <li><a href="#">Home</a></li>
    <li class="active">PROFILE</li>
</ol>
<h4 class="page-title">PROFILE</h4>

<section class="block-area" id="defaultStyle">
    <!-- USER PROFILE -->
    <div class="clearfix" style="padding-bottom: 50px;"></div>
    <input type="hidden" id="user-id" value="<?php echo $_SESSION['CID'] ?>">

    <div class="block-area">
    <div class="row">
    <div class="col-md-9">
    <div class="tile-light p-5 m-b-15">
        <div class="cover p-relative">
            <img src="" class="w-100" alt="">
            <img class="profile-pic" src="style/include/img/profile-pic.png" alt="">
            <div class="profile-btn">
                <button class="btn btn-alt btn-sm"><i class="icon-bubble"></i> <span>Message</span></button>
                <button class="btn btn-alt btn-sm"><i class="icon-user-2"></i> <span>Friend</span></button>
            </div>
        </div>
        <div id="section-user-info" class="p-5 m-t-15">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis eget risus rhoncus, cursus purus vitae, venenatis eros. Phasellus at tincidunt risus. Integer sed massa fermentum, feugiat arcu quis, ultrices nisi. Quisque commodo nisi scelerisque, tempus diam ac, dignissim tellus. Mauris adipiscing elit tortor, dignissim auctor diam mollis sed. Nulla eu dui non velit accumsan scelerisque eget et felis.
        </div>
    </div>

    <div class="m-b-15 text-center profile-summary">
        <button class="btn btn-sm">42 Followers</button>
        <button class="btn btn-sm">69 Followings</button>
        <button class="btn btn-sm hidden-xs">120 Comments</button>
        <button class="btn btn-sm hidden-xs">165 Likes</button>
    </div>
    </div>

    <div class="col-md-3">

        <!-- About Me -->
        <div class="tile">
            <h2 class="tile-title">About me</h2>
            <div class="tile-config dropdown">
                <a data-toggle="dropdown" href="#" class="tooltips tile-menu" title="" data-original-title="Options"></a>
                <ul class="dropdown-menu pull-right text-right">
                    <li><a href="#">Edit</a></li>
                    <li><a href="#">Delete</a></li>
                </ul>
            </div>

            <div class="listview icon-list">
                <div class="media">
                    <i class="icon pull-left">&#61744</i>
                    <div class="media-body">Software Developer at Google</div>
                </div>

                <div class="media">
                    <i class="icon pull-left">&#61753</i>
                    <div class="media-body">Studied at Oxford University</div>
                </div>

                <div class="media">
                    <i class="icon pull-left">&#61713</i>
                    <div class="media-body">Lives in Saturn, Milkyway</div>
                </div>

                <div class="media">
                    <i class="icon pull-left">&#61742</i>
                    <div class="media-body">From Titan, Jupitor</div>
                </div>
            </div>
        </div>

        <!-- Friends -->
        <div class="tile">
            <h2 class="tile-title">Connections</h2>
            <div class="tile-config dropdown">
                <a data-toggle="dropdown" href="#" class="tooltips tile-menu" title="" data-original-title="Options"></a>
                <ul class="dropdown-menu pull-right text-right">
                    <li><a href="#">Edit</a></li>
                    <li><a href="#">Delete</a></li>
                </ul>
            </div>

            <div class="listview narrow">
                <div class="media p-l-5">
                    <div class="pull-left">
                        <img width="37" src="img/profile-pics/1.jpg" alt="">
                    </div>
                    <div class="media-body">
                        <a class="news-title" href="#">Mitchell Christein</a>
                        <div class="clearfix"></div>
                        <a href="#"><small class="text-muted">Unfriend</small></a>
                    </div>
                </div>
                <div class="media p-l-5">
                    <div class="pull-left">
                        <img width="37" src="img/profile-pics/2.jpg" alt="">
                    </div>
                    <div class="media-body">
                        <a class="news-title" href="#">David Villa</a>
                        <div class="clearfix"></div>
                        <a href="#"><small class="text-muted">Unfriend</small></a>
                    </div>
                </div>
                <div class="media" p-l-5">
                <div class="pull-left">
                    <img width="37" src="img/profile-pics/3.jpg" alt="">
                </div>
                <div class="media-body">
                    <a class="news-title" href="#">The Iron man Jr.</a>
                    <div class="clearfix"></div>
                    <a href="#"><small class="text-muted">Unfriend</small></a>
                </div>
            </div>
            <div class="media" p-l-5">
            <div class="pull-left">
                <img width="37" src="img/profile-pics/4.jpg" alt="">
            </div>
            <div class="media-body">
                <a class="news-title" href="#">Stephen Elop</a>
                <div class="clearfix"></div>
                <a href="#"><small class="text-muted">Unfriend</small></a>
            </div>
        </div>
        <div class="media" p-l-5">
        <div class="pull-left">
            <img width="37" src="img/profile-pics/5.jpg" alt="">
        </div>
        <div class="media-body">
            <a class="news-title" href="#">Wendy wenkitson</a>
            <div class="clearfix"></div>
            <a href="#"><small class="text-muted">Unfriend</small></a>
        </div>
    </div>
    <div class="media p-5 text-center l-100">
        <a href="#"><small>VIEW ALL</small></a>
    </div>
    </div>
    </div>
    <!-- Photos -->
    <div class="tile">
        <h2 class="tile-title">Photos</h2>
        <div class="tile-config dropdown">
            <a data-toggle="dropdown" href="#" class="tooltips tile-menu" title="" data-original-title="Options"></a>
            <ul class="dropdown-menu pull-right text-right">
                <li><a href="#">Edit</a></li>
                <li><a href="#">Delete</a></li>
            </ul>
        </div>

        <div class="p-5 photos">
            <div class="col-xs-3">
                <img src="img/profile-pics/1.jpg" alt="">
            </div>
            <div class="col-xs-3">
                <img src="img/profile-pics/2.jpg" alt="">
            </div>
            <div class="col-xs-3">
                <img src="img/profile-pics/3.jpg" alt="">
            </div>
            <div class="col-xs-3">
                <img src="img/profile-pics/4.jpg"  alt="">
            </div>
            <div class="col-xs-3">
                <img src="img/profile-pics/5.jpg" alt="">
            </div>
            <div class="col-xs-3">
                <img src="img/profile-pics/6.jpg" alt="">
            </div>
            <div class="col-xs-3">
                <img src="img/profile-pics/2.jpg" alt="">
            </div>
            <div class="col-xs-3">
                <img src="img/profile-pics/5.jpg" alt="">
            </div>
            <div class="col-xs-3">
                <img src="img/profile-pics/1.jpg" alt="">
            </div>
            <div class="col-xs-3">
                <img src="img/profile-pics/3.jpg" alt="">
            </div>
            <div class="col-xs-3">
                <img src="img/profile-pics/4.jpg" alt="">
            </div>
            <div class="col-xs-3">
                <img src="img/profile-pics/6.jpg" alt="">
            </div>

            <div class="clearfix"></div>
        </div>
    </div>
    </div>
    </div>

    <br/><br/><br/>
    </div>

</section>
    <script type="text/javascript" src="js/profile.js"></script>
<?php
include_once 'common/footer.tmpl.php';
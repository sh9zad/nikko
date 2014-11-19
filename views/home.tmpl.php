<?php
/**
 * Created by PhpStorm.
 * User: sh.hasanzadeh
 * Date: 5/24/14
 * Time: 5:34 PM
 */
require_once 'common/header.tmpl.php';
if (!isset($_SESSION)) {session_start();}
if (!$_SESSION['member']->CheckLogin()){
    header('Location: index.php?control=main&action=enter');
}
?>
    <nav id="secondary">
        <ul>
            <li class="current"><a id="btn-show-home" href="#">خانه</a></li>
            <?php if ($_SESSION['ACL']->checkPermission($_SESSION['CID'], 'forum', 'full|view|add|update')){ ?>
                <li><a id="btn-show-topic-list" href="#">تاپیک</a></li>
                <li><a id="btn-show-cat-list" href="#">تالارها</a></li>
                <li><a id="btn-show-topic-sent-list" href="#">تاپیک های ارسالی</a></li>
            <?php } ?>
        </ul>
    </nav>
    <section id="content">
    <div id="box-show-home">
        <h2>خانه</h2>
        <h4>به خانه خوش آمدید :)</h4>
    </div>
    <div id="box-show-topic-list" class="hide">
        <h2>تاپیک</h2>
        <form class="wymupdate">
            <div class="column right" style="margin-bottom: 20px;">
                <a class="button icon add" id="btn-show-box-add-topic">اضافه کردن تاپیک</a>
                <a class="button icon search" id="btn-show-box-search-topic">جستجوی تاپیک</a>
                <section id="show-box-add-topic" class="hide">
                    <label>
                        انتخب فروم و اضافه کردن متن
                        <small>متن تاپیک را وارد نمایید</small>
                    </label>
                    <div>
                        <select id="lst-categories"></select>
                        <textarea id="txt-description-topic" name="textarea"></textarea>
                        <p>
                            <a href="#" class="button primary submit" id="btn-add-topic">تایید</a>
                        </p>
                    </div>
                </section>
                <section id="show-box-search-topic" class="hide">
                    <label>
                        جستجوی تاپیک مورد نظر
                        <small>
                            چنانچه مایل به استفاده از موضوع و یا تاریخ نیستید، آن ها را خالی بگذارید
                        </small>
                    </label>
                    <div>
                        <div class="titleAction">جستجو بر اساس موضوع</div>
                        <input placeholder="از شماره 1" type="text" class="medium" id="txt-subject-start">
                        <input placeholder="تا N" type="text" class="medium" id="txt-subject-finish">
                        <br />
                        <div class="titleAction">جستجو بر اساس تاریخ</div>
                        <input placeholder="تاریخ شروع" type="text" class="medium" id="txt-date-start">
                        <input placeholder="تاریخ پایان" type="text" class="medium" id="txt-date-finish">
                        <p>
                            <a href="#" class="button primary submit" id="btn-search-topic">شروع جستجو</a>
                        </p>
                    </div>
                </section>
            </div>
        </form>
        <table>
            <thead></thead>
            <tbody></tbody>
        </table>
    </div>
    <div id="box-show-category-list" class="hide">
        <h2>تالار</h2>
        <form class="wymupdate">
            <div class="column right">
                <section>
                    <label>
                        اضافه کردن تالار جدید
                        <small>وارد کردن نام برای تالار جدید</small>
                    </label>
                    <div>
                        <input type="text" id="txt-add-catname" />
                        <input type="text" id="txt-add-mokeyword" />
                        <p>
                            <a href="#" class="button primary submit" id="btn-add-categories">تایید</a>
                        </p>
                    </div>
                </section>
            </div>
        </form>
        <table></table>
    </div>
    <div id="show-topic"></div>

    <div id="box-show-sent-topics" class="hide">
        <h2>تاپیک های ارسالی</h2>
        <table></table>
    </div>
    <h2>SMS Form</h2>
    <?php
        if (isset($_SESSION['error'])){
            ?>
            <h2><?php echo $_SESSION['error']; ?></h2>
            <?php
        }
        elseif(isset($_SESSION['record'])){
            ?>
            <div>
                <p>Record with id: <strong><?php echo $_SESSION['record']['id']; ?></strong> added to the database @ <strong><?php echo $_SESSION['record']['date']; ?></strong>.</p>
            </div>
            <?php
        }
    ?>
    <form action="getmessage.php" method="get" style="display: none;">
        <input type="hidden" name="test" value="true">
        <ul>
            <li>Sender:</li>
            <li><input id="txt-sender" name="sender" type="text"></li>
            <li>From:</li>
            <li><input id="txt-from" name="scode" type="text"></li>
            <li>Text:</li>
            <li><textarea name="text" id="txt-text"></textarea></li>
            <li><input type="submit" value="Send" id="btn-send-sms"></li>
        </ul>
    </form>
    <br>
    <form action="sendmessage.php" method="get" style="display: none;">
        <input type="submit" value="Send">
    </form>
</section>
<script type="text/javascript" src="js/home.js"></script>
<?php
require_once 'common/footer.tmpl.php';
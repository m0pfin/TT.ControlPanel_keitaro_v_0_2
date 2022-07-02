<?php
/**
 * Created by PhpStorm.
 * User: m0pfin
 * Date: 26.06.2020
 * Time: 01:47
 */
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);

include __DIR__.'/functions.php';
include __DIR__.'/include/head.php';
?>
<script language="JavaScript">
    $(document).ready(function(){
        $("#getCost").click(function()
        {
            $("#erconts").fadeIn(5000);
            $.ajax(
                {
                    type: "POST",
                    url: "ttGetCampaign.php", // Адрес обработчика
                    data: $("#callbacks").serialize(),
                    error:function()
                    {
                        $("#erconts").html(result);
                    },
                    beforeSend: function()
                    {
                        $("#erconts").html("Загрузка... <br><img src='assets/ajax-loader.gif'>");
                    },
                    success: function(result)
                    {
                        $("#erconts").html(result);
                        checkThis();
                    }
                });
            return false;
        });
    });
</script>
<script language="JavaScript">
    $(document).ready(function(){
        $("#getInfo").click(function()
        {
            $("#infoget").fadeIn(5000);
            $.ajax(
                {
                    type: "POST",
                    url: "getInfo.php", // Адрес обработчика
                    data: $("#callbacks").serialize(),
                    error:function()
                    {
                        $("#infoget").html(result);
                    },
                    beforeSend: function()
                    {
                        $("#infoget").html("Загрузка... <br><img src='assets/ajax-loader.gif'>");
                    },
                    success: function(result)
                    {
                        $("#infoget").html(result);
                        setTimeout(() => {  console.log("Reload!"); }, 3000);
                        window.location.reload();
                        checkThis();
                    }
                });
            return false;
        });
    });
</script>
<!-- Header -->
<div class="header">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 d-inline-block mb-0">Аккаунты</h6>
                    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                        <ol class="breadcrumb breadcrumb-links">
                            <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="#">Dashboards</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Аккаунты</li>
                        </ol>
                    </nav>
                </div>
                <div class="col-lg-6 col-5 text-right">
                    <a href="https://chrome.google.com/webstore/detail/dolphin-tt/ipjboigiejagkjgffdhcmdpkldmjfghe" class="btn btn-sm btn-neutral" target="_blank">Ссылка на расширение (Dolphin)</a><a href="https://www.donationalerts.com/r/m0fpin" class="btn btn-sm btn-neutral">Задонатить автору</a>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="container-fluid">
    <div class="row">
        <div class="col-xl-3 col-md-6">
            <div class="card card-stats">
                <!-- Card body -->
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h5 class="card-title text-uppercase text-muted mb-0">Активные</h5>
                            <span class="h2 font-weight-bold mb-0"><?php
                            $leadtoday = $db->query('SELECT * FROM tokens WHERE status = 1');
                            $leads_today = count($leadtoday);
                            echo $leads_today;
                            ?></span>
                        </div>
                        <div class="col-auto">
                            <div class="icon icon-shape bg-gradient-green text-white rounded-circle shadow">
                                <i class="ni ni-chart-bar-32"></i>
                            </div>
                        </div>
                    </div>
                    <!--                <p class="mt-3 mb-0 text-sm">-->
                    <!--                    <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 3.48%</span>-->
                    <!--                    <span class="text-nowrap">Since last month</span>-->
                    <!--                </p>-->
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card card-stats">
                <!-- Card body -->
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h5 class="card-title text-uppercase text-muted mb-0">Заблокированные</h5>
                            <span class="h2 font-weight-bold mb-0">
                            <?php
                            $leadtoday = $db->query('SELECT * FROM tokens WHERE status = 1');
                            $leads_today = count($leadtoday);
                            echo $leads_today;
                            ?>
                        </span>
                        </div>
                        <div class="col-auto">
                            <div class="icon icon-shape bg-gradient-red text-white rounded-circle shadow">
                                <i class="ni ni-active-40"></i>
                            </div>
                        </div>
                    </div>
                    <!--                <p class="mt-3 mb-0 text-sm">-->
                    <!--                    <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 3.48%</span>-->
                    <!--                    <span class="text-nowrap">Since last month</span>-->
                    <!--                </p>-->
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card card-stats">
                <!-- Card body -->
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h5 class="card-title text-uppercase text-muted mb-0">Кол-во лидов</h5>
                            <span class="h2 font-weight-bold mb-0">
                            <?php 
                       
                       $res = $db->query("SELECT SUM(cpa) FROM `tokens`");
                       //var_dump($res);
                       echo $res[0]["SUM(cpa)"];
                       ?>
                        </span>
                        </div>
                        <div class="col-auto">
                            <div class="icon icon-shape bg-gradient-orange text-white rounded-circle shadow">
                                <i class="ni ni-chart-pie-35"></i>
                            </div>
                        </div>
                    </div>
                    <!--                <p class="mt-3 mb-0 text-sm">-->
                    <!--                    <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 3.48%</span>-->
                    <!--                    <span class="text-nowrap">Since last month</span>-->
                    <!--                </p>-->
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card card-stats">
                <!-- Card body -->
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h5 class="card-title text-uppercase text-muted mb-0">Потрачено сегодня</h5>
                            <span class="h2 font-weight-bold mb-0">
                            <?php 
                       
                       $res = $db->query("SELECT SUM(cost) FROM `tokens`");
                       //var_dump($res);
                       echo $res[0]["SUM(cost)"].' $';
                       ?>
                        </div>
                        <div class="col-auto">
                            <div class="icon icon-shape bg-gradient-info text-white rounded-circle shadow">
                                <i class="ni ni-money-coins"></i>
                            </div>
                        </div>
                    </div>
                    <!--                <p class="mt-3 mb-0 text-sm">-->
                    <!--                    <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 3.48%</span>-->
                    <!--                    <span class="text-nowrap">Since last month</span>-->
                    <!--                </p>-->
                </div>
            </div>
        </div>
    </div>
</div>


<div class="container-fluid">
    <div class="alert alert-warning alert-dismissible fade show" role="alert"  id="erconts" style = "display: none"><span class="alert-icon"><i class="ni ni-like-2"></i></span><span class="alert-text"><strong>Аккаунт</strong> удалён!</span><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button></div>
    <div class="alert alert-warning alert-dismissible fade show" role="alert"  id="infoget" style = "display: none"><span class="alert-icon"><i class="ni ni-like-2"></i></span><span class="alert-text"><strong>Аккаунт</strong> удалён!</span><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button></div>

    <?php

    if ($_GET['delete'] == 'success'){
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">';
        echo '<span class="alert-icon"><i class="ni ni-like-2"></i></span>';
        echo '<span class="alert-text"><strong>Аккаунт</strong> удалён!</span>';
        echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close">';
        echo '<span aria-hidden="true">×</span>';
        echo '</button></div>';
    }
    if ($_GET['add'] == 'no_ad_id'){
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">';
        echo '<span class="alert-icon"><i class="ni ni-active-40"></i></span>';
        echo '<span class="alert-text"><strong>Отсутсвует ID рекламного кабинета</strong> (обновите страницу) перейдите в кампании->адсеты и обратно. И попробуйте снова взять токен.</span>';
        echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close">';
        echo '<span aria-hidden="true">×</span>';
        echo '</button></div>';
    }
    if ($_GET['add'] == 'empty'){
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">';
        echo '<span class="alert-icon"><i class="ni ni-like-2"></i></span>';
        echo '<span class="alert-text"><strong>Отсутсвуют данные</strong> для добавления!</span>';
        echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close">';
        echo '<span aria-hidden="true">×</span>';
        echo '</button></div>';
    }
    if ($_GET['add'] == 'success'){
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">';
        echo '<span class="alert-icon"><i class="ni ni-like-2"></i></span>';
        echo '<span class="alert-text"><strong>Аккаунт</strong> добавлен!</span>';
        echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close">';
        echo '<span aria-hidden="true">×</span>';
        echo '</button></div>';
    }
    if ($_GET['account'] == 'update'){
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">';
        echo '<span class="alert-icon"><i class="ni ni-like-2"></i></span>';
        echo '<span class="alert-text"><strong>Данные аккаунтов</strong> обновлены!</span>';
        echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close">';
        echo '<span aria-hidden="true">×</span>';
        echo '</button></div>';
    }
    ?>

    <div class="card">
        <div class="card-header border-0">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="mb-0">Аккаунты</h3>
                </div>
                <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-form">
                    + Add
                </button>
                <button type="button" class="btn btn-primary" data-toggle="tooltip" data-placement="top" id="getCost" title="Тестовый прогон расходов">
                    <i class="fas fa-sync-alt"></i>
                </button>
                <button type="button" class="btn btn-success" id="getInfo" data-toggle="tooltip" data-placement="top" title="Обновить данные аккаунтов">
                    <i class="ni ni-cloud-download-95"></i>
                </button>
            </div>

        </div>
        <div class="table-responsive">
            <!-- Projects table -->
            <div class="table-responsive">
                <table class="table align-items-center table-flush" id="myTable">
                    <thead class="thead-light">
                    <tr>

                        <th>id</th>
                        <th>Name</th>
                        <th>Status</th>
                        <th>ID ACC</th>
                        <th>Balance</th>
                        <th>IMRESS</th>
                        <th>CLICKS</th>
                        <th>CTR</th>
                        <th>CPC</th>
                        <th>CPA</th>
                        <th>CPA.COST</th>
                        <th>TOTAL.COST</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $lead = $db->query("SELECT * FROM `tokens` ORDER BY id ASC");

                    foreach ($lead as $leads) {
                        ?>
                        <tr id="<?php echo $leads['id']; ?>">
                            <th>
                                <?php echo $leads['id']; ?>
                            </th>
                            <td>
                                <div class="media align-items-center">
                                    <a href="#" class="avatar rounded-circle mr-3">
                                        <i class="ni ni-notification-70"></i>
                                    </a>
                                    <span class="name mb-0 text-sm"><?php echo $leads['name']; ?></span>
                                </div>
                            </td>
                            <td>
                                <?php echo status($leads['status']); ?>
                            </td>
                            <td>
                                <?php echo $leads['id_ad_account']; ?>
                            </td>
                            <td>
                                <?php echo $leads['balance']; ?>
                            </td>
                            <td>
                                <?php echo $leads['impressions']; ?>
                            </td>
                            <td>
                                <?php echo $leads['clicks']; ?>
                            </td>
                            <td>
                                <?php echo $leads['ctr']; ?>
                            </td>
                            <td>
                                <?php echo $leads['cpc']; ?>
                            </td>
                            <td>
                                <?php echo $leads['cpa']; ?>
                            </td>
                            <td>
                                <?php echo $leads['cpa_cost']; ?>
                            </td>
                            <td>
                                <?php echo $leads['cost']; ?>
                            </td>

                            <td class="text-right">
                                <div class="dropdown">
                                    <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                        <a class="dropdown-item" href="include/crud.php?delete=<?php echo $leads['id']; ?>">Delete</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                   
                    </tbody>

                </table>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="modal fade" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
            <div class="modal-dialog modal- modal-dialog-centered modal-sm" role="document">
                <div class="modal-content">

                    <div class="modal-body p-0">



                        <div class="card bg-secondary border-0 mb-0">
                            <div class="card-body px-lg-5 py-lg-5">
                                <div class="text-center text-muted mb-4">
                                    <small>Добавление нового аккаунта Tik-Tok</small>
                                </div>
                                <form role="form" action="addToken.php" method="POST">
                                    <!--div class="form-group mb-3">
                                        <div class="input-group input-group-merge input-group-alternative">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                                            </div>
                                            <input class="form-control" name="name" placeholder="Название" type="text">
                                        </div>
                                    </div-->
                                    <div class="form-group">
                                        <div class="input-group input-group-merge input-group-alternative">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                                            </div>
                                            <input class="form-control" name="token" placeholder="Токен аккаунта" type="text">
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary my-4">Добавить</button>
                                    </div>
                                </form>
                            </div>
                        </div>




                    </div>

                </div>
            </div>
        </div>

    </div>
</div>
</div>
<?php
include 'include/foot.php';
?>

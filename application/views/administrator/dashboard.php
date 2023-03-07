<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>Dashboard</h1>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="page-header float-right">
            <div class="page-title">
                <ol class="breadcrumb text-right">
                    <li class="active">Dashboard</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="content mt-3">
    <div class="row">
        <div class="col-sm-6 col-lg-3">
            <div class="card text-white bg-success">
                <div class="card-body pb-0">
                    <div class="float-right">
                        <i class="fa fa-dollar"></i>
                    </div>
                    <h4 class="mb-0">
                        <span class="count"><?= rupiah($today_income); ?></span>
                    </h4>
                    <p class="text-light">Pendapatan Hari Ini</p>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="card text-white bg-info">
                <div class="card-body pb-0">
                    <div class="float-right">
                        <i class="fa fa-cogs"></i>
                    </div>
                    <h4 class="mb-0">
                        <span class="count"><?= $today_service; ?></span>
                    </h4>
                    <p class="text-light">Service Selesai Hari Ini</p>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="card text-white bg-warning">
                <div class="card-body pb-0">
                    <div class="float-right">
                        <i class="fa fa-share"></i>
                    </div>
                    <h4 class="mb-0">
                        <span class="count"><?= $today_items_sold; ?></span>
                    </h4>
                    <p class="text-light">Item Terjual Hari Ini</p>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="card text-white bg-danger">
                <div class="card-body pb-0">
                    <div class="float-right">
                        <i class="fa fa-warning"></i>
                    </div>
                    <h4 class="mb-0">
                        <span class="count"><?= $items_sold_out; ?></span>
                    </h4>
                    <p class="text-light">Stock Telah Habis</p>
                </div>
            </div>
        </div>
    </div>
</div>

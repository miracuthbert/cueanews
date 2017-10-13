<div class="col col-12 col-sm-12 col-md-6 col-xl-7 history-col">
    <div class="card sameheight-item" data-exclude="xs">
        <div class="card-header card-header-sm bordered">
            <div class="header-block">
                <h3 class="title">Reports</h3>
            </div>
        </div>
        <div class="card-block">
            <a href="{{ route('admin.reports.metrics.download') }}" class="btn btn-primary btn-block">
                <i class="fa fa-line-chart"></i> Download Metrics Report</a>

            <a href="{{ route('admin.reports.users.download') }}" class="btn btn-success btn-block">
                <i class="fa fa-users"></i> Download Users Report</a>
        </div>
    </div>
</div>

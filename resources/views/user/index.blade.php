<div class="row wrapper border-bottom white-bg page-heading">
    @include('dashboard.component.breadcrumb', ['title' => $config['seo']['index']['title']])

    <div class="col-lg-12 mt20">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>{{ $config['seo']['index']['tableHeading'] }} </h5>
                @include('user.components.toolbox')
            </div>
            <div class="ibox-content">
                @include('user.components.filter')
                @include('user.components.table')
            </div>
        </div>
    </div>
</div>

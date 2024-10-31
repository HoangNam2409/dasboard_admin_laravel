@include('dashboard.component.breadcrumb', ['title' => $config['seo']['index']['title']])
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="col-lg-12 mt20">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>{{ $config['seo']['index']['tableHeading'] }} </h5>
                @include('dashboard.component.toolbox', ['model' => 'Language'])
            </div>
            <div class="ibox-content">
                @include('language.components.filter')
                @include('language.components.table')
            </div>
        </div>
    </div>
</div>
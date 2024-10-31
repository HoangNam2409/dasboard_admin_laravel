@include('dashboard.component.breadcrumb', ['title' => $config['seo']['create']['title']])

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@php
    $url =
        $config['method'] == 'create'
            ? route('post.catalogue.store')
            : route('post.catalogue.update', $postCatalogue->id);
@endphp
<form action="{{ $url }}" method="post" class="box" enctype="multipart/form-data">
    @csrf
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-9">
                {{-- Thông tin chung --}}
                @include('post.catalogue.components.general')

                {{-- Cấu hình chung --}}
                @include('post.catalogue.components.seo')
            </div>
            <div class="col-lg-3">
                @include('post.catalogue.components.aside')
            </div>
        </div>
        <hr>


        <div class="text-right mb15">
            <button type="submit" class="btn btn-primary" name="send" value="send">Lưu lại</button>
        </div>
    </div>
</form>

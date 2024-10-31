<form action="{{ route('post.catalogue.index') }}" method="get">
    <div class="filter-wrapper">
        <div class="uk-flex uk-flex-middle uk-flex-space-between">
            <div class="perpage">
                @php
                    $perpage = request('perpage') ?: old('perpage');
                @endphp
                <div class="uk-flex uk-flex-middle uk-flex-space-between">
                    <select name="perpage" id="perpage" class="form-control input-sm perpage fileter mr10">
                        @for ($i = 20; $i <= 200; $i += 20)
                            <option {{ $perpage == $i ? 'selected' : '' }} value="{{ $i }}">
                                {{ $i }} bản ghi</option>
                        @endfor
                    </select>
                </div>
            </div>

            @php
                $publish = request('publish') ?: old('publish');
            @endphp
            <div class="action">
                <div class="uk-flex">
                    <select name="publish" class="form-control mr10">
                        @foreach (config('apps.general.publish') as $key => $val)
                            <option value="{{ $key }}" {{ $publish == $key ? 'selected' : '' }}>
                                {{ $val }}</option>
                        @endforeach
                    </select>
                    <div class="uk-search uk-flex uk-flex-middle mr10">
                        <div class="input-group">
                            <input type="text" name="keyword" value="{{ request('keyword') ?: old('keyword') }}"
                                placeholder="Nhập từ khóa tìm kiếm..." class="form-control">
                            <span class="input-group-btn">
                                <button type="submit" name="search" value="search"
                                    class="btn btn-primary mb0 btn-sm">Tìm
                                    kiếm</button>
                            </span>
                        </div>
                    </div>
                    <a href="{{ route('post.catalogue.create') }}" class="btn btn-danger">
                        <i class="fa fa-plus mr10"></i>
                        Thêm mới nhóm bài viết
                    </a>
                </div>
            </div>
        </div>
    </div>

</form>

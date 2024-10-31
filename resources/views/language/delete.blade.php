@include('dashboard.component.breadcrumb', ['title' => $config['seo']['create']['title']])

<form action="{{ route('language.destroy', $language->id) }}" method="post" class="box">
    @csrf
    @method('DELETE')
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-5">
                <div class="panel-head">
                    <div class="panel-title">Thông tin chung</div>
                    <div class="panel-description">
                        <p>- Bạn muốn xóa ngôn ngữ: {{ $language->name }}</p>
                        <p>- Lưu ý: Không thể hồi phục thành viên sau khi xóa. Bạn chắc chắn muốn thực hiện chức năng
                            này.
                    </div>
                </div>
            </div>
            <div class="col-lg-7">
                <div class="ibox">
                    <div class="ibox-content">
                        <div class="row mb15">
                            <div class="col-lg-12">
                                <div class="form-row">
                                    <label for="" class="control-label text-left">Tên ngôn ngữ</label>
                                    <input type="text" name="name" value="{{ $language->name ?? '' }}"
                                        class="form-control" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="text-right mb15">
        <a href="{{ route('user.catalogue.index') }}" type="submit" class="btn btn-warning" name="send"
            value="send">Hủy</a>
        <button type="submit" class="btn btn-danger" name="send" value="send">Xóa dữ liệu</button>
    </div>
    </div>
</form>

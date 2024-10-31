<div class="ibox">
    <div class="ibox-title">
        <h5>Thông tin chung</h5>
    </div>
    <div class="ibox-content">
        <div class="row">
            <div class="col-lg-12">
                <div class="form-row">
                    <label for="" class="control-label text-left">Chọn danh mục cha <span
                            class="text-danger">(*)</span></label>
                    <p class="text-danger notice">*Chọn root nếu không có danh mục cha</p>
                    <select name="" class="form-control setupSelect2" id="">
                        <option value="0">Danh mục cha</option>
                        <option value="1">Root</option>
                        <option value="2">...</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="ibox">
    <div class="ibox-title">
        <h5>Chọn ảnh đại diện</h5>
    </div>
    <div class="ibox-content">
        <div class="row">
            <div class="col-lg-12">
                <div class="form-row">
                    <div class="image img-post-catalogue"><img src="/template/img/Image-not-found.png" alt="">
                    </div>
                    <input type="hidden" name="image" value="">
                </div>
            </div>
        </div>
    </div>
</div>

<div class="ibox">
    <div class="ibox-title">
        <h5>Cấu hình nâng cao</h5>
    </div>
    <div class="ibox-content">
        <div class="row">
            <div class="col-lg-12">
                <div class="form-row">
                    <div class="mb15">
                        <select name="" class="form-control" id="">
                            @foreach (config('apps.general.publish') as $key => $val)
                                <option value="$key">{{ $val }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <select name="" class="form-control" id="">
                            @foreach (config('apps.general.follow') as $key => $val)
                                <option value="$key">{{ $val }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

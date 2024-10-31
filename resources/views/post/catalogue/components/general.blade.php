<div class="ibox">
    <div class="ibox-title">
        <h5>Thông tin chung</h5>
    </div>
    <div class="ibox-content">
        <div class="row mb15">
            <div class="col-lg-12">
                <div class="form-row">
                    <label for="" class="control-label text-left">Tiêu đề nhóm bài viết <span
                            class="text-danger">(*)</span></label>
                    <input type="text" name="name" value="{{ old('name', $postCatalogue->name ?? '') }}"
                        class="form-control" placeholder="">
                </div>
            </div>
        </div>

        <div class="row mb15">
            <div class="col-lg-12">
                <div class="form-row">
                    <label for="" class="control-label text-left">Mô tả<span
                            class="text-danger">(*)</span></label>
                    <textarea name="description" class="form-control" placeholder="">{{ old('description', $postCatalogue->description ?? '') }}</textarea>
                </div>
            </div>
        </div>

        <div class="row mb15">
            <div class="col-lg-12">
                <div class="form-row">
                    <label for="" class="control-label text-left">Nội dung<span
                            class="text-danger">(*)</span></label>
                    <textarea name="content" class="form-control" placeholder="">{{ old('content', $postCatalogue->content ?? '') }}</textarea>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="ibox">
    <div class="ibox-title">
        <h5>Cấu hình SEO</h5>
    </div>
    <div class="ibox-content">
        <div class="seo-container">
            <div class="meta-title">Lộ trình học Laravel từ A – Z cho người mới - CodeGym</div>
            <div class="canonical">http://laravel.com/tu-hoc-laravel.html</div>
            <div class="meta-description">Trước khi bắt đầu lộ trình học Laravel, bạn cần tìm hiểu các
                kiến thức về Laravel Artisan, mô hình MVC, Blade Template, Eloquent ORM và Middleware.
                2.1. Laravel ...</div>
        </div>
        <div class="seo-wrapper">
            <div class="row mb15">
                <div class="col-lg-12">
                    <div class="form-row">
                        <label for="" class="control-label text-left">
                            <div class="uk-flex uk-flex-middle uk-flex-space-between">
                                <span>Tiêu đề SEO</span>
                                <span class="count_meta-title">0 ký tự </span>
                            </div>
                        </label>
                        <input type="text" name="meta_title"
                            value="{{ old('meta_title', $postCatalogue->meta_title ?? '') }}" class="form-control"
                            placeholder="">
                    </div>
                </div>
            </div>

            <div class="row mb15">
                <div class="col-lg-12">
                    <div class="form-row">
                        <label for="" class="control-label text-left">Từ khóa SEO</label>
                        <input type="text" name="meta_keyword"
                            value="{{ old('meta_keyword', $postCatalogue->meta_keyword ?? '') }}" class="form-control"
                            placeholder="">
                    </div>
                </div>
            </div>

            <div class="row mb15">
                <div class="col-lg-12">
                    <div class="form-row">
                        <label for="" class="control-label text-left">
                            <div class="uk-flex uk-flex-middle uk-flex-space-between">
                                <span>Mô tả SEO</span>
                                <span class="count_meta-description">0 ký tự </span>
                            </div>
                        </label>
                        <textarea name="meta_description" class="form-control" placeholder="">{{ old('meta_description', $postCatalogue->meta_description ?? '') }}</textarea>
                    </div>
                </div>
            </div>

            <div class="row mb15">
                <div class="col-lg-12">
                    <div class="form-row">
                        <label for="" class="control-label text-left">Đường dẫn</label>
                        <input type="text" name="canonical"
                            value="{{ old('canonical', $postCatalogue->canonical ?? '') }}" class="form-control"
                            placeholder="">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

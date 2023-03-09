<div class="card card-olive card-outline">
    <div class="card-header">
        <div class="d-flex">
            <div class="mr-auto">
                <h3 class="card-title mt-1">
                    <i class="fa fa-calendar-alt"></i>
                    &nbsp; {{ $title }}
                </h3>
            </div>
            <div class="mr-1">
                <a href="{{ route('administrator.sms-mail.index') }}" class="btn btn-secondary btn-flat btn-sm">
                    <i class="fa fa-arrow-left"></i>
                    &nbsp;&nbsp; Kembali
                </a>
            </div>
            @if ($action !== 'show')
                <div class="">
                    <button type="submit" class="btn btn-info btn-flat btn-sm">
                        <i class="fa fa-check"></i>
                        &nbsp;&nbsp; Simpan
                    </button>
                </div>
            @endif
        </div>
    </div>
    <div class="card-body p-0">
        <div id="stepperForm" class="bs-stepper linear">
            <div class="bs-stepper-header" role="tablist">
                <div class="step active" data-target="#category-part">
                    <button type="button" class="step-trigger" role="tab" aria-controls="category-part"
                        id="category-part-trigger" aria-selected="true">
                        <span class="bs-stepper-circle">1</span>
                        <span class="bs-stepper-label">Kategori & Template</span>
                    </button>
                </div>
                <div class="line"></div>
                <div class="step" data-target="#information-part">
                    <button type="button" class="step-trigger" role="tab" aria-controls="information-part"
                        id="information-part-trigger" aria-selected="false" disabled="disabled">
                        <span class="bs-stepper-circle">2</span>
                        <span class="bs-stepper-label">Informasi</span>
                    </button>
                </div>
                <div class="line"></div>
                <div class="step" data-target="#tenant-part">
                    <button type="button" class="step-trigger" role="tab" aria-controls="tenant-part"
                        id="tenant-part-trigger" aria-selected="false" disabled="disabled">
                        <span class="bs-stepper-circle">3</span>
                        <span class="bs-stepper-label">Tenants</span>
                    </button>
                </div>
                <div class="line"></div>
                <div class="step" data-target="#review-part">
                    <button type="button" class="step-trigger" role="tab" aria-controls="review-part"
                        id="review-part-trigger" aria-selected="false" disabled="disabled">
                        <span class="bs-stepper-circle">4</span>
                        <span class="bs-stepper-label">Review</span>
                    </button>
                </div>


            </div>
            <div class="bs-stepper-content">

                <div id="category-part" class="content active dstepper-block bs-stepper-pane" role="tabpanel"
                    aria-labelledby="category-part-trigger">

                    <div class="row">
                        <div class="col-sm-12">
                            <!-- text input -->
                            <div class="form-group">
                                <label> {{ __('Kategori') }} </label>
                                <select id="category-mail" class="form-control select2" style="width: 100%;" name="category">
                                </select>
                                <div class="invalid-feedback">Please fill the category field</div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <!-- text input -->
                            <div class="form-group">
                                <label> {{ __('Template') }} </label>
                                <select id="template-mail" class="form-control select2" style="width: 100%;" name="template">
                                </select>
                                <div class="invalid-feedback">Please fill the Template field</div>
                            </div>
                        </div>
                    </div>

                    <button class="btn btn-primary btn-next-form" onclick="stepperForm.next()">Next</button>
                </div>

                <div id="information-part" class="content bs-stepper-pane" role="tabpanel" aria-labelledby="information-part-trigger">
                    <div id="information-input-box">

                    </div>

                    <button class="btn btn-primary" onclick="stepperForm.previous()">Previous</button>
                    <button class="btn btn-primary btn-next-form" id="btn-next-information-part" onclick="stepperForm.next()">Next</button>

                </div>

                <div id="tenant-part" class="content bs-stepper-pane" role="tabpanel" aria-labelledby="tenant-part-trigger">
                    <div class="row">
                        @foreach ($hashtagCategories as $hashtagCategory)
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <div
                                        class="custom-control custom-switch custom-switch-off-warning custom-switch-on-success">
                                        <input class="custom-control-input hashtag-category"
                                            data-text="{{ str_replace('_', ' ', strtoupper($hashtagCategory->name)) }}"
                                            type="checkbox" id="{{ $hashtagCategory->name }}"
                                            value="{{ $hashtagCategory->id }}">
                                        <label for="{{ $hashtagCategory->name }}"
                                            class="custom-control-label">{{ str_replace('_', ' ', strtoupper($hashtagCategory->name)) }}</label>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <hr>

                    <div class="filter-tenant d-none" id="filter-tenant">
                        <div class="row">
                            <div class="col-auto mr-auto">
                                <h4 class="filter-category-title">Title</h4>
                            </div>
                            <div class="col-auto">
                                <div
                                    class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                    <input class="custom-control-input filter-category-check-all" data-text=""
                                        type="checkbox" value="">
                                    <label for=""
                                        class="custom-control-label filter-category-label-check-all">Check All</label>
                                </div>
                            </div>
                        </div>
                        <div class="filter-category-checkbox">

                        </div>
                    </div>

                    <button class="btn btn-primary" onclick="stepperForm.previous()">Previous</button>
                    <button class="btn btn-primary btn-next-form" onclick="stepperForm.next()">Next</button>
                </div>

                <div id="review-part" class="content bs-stepper-pane" role="tabpanel" aria-labelledby="review-part-trigger">
                    <div class="row">
                        <div class="col-sm-12">
                        <!-- text input -->
                            <div class="form-group">
                                <label> Judul </label>
                                <input id="template-title" type="text" name="title" class="form-control" placeholder="Judul ..." value="" >
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Deskripsi</label>
                                <textarea id="template-content" name="description" class="form-control tinymce-editor" placeholder="Deskripsi ..." rows="2"></textarea>
                            </div>
                        </div>
                    </div>

                    <button class="btn btn-primary" onclick="stepperForm.previous()">Previous</button>
                    <!--<button type="submit" class="btn btn-primary">Submit</button>-->

                </div>


            </div>


        </div>
    </div>
</div>


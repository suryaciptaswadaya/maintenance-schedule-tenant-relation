<div class="">
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
                    <a href="{{ route('administrator.maintenance-schedule.index') }}" class="btn btn-secondary btn-flat btn-sm">
                        <i class="fa fa-arrow-left"></i>
                        &nbsp;&nbsp; Kembali
                    </a>
                </div>
                @if ($action !==  "show")
                    <div class="">
                        <button type="submit" class="btn btn-info btn-flat btn-sm">
                            <i class="fa fa-check"></i>
                            &nbsp;&nbsp; Simpan
                        </button>
                    </div>
                @endif
            </div>
        </div>
        <div class="card-body">
            @if ($errors->all())
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h5><i class="icon fas fa-ban"></i> Alert!</h5>
                <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
                </ul>
            </div>
            @endif
            <div class="row">
                <div class="col-sm-5">
                    <label>Waktu Maintenance</label>
                    <div class="input-group" >
                        <input type="text" name="start_date_time" @if ($action ===  "show") disabled @endif class="form-control text-right daterange-single @error('start_date_time') is-invalid @enderror" placeholder="{{ now()->format('d-m-Y H:i') }}" value="{{ old('start_date_time', $data->start_date_time) }}" required>
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="fas fa-ellipsis-v"></i></span>
                        </div>
                        <input type="text" name="end_date_time" @if ($action ===  "show") disabled @endif class="form-control  daterange-single @error('end_date_time') is-invalid @enderror" placeholder="{{ now()->format('d-m-Y H:i') }}" value="{{ old('end_date_time', $data->end_date_time) }}" required>
                    </div>
                </div>

                <div class="col-sm-3">
                    <!-- text input -->
                    <div class="form-group">
                        <label> {{ __('Kategori') }} </label>
                        <select id="" class="form-control select2 select2-js-test" style="width: 100%;" name="umkm_id">
                            <option></option>
                            <option value="Kategori 1">Kategori 1</option>
                            <option value="Kategori 2">Kategori 2</option>
                            <option value="Kategori 3">Kategori 3</option>
                            <option value="Kategori 4">Kategori 4</option>
                        </select>
                    </div>
                </div>

                <div class="col-sm-4">
                    <!-- text input -->
                    <div class="form-group">
                        <label> {{ __('Perusahaan') }} </label>
                        <select id="" class="form-control select2 select2-js"  multiple="multiple" style="width: 100%;" name="umkm_id">
                            <option value="Perusahaan 1">Perusahaan 1</option>
                            <option value="Perusahaan 2">Perusahaan 2</option>
                            <option value="Perusahaan 3">Perusahaan 3</option>
                            <option value="Perusahaan 4">Perusahaan 4</option>
                        </select>
                    </div>
                </div>

                <div class="col-sm-12">
                <!-- text input -->
                    <div class="form-group">
                        <label> {{ __('Judul') }} </label>
                        <input type="text" name="subject" @if ($action ===  "show") disabled @endif class="form-control @error('subject') is-invalid @enderror" placeholder="Judul ..." value="{{ old('subject', $data->subject) }}" required>
                    </div>
                </div>

                <div class="col-sm-12">
                    <div class="form-group">
                        <label>Deskripsi</label>
                        <textarea id="tinymce-editor" name="content" class="form-control  @error('content') is-invalid @enderror" placeholder="Description ..." rows="2" @if ($action ===  "show") disabled @endif >{{ old('content', $data->content) }}</textarea>
                    </div>
                </div>



            </div>
        </div>
    </div>
</div>

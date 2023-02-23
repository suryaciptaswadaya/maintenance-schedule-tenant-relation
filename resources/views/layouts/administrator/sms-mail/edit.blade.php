@extends('adminlte::page')

@section('title', 'Pemberdayaan')

@section('content_header')


<div class="row mb-2">
    <div class="col-sm-6">
        <h1 class="m-0 text-dark">{{ $title }}</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Kreatifitas Masyarakat</a></li>
            <li class="breadcrumb-item"><a href="#">{{ $title }}</a></li>
        </ol>
    </div>
</div>
@stop

@section('content')
<div class="row">
    <form role="form" action="{{ route('administrator.masyarakat-creativity.update',$data->id) }}" method="POST" class="col-md-12" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include("layouts.administrator.masyarakat-creativity.fields")
    </form>
</div>
@stop

@section('css')
    <!--<link rel="stylesheet" href="/css/admin_custom.css">-->
@stop

@push('js')
<script src="https://cdn.tiny.cloud/1/88sysgy3de5twnl1vna0apf5dkw6ukgpi3c3bnsmj3fjqrz3/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script type="text/javascript">

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).ready(function() {

        $('#image').change(function(){
            let reader = new FileReader();
            reader.onload = (e) => {
                $('#preview-image-before-upload').attr('src', e.target.result);
            }

            reader.readAsDataURL(this.files[0]);
        });

        tinymce.init({
            selector: 'textarea#tinymce-editor',
            //height: 500,
            menubar: false,
            plugins: [
                'autolink lists link image charmap print preview anchor',
                'searchreplace visualblocks code fullscreen',
                'insertdatetime media table paste code help wordcount'
            ],
            toolbar: 'undo redo | formatselect | ' +
            'bold italic backcolor | alignleft aligncenter ' +
            'alignright alignjustify | bullist numlist outdent indent | ' +
            'removeformat | help',
            content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }'
        });

        $('.custom-file input').change(function (e) {
            if (e.target.files.length) {
                $(this).next('.custom-file-label').html(e.target.files[0].name);
            }
        });
    });



</script>
@endpush

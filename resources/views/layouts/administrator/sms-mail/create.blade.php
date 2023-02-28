@extends('adminlte::page')

@section('title', 'Mail')

@section('content_header')


<div class="row mb-2">
    <div class="col-sm-6">
        <h1 class="m-0 text-dark">{{ $title }}</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Mail</a></li>
            <li class="breadcrumb-item"><a href="#">{{ $title }}</a></li>
        </ol>
    </div>
</div>
@stop

@section('content')
<div class="row">
    <form role="form" action="{{ route('administrator.sms-mail.store') }}" method="POST" class="col-md-12" enctype="multipart/form-data">
        @csrf
        @include("layouts.administrator.sms-mail.fields")
    </form>
</div>
@stop

@section('css')
    <!--<link rel="stylesheet" href="/css/admin_custom.css">-->
@stop
@section('plugins.Select2', true)
@section('plugins.Moment', true)
@section('plugins.BsStepper', true)
@push('js')
<script src="https://cdn.tiny.cloud/1/88sysgy3de5twnl1vna0apf5dkw6ukgpi3c3bnsmj3fjqrz3/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script type="text/javascript">

// BS-Stepper Init
    document.addEventListener('DOMContentLoaded', function () {
        window.stepper = new Stepper(document.querySelector('.bs-stepper'))
    })

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).ready(function() {
        //var stepper = new Stepper($('.bs-stepper')[0])

        $(".select2-js").select2({
            placeholder: 'Pilih Perusahaan',
            minimumInputLength: 2,
            //theme: 'bootstrap4',
            // ajax: {
            //     url : "#",
            //     method : "POST",
            //     dataType : 'json',
            //     delay: 1000,
            //     data: function(params) {
            //         var query = {
            //             search: params.term,
            //             page: params.page || 1
            //         }
            //         // Query parameters will be ?search=[term]&page=[page]
            //         return query;
            //     },
            //     processResults: function (response) {
            //         return {
            //             results: response
            //         };
            //     }
            // }
        });

        $(".select2-js-test").select2({
            placeholder: 'Pilih Kategori',
            minimumInputLength: 2,
            //theme: 'bootstrap4',
            // ajax: {
            //     url : "#",
            //     method : "POST",
            //     dataType : 'json',
            //     delay: 1000,
            //     data: function(params) {
            //         var query = {
            //             search: params.term,
            //             page: params.page || 1
            //         }
            //         // Query parameters will be ?search=[term]&page=[page]
            //         return query;
            //     },
            //     processResults: function (response) {
            //         return {
            //             results: response
            //         };
            //     }
            // }
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

        $('.daterange-single').daterangepicker({
            singleDatePicker: true,
            autoApply: true,
            timePicker:true,
            timePicker24Hour:true,
            locale: {
                format: 'DD-MM-YYYY T HH:mm'
            }
        });




        getHashTags();
        getTenants();
        searchCheckboxIds();
        getHashTagsIds();
        hashTagTrigger();

        //getHashTags();


    });

    function searchCheckboxIds(){
        $('.hashtag-category').click(function(){
            $(this).prop('checked')
            let hashTagCategoryIds = getHashTagsCategoryIds();
            getHashTags(hashTagCategoryIds);
        });
    }

    function hashTagTrigger()
    {
       $('#hashtags').on('select2:select',function(){
            let hashTagCategoryIds = getHashTagsCategoryIds();
            let hashTagIds = getHashTagsIds();
            console.log(hashTagCategoryIds,hashTagIds);
            getTenants(hashTagCategoryIds,hashTagIds)
        });
    }

    function getHashTags(hashTagCategory)
    {
        $("#hashtags").select2({
            placeholder: 'Pilih Kategori',
            minimumInputLength: 1,
            closeOnSelect: false,
            ajax: {
                url : "{{ route('administrator.sms-hashtag.json') }}",
                method : "POST",
                dataType : 'json',
                delay: 1000,
                data: function(params) {
                    var query = {
                        search: params.term,
                        //page: params.page || 1,
                        hash_tag_category: hashTagCategory
                    }
                    // Query parameters will be ?search=[term]&page=[page]
                    return query;
                },
                processResults: function (response) {
                    return {
                        results: response
                    };
                }
            }
        });
    }

    function getHashTagsCategoryIds()
    {
        let searchCategoryIds = $("input:checkbox:checked").map(function(){
            return $(this).val();
        }).toArray();

        return searchCategoryIds;
    }

    function getHashTagsIds()
    {
        let hashTagIds = [];
        $.each($('#hashtags').find(":selected"), function (i, item) {
            // custom attribute hashTagIds.push($(item).data());
            hashTagIds.push($(item).val());

        });
        return hashTagIds;
    }

    function getTenants(hashTagCategory = '', hashTag ='')
    {
        $("#tenants").select2({
            placeholder: 'Pilih Tenants',
            minimumInputLength: 1,
            closeOnSelect: false,
            ajax: {
                url : "{{ route('administrator.sms-tenant.json') }}",
                method : "POST",
                dataType : 'json',
                delay: 1000,
                data: function(params) {
                    var query = {
                        search: params.term,
                        hash_tag_category: hashTagCategory,
                        hash_tag: hashTag
                    }
                    // Query parameters will be ?search=[term]&page=[page]
                    return query;
                },
                processResults: function (response) {
                    return {
                        results: response
                    };
                }
            }
        });

    }





    //    $('.hashtag-category').on('change', function() {
    //     var searchIDs = $('.hashtag-category').val($('input:checkbox:checked').map(function() {
    //             return $(this).val();
    //         }).toArray());


    //     });
        // var rfs = $(this).val();
            // $.ajax({
            //     url : "#",
            //     method : "POST",
            //     data : {date: rfs},
            //     async : true,
            //     dataType : 'json',
            //     beforeSend: function () {
            //         $("#modalLoading").modal('show');
            //     },
            //     success:function(data, text) {
            //         vatMultiplier = parseFloat(data.vat.multiply_vat);
            //         vatValue = parseFloat(data.vat.value);
            //         $('#ppn-value').text(vatValue);
            //         for (let index = 0; index < $('[name^="price_surcharge"]').length; index++) {
            //             let val = $('#product-surcharge-' + index).val();
            //             $('#product-surcharge-' + index).val(val).trigger("change");
            //         }
            //         for (let index = 0; index < $('[name^="price_sell"]').length; index++) {
            //             let val = $('#product-sell-' + index).val();
            //             $('#product-sell-' + index).val(val).trigger("change");
            //         }
            //         if ($('#package-service-plan').val().length != 0){
            //             $('#package-service-plan').change();
            //         }
            //     },
            //     error: function(request, status, error){
            //         var regex = /(?<=\[).+?(?=\])/g;
            //         toastr.error(request.responseJSON?.errors ? regex.exec(JSON.stringify(request.responseJSON?.errors)) : request.responseJSON?.message, error);
            //     },
            //     complete: function(data) {
            //         $("#modalLoading").modal('hide');
            //     },
            // });
        //});
</script>

@endpush

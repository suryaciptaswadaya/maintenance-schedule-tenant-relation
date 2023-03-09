@extends('layouts.master-adminlte')

@section('title', 'Mail')

@section('content_header')
@include('layouts.include.loading',['modalTitle' => 'Please Wait...'])
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
    <form role="form was-validated" action="{{ route('administrator.sms-mail.store') }}" method="POST" class="col-md-12" onsubmit="return false" enctype="multipart/form-data">
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
@section('plugins.Sweetalert2', true)

@push('js')
<script src="https://cdn.tiny.cloud/1/88sysgy3de5twnl1vna0apf5dkw6ukgpi3c3bnsmj3fjqrz3/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script type="text/javascript">

    //BS-Stepper Init
    document.addEventListener('DOMContentLoaded', function () {
       //window.stepper = new Stepper(document.querySelector('.bs-stepper'))

        var stepperFormEl = document.querySelector('#stepperForm')
        window.stepperForm = new Stepper(stepperFormEl)
        // var btnNextList = [].slice.call(document.querySelectorAll('.btn-next-form'))
        var stepperPanList = [].slice.call(stepperFormEl.querySelectorAll('.bs-stepper-pane'))
        var inputCategoryMailForm = document.getElementById('category-mail')
        var inputTemplateMailForm = document.getElementById('template-mail')

        var form = stepperFormEl.querySelector('.bs-stepper-content');

        stepperFormEl.addEventListener('show.bs-stepper', function (event) {

            form.classList.remove('was-validated')
            var nextStep = event.detail.indexStep
            var currentStep = nextStep

            var checkboxesTenant = document.querySelectorAll('.tenant');

            var informationTemplate = document.querySelectorAll('.information-template');

            var checkedTenant = false;
            var checkedInformation = false;



            for (var i = 0; i < checkboxesTenant.length; i++) {
                if (checkboxesTenant[i].checked) {
                    checkedTenant = true;
                    break;
                }
            }

            for (let i = 0; i < informationTemplate.length; i++) {
                if (informationTemplate[i].value) {
                    checkedInformation = true;
                    break;
                }
            }

            //console.log(currentStep);


            if (currentStep > 0) {
                currentStep--
            }

            var stepperPan = stepperPanList[currentStep];

            //console.log(stepperPan.getAttribute('id'));

            if ((stepperPan.getAttribute('id') === 'category-part' && !inputCategoryMailForm.value.length || !inputTemplateMailForm.value.length)
                ||
                (stepperPan.getAttribute('id') === 'tenant-part' && !checkedTenant)
                ||
                (stepperPan.getAttribute('id') === 'information-part' && !checkedInformation)
            ) {

                event.preventDefault()
                @include('layouts.include.sweetalert',['title' => 'Oops..', 'text'=>'Silahkan lengkapi data yang diinput', 'type'=>'error'])
                //form.classList.add('was-validated')

            }
         })
    })

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).ready(function() {

        /*Begin - Kategori & Tempalte*/
        getCategory();
        categoryMailTrigger();
        getMailTempalte();
        mailTemplateHashTagTrigger();
        /*End - Kategori & Tempalte*/


        /*Begin - Tenant*/
        propCheckAllHashTag();
        propCheckHashTag();
        propCheckAllTenant();
        searchCheckboxHashTagCategoryIds();
        searchChechkboxHastagIds();
        /*End - Tenant*/

        tinyMCEEditor();

        replaceTemplateContent();


    });



    function searchCheckboxHashTagCategoryIds(){
        $('.hashtag-category').click(function(){
            $(this).prop('checked');
            let template = $('#filter-tenant');

            if (this.checked) {
                // if checked clone without events and append
                let idCategory = $(this).val();
                //console.log(idCategory);
                let idCheckbox = `checkbox-${idCategory}`;
                let _token = $('input[name="_token"]').val();
                let clone = template.clone().attr('id',idCategory).removeClass('d-none');
                $('.filter-category-title', clone).text($(this).data('text'));
                $('.filter-category-checkbox', clone).attr('id',idCheckbox);

                $('.filter-category-check-all', clone).attr('id',`check-all-${idCategory}`).attr('value',`check-all-${idCategory}`).addClass('check-all-hashtag');
                $('.filter-category-label-check-all', clone).attr('for',`check-all-${idCategory}`);

                //var id=$(this).val();
                //var listBandwidth = "#list-bandwidth";
                $.ajax({
                    url : "{{ route('administrator.sms-hashtag.html') }}",
                    method : "POST",
                    data : {id_hash_tag_category: idCategory,  _token:_token},
                    async : true,
                    dataType : 'json',
                    beforeSend: function () {
                        $("#modalLoading").modal('show');
                    },
                    success: function(data){
                        console.log(idCheckbox);
                        $(`#${idCheckbox}`).html(data.response);
                    },complete: function(data) {
                        $("#modalLoading").modal('hide');
                    },
                });
                template.before(clone);
            } else {
                //console.log($(this).val());
                $('#'+$(this).val()).remove();
            }

            // var template = $('#filter-tenant');
            // template.before(clone);

            //let hashTagCategoryIds = getHashTagsCategoryIds();
            //console.log(hashTagCategoryIds);
            //searchChechkboxHastagIds();
            //getHashTags(hashTagCategoryIds);
        });
    }

    function propCheckAllHashTag()
    {
        $(document).on("change", ".check-all-hashtag", function() {
            let checkAllClassGroup = $(this).val();
            // let status = this.checked ? true : false;
            // $(this).prop({
            //     'checked': status
            // });

            if ($(this).is(':checked')) {
                $(`.${checkAllClassGroup}`).prop('checked', true);
                $('#tenant').remove();
                getTenants();
            }else{
                $(`.${checkAllClassGroup}`).prop('checked', false);
                $('#tenant').remove();
                getTenants();
            }
            //console.log($(this).val());
            //let test = getHashTagsIds();
            // let test = getHashTagsIds();
            // console.log(test);
        });
    }

    function propCheckHashTag()
    {
        $(document).on("change", ".hashtag", function() {
            let checkHashTag = $(this).val();
            // let status = this.checked ? true : false;
            // $(this).prop({
            //     'checked': status
            // });

            if ($(this).is(':checked')) {
                $(`#${checkHashTag}`).prop('checked', true);
            }else{
                $(`#${checkHashTag}`).prop('checked', false);
            }
            //console.log($(this).val());
            //let test = getHashTagsIds();
            // let test = getHashTagsIds();
            // console.log(test);
        });
    }

    function propCheckAllTenant()
    {
        $(document).on("change", "#check-all-tenant", function() {
            let checkAllClassGroup = $(this).val();
            //console.log(checkAllClassGroup);
            if ($(this).is(':checked')) {
                $(`.${checkAllClassGroup}`).prop('checked', true);
            }else{
                $(`.${checkAllClassGroup}`).prop('checked', false);
            }
        });
    }



    function getHashTagsCategoryIds()
    {
        let searchCategoryIds = $(".hashtag-category:checked").map(function(){
            return $(this).val();
        }).toArray();

        return searchCategoryIds;
    }

    function getHashTagsIds()
    {
        let searchHashtagIds = $(".hashtag:checked").map(function(){
            return $(this).val();
        }).toArray();

        //console.log(searchHashtagIds);;
        return searchHashtagIds;
    }

    function getTenantIds()
    {
        let searchTenantIds = $(".tenant:checked").map(function(){
            return $(this).val();
        }).toArray();

        //console.log(searchHashtagIds);;
        return searchTenantIds;
    }

    function getCategory(){
        $("#category-mail").select2({
            placeholder: 'Pilih Kategori',
            //minimumInputLength: 1,
            //closeOnSelect: false,
            ajax: {
                url : "{{ route('administrator.sms-mail-category.json') }}",
                method : "POST",
                dataType : 'json',
                delay: 1000,
                data: function(params) {
                    var query = {
                        search: params.term
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

    function categoryMailTrigger()
    {
        $('#category-mail').on('select2:select',function(){
            let categoryId = getCategoryMailId();
            //console.log(categoryId);
            $("#template-mail").empty().trigger('change');
            getMailTempalte(categoryId)
        });
    }

    function getCategoryMailId()
    {
        let categoryIds = "";
        categoryIds = $('#category-mail').find(":selected").val();
        return categoryIds;
    }

    function getMailTempalte(mailCategoryId)
    {
        $("#template-mail").select2({
            placeholder: 'Pilih Template',
            //minimumInputLength: 1,
            //closeOnSelect: false,
            ajax: {
                url : "{{ route('administrator.sms-mail-template.json') }}",
                method : "POST",
                dataType : 'json',
                delay: 1000,
                data: function(params) {
                    var query = {
                        search: params.term,
                        mail_category_id: mailCategoryId
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

    function mailTemplateHashTagTrigger()
    {
        $(document).on("select2:select", "#template-mail", function(item) {
            let data = item.params.data;
            let templateMailId = data.id;
            let _token = $('input[name="_token"]').val();
            //console.log(data.id);

            $.ajax({
                url : "{{ route('administrator.sms-mail-template-hashtag.html') }}",
                method : "POST",
                data : {id:templateMailId, _token:_token},
                async : true,
                dataType : 'json',
                beforeSend: function () {
                    $("#modalLoading").modal('show');
                },
                success: function(data){
                    if (data.response === 'empty') {
                        $('#information-input-box').remove();
                    } else {
                        $(`#information-input-box`).html(data.response);

                        getTitleContentTemplate(data.title, data.content);

                    }
                    singleTimePicker();
                    singleDatePicker();

                },
                complete: function(data) {
                    $("#modalLoading").modal('hide');
                }
            });
            //template.after(clone);
        });

    }

    function searchChechkboxHastagIds()
    {
        $(document).on("click", ".hashtag", function() {
            //$(this).prop('checked');

            if (this.checked) {
                $('#tenant').remove();
                getTenants();
            }else{
                $('#tenant').remove();
                getTenants();
            }
        });
    }

    function getTenants()
    {
        let template = $('#filter-tenant');

        //let hashTagCategoryIds = getHashTagsCategoryIds();
        let hashTagIds = getHashTagsIds();

        // if checked clone without events and append
        let idCategory = 'tenant';
        let idCheckbox = `checkbox-${idCategory}`;

        let _token = $('input[name="_token"]').val();
        let clone = template.clone().attr('id',idCategory).removeClass('d-none');
        $('.filter-category-title', clone).text("TENANTS");
        $('.filter-category-checkbox', clone).attr('id',idCheckbox);

        $('.filter-category-check-all', clone).attr('id',`check-all-${idCategory}`).attr('value',`check-all-${idCategory}`);
        $('.filter-category-label-check-all', clone).attr('for',`check-all-${idCategory}`);

        //var id=$(this).val();
        //var listBandwidth = "#list-bandwidth";
        $.ajax({
            url : "{{ route('administrator.sms-tenant.html') }}",
            method : "POST",
            data : {hash_tag_ids:hashTagIds, _token:_token},
            async : true,
            dataType : 'json',
            beforeSend: function () {
                $("#modalLoading").modal('show');
            },
            success: function(data){
                if (data.response === 'empty') {
                    $('#tenant').remove();
                } else {
                    $(`#${idCheckbox}`).html(data.response);
                }
            },
            complete: function(data) {
                $("#modalLoading").modal('hide');
            }
        });
        template.after(clone);
    }

    function singleTimePicker()
    {
        $('.single-time-picker').daterangepicker({
            timePicker : true,
            singleDatePicker:true,
            timePicker24Hour : true,
            timePickerIncrement : 15,
            autoApply: true,
            //autoUpdateInput: false,
            //timePickerSeconds : true,
            locale : {
                format : 'HH:mm'
            }
            }).on('show.daterangepicker', function(ev, picker) {
                picker.container.find(".calendar-table").hide();
        }).val('');
    }

    function singleDatePicker(){
            $('.single-date-picker').daterangepicker({
            singleDatePicker: true,
            //autoUpdateInput: false,
            showDropdowns: true,
            startDate: new Date(),
            autoApply: true,
            minYear: 2023,
            maxYear: 2040,
            locale: {
                format: 'DD-MM-YYYY'
            }
        }).val('');
    }

    function tinyMCEEditor()
    {
        tinymce.init({
            selector: 'textarea.tinymce-editor',
            height: 500,
            menubar: false,
            resize: 'both',
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
    }

    function getTitleContentTemplate(title, content)
    {
        $('#template-title').val(title);
        //$('#template-content').val(content);
        tinymce.get('template-content').setContent(content);
        return;
    }

    function replaceTemplateContent()
    {
        var btnNextInformationPart = document.getElementById('btn-next-information-part'); // selecting the button element by its id

        btnNextInformationPart.addEventListener('click', function() {
            //console.time();
            let informationTemplate = document.querySelectorAll('.information-template');
            let textNeedReplace = document.getElementById('template-content').value;

            let arrayInformationTemplate = [];

            for (let i = 0; i < informationTemplate.length; i++) {
                //if(informationTemplate.)
                arrayInformationTemplate[ informationTemplate[i].id ] = informationTemplate[i].value;
            }

            // bisa pake ini atau regex
            // for (let key in arrayInformationTemplate) {
            //     textNeedReplace = textNeedReplace.replace(`[${key}]`, arrayInformationTemplate[key]);
            // }

            let regex = /\[(.*?)\]/g;

            let result = textNeedReplace.replace(regex, (match, p1) => {
                return arrayInformationTemplate[p1] || "";
            });

            tinymce.get('template-content').setContent(result);
            //console.timeEnd();
        });
    }



    // function getHashTagsIds()
    // {
    //     let hashTagIds = [];
    //     $.each($('#hashtags').find(":selected"), function (i, item) {
    //         // custom attribute hashTagIds.push($(item).data());
    //         hashTagIds.push($(item).val());
    //     });

    //     return hashTagIds;
    // }



    // function getTenants(hashTagCategory = '', hashTag ='')
    // {
    //     $("#tenants").select2({
    //         placeholder: 'Pilih Tenants',
    //         minimumInputLength: 1,
    //         closeOnSelect: false,
    //         ajax: {
    //             url : "{{ route('administrator.sms-tenant.json') }}",
    //             method : "POST",
    //             dataType : 'json',
    //             delay: 1000,
    //             data: function(params) {
    //                 var query = {
    //                     search: params.term,
    //                     hash_tag_category: hashTagCategory,
    //                     hash_tag: hashTag
    //                 }
    //                 // Query parameters will be ?search=[term]&page=[page]
    //                 return query;
    //             },
    //             processResults: function (response) {
    //                 return {
    //                     results: response
    //                 };
    //             }
    //         }
    //     });

    // }

     // function hashTagTrigger()
    // {
    //    $('#hashtags').on('select2:select',function(){
    //         let hashTagCategoryIds = getHashTagsCategoryIds();
    //         let hashTagIds = getHashTagsIds();
    //         console.log(hashTagCategoryIds,hashTagIds);
    //         getTenants(hashTagCategoryIds,hashTagIds)
    //     });
    // }

    // function getHashTags(hashTagCategory)
    // {
    //     $("#hashtags").select2({
    //         placeholder: 'Pilih Kategori',
    //         minimumInputLength: 1,
    //         closeOnSelect: false,
    //         ajax: {
    //             url : "{{ route('administrator.sms-hashtag.json') }}",
    //             method : "POST",
    //             dataType : 'json',
    //             delay: 1000,
    //             data: function(params) {
    //                 var query = {
    //                     search: params.term,
    //                     //page: params.page || 1,
    //                     hash_tag_category: hashTagCategory
    //                 }
    //                 // Query parameters will be ?search=[term]&page=[page]
    //                 return query;
    //             },
    //             processResults: function (response) {
    //                 return {
    //                     results: response
    //                 };
    //             }
    //         }
    //     });
    // }




    //    $('.hashtag-category').on('change', function() {
    //     var searchIDs = $('.hashtag-category').val($('input:checkbox:checked').map(function() {
    //             return $(this).val();
    //         }).toArray());


    //     });

    //var stepper = new Stepper($('.bs-stepper')[0])

        // $(".select2-js").select2({
        //     placeholder: 'Pilih Perusahaan',
        //     minimumInputLength: 2,
        //     //theme: 'bootstrap4',
        //     // ajax: {
        //     //     url : "#",
        //     //     method : "POST",
        //     //     dataType : 'json',
        //     //     delay: 1000,
        //     //     data: function(params) {
        //     //         var query = {
        //     //             search: params.term,
        //     //             page: params.page || 1
        //     //         }
        //     //         // Query parameters will be ?search=[term]&page=[page]
        //     //         return query;
        //     //     },
        //     //     processResults: function (response) {
        //     //         return {
        //     //             results: response
        //     //         };
        //     //     }
        //     // }
        // });

        // $(".select2-js-test").select2({
        //     placeholder: 'Pilih Kategori',
        //     minimumInputLength: 2,
        //     //theme: 'bootstrap4',
        //     // ajax: {
        //     //     url : "#",
        //     //     method : "POST",
        //     //     dataType : 'json',
        //     //     delay: 1000,
        //     //     data: function(params) {
        //     //         var query = {
        //     //             search: params.term,
        //     //             page: params.page || 1
        //     //         }
        //     //         // Query parameters will be ?search=[term]&page=[page]
        //     //         return query;
        //     //     },
        //     //     processResults: function (response) {
        //     //         return {
        //     //             results: response
        //     //         };
        //     //     }
        //     // }
        // });

        // tinymce.init({
        //     selector: 'textarea#tinymce-editor',
        //     //height: 500,
        //     menubar: true,
        //     plugins: [
        //         'autolink lists link image charmap print preview anchor',
        //         'searchreplace visualblocks code fullscreen',
        //         'insertdatetime media table paste code help wordcount'
        //     ],
        //     toolbar: 'undo redo | formatselect | ' +
        //     'bold italic backcolor | alignleft aligncenter ' +
        //     'alignright alignjustify | bullist numlist outdent indent | ' +
        //     'removeformat | help',
        //     content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }'
        // });

        // $('.daterange-single').daterangepicker({
        //     singleDatePicker: true,
        //     autoApply: true,
        //     timePicker:true,
        //     timePicker24Hour:true,
        //     locale: {
        //         format: 'DD-MM-YYYY T HH:mm'
        //     }
        // });

</script>

@endpush

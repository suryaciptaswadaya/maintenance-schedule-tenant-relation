<script>

    /*
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
*/
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

        unction toggleSubmitForm() {
        const form = document.getElementById("mail-form-stepper");
        const btnStepper = document.querySelectorAll('.btn-stepper');
        const btnSubmit = document.getElementById("btn-submit");

        // Loop through all the buttons and add a click event listener
        btnStepper.forEach(button => {
            button.addEventListener('click', () => {
            // If the button clicked is a "previous" button
            if (button.classList.contains('btn-prev-form')) {
                // Disable the submit button, add the "disabled" class, and set the form submit event to return false
                btnSubmit.disabled = true;
                btnSubmit.classList.add("disabled");
                form.onsubmit = () => false;
            }
            // If the button clicked is a "next" button
            else if (button.classList.contains('btn-next-form')) {
                // Check if the button is the last one
                const isLastButton = button.classList.contains('btn-next-last-form');
                // Enable or disable the submit button depending on whether it's the last button or not, and toggle the "disabled" class accordingly
                btnSubmit.disabled = !isLastButton;
                btnSubmit.classList.toggle("disabled", !isLastButton);
                // Set the form submit event to return true if it's the last button, false otherwise
                form.onsubmit = () => isLastButton;
                // If it's the last button, prevent the default form submit behavior
                if (isLastButton) {
                event.preventDefault();
                }
            }
            });
        });

        // let form = document.getElementById("mail-form-stepper");
        // let btnStepper = document.querySelectorAll('.btn-stepper');
        // let btnSubmit = document.getElementById("btn-submit");


        // btnStepper.forEach(function(button) {
        //     if (button.classList.contains('btn-prev-form')) {
        //         button.addEventListener('click', function() {
        //             btnSubmit.disabled = true;
        //             btnSubmit.classList.add("disabled");
        //             form.onsubmit = function() { return false; };
        //         });
        //     } else if (button.classList.contains('btn-next-form')) {
        //         button.addEventListener('click', function() {
        //         // let lastButton = btnStepper[btnStepper.length - 1];
        //         // console.log(button,lastButton);

        //         if (button.classList.contains('btn-next-last-form')) {
        //             console.log("test 1");
        //             btnSubmit.disabled = false;
        //             btnSubmit.classList.remove("disabled");
        //             form.onsubmit = function() { return true; };
        //             event.preventDefault();
        //         } else {
        //             console.log("test 2");

        //             btnSubmit.disabled = true;
        //             btnSubmit.classList.add("disabled");
        //             form.onsubmit = function() { return false; };
        //         }
        //         });
        //     }
        // });
    }

</script>

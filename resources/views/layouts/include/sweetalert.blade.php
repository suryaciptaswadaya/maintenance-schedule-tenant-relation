swal.fire({
    title: "{{ $title }}",
    text: "{{ $text }}",
    type: "{{ $type ?? 'error'}}",
    showConfirmButton: {{ $buttonStyling ?? 'false'}},
    timer: 1000,
    confirmButtonClass: "btn btn-{{ $color ?? 'primary' }}"
});


<script>
toastr.options = {
  "closeButton": true,
  "debug": false,
  "newestOnTop": false,
  "progressBar": true,
  "positionClass": "toast-bottom-right",
  "preventDuplicates": false,
  "onclick": null,
  "showDuration": "300",
  "hideDuration": "1000",
  "timeOut": "5000",
  "extendedTimeOut": "1000",
  "showEasing": "swing",
  "hideEasing": "linear",
  "showMethod": "fadeIn",
  "hideMethod": "fadeOut"
}
</script>
@if (session('status'))
@if(@$message)<script>
        toastr.success("{{ session('status') }}")
</script>
@endif @endif
@if ($message = Session::get('success'))
@if(@$message)<script>
    toastr.success("{{ $message }}")
</script>
@endif @endif
@if ($message = Session::get('error'))
@if(@$message)<script>
    toastr.error("{{ $message }}")
</script>
@endif @endif
@if(Session::has('errors'))
@if(@$message)<script>
    toastr.error("{{ $message }}")
</script>
@endif @endif

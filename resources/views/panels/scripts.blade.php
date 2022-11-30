<!-- BEGIN: Vendor JS-->
<script src="{{ asset('vendors/js/vendors.min.js') }}"></script>
<!-- BEGIN Vendor JS-->
<!-- BEGIN: Page Vendor JS-->
<script src="{{asset('vendors/js/ui/jquery.sticky.js')}}"></script>
<script src="{{ asset('vendors/js/extensions/toastr.min.js')}}"></script>
<script src="{{ asset('vendors/js/extensions/sweetalert2.all.min.js') }}"></script>

<script>
    var CSRF_TOKEN = '{{ csrf_token() }}'
    function toastMessage(message, type, title=""){
        toastr[type](message, title, {
            closeButton: true,
            tapToDismiss: false,
        })
    }

    function confirmedMessage(){
        Swal.fire({
            // position: 'top-end',
            icon: 'success',
            title: 'Your work has been saved',
            showConfirmButton: false,
            scrollbarPadding: false,
            heightAuto: false, 
            timer: 1500,
            customClass: {
            confirmButton: 'btn btn-primary'
            },
            buttonsStyling: false
        })
    }

    $(function(){
        $('body').removeClass('footer-static footer-hidden').addClass('footer-fixed');
        $('.footer').removeClass('d-none footer-static');
    }); 
</script>
@yield('vendor-script')
<!-- END: Page Vendor JS-->
<!-- BEGIN: Theme JS-->
<script src="{{ asset('js/core/app-menu.js') }}"></script>
<script src="{{ asset('js/core/app.js') }}"></script>

<!-- custome scripts file for user -->
<script src="{{ asset('js/core/scripts.js') }}"></script>

@if($configData['blankPage'] === false)
<script src="{{ asset('js/scripts/customizer.js')}}"></script>
@endif
<!-- END: Theme JS-->
<!-- BEGIN: Page JS-->
@yield('page-script')
<!-- END: Page JS-->

@livewireScripts
<script src="{{ asset('js/alpine.min.js') }}"></script>

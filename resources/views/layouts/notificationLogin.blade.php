@if (session('success_login'))
<script>
    Lobibox.notify('success', {
        pauseDelayOnHover: true,
        size: 'mini',
        icon: 'bx bx-check-circle',
        continueDelayOnInactiveTab: false,
        position: 'bottom right',
        msg: '{{session('success_login')}}'
    });
</script>
@endif
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://use.fontawesome.com/120cec54d3.js"></script>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-eMNCOe7tC1doHpGoWe/6oMVemdAVTMs2xqW4mwXrXsW0L84Iytr2wi5v2QjrP/xp" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.min.js" integrity="sha384-cn7l7gDp0eyniUwwAZgrzD06kc/tftFf19TOAs2zVinnD/C7E91j9yyk5//jjpt/" crossorigin="anonymous"></script>
<!-- mousewheel plugin -->
<script src="{{ asset('js/jquery.mousewheel.min.js') }}"></script>
<!-- custom scrollbars plugin -->
<script src="{{ asset('js/jquery.mCustomScrollbar.min.js') }}"></script>
<script src="//cdn.jsdelivr.net/gh/kenwheeler/slick@1.5.9/slick/slick.min.js"></script>
<script src="{{ asset('js/main.js') }}?ver={{ time() }}"></script>

@yield('js')

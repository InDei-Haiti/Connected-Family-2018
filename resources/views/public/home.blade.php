@extends('layouts.master')

@section('title')
  Home
@stop

@section('body')
  @include('vendor.slider')
@stop

@section('scripts')
  <script type="text/javascript">
    $(document).ready(function() {
      $('#connected-footer').addClass('d-md-block').addClass('d-none');
      screenSetup();
      setTimeout(function (){
        $('html, body').animate({
          scrollTop: $(document).height()
        }, 100);
      }, 200);
    });
  </script>
  <script type="text/javascript" src="/js/lib/jquery.touchSwipe-1.6.4.min.js"></script>
  <script type="text/javascript" src="/js/asset/adds-on/carousel.swipe.js"></script>
@stop

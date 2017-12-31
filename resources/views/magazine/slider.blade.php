<!DOCTYPE html>
<html>
<head>
  <title>Magazine</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="/css/lib/bootstrap.min.css">
  <style type="text/css">
    .carousel-item {
      width: 100%;
      height: 100%;
      background: url(http://magazine.connected-family.org/0-75.png);
    }
    .body {
      background: url(http://magazine.connected-family.org/0-75.png);
    }
    .article {
      background-color: rgba(255, 255, 255, 0.5);
      color: #000;
    }
    .ar {
      direction: rtl;
    }
  </style>
</head>
<body>
  <div class="container-fluid wrap">

    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
      <ol class="carousel-indicators">
        @for($i = 0; $i < $articlesCount; $i++)
          <li data-target="#carouselExampleIndicators" data-slide-to="{{$i}}" @if($i == 0) class="active" @endif></li>
        @endfor
      </ol>
      <div class="carousel-inner" role="listbox">
        <div class="carousel-item active">
          <div class="container-fluid">
            <div class="row article">
              <div class="col-md-10 d-md-block d-none">
                <p class="ar">{!! nl2br($articles[0]->content) !!}</p>
              </div>
              <div class="col-md-2">
                <img class="w-100" src="data:image/png;base64,{{ base64_encode(Storage::get("/public/imgs/256/magazine/".$articles[0]->picture_src)) }}">
              </div>
              <div class="col-md-10 d-md-none d-block">
                <p class="ar">{!! nl2br($articles[0]->content) !!}</p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>

  </div>

  <script type="text/javascript" src="/js/lib/jquery-3.2.1.min.js"></script>
  <script type="text/javascript" src="/js/lib/tether.min.js"></script>
  <script type="text/javascript" src="/js/lib/bootstrap.min.js"></script>
  {{-- <script type="text/javascript" src="/js/lib/jquery.touchSwipe-1.6.4.min.js"></script> --}}
  {{-- <script type="text/javascript" src="/js/asset/adds-on/carousel.swipe.js"></script> --}}
  <script type="text/javascript">
    $('.carousel').carousel({
      interval: false
    });
  </script>
</body>
</html>

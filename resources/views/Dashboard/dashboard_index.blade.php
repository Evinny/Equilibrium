<!DOCTYPE html>
<html class="wide wow-animation" lang="en">
  <head>
    <title>Contact Us</title>
    <meta name="format-detection" content="telephone=no">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta charset="utf-8">
    <link rel="icon" href="images/favicon.ico" type="image/x-icon">
    <!-- Stylesheets-->
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Montserrat:400,500,600,700%7CPoppins:400%7CTeko:300,400">
    <link rel="stylesheet" href="{{URL::asset('../css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{URL::asset('../css/fonts.css')}}">
    <link rel="stylesheet" href="{{URL::asset('../css/style.css')}}">
    <style>.ie-panel{display: none;background: #212121;padding: 10px 0;box-shadow: 3px 3px 5px 0 rgba(0,0,0,.3);clear: both;text-align:center;position: relative;z-index: 1;} html.ie-10 .ie-panel, html.lt-ie-10 .ie-panel {display: block;}</style>
  
  
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Habito', ''],
          @php
            if(isset($data)){

            
            foreach($data as $name => $amount)
            {
                echo "['" . $name . "', " . $amount . "],";
            }

            }
            @endphp
          
          
          
         
          
        ]);

        $(window).resize(function(){
          drawChart();
        });

        var options = {
          
          chart: {
            responsive: true,
            title: 'Habito',
            subtitle: 'Habito',
          },
          bars: 'horizontal' // Required for Material Bar Charts.
        };

        var chart = new google.charts.Bar(document.getElementById('barchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
    </script>
  
    
  </head>
  <body>
    
      <!-- Page Header-->
      
      <!-- RD Google Map-->
      <!-- Contact Form-->
      

      
      

      <div style='text-align:left;padding: 2% 0 0 2%';>
      <img src="/images/logo-default-450x37.png" alt="" width="225" height="18">
      </div>

      <center>


        @if(isset($data))
          <div id="barchart_material" style="width: 100%;"></div>
        @else 
          <h3>Começe adicionando seu primeiro Habito, Apertando no <b>"+"</b></h3>
        @endif
        <br><br><br>
        
      </center>
      <br><Br>
      <div style="position: fixed; right:2%; bottom:5%; width:5%; min-width:50px">
        <a href={{route('dashboard.input.form')}}><img src="\images\equilibrium_photos\images\dashboard\blue-plus-icon-9.png" alt='Adicionar'></a>
      </div>
    
      
        <div style="position: fixed; bottom:5%;border-style:ridge;">
          <div class="pagination">
          
          <a href="{{route('dashboard.index', ['pag' => 1])}}"><img src="\images\equilibrium_photos\images\dashboard\habits.png" alt="" width="55%"/></a>
          <a href="{{route('dashboard.index', ['pag' => 2])}}"><img src="\images\equilibrium_photos\images\dashboard\habits.png" alt="" width="55%"/></a>
          <a href="#"><img src="\images\equilibrium_photos\images\dashboard\habits.png" alt="" width="55%"/></a>
          <a href="#"><img src="\images\equilibrium_photos\images\dashboard\habits.png" alt="" width="55%"/></a>
          <a href="#"><img src="\images\equilibrium_photos\images\dashboard\habits.png" alt="" width="55%"/></a>
          <a href="#"><img src="\images\equilibrium_photos\images\dashboard\habits.png" alt="" width="55%"/></a>
          
      </div>



























































































      <!-- Page Footer-->
      
    <!-- Global Mailform Output-->
    
    <!-- Javascript-->
    <script src="../js/core.min.js"></script>
    <script src="../js/script.js"></script>
  </body>
</html>










<!-- Contact information
      <section class="section section-sm section-first bg-default">
        <div class="container">
          <div class="row row-30 justify-content-center">
            <div class="col-sm-8 col-md-6 col-lg-4">
              <article class="box-contacts">
                <div class="box-contacts-body">
                  <div class="box-contacts-icon fl-bigmug-line-cellphone55"></div>
                  <div class="box-contacts-decor"></div>
                  <p class="box-contacts-link"><a href="tel:#">+1 323-913-4688</a></p>
                  <p class="box-contacts-link"><a href="tel:#">+1 323-888-4554</a></p>
                </div>
              </article>
            </div>
            <div class="col-sm-8 col-md-6 col-lg-4">
              <article class="box-contacts">
                <div class="box-contacts-body">
                  <div class="box-contacts-icon fl-bigmug-line-up104"></div>
                  <div class="box-contacts-decor"></div>
                  <p class="box-contacts-link"><a href="#">4730 Crystal Springs Dr, Los Angeles, CA 90027</a></p>
                </div>
              </article>
            </div>
            <div class="col-sm-8 col-md-6 col-lg-4">
              <article class="box-contacts">
                <div class="box-contacts-body">
                  <div class="box-contacts-icon fl-bigmug-line-chat55"></div>
                  <div class="box-contacts-decor"></div>
                  <p class="box-contacts-link"><a href="mailto:#">mail@demolink.org</a></p>
                  <p class="box-contacts-link"><a href="mailto:#">info@demolink.org</a></p>
                </div>
              </article>
            </div>
          </div>
        </div>
      </section>
      -->
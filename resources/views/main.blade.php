@extends('layouts.app')
@section('content')

<header>
  <div class="container">
    <div class="intro-text">
      <div class="intro-heading">SMART-SCHOOLBUS</div>
      <hr style="border-color: #fed136; border-width: 3px; max-width: 50px;">
      <div class="intro-lead-in">Find your <i><u style="color: #fed136;">PERFECT</u></i> and <i><u style="color: #fed136;">COOL</u></i> school bus service provider</div>
      <a href="#feature" class="btn btn-xl" style="padding: 20px 40px; font-size: 18px; border-radius: 15px;"><b>FIND OUT MORE</b></a>
    </div>
  </div>
</header>

<div class="container marketing" style="margin-top: 50px">
  <!-- START THE FEATURETTES -->

  <div class="row featurette" id="feature">
    <div class="col-md-7">
      <h2 class="featurette-heading">Find The School Bus<span class="text-muted"> Services</span></h2>
      <p class="lead">School Bus Services is for transporting the pupil to and from school. So the parent concerned about selecting the service provider which trusted and attentive the little angel. <i>Our website able to give you a hand.</i></p>
    </div>
    <div class="col-md-5">
      <img class="featurette-image img-responsive center-block img-main" data-src="holder.js/500x500/auto" alt="500x500" src="https://pixady.com/img/2017/01/649559_47235245o.jpg" data-holder-rendered="true">
    </div>
  </div>

  <hr class="featurette-divider">

  <div class="row featurette">
    <div class="col-md-7 col-md-push-5">
      <h2 class="featurette-heading">Generate Student ID<span class="text-muted"> Cards</span></h2>
      <p class="lead">To ensure the safety of students, parents can generate student ID cards with QR code. So it would be easy for school bus driver to mark attendance in the school bus.</p>
    </div>
    <div class="col-md-5 col-md-pull-7">
      <img class="featurette-image img-responsive center-block img-main" data-src="holder.js/500x500/auto" alt="500x500" src="https://pixady.com/img/2017/01/644036_52o.jpg" data-holder-rendered="true">
    </div>
  </div>

  <hr class="featurette-divider">

  <div class="row featurette">
    <div class="col-md-7">
      <h2 class="featurette-heading">School Bus Attendance System<span class="text-muted"> (Application)</span></h2>
      <p class="lead">School bus driver mark attendance of students by scanning the QR code and automatic notification (SMS) sent to the parent assigned mobile number.</p>
      <img class="pull-right" src="http://www.twigmo.com/wp-content/uploads/2014/09/google-play-en.png" style="width: 150px; height: auto;">
    </div>
    <div class="col-md-5">
      <img class="featurette-image img-responsive center-block img-main" data-src="holder.js/500x500/auto" alt="500x500" src="https://pixady.com/img/2017/01/702478_12.jpg" data-holder-rendered="true">

    </div>
  </div>

  <hr class="featurette-divider">

  <div class="row featurette" style="margin-top: -50px;">
    <div class="col-md-7 col-md-push-5">
      <h2 class="featurette-heading">Be A School Bus Driver With<span class="text-muted"> US</span></h2>
      <p class="lead">Earn extra income by getting more users when you are available via our system.</p>
      <a href="/login" class="btn btn-xl btn-sbdriver" style="padding: 20px 20px; border-radius: 15px; font-size: 16px;"><i class="glyphicon glyphicon-user" aria-hidden="true"></i> SCHOOL BUS DRIVER Login/Register</a>
    </div>
    <div class="col-md-5 col-md-pull-7" style="margin-top: 50px; margin-bottom: 40px;">
      <img class="featurette-image img-responsive center-block img-main" data-src="holder.js/500x500/auto" alt="500x500" src="http://i.share.pho.to/5f47609a_o.jpeg" data-holder-rendered="true">
    </div>
  </div>

  <hr class="featurette-divider">
<div class="container marketing" style="margin-top: 20px" id="howitwork">
  <h1 align="center" style="margin-top: 40px">HOW IT WORKS - SIMPLE AS 1, 2, 3</h1>
  <hr style="border-color: #fed136; border-width: 2px; max-width: 100px;margin-bottom: 50px;">
  <!-- Three columns of text below the carousel -->
  <div class="row" style="margin-bottom: 50px;">
    <div class="col-lg-4">
      <img class="center-block"  src="http://www.iconsfind.com/wp-content/uploads/2015/10/20151012_561bac77eb9eb.png" alt="Generic placeholder image" width="140" height="auto">
      <h4 align="center" id="head">1. Send request</h4>
      <p id="detail">Find the school bus service provider who you want them to take care of your child and send them a service request.</p>
    </div><!-- /.col-lg-4 -->
    <div class="col-lg-4">
      <img class="img-circle center-block" src="http://icons.iconarchive.com/icons/paomedia/small-n-flat/1024/sign-check-icon.png" alt="Generic placeholder image" width="140" height="auto">
      <h4 align="center" id="head">2. Confirm</h4>
      <p id="detail">When the school bus service provider confirmed your service request, your child information will be added automatically on their student list.</p>
    </div><!-- /.col-lg-4 -->
    <div class="col-lg-4">
      <img class="img-circle center-block" src="http://formcrafts.com/images/icons/128/226685%20-%20communication%20email%20letter%20mail%20messege%20post%20send.png" alt="Generic placeholder image" width="140" height="auto">
      <h4 align="center" id="head">3. Contact</h4>
      <p id="detail">Relax and enjoy your day, you will receive an email confirmation and a phone call from the school bus service provider.</p>
    </div><!-- /.col-lg-4 -->
  </div><!-- /.row -->

  <hr class="featurette-divider">

  
    <h2 align="center">READY TO FIND A SCHOOL BUS SERVICE?</h2>
    <hr style="border-color: #fed136; border-width: 2px; max-width: 100px;">
    <div class="row">
      <div class="col-md-offs">
        <a href="/bookservice" class="btn btn-xl center-block" style="padding: 15px; font-size: 18px; border-radius: 15px; margin-bottom: 60px; margin-top: 10px; "><b>FIND A SCHOOL BUS SERVICE</b></a>
      </div>
    </div><!-- /.row -->
  </div>

  <!-- <div class="panel-footer">Panel Footer</div> -->
  @endsection

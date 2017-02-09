<!DOCTYPE html>
<html>
<head>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head>
<body>
  <style>

    #image {
    }

    #qr {
    }

    #nickname {
      color: white;
      font-size: 50px;
      font-weight: bold;
      font-family:sans-serif;
    }

    #parenttel {
      color: white;
      font-size: 22px;
      font-weight: bold;
      font-family:sans-serif;
    }

    #tel {
     position: absolute;
     color: white;
     font-size: 22px;
     font-weight: bold;
     font-family:sans-serif;
   }

   #school {
     color: white;
     font-size: 22px;
     font-weight: bold;
     font-family: Garuda;
   }

   .columns-container {
    text-align: center;
  }

</style>
<div class="container">
  <div class="row">
    <div class="col-md-14">
      <div class="panel panel-default">
        <div class="panel-body">   

          @foreach( $students as $student)
          <img id="image" src="http://i.imgur.com/jHhFrja.jpg">
          
<?php $txt = "SchoolBusApp_" . $student->student_id . "_" . $student->student_nickname ;?>
<table class="tg" style="margin-top: -410px; margin-left: 50px">
  <tr>
    <th class="tg-yw4l"></th>
    <th class="tg-yw4l" colspan="3" rowspan="3"><img id="qr" src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(250)->margin(1)->merge('\public\img\qr_tag\qr_icon.png', .175)->generate($txt)) !!} "></th>
    <th class="tg-yw4l"></th>
    <th class="tg-yw4l"></th>
    <th class="tg-yw4l"></th>
    <th class="tg-yw4l"></th>
    <th class="tg-yw4l"></th>
    <th class="tg-yw4l"></th>
    <th class="tg-yw4l"></th>
  </tr>
  <tr>
    <td class="tg-031e"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
  </tr>
  <tr>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
  </tr>
  <tr>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l" colspan="3"><p id="parenttel">Parent: {{ $student->parent->phone }}</p></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
  </tr>
  <tr>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l" style="text-align:center;" colspan="3"><p id="nickname">{{ $student->student_nickname }}</p></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l" colspan="3"><p id="tel">Student: {{ $student->phone }}</p></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
  </tr>
  <tr>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
     <td class="tg-yw4l" colspan="3"><p id="school">{{ $student->school->school_name }}</p></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
  </tr>
</table>
          <img style="margin-top: 100px" id="image" src="http://i.imgur.com/vrIxseb.jpg">
          @endforeach
        </div>
      </div>
    </div>
  </div>
</div>
</body>
</html>
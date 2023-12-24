<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            
           .title {
            font-family: Dejavu Sans, sans-serif;
        }
        table tr th {
            border: 1px solid black;
        }
        table tr td {
            border: 1px solid black;
        }
        </style>
    </head>
    <body>
        <p style="color: red">Đơn xin nghỉ của bạn đã được phê duyệt</p>
      <div class="table-responsive">
          <table class="table table-hover">
              <thead>
                  <tr>
                      <th>tên nhân viên</th>
                      <th>nhân viên phê duyệt</th>
                      <th>số ngày nghỉ</th>
                      <th>thời gian bắt đầu nghỉ</th>
                      <th>thời gian kết thúc</th>
                      <th>phòng ban</th>
                      <th>lý do</th>
                  </tr>
              </thead>
              <tbody>
                  <tr>
                      <td>{{ $tennhanvien }}</td>
                      <td>{{ $nvpheduyet }}</td>
                      <td>{{ $songaynghi }}</td>
                      <td>{{date('H:i d/m/Y',strtotime($dates))}}</td>
                      <td>{{date('H:i d/m/Y',strtotime($ngayketthuc))}}</td>
                      <td>{{ $vitri }}</td>
                      <td>{{ $ly }}</td>
                  </tr>
              </tbody>
          </table>
      </div>
    </body>
</html>
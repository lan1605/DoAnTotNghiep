<h2>Xin chào, Admin</h2> 
<br>
<p>{{ $data->ten }} vừa mới gửi thông tin liên hệ đến hệ thống</p>
<strong>Thông tin cá nhân của {{ $data->ten }}: </strong><br>
<strong>Email: </strong>{{ $data->email }} <br>
<strong>Số điện thoại: </strong>{{ $data->sdt }} <br>
<strong>Nội dung liên hệ: </strong>{{ $data->noidung_lienhe }} <br><br>
  
Xin vui lòng phản hồi sớm đến {{ $data->ten }}!
<br>
Xin cảm ơn.
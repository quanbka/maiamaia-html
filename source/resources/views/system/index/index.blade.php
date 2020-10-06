@extends('system.layouts.main')
@section('script')

@endsection
@section('content')
<section class="content-header">
  <h1>
    Dashboard
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Dashboard</li>
  </ol>
</section>

<section class="content">
    <div class="box">
        <table class="table">
            <tr>
                <th>Thời gian</th>
                <th>Tên</th>
                <th>Số điện thoại</th>
                <th>Dịch vụ</th>
            </tr>
            @foreach ($registers as $key => $value)
                <tr>
                    <td>{{ $value->created_at }}</td>
                    <td>{{ $value->name }}</td>
                    <td>{{ $value->phone }}</td>
                    <td>{{ $value->service }}</td>
                </tr>

            @endforeach
        </table>
    </div>


</section>
@endsection

@extends('admin.layout')
@section('wrapper')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">User
            <small>Danh sách User</small>
        </h1>
    </div>
    <!-- /.col-lg-12 -->
    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
        <thead>
            <tr align="center">
                <th>ID</th>
                <th>Email</th>
                <th>Tên</th>
                <th>Số dư</th>
                <th>Tình trạng</th>
                <th>Quyền</th>
                <th>Ngày tạo</th>
                <th>Ngày sửa</th>
                <th>Delete</th>
                <th>Edit</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $u)
            <tr class="odd gradeX" align="center">
                <td>{{$u->id}}</td>
                <td>{{$u->email}}</td>
                <td>{{$u->name}}</td>
                <td>{{$u->balance}}</td>
                <td>{{$u->status == '1'?'Active':'Banned'}}</td>
                <td>{{$u->type}}</td>
                <td>{{$u->created_at}}</td>
                <td>{{$u->updated_at}}</td>
                <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="#"> Delete</a></td>
                <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="#">Edit</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
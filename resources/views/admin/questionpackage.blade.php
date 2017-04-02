@extends('admin.layout')
@section('wrapper')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Gói câu hỏi
            <small>Danh sách gói câu hỏi</small>
        </h1>
    </div>
    <!-- /.col-lg-12 -->
    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
        <thead>
            <tr align="center">
                <th>ID</th>
                <th>Loại câu hỏi</th>
                <th>Ngày tạo</th>
                <th>Ngày sửa</th>
                <th>Delete</th>
                <th>Edit</th>
            </tr>
        </thead>
        <tbody>
            @foreach($question_packages as $p)
            <tr class="odd gradeX" align="center">           
                <td>{{$p->id}}</td>
                <td>{{$p->question_type->name}}</td>
                <td>{{$p->created_at}}</td>
                <td>{{$p->updated_at}}</td>
                <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="#"> Delete</a></td>
                <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="#">Edit</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
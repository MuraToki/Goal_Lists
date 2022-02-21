@extends('layouts.app')
@section('title', 'リスト&作成')
@section('content')
<div class="col-md-6 col-md-offset-2 m-auto"> 
    <form method="post" action="{{ route('store') }}" onSubmit="return checkSubmit()">
        @csrf
        <h4>My Goal</h4>
        @if ($errors->has('title'))
        <div class="alert alert-danger" role="alert" style="font-weight: bold; font-size: 16px;">
            {{ $errors->first('title') }}
        </div>
        @endif
        <input id="title" name="title" class="form-control" value="{{ old('title') }}" type="text" placeholder="あなたの目標は何ですか？">
        <button type="submit" class="btn btn-info mt-2 mb-2">追加</button>
    </form>
</div>

<div class="show">
    <h1 style="text-align: center;font-weight: bold;">Goal Lists</h1>
</div>

<section class="table_main">
    @if (session('err_msg'))
          <p class="alert alert-success" role="alert" style="width: 70%;margin: auto;">
            {{ session('err_msg') }}
          </p>
    @endif
    <table class="table table-striped mt-3">
        <tr class="thead">
            <th style="color: white;">番号</th>
            <th style="color: white;">目標</th>
            <th style="color: white;">時間</th>
            <th></th>
            <th></th>
        </tr>
        @foreach($todos as $todo)
        <tr>
            <td>{{ $todo->id }}</td>
            <td>{{ $todo->title }}</td>
            <td>{{ $todo->updated_at }}</td>
            <td><button type="button" class="btn btn-primary" onclick="location.href='/edit/{{ $todo->id }}'">編集</button></td>
            <form method="post" action="{{ route('delete', $todo->id) }}" onSubmit="return checkDelete()">
                @csrf
                <td><button type="submit" class="btn btn-danger" onclick=>削除</button></td>
            </form>
        </tr>
        @endforeach
        
    </table>
</section>
<script>
function checkSubmit(){
if(confirm('目標を追加してもいいかな？')){
    return true;
} else {
    return false;
}
}

function checkDelete(){
if(confirm('削除をするということは、達成しましたか？')){
    return true;
} else {
    return false;
}
}
</script>
@endsection

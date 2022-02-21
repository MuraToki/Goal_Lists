@extends('layouts.app')
@section('title', '編集フォーム')
@section('content')
    <div class="col-md-6 col-md-offset-2 m-auto">
        <h2 style="text-align: center;">編集フォーム</h2>
        <form method="POST" action="{{ route('update') }}" onSubmit="return checkSubmit()">
          @csrf
          <input type="hidden" name="id" value="{{ $todo->id }}">
            <div class="form-group">
                <h4>My Goal</h4>
                @if ($errors->has('title'))
                    <div class="alert alert-danger" role="alert" style="font-weight: bold; font-size: 16px;">
                        {{ $errors->first('title') }}
                    </div>
                @endif
                <input id="title" name="title" class="form-control" value="{{ $todo->title }}" type="text" placeholder="目標は何に変更するの？">
            </div>
            <div class="mt-3">
                <a class="btn btn-secondary" href="{{ route('home') }}">
                    戻る
                </a>
                <button type="submit" class="btn btn-primary">
                    更新
                </button>
            </div>
        </form>
    </div>
<script>
function checkSubmit(){
if(confirm('更新してもいいかな？')){
    return true;
} else {
    return false;
}
}
</script>
@endsection
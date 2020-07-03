@extends('layouts.app')

@section('content')

    @if (Auth::check())
        <h1>{{ Auth::user()->name }}のタスク一覧</h1>
        @include('tasks.tasks')
         {{-- タスク作成ページへのリンク --}}
        {!! link_to_route('tasks.create', '新規タスクの投稿', [], ['class' => 'btn btn-primary']) !!}
    @else
        {{-- ユーザ登録ページへのリンク --}}
        {!! link_to_route('signup.get', 'Sign up now!', [], ['class' => 'btn btn-lg btn-primary']) !!}
        {{-- ユーザログインページへのリンク --}}
        {!! link_to_route('login', 'Login now!', [], ['class' => 'btn btn-lg btn-primary']) !!}
    @endif

@endsection
@extends('dashboard.layouts.master')
@section('title', "Home")
@php $user = Auth::user(); @endphp
@section('container')
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <h3 class="card-title">
          {{ $user->name }}, Welcome to dashboard<hr>
        </h3>
        <div class="card-body">
          You have the following abilities:<br>
          @forelse($user->admin->abilities as $ability)
            - {{ $ability->description }} <br>
          @empty
            No Abilities Found!
          @endforelse
        </div>
      </div>
    </div>
  </div>
@stop

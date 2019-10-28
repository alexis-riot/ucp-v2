@extends('errors::layout')

@section('title', __('Too Many Requests'))
@section('image', asset('images/error/bg-gtav.png'))
@section('code', '429')
@section('code-string', 'TOO MANY REQUESTS')
@section('message', __('Woow, I\'m old, go slowly'))

@extends('errors::layout')

@section('title', __('Service Unavailable'))
@section('image', asset('images/error/bg-gtav.png'))
@section('code', '503')
@section('code-string', 'SERVICE UNAVAILABLE')
@section('message', __('Wow, it sounds serious...'))

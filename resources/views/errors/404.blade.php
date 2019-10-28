@extends('errors::layout')

@section('title', __('Not Found'))
@section('image', asset('images/error/bg-gtav.png'))
@section('code', '404')
@section('code-string', 'ERROR')
@section('message', __('Wow, we don\'t find the content'))

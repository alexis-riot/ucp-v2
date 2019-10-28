@extends('errors::layout')

@section('title', __('Server Error'))
@section('image', asset('images/error/bg-gtav.png'))
@section('code', '500')
@section('code-string', 'SERVER ERROR')
@section('message', __('The server is a little stupid today'))

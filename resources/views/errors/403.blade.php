@extends('errors::layout')

@section('title', __('Forbidden'))
@section('image', asset('images/error/bg-gtav.png'))
@section('code', '403')
@section('code-string', 'FORBIDDEN')
@section('message', __('The server is f**king capricious today, come back later'))

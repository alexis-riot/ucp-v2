@extends('errors::layout')

@section('title', __('Unauthorized'))
@section('image', asset('images/error/bg-gtav.png'))
@section('code', '401')
@section('code-string', 'UNAUTHORIZED')
@section('message', __('You have nothing to do here'))

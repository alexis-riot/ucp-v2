@extends('errors::layout')

@section('title', __('CSRF Missing'))
@section('image', asset('images/error/bg-gtav.png'))
@section('code', '419')
@section('code-string', 'CSRF MISSING')
@section('message', __('It\'s a secure area here, get back!'))

@extends('layouts.backendMaster')
@section('style_body')
<style>
.toggleswitch {
  position: relative;
  width: 90px;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
}

.toggleswitch-checkbox {
  display: none;
}

.toggleswitch-label {
  display: block;
  overflow: hidden;
  cursor: pointer;
  border: 2px solid #27A1CA;
  border-radius: 0px;
}

.toggleswitch-inner {
  display: block;
  width: 200%;
  margin-left: -100%;
  -moz-transition: margin 0.3s ease-in 0s;
  -webkit-transition: margin 0.3s ease-in 0s;
  -o-transition: margin 0.3s ease-in 0s;
  transition: margin 0.3s ease-in 0s;
}

.toggleswitch-inner:before,
.toggleswitch-inner:after {
  display: block;
  float: left;
  width: 50%;
  height: 30px;
  padding: 0;
  line-height: 26px;
  font-size: 14px;
  color: white;
  font-family: Trebuchet, Arial, sans-serif;
  font-weight: bold;
  -moz-box-sizing: border-box;
  -webkit-box-sizing: border-box;
  box-sizing: border-box;
  border: 2px solid transparent;
  background-clip: padding-box;
}

.toggleswitch-inner:before {
  content: "Send";
  padding-left: 10px;
  background-color: #FFFFFF;
  color: #00ffff;
}

.toggleswitch-inner:after {
  content: "Done";
  padding-right: 10px;
  background-color: #FFFFFF;
  color: #274dca;
  text-align: right;
}

.toggleswitch-switch {
  display: block;
  width: 25px;
  margin: 0px;
  background: #27A1CA;
  position: absolute;
  top: 0;
  bottom: 0;
  right: 65px;
  -moz-transition: all 0.3s ease-in 0s;
  -webkit-transition: all 0.3s ease-in 0s;
  -o-transition: all 0.3s ease-in 0s;
  transition: all 0.3s ease-in 0s;
}

.toggleswitch-checkbox:checked + .toggleswitch-label .toggleswitch-inner {
  margin-left: 0;
}

.toggleswitch-checkbox:checked + .toggleswitch-label .toggleswitch-switch {
  right: 0px;
}
</style>
@endsection
@section('backend_content')

 @livewire('email-send',['users' => $users])

@endsection
@section('script_body')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection


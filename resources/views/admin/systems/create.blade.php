@extends('admin.layouts.master')
@section('title', '新增基本设置')
@section('content')
    <div class="container">
        <!-- left, vertical navbar & content -->
        <div class="row">
            <!-- left, vertical navbar -->
            @include('admin.layouts.left')
                    <!-- content -->
            <div class="col-md-10">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="page-header">
                            <h1>新增基本设置</h1>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        @foreach ($errors->all() as $error)
                            <div class="alert alert-danger">
                                <a class="close" data-dismiss="alert" href="#">&times;</a>
                                {{ $error }}
                            </div>
                        @endforeach
                        <div class="panel panel-default bootstrap-admin-no-table-panel">
                            <div class="panel-heading">
                                <div class="text-muted bootstrap-admin-box-title">基本设置</div>
                            </div>
                            <div class="bootstrap-admin-no-table-panel-content bootstrap-admin-panel-content collapse in">
                                <form class="form-horizontal" action="{{URL::route('webmanagent.systems.store')}}" method="post">
                                    <fieldset>
                                        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"/>
                                        <div class="form-group">
                                            <label class="col-lg-2 control-label" for="system_key">key</label>
                                            <div class="col-lg-4">
                                                <input class="form-control" id="system_key" name="system_key" type="text" value="@if (!empty(Session::get('system_key'))){{Session::get('system_key')}}@endif">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-2 control-label" for="systems_name">名称</label>
                                            <div class="col-lg-4">
                                                <input class="form-control" id="system_name" name="system_name" type="text" value="@if (!empty(Session::get('system_name'))){{Session::get('system_name')}}@endif">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-2 control-label" for="systems_value">值</label>
                                            <div class="col-lg-4">
                                                <input class="form-control" id="system_value" name="system_value" type="text" value="@if (!empty(Session::get('system_value'))){{Session::get('system_value')}}@endif">
                                            </div>
                                        </div>
                                        <div style="padding-left:90px;">
                                            <button type="submit" class="btn btn-primary">保存</button>
                                            <button type="reset" class="btn btn-default">取消</button>
                                        </div>
                                    </fieldset>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
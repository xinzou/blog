@extends('admin.layouts.master')
@section('title', '修改标签')
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
                            <h1>修改标签</h1>
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
                                <div class="text-muted bootstrap-admin-box-title">标签</div>
                            </div>
                            <div class="bootstrap-admin-no-table-panel-content bootstrap-admin-panel-content collapse in">
                                <form class="form-horizontal" action="{{URL::route('webmanagent.tags.update',$tagsInfo->id)}}" method="post">
                                    <fieldset>
                                        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"/>
                                        <input type="hidden" name="_method" value="PUT"/>
                                        <div class="form-group">
                                            <label class="col-lg-2 control-label" for="name">标签名称</label>
                                            <div class="col-lg-4">
                                                <input class="form-control" id="name" name="name" type="text" value="@if (!empty(Session::get('name'))){{Session::get('name')}}@elseif($tagsInfo->name){{$tagsInfo->name}}@endif">
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
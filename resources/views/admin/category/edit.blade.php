@extends('admin.layouts.master')
@section('title', '修改文章分类')
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
                            <h1>修改文章分类</h1>
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
                                <div class="text-muted bootstrap-admin-box-title">文章分类</div>
                            </div>
                            <div class="bootstrap-admin-no-table-panel-content bootstrap-admin-panel-content collapse in">
                                <form class="form-horizontal" action="{{URL::route('webmanagent.category.update',$categoryInfo->id)}}" method="post">
                                    <fieldset>
                                        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"/>
                                        <input type="hidden" name="_method" value="PUT"/>

                                        <div class="form-group">
                                            <label class="col-lg-2 control-label" for="parent_id">上级分类</label>
                                            <div class="col-lg-4">
                                                <select id="parent_id" name="parent_id" class="form-control" style="width: 150px">
                                                    @foreach($categoryTreeList as $key => $val)
                                                        <option value="{{$key}}" @if ($categoryInfo->parent_id == $key) selected @elseif(Session::get('parent_id') == $key) selected @endif>{{$val}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-2 control-label" for="cate_name">分类名称</label>
                                            <div class="col-lg-4">
                                                <input class="form-control" id="cate_name" name="cate_name" type="text" value="@if (!empty(Session::get('cate_name'))){{Session::get('cate_name')}}@elseif($categoryInfo->cate_name){{$categoryInfo->cate_name}}@endif">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-2 control-label" for="as_name">别名</label>
                                            <div class="col-lg-4">
                                                <input class="form-control" id="as_name" name="as_name" type="text" value="@if (!empty(Session::get('as_name'))){{Session::get('as_name')}}@elseif($categoryInfo->as_name){{$categoryInfo->as_name}}@endif">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-2 control-label" for="seo_title">seo标题</label>
                                            <div class="col-lg-4">
                                                <input class="form-control" id="seo_title" name="seo_title" type="text" value="@if (!empty(Session::get('seo_title'))){{Session::get('seo_title')}}@elseif($categoryInfo->seo_title){{$categoryInfo->seo_title}}@endif">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-2 control-label" for="seo_key">seo关键字</label>
                                            <div class="col-lg-4">
                                                <input class="form-control" id="seo_key" name="seo_key" type="text" value="@if (!empty(Session::get('seo_key'))){{Session::get('seo_key')}}@elseif($categoryInfo->seo_key){{$categoryInfo->seo_key}}@endif">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-2 control-label" for="seo_desc">seo描述</label>
                                            <div class="col-lg-6">
                                                <textarea class="form-control" rows="3" id="seo_desc" name="seo_desc" >@if (!empty(Session::get('seo_desc'))){{Session::get('seo_desc')}}@elseif($categoryInfo->seo_desc){{$categoryInfo->seo_desc}}@endif</textarea>
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
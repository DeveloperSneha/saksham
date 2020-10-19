@extends('admin.admin_layout')
@section('content')
<div class="panel panel-default">
    <div class="panel-heading">Saksham Darpan Notifications: <span class="font-semibold"></span></div>
    <div class="panel-body">
        <div class="admin_login_wrap adin_log" style="background: url({{asset('dist/img/images/bg-01.jpg')}}) no-repeat">
            <div class="admin_login_container">
        <div class="admin_login_div add_notification" style="text-align: center;padding: 49px 0 0;padding-bottom: 30px;">
            <span class="fa fa-bullhorn"></span>
            <div ng-controller="add_notification_controller">
                <h2>Saksham Darpan Notifications</h2>
                {!! Form::open(['method' => 'POST',  'action' => ['Admin\AdminController@saveNotification'], 'class' => 'form-horizontal']) !!}
                    <div class="">
                        <div class="search_inputs">
                            <div class="official_login_type_div add_notification_type_div" ng-init="notification_type='text'">

                                <ul style="text-align: center;">
                                    <li class="official_login_txt"><b>Notification Type</b></li>
                                    <li>
                                        <input type="radio" id="notification_type_text" name="notification_type" ng-model="notification_type" value="text" >
                                        <label for="notification_type_text">Text</label>
                                    </li>
                                    <li>
                                        <input type="radio" id="notification_type_link" name="notification_type" ng-model="notification_type" value="link">
                                        <label for="notification_type_link">Link</label>
                                    </li>
                                    <li>
                                        <input type="radio" id="notification_type_file" name="notification_type" ng-model="notification_type" value="file">
                                        <label for="notification_type_file">File</label>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <input type="text" autocomplete="off" placeholder="Enter Notification Title" name="notification_title" ng-model="notification_title" required style="text-align: center;">
                        <input ng-show="notification_type == 'link'" type="url" name="notification_url" placeholder="Enter URL" ng-model="notification_url" required style="text-align: center;">
                        <input id="notification_file" accept="application/msword, application/pdf" ng-show="notification_type == 'file'" type="file" placeholder="Enter File" ng-file-model="notification_file"  required style="padding-left: 15%; margin-left: 15%;">
                        <button type="submit">Add Notification</button>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
        </div>
    </div>
</div>
@stop
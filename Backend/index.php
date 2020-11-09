<DOCTYPE html>
<html>
<head>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.5.7/angular.min.js"></script>
    <style>
    .form_style
    {
        width: 600px;
        margin: 0 auto;
    }
    </style>
</head>
    <body>
        <br />
        <h3 align="center">Sistem Absensi</h3>
        <br />
        <div ng-app ="login" ng-controller="login_controller" class="container form_style">
            <div class="alert {{alertClass}} alert-dismissible"  ng-show="alertMsg">
                <a href="#" class="close" ng-click="closeMsg()"
                aria-label="close">&times;</a>
                {{alertMessage}}
            </div>
            <!-- form login -->
            <div class="panel panel-default" ng-show="login_form">
                <div class="panel-heading">
                    <h3 class="panel-title">Login</h3>
                </div>
                <div class="panel-body">
                    <form method="post" ng-submit="submitLogin()">
                        <div class="form-group">
                            <label>Username</label>
                            <input type="number" name="username" placeholder="Insert Your Username/NIP" ng-model="loginData.username"
                            class="form-control" maxlength="8" />
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="password" placeholder="Insert Your Password" ng-model="loginData.password"
                            class="form-control"/>
                        </div>
                        <div class="form-group" align="center">
                            <input type="submit" name="Login"
                            class="btn btn-primary" value="Login" />
                            <br />
                            <input type="button" name="input_link"class="btn btn-primary btn-link" 
                            ng-click="showInput()" value="Input Keterangan" />
                            <br />
                            <input type="button" name="report_link"class="btn btn-primary btn-link" 
                            ng-click="showReport()" value="Report" />
                        </div>
                    </form>
                <div>
            </div>
            <!-- form Input Keterangan -->
            <div class="panel panel-default" ng-show="input_form">
                <div class="panel-heading">
                    <h3 class="panel-title">Input Keterangan</h3>
                </div>
                <div class="panel-body">
                    <form method="post" ng-submit="submitInput()">
                        <div class="form-group">
                            <label>Username</label>
                            <input type="number" name="username" placeholder="Insert Your Username/NIP" ng-model="inputData.username"
                            class="form-control" maxlength="8" />
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="password" placeholder="Insert Your Password" ng-model="inputData.password"
                            class="form-control"/>
                        </div>
                        <div class="form-group" align="center">
                            <input type="submit" name="Input"
                            class="btn btn-primary" value="Input" />
                            <br />
                            <input type="button" name="login_link"class="btn btn-primary btn-link" 
                            ng-click="showLogin()" value="Menu Login" />
                            <br />
                            <input type="button" name="report_link"class="btn btn-primary btn-link" 
                            ng-click="showReport()" value="Report" />
                        </div>
                    </form>
                <div>
            </div>
        </div>
        
    </body>
</html>
<script>
var app = angular.module('login',[]);
app.controller('login_controller', function($scope, $http){
    $scope.closeMsg = function(){
        $scope.alerMsg = false;
    };
    $scope.login_form = true;
    $scope.showLogin = function(){
        $scope.login_form = true;
        $scope.input_form = false;
        $scope.report_form = false;
        $scope.alerMsg = false;
    };
    $scope.showInput = function(){
        $scope.login_form = false;
        $scope.input_form = true;
        $scope.report_form = false;
        $scope.alerMsg = false;
    };
    $scope.showReport = function(){
        $scope.login_form = false;
        $scope.input_form = false;
        $scope.report_form = true;
        $scope.alerMsg = false;
    };

    $scope.submitLogin = function(){
        $http({
            method:"POST",
            url:"login.php",
            data:$scope.loginData
        }).success(function(data){
            $scope.alertMsg = true;
            if(data.error != '')
            {
                $scope.alertClass = 'alert-danger';
                $scope.alertMessage = data.error;
            }
            else
            {
                $scope.alertClass = 'alert-success';
                $scope.alertMessage = data.message;
                $scope.loginData = {};
            }
        });
    };
});
</script>
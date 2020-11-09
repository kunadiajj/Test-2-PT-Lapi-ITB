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
    <h3 align="center">Menu Kehadiran</h3>
    <br />
    <div ng-app ="kehadiran" ng-controller="kehadiran_controller" class="container form_style">
        <div class="alert {{alertClass}}
        alert-dismissible"  ng-show="alertMsg">
            <a href="#" class="close" ng-click="closeMsg()"
            aria-label="close">&times;</a>
            {{alertMessage}}
        </div>
        <div class="panel panel-default" ng-show="kehadiran_form">
            <div class="panel-heading">
                <h3 class="panel-title">Form Kehadiran</h3>
            </div>
            <div class="panel-body">
                <form method="post" ng-submit="submitKehadiran()">
                    <div class="form-group">
                        <label>NIP</label>
                        <input type="number" name="nip" ng-model="kehadiranData.nip"
                        class="form-control" maxlength="8" />
                    </div>
                    <div class="form-group">
                        <label>PIN</label>
                        <input type="password" name="pin" pattern="[0-9]*" inputmode="numeric" ng-model="kehadiranData.pin"
                        class="form-control" maxlength="6"/>
                    </div>
                    <div class="form-group" align="center">
                        <input type="submit" name="hadir"
                        class="btn btn-primary" value="Absen" />
                    </div>
                </form>
            <div>
        </div>
    </div>
</body>
</html>
<script>
var app = angular.module('kehadiran',[]);
app.controller('kehadiran_controller', function($scope, $http){
    $scope.closeMsg = function(){
        $scope.alerMsg = false;
    };
    $scope.kehadiran_form = true;

    $scope.submitKehadiran = function(){
        $http({
            method:"POST",
            url:"kehadiran.php",
            data:$scope.kehadiranData
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
                $scope.kehadiranData = {};
            }
        });
    };
});
</script>
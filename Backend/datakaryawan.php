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
    <h3 align="center">Data Karyawan</h3>
    <br />
    <div ng-app ="karyawan" ng-controller="karyawan_controller" class="container form_style">
        <div class="alert {{alertClass}}
        alert-dismissible"  ng-show="alertMsg">
            <a href="#" class="close" ng-click="closeMsg()"
            aria-label="close">&times;</a>
            {{alertMessage}}
        </div>
        <div class="panel panel-default" ng-show="karyawan_form">
            <div class="panel-heading">
                <h3 class="panel-title">Form karyawan</h3>
            </div>
            <div class="panel-body">
                <form method="post" ng-submit="submitkaryawan()">
                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" name="nama" ng-model="karyawanData.nama"
                        class="form-control {{nama}}" />
                    </div>
                    <div class="form-group">
                        <label>Tanggal Masuk</label>
                        <input type="date" name="masuk" ng-model="karyawanData.masuk"
                        class="form-control {{masuk}}" />
                    </div>
                    <div class="form-group">
                        <label>Fungsional</label>
                        <select ng-model="karyawanData.fungsi" id="fungsi" ng-change="SelectedFungsi()" class="form-control {{fungsi}}">
                            <option value="Engineer">Engineer</option>
                            <option value="Administrasi">Administrasi</option>
                            <option value="Support">Support</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Struktural</label>
                        <select ng-model="karyawanData.struk" ng-change="SelectedStruk()" class="form-control {{struk}}">
                            <option value="Manager">Manager</option>
                            <option value="Team Leader">Team Leader</option>
                            <option value="Staff">Staff</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>PIN</label>
                        <input type="number" name="pin" pattern="[0-9]*" inputmode="numeric" ng-model="karyawanData.pin"
                        class="form-control" maxlength="6"/>
                    </div>
                    <div class="form-group" align="center">
                        <input type="submit" name="input"
                        class="btn btn-primary" value="Input" />
                    </div>
                </form>
            <div>
        </div>
    </div>
</body>
</html>
<script>
var app = angular.module('karyawan',[]);
app.controller('karyawan_controller', function($scope, $http){
    $scope.closeMsg = function(){
        $scope.alerMsg = false;
    };
    var a ="";
    var b ="";
    $scope.karyawan_form = true;
    $scope.submitkaryawan = function(){
        $http({
            method:"POST",
            url:"inputkaryawan.php",
            data:$scope.karyawanData
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
                $scope.karyawanData = {};
            }
        });
    };
});
</script>
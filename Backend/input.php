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
        <div ng-app ="input" ng-controller="input_controller" class="container form_style">
            <div class="alert {{alertClass}} alert-dismissible"  ng-show="alertMsg">
                <a href="#" class="close" ng-click="closeMsg()"
                aria-label="close">&times;</a>
                {{alertMessage}}
            </div>
            <!-- form Input Keterangan -->
            <div class="panel panel-default" ng-show="input_form">
                <div class="panel-heading">
                    <h3 class="panel-title">Input Izin Pegawai</h3>
                </div>
                <div class="panel-body">
                    <form method="post" ng-submit="submitInput()" ng-init="loadData()">
                        <div class="form-group">
                            <label>Cari NIP/Nama</label>
                            <select ng-model="inputData.karyawan" id="keterangan" "
                            class="form-control {{karyawan}}" ng-change="loadKaryawan(this)">  
                                <option value="">Select Karyawan</option>  
                                <option ng-repeat="x in karyawan" value={{x.nip}} name={{x.nama}}>{{x.nip}} - {{x.nama}}</option>  
                            </select>  
                        </div>
                        <div class="form-group">
                            <label>Nip</label>
                            <input type="text" id="nip" ng-model="inputData.nip"
                            class="form-control {{nip}}" />
                        </div>
                        <div class="form-group">
                            <label>Nama</label>
                            <input type="text" id="nama" ng-model="inputData.nama"
                            class="form-control" />
                        </div>
                        <div class="form-group">
                            <label>Tanggal Masuk</label>
                            <input type="date" name="masuk" ng-model="inputData.masuk"
                            class="form-control" />
                        </div>
                        <div class="form-group">
                            <label>Keterangan</label>
                            <select ng-model="inputData.keterangan" id="keterangan" ng-change="SelectedKeterangan()" class="form-control {{keterangan}}">
                                <option value="Sakit">Sakti</option>
                                <option value="Ijin">Ijin</option>
                            </select>  
                        </div>
                        <div class="form-group" align="center">
                            <input type="submit" name="Input"
                            class="btn btn-primary" value="Input" />
                        </div>
                    </form>
                <div>
            </div>
        </div>
        
    </body>
</html>
<script>
var app = angular.module('input',[]);
app.controller('input_controller', function($scope, $http){
    $scope.loadData = function(){  
           $http.get("getData.php")  
           .success(function(data){  
                $scope.karyawan = data;  
           })  
      }
    
    $scope.closeMsg = function(){
        $scope.alerMsg = false;
    };
    
    $scope.input_form = true;
    $scope.loadKaryawan = function(sel){
        document.getElementById("nip").value = sel.value;
        document.getElementById("nama").value = sel.name;
    };

    $scope.submitInput = function(){
        $http({
            method:"POST",
            url:"inputData.php",
            data:$scope.inputData
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
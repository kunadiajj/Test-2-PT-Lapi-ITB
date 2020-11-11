<?php

session_start();

?>
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
    .tab 
    {
        padding: 10px 20px; 
        color: gray;
    }
    .activetab 
    {
    color: black;
    border-bottom: 3px solid #2d2d2d;
    }
    .tabs 
    {
        margin: 1em; 
    }
    .tab:hover 
    {
        color: black;
        text-decoration: none; 
    }
    </style>
</head>
    <body>
        <br />
        <h3 align="center">Sistem Absensi</h3>
        <br />
        <div ng-app ="login" ng-controller="login_controller" class="container form_style">
            <?php
                if(isset($_SESSION["name"]))
                {
            ?>
            <div>
                <div class="container-fluid">
                    <div class="ods-box" ng-init="tabselector = 'home'">
                        <div class="tabs">
                            <a class="tab" 
                                ng-click="tabselector = 'home'" 
                                ng-class="{'activetab' : tabselector == 'home'}">Home</a>
                            <a class="tab" 
                                ng-click="tabselector = 'data_karyawan'" 
                                ng-class="{'activetab' : tabselector == 'data_karyawan'}">Data Karyawan</a>
                            <a class="tab" 
                                ng-click="tabselector = 'data_keterangan'" 
                                ng-class="{'activetab' : tabselector == 'data_keterangan'}">Data Ketangan</a>
                            <a class="tab" 
                                ng-click="tabselector = 'report'" 
                                ng-class="{'activetab' : tabselector == 'report'}">Report</a>
                        </div>
                        <div class="ods-box">
                            <!-- home -->
                            <div ng-if="tabselector == 'home'">
                                <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h3 class="panel-title">Welcome To System</h3>
                                        </div>
                                        <div class="panel-body">
                                            <h3>Welcome - <?php echo $_SESSION["name"];
                                            ?></h3>
                                        </div>
                                </div>
                            </div>
                            <!-- data karyawan -->
                            <div ng-if="tabselector == 'data_karyawan'">
                                <div class="alert {{alertClass}}
                                alert-dismissible"  ng-show="alertMsg">
                                    <a href="#" class="close" ng-click="closeMsg()"
                                    aria-label="close">&times;</a>
                                    {{alertMessage}}
                                </div>
                                <div class="panel panel-default">
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
                            <!-- data keterangan -->
                            <div ng-if="tabselector == 'data_keterangan'">
                                <div class="alert {{alertClass}} alert-dismissible"  ng-show="alertMsg">
                                    <a href="#" class="close" ng-click="closeMsg()"
                                    aria-label="close">&times;</a>
                                    {{alertMessage}}
                                </div>
                                <div class="panel panel-default">
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
                            <!-- report -->
                            <div ng-if="tabselector == 'report'">
                                <h3>
                                    report
                                </h3>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
            <?php
                }
                else
                {
            ?>
            <!-- alert -->
            <div class="alert {{alertClass}} alert-dismissible"  ng-show="alertMsg">
                <a href="#" class="close" ng-click="closeMsg()"
                aria-label="close">&times;</a>
                {{alertMessage}}
            </div>
            <!-- Form Login -->
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
                        </div>
                    </form>
                <div>
            </div>
            <?php
                }
            ?>
        </div>
    </body>
</html>
<script>
var app = angular.module('login',[]);
app.controller('login_controller', function($scope, $http){
    $scope.closeMsg = function(){
        $scope.alerMsg = false;
    };
    $scope.submitLogin = function(){
        $http({
            method:"POST",
            url:"login.php",
            data:$scope.loginData
        }).success(function(data){
            
            if(data.error != '')
            {
                $scope.alertMsg = true;
                $scope.alertClass = 'alert-danger';
                $scope.alertMessage = data.error;
            }
            else
            {
                location.reload();
            }
        });
    };
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
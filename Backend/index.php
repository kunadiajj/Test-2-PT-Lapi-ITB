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
        width: 1000px;
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
                        <center>
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
                                <a class="btn btn-danger" href="logout.php" role="button">Logout</a>
                        </center>
                        </div>
                        <div class="ods-box">
                        <label id="lnip"></label>
                            <!-- home -->
                            <div ng-if="tabselector == 'home'">
                                <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h3 class="panel-title">Welcome To System</h3>
                                        </div>
                                        <div class="panel-body">
                                            <center>
                                                <h3>Welcome - <?php echo $_SESSION["name"];
                                                ?></h3>
                                            </center>
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
                                        <form method="post" ng-submit="submitkaryawan()" ng-init="getDataKaryawan()">
                                            <div class="form-group">
                                                <label>NIP</label>
                                                <input type="text" id="nip_kar" ng-model="karyawanData.nip_kar"
                                                class="form-control {{karyawanData.nip_kar}}" disabled/>
                                            </div>
                                            <div class="form-group">
                                                <label>Nama</label>
                                                <input type="text" id="nama_kar" ng-model="karyawanData.nama_kar"
                                                class="form-control {{karyawanData.nama_kar}}" />
                                            </div>
                                            <div class="form-group">
                                                <label>Tanggal Masuk</label>
                                                <input type="date" id="masuk_kar" ng-model="karyawanData.masuk_kar"
                                                class="form-control {{karyawanData.masuk_kar}}" />
                                            </div>
                                            <div class="form-group">
                                                <label>Fungsional</label>
                                                <select id="fungsi_kar" ng-model="karyawanData.fungsi" id="fungsi" ng-change="SelectedFungsi()" class="form-control {{karyawanData.fungsi}}">
                                                    <option value="Engineer">Engineer</option>
                                                    <option value="Administrasi">Administrasi</option>
                                                    <option value="Support">Support</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Struktural</label>
                                                <select id="struk_kar" ng-model="karyawanData.struk" ng-change="SelectedStruk()" class="form-control {{karyawanData.struk}}">
                                                    <option value="Manager">Manager</option>
                                                    <option value="Team Leader">Team Leader</option>
                                                    <option value="Staff">Staff</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>PIN</label>
                                                <input type="number" id="pin_kar" pattern="[0-9]*" inputmode="numeric" ng-model="karyawanData.pin_kar"
                                                class="form-control" maxlength="6"/>
                                            </div>
                                            <div class="form-group" align="center">
                                                <input type="submit" id= "btn" name="input"
                                                class="btn btn-primary" value="Input" />
                                            </div>
                                            <div class="table-responsive" >
                                                <table class="table table-hover  table-bordered">
                                                    <center>
                                                    <tr class="success">
                                                        <th><center>No</center></th>   
                                                        <th><center>NIP</center></th>
                                                        <th><center>Nama Pegawai</center></th>
                                                        <th><center>Fungsional</center></th>
                                                        <th><center>Struktur</center></th>
                                                        <th><center>Tanggal Join</center></th>
                                                        <th><center>Action</center></th>
                                                    </tr>
                                                    <tr ng-repeat="data in database2">
                                                        <td>{{data.no}}</td>
                                                        <td>{{data.nip}}</td>
                                                        <td>{{data.nama}}</td>
                                                        <td>{{data.fungsional}}</td>
                                                        <td>{{data.struktural}}</td>
                                                        <td>{{data.tgl_masuk}}</td>
                                                        <td>
                                                            <button type="button" ng-click="update($event)"  value="{{data.nip}}" class="btn btn-success">Update Data</button>
                                                            <button type="button" ng-click="hapus($event)"  value="{{data.nip}}" class="btn btn-danger">Hapus Data</button>
                                                        </td>
                                                    </tr>
                                                    
                                                </table>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- data keterangan -->
                            <div ng-if="tabselector == 'data_keterangan'">
                                <div class="alert {{alertClass}} alert-dismissible"  ng-show="alertMsg">
                                    <a href="#" class="close" ng-click="closeMsg()"
                                    aria-label="close">&times;</a>
                                    {{alertMessage}}
                                </div>
                                <div class="panel panel-default" >
                                    <div class="panel-heading">
                                        <h3 class="panel-title">Input Izin/Sakit Pegawai</h3>
                                    </div>
                                    <div class="panel-body">
                                        <form method="post" ng-submit="submitInput()" ng-init="getData()">
                                            <div class="form-group">
                                                <label>Cari NIP/Nama</label>
                                                <select ng-model="inputData.karyawan" id="search" "
                                                class="form-control {{karyawan}}" ng-change="loadKaryawan(this)">  
                                                    <option value="">Select Karyawan</option>  
                                                    <option ng-repeat="x in karyawan" value={{x.nip}} name={{x.nama}}>{{x.nip}} - {{x.nama}}</option>  
                                                </select>  
                                            </div>
                                            <div class="form-group">
                                                <label>Nip</label>
                                                <input type="text" id="nip_ket" ng-model="inputData.nip" ng-change="nipCari()"
                                                class="form-control {{nip}}" disabled/>
                                            </div>
                                            <div class="form-group">
                                                <label>Nama</label>
                                                <input type="text" id="nama_ket" ng-model="inputData.nama"
                                                class="form-control" disabled/>
                                            </div>
                                            <div class="form-group">
                                                <label>Tanggal Masuk</label>
                                                <input type="month" id="masuk_ket" ng-model="inputData.masuk"
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
                                    </div>
                                </div>
                                <h3>keterangan</h3>
                            </div>
                            <!-- report -->
                            <div ng-if="tabselector == 'report'">
                                <div class="panel panel-default" >
                                    <div class="panel-heading">
                                        <h3 class="panel-title">Report Kehadiran</h3>
                                    </div>
                                    <div class="panel-body">
                                        <form method="get" ng-submit="getReport()" ng-init="getData()">
                                            <div class="form-group row">
                                                <div class="col-xs-4">
                                                    <label>Periode</label>
                                                    <input type="month" id="tgl_awal" ng-model="report.tgl_awal"
                                                    class="form-control" />
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Cari NIP/Nama</label>
                                                <select ng-model="inputData.karyawan" id="search2" 
                                                class="form-control {{karyawan}}" ng-change="loadKaryawan2()">  
                                                    <option value="">Select Karyawan</option>  
                                                    <option ng-repeat="x in karyawan" value={{x.nip}} name={{x.nama}}>{{x.nip}} - {{x.nama}}</option>  
                                                </select>  
                                            </div>
                                            <div class="form-group" align="center">
                                                <input type="submit" name="search"
                                                class="btn btn-primary" value="Search" />
                                            </div>
                                            <div class="table-responsive">
                                                <table class="table table-hover  table-bordered">
                                                    <tr class="success">
                                                        <th>No</th>   
                                                        <th>NIP</th>
                                                        <th>Nama Pegawai</th>
                                                        <th>Fungsional</th>
                                                        <th>Struktur</th>
                                                        <th>Hadir</th>
                                                        <th>Sakit</th>
                                                        <th>Ijin</th>
                                                        <th>Alpa *)</th>
                                                        <th>Total</th>
                                                    </tr>
                                                    <tr ng-repeat="data in database">
                                                        <td>{{data.no}}</td>
                                                        <td>{{data.nip}}</td>
                                                        <td>{{data.nama}}</td>
                                                        <td>{{data.fungsional}}</td>
                                                        <td>{{data.struktural}}</td>
                                                        <td>{{data.hadir}}</td>
                                                        <td>{{data.sakit}}</td>
                                                        <td>{{data.ijin}}</td>
                                                        <td>{{data.alpa}}</td>
                                                        <td>{{data.total}}</td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </form>
                                    </div>
                                </div>
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
            <div class="panel panel-default">
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
    // document.getElementById("lnip").style.display = 'none';
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
        var data_kar = {
                nip: document.getElementById("nip_kar").value,
                nama: document.getElementById("nama_kar").value,
                masuk: document.getElementById("masuk_kar").value,
                fungsi: document.getElementById("fungsi_kar").value,
                struk: document.getElementById("struk_kar").value,
                pin: document.getElementById("pin_kar").value
            };
            var b = document.getElementById("btn").value;
            if(b == "Update"){
                //Update Data
                $http({
                    method:"POST",
                    url:"UpdateKaryawan.php",
                    data:data_kar
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
                        document.getElementById("nip_kar").value ="",
                        document.getElementById("nama_kar").value ="",
                        document.getElementById("masuk_kar").value ="",
                        document.getElementById("fungsi_kar").value ="",
                        document.getElementById("struk_kar").value ="",
                        document.getElementById("pin_kar").value =""
                        document.getElementById("btn").value = "Input";
                    }
                });
            }else if(b == "Input"){
                //Input Data
                $http({
                    method:"POST",
                    url:"inputkaryawan.php",
                    data:data_kar
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
                        $http({
                            method: 'POST',
                            url: 'getData.php',
                            data: {nip: ""}
                            }).success(function(data){
                            $scope.database2 = data;
                        });
                    }
                });
            }
        
    };
    $scope.loadKaryawan = function(){
        var a = document.getElementById("search").value;
        document.getElementById("lnip").innerHTML =  a;
        document.getElementById("nip_ket").value = a;
        if (a ==""){
            document.getElementById("nama_ket").value = "";
        }else{
            $http({
                method: 'POST',
                url: 'getData.php',
                data: {nip: a}
                }).success(function(data){
                    document.getElementById("nama_ket").value = data[0]['nama'];
            });
        }
    };
    $scope.loadKaryawan2 = function(){
        var a = document.getElementById("search2").value;
        document.getElementById("lnip").innerHTML =  a;
    };
    $scope.getData = function(){
        $http({
            method: 'POST',
            url: 'getData.php',
            data: {nip: ""}
            }).success(function(data){
            $scope.karyawan = data;
        });
    };

    $scope.submitInput = function(){
        var data_ket = {
                karyawan: document.getElementById("nip_ket").value,
                masuk: document.getElementById("masuk_ket").value,
                keterangan: document.getElementById("keterangan").value
            };
        $http({
            method:"POST",
            url:"inputData.php",
            data:data_ket
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
    $scope.getReport = function(){
        var data_report = {
                tgl_awal: document.getElementById("tgl_awal").value,
                nip : document.getElementById("lnip").textContent
            };
            console.log(data_report);
        $http({
            method:"POST",
            url:"getReport.php",
            data:data_report
        }).success(function(data){
            $scope.database = data;
        });
    };
    $scope.getDataKaryawan = function(){
        $http({
            method: 'POST',
            url: 'getData.php',
            data: {nip: ""}
            }).success(function(data){
            $scope.database2 = data;
        });
    };
    $scope.update = function(ac){
        console.log(ac.currentTarget.value);
        $http({
            method: 'POST',
            url: 'getData.php',
            data: {nip: ac.currentTarget.value}
            }).success(function(data){
                console.log(data);
                document.getElementById("nip_kar").value = data[0]['nip'];
                document.getElementById("nama_kar").value = data[0]['nama'];
                document.getElementById("masuk_kar").value = data[0]['tgl_masuk'];
                document.getElementById("fungsi_kar").value = data[0]['fungsional'];
                document.getElementById("struk_kar").value = data[0]['struktural'];
                document.getElementById("pin_kar").value = data[0]['pin'];
                document.getElementById("btn").value = "Update";
        });
    };
    $scope.hapus = function(a){
        var r = confirm("Apakah Anda Ingin Menghapus Karyawan Dengan NIP "+a.currentTarget.value);
        if (r == true) {
            $http({
                method:"POST",
                url:"hapusKaryawan.php",
                data:{nip: a.currentTarget.value}
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
                    $http({
                        method: 'POST',
                        url: 'getData.php',
                        data: {nip: ""}
                        }).success(function(data){
                        $scope.database2 = data;
                    });
                }
            });
        }
    };
});
</script>
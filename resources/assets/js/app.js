import './bootstrap'; 
import 'angular';

/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// Vue.component('example', require('./components/Example.vue'));

// const app = new Vue({
//     el: '#app'
// });

var app = angular.module('PharmaCite', []
    , ['$httpProvider', function ($httpProvider) {
        $httpProvider.defaults.headers.post['X-CSRF-TOKEN'] = $('meta[name=csrf-token]').attr('content');
    }]);

app.controller('MedicineController', ['$scope', '$http', function ($scope, $http) {

}]);

$scope.medicines = [];

// List medicines
$scope.loadMeds = function () {
    $http.get('/medicine')
        .then(function success(e) {
            $scope.medicine = e.data.medicines;
        });
};
$scope.loadMeds();

$scope.errors = [];

    $scope.medicine = {
        name: '',
        description: '',
        amount: '',
        price: '',
        storedDate: ''
    };
    $scope.initMed = function () {
        $scope.resetForm();
        $("#add_new_medicine").modal('show');
    };

    // Add new med
    $scope.addMed = function () {
        $http.post('/medicine', {
            name: $scope.medicine.name,
            description: $scope.medicine.description,
            amount: $scope.medicine.amount,
            price: $scope.medicine.price,
            storedDate: $scope.medicine.storedDate,
            soldOut: $scope.medicine.soldOut

        }).then(function success(e) {
            $scope.resetForm();
            $scope.medicine.push(e.data.medicines);
            $("#add_new_medicine").modal('hide');

        }, function error(error) {
            $scope.recordErrors(error);
        });
    };
    $scope.edit_medicine = {};
    // initialize update action
    $scope.initEdit = function (index) {
        $scope.errors = [];
        $scope.edit_medicine = $scope.medicines[index];
        $("#edit_medicine").modal('show');
    };

    // update the given medicine
    $scope.updateMed = function () {
        $http.patch('/medicine/' + $scope.edit_medicine.id, {
            name: $scope.edit_medicine.name,
            description: $scope.edit_medicine.description,
            amount: $scope.edit_medicine.amount,
            price: $scope.edit_medicine.price,
            soldOut: $scope.edit_medicine.soldOut,
            storedDate: $scope.edit_medicine.storedDate
        }).then(function success(e) {
            $scope.errors = [];
            $("#edit_medicine").modal('hide');
        }, function error(error) {
            $scope.recordErrors(error);
        });
    };

    // delete the given medicine
    $scope.deleteMed = function (index) {

        var conf = confirm("Do you really want to delete this Medicine?");

        if (conf === true) {
            $http.delete('/medicine/' + $scope.medicines[index].id)
                .then(function success(e) {
                    $scope.medicines.splice(index, 1);
                });
        }
    };

    $scope.recordErrors = function (error) {
        $scope.errors = [];
        if (error.data.errors.name) {
            $scope.errors.push(error.data.errors.name[0]);
        }

        if (error.data.errors.description) {
            $scope.errors.push(error.data.errors.description[0]);
        }

        if (error.data.errors.amount) {
            $scope.errors.push(error.data.errors.amount[0]);
        }

        if (error.data.errors.price) {
            $scope.errors.push(error.data.errors.price[0]);
        }

        if (error.data.errors.storedDate) {
            $scope.errors.push(error.data.errors.storedDate[0]);
        }

        if (error.data.errors.soldOut) {
            $scope.errors.push(error.data.errors.soldOut[0]);
        }


    };

    $scope.resetForm = function () {
        $scope.medicine.name = '';
        $scope.medicine.description = '';
        $scope.medicine.amount = '';
        $scope.medicine.price = '';
        $scope.medicine.storedDate = '';
        // $scope.medicine.soldOut = '';
        $scope.errors = [];
    };
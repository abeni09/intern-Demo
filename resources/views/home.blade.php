@extends('layouts.app')

@section('content')
    <div class="container" ng-controller="MedicineController">
        <div class="modal fade" #myModal tabindex="-1" role="dialog" id="add_new_medicine">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title">Add medicine</h4>
                    </div>
                    <div class="modal-body">

                        <div class="alert alert-danger" ng-if="errors.length > 0">
                            <ul>
                                <li ng-repeat="error in errors">@{{ error }}</li>
                            </ul>
                        </div>

                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" class="form-control" ng-model="medicine.name">
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea name="description" rows="5" class="form-control"
                                      ng-model="medicine.description"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="amount">Amount</label>
                            <input type="text" name="amount" class="form-control" ng-model="medicine.amount">
                        </div>
                        <div class="form-group">
                            <label for="price">Price</label>
                            <input type="text" name="price" class="form-control" ng-model="medicine.price">
                        </div>
                        <div class="form-group">
                            <label for="storedDate">Stored Date</label>
                            <input type="text" name="storedDate" class="form-control" ng-model="medicine.storedDate">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" ng-click="addmMed()">Submit</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
        <div class="modal fade" tabindex="-1" role="dialog" id="edit_medicine">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Update Medicine</h4>
                    </div>
                    <div class="modal-body">

                        <div class="alert alert-danger" ng-if="errors.length > 0">
                            <ul>
                                <li ng-repeat="error in errors">@{{ error }}</li>
                            </ul>
                        </div>

                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" class="form-control" ng-model="edit_medicine.name">
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea name="description" rows="5" class="form-control"
                                      ng-model="edit_medicine.description"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="amount">Amount</label>
                            <input type="text" name="amount" class="form-control" ng-model="medicine.amount">
                        </div>
                        <div class="form-group">
                            <label for="price">Price</label>
                            <input type="text" name="price" class="form-control" ng-model="medicine.price">
                        </div>
                        <div class="form-group">
                            <label for="storedDate">Stored Date</label>
                            <input type="text" name="storedDate" class="form-control" ng-model="medicine.storedDate">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" ng-click="updateMed()">Submit</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <button class="btn btn-primary btn-xs pull-right" data-toggle="modal" data-target="#add_new_medicine" data-backdrop="static" data-keyboard="false" >Add Medicine</button>
                        Medicine
                    </div>

                    <div class="panel-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif


                        <table class="table table-bordered table-striped" ngIf="medicine.length > 0">
                            <tr>
                                <th>No.</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Amount</th>
                                <th>Price</th>
                                <th>Sold Out</th>
                                <th>Stored Date</th>
                            </tr>
                            <tr ng-repeat="(index, medicine) in medicines">
                                <td>
                                    @{{ index + 1 }}
                                </td>
                                <td>@{{ medicine.name }}</td>
                                <td>@{{ medicine.description }}</td>
                                <td>@{{ medicine.amount }}</td>
                                <td>@{{ medicine.price }}</td>
                                <td>@{{ medicine.soldOut }}</td>
                                <td>@{{ medicine.storedDate }}</td>
                                <td>
                                    <button class="btn btn-success btn-xs" ng-click="initEdit(index)">Edit</button>
                                    <button class="btn btn-danger btn-xs" ng-click="deleteMed(index)" >Delete</button>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
 
    </div>
@endsection
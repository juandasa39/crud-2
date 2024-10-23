<!DOCTYPE html>
<html ng-app="UserApp">
    <head>
        <title>Registro de Usurios</title>
        <link rel="stylesheet" href="<?= base_url('Resources/app/css/style.css') ?>">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.8.2/angular.min.js"></script>
    </head>
    <body ng-controller="UserController">

        <div class="container">
            <button type="button" class="btn btn-primary my-3" ng-click="openRegistrationModal()">Registro</button>
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Direccion</th>
                        <th>Telefono</th>
                        <th>Contraseña</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr ng-repeat="user in users">
                        <td>{{ user.id}}</td>
                        <td>{{ user.name}}</td>
                        <td>{{ user.email}}</td>
                        <td>{{ user.address}}</td>
                        <td>{{ user.phone}}</td>
                        <td>{{ user.password}}</td>
                        <td>
                            <button class="btn btn-info" ng-click="openEditModal(user)">Editar</button>
                            <button class="btn btn-danger" ng-click="deleteUser(user.id)">Eliminar</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Registration Modal -->
        <div class="modal fade" id="registrationModal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form ng-submit="saveUser()">
                        <div class="modal-header">
                            <h5 class="modal-title">Inicia tu registro</h5>
                            <button type="button" class="close" data-dismiss="modal">
                                <span>&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <input type="text" class="form-control" ng-model="user.name" placeholder="Nombre" required>
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control" ng-model="user.email" placeholder="Email" required>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" ng-model="user.address" placeholder="Direccion" required>
                            </div>
                            <div class="form-group">
                                <input type="tel" class="form-control" ng-model="user.phone" placeholder="Telefono" required>
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" ng-model="user.password" placeholder="Contraseña" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Edit Modal -->
        <div class="modal fade" id="editModal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form ng-submit="updateUser()">
                        <div class="modal-header">
                            <h5 class="modal-title">Actualizar informacion</h5>
                            <button type="button" class="close" data-dismiss="modal">
                                <span>&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" ng-model="user.id">
                            <div class="form-group">
                                <input type="text" class="form-control" ng-model="user.name" placeholder="Nombre" required>
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control" ng-model="user.email" placeholder="Email" required>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" ng-model="user.address" placeholder="Direccion" required>
                            </div>
                            <div class="form-group">
                                <input type="tel" class="form-control" ng-model="user.phone" placeholder="Telefono" required>
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" ng-model="user.password" placeholder="Contraseña" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary">Actualizar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Success Modal -->
        <div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="successModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="successModalLabel">¡Operación Exitosa!</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Tu operación se ha realizado correctamente.
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <script src="<?= base_url('Resources/app/js/app.js') ?>"></script>    
    </body>
</html>

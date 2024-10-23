var app = angular.module('UserApp', []);

app.controller('UserController', ['$scope', '$http', function ($scope, $http) {

    $scope.user = {};
    $scope.users = [];

    // Cargar la lista de usuarios
    $scope.loadUsers = function () {
        $http.get('loadData').then(function (response) {
            $scope.users = response.data;
        }, function () {
            alert("Error al cargar los datos.");
        });
    };

    // Abrir modal para registrar un nuevo usuario
    $scope.openRegistrationModal = function () {
        $scope.user = {};
        $('#registrationModal').modal('show');
    };

    // Abrir modal para editar un usuario existente
    $scope.openEditModal = function (user) {
        $scope.user = angular.copy(user);
        $('#editModal').modal('show');
    };

    // Guardar nuevo usuario
    $scope.saveUser = function () {
        $('#loader').show();
        $http({
            headers: {'Content-Type': 'application/x-www-form-urlencoded'},
            method: 'POST',
            url: 'customers/save',
            data: $.param($scope.user)
        }).then(function (response) {
            if (response.data.status === 'success') {
                $scope.user = {};
                $('#registrationModal').modal('hide');
                $('#successModal').modal('show');
                $scope.loadUsers();
            } else {
                alert(response.data.message);
            }
        }).catch(function () {
            alert("Ocurrió un error al procesar la solicitud.");
        }).finally(function () {
            $('#loader').hide();
        });
    };

    // Actualizar usuario existente
    $scope.updateUser = function () {
        $http({
            headers: {'Content-Type': 'application/x-www-form-urlencoded'},
            method: 'POST',
            url: 'customers/update',
            data: $.param($scope.user)
        }).then(function (response) {
            if (response.data.status === 'success') {
                $scope.loadUsers();
                $('#editModal').modal('hide');
                $('#successModal').modal('show');
            } else {
                alert(response.data.message);
            }
        }).catch(function () {
            alert("Ocurrió un error al actualizar el usuario.");
        });
    };

    // Eliminar usuario
    $scope.deleteUser = function (id) {
        if (confirm('¿Estás seguro de que deseas eliminar este usuario?')) {
            $http({
                headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                method: 'POST',
                url: 'customers/delete',
                data: $.param({id: id})
            }).then(function (response) {
                if (response.data.status === 'success') {
                    $scope.loadUsers();
                    $('#successModal').modal('show');
                } else {
                    alert(response.data.message);
                }
            }).catch(function () {
                alert("Ocurrió un error al eliminar el usuario.");
            });
        }
    };

    // Inicializar cargando la lista de usuarios
    $scope.loadUsers();
}]);

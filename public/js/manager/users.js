$(document).ready(function () {

    var $modal = $('#myModal');
    var $modalBody = $modal.find('.modal-body');
    var $tableList = $('#tableList');
    var $modalBtnSave = $('#modalBtnSave');
    var $btnAdd = $('#btnAdd');

    function addRow(data) {

        var id = data.id_user;

        var $row = $('<tr>')
            .appendTo($tableList);

        $('<td>')
            .html(id)
            .appendTo($row);

        $('<td>')
            .html(data.name)
            .appendTo($row);

        var $tdButton = $('<td>')
            .appendTo($row);

        $('<button>')
            .html('Edit')
            .addClass('btn')
            .attr({
                'data-id': id,
                'data-name': 'btnEdit'
            })
            .on('click', function (e) {

                e.preventDefault();

                var idUser = $(this).data('id');

                userGetById(idUser, function (data) {

                    if (data.success) {

                        _createFormUser(data.user);
                    }
                });
            })
            .appendTo($tdButton);

        $('<button>')
            .html('Delete')
            .addClass('btn btn-danger')
            .attr({
                'data-id': id,
            })
            .on('click', function (e) {

                e.preventDefault();

                var idUser = $(this).data('id');

                userDelete(idUser);
            })
            .appendTo($tdButton);
    }

    function userGetList() {

        $.get('/api/users', function (res) {

            if (res.success) {

                for(var index in res.users) {

                    var user = res.users[index];
                    addRow(user);
                }
            }
        });
    }

    function userGetById(id, callback) {

        $.get('/api/users/' + id, function (res) {

            callback(res);
        });
    }

    function userStore(data, id) {

        if (!id) {

            userCreate(data);
        } else {

            userUpdate(data, id);
        }
    }

    function userCreate(data) {

        data.passwoard = '123456';

        $.ajax({
            url: '/api/users',
            type: 'POST',
            dataType: 'json',
            data: data,
            success: function(response) {

                console.log(response);
            }
        });
    }

    function userUpdate(data, id) {

        $.ajax({
            url: '/api/users/' + id,
            type: 'PUT',
            dataType: 'json',
            data: data,
            success: function(response) {

                console.log(response);
            }
        });
    }

    function userDelete(id) {

        $.ajax({
            url: '/api/users/' + id,
            type: 'DELETE',
            dataType: 'json',
            success: function(response) {

                console.log(response);
            }
        });
    }

    function _createFormUser(user) {

        user = user || {};

        $modalBody.empty();

        $form = $('<form>')
            .appendTo($modalBody);

        $('<input>')
            .attr({
                id: 'inputId',
                name: 'inputId',
                type: 'hidden',
                'data-id': user.id_user
            })
            .appendTo($form);

        $contentName = $('<div>')
            .appendTo($form);

        $('<label>')
            .html('Nome')
            .appendTo($contentName);

        var inputName = $('<input>')
            .attr({
                name: 'inputName',
                id: 'inputName',
                value: user.name
            })
            .appendTo($contentName);

        $contentEmail = $('<div>')
            .appendTo($form);

        $('<label>')
            .html('Email')
            .appendTo($contentEmail);

        var inputEmail = $('<input>')
            .attr({
                type: 'email',
                name: 'inputEmail',
                id: 'inputEmail',
                value: user.email
            })
            .appendTo($contentEmail);

        $modalBtnSave.on('click', function() {

            var data = {
                'name': inputName.val(),
                'email': inputEmail.val()
            };

            userStore(data, user.id_user);
            $modal.modal('hide');
        });

        $modal.modal('show');
    }

    function onBtnShow(idUser) {

        _createFormUser([]);

    }

    function onBtnEdit(idUser) {

    }

    function onBtnDelete(idUser) {

        $modalBody.empty();
    }

    userGetList();

    $btnAdd.on('click', function (e) {

        e.preventDefault();

        _createFormUser();
    });

    $('.btn-action').on('click', function(e) {

        e.stopPropagation();

        var dataName = $(this).data('name');
        var idUser = $(this).data('id');

        $modal.modal('show');

        if (dataName == 'btnShow') {

            onBtnShow(idUser);
        } else if (dataName == 'btnEdit') {

            onBtnEdit(idUser);
        } else if (dataName == 'btnDelete') {

            onBtnDelete(idUser);
        }



        console.log();
    });
});
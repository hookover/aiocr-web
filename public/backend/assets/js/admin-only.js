$().ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
});

admin = {
    adminPay: function (url) {
        var user_type    = $("input[name='user_type']:checked").val();
        var uid          = $("input[name='uid']").val();
        var money        = $("input[name='money']").val();
        var actual_money = $("input[name='actual_money']").val();
        var description  = $("input[name='description']").val();

        if (!user_type) {
            app.alertError('用户类型不能为空！')
            return false;
        }

        if (!uid) {
            app.alertError('用户ID不能为空！')
            return false;
        }

        if (!money) {
            app.alertError('充值金额不能为空！')
            return false;
        }

        if (actual_money == "") {
            app.alertError('实充金额不能为空，若实充值0,则填0！')
            return false;
        }

        var data = {
            user_type:    user_type,
            uid:          uid,
            money:        money,
            actual_money: actual_money,
            description:  description
        };
        app.postData(url, data);
    },

    confirmBankTransfer: function (url, payment_id, type) {
        if (type != 'pass' && type != 'refusal') {
            app.alertError('此函数type参数只接受：pass和refusal')
            return false;
        }

        if (!payment_id) {
            app.alertError('订单ID不能为空！')
            return false;
        }

        var data = {
            type: type,
            payment_id: payment_id,
        };

        if(type == 'pass') {

            swal({
                title:              '确认？',
                text:               '这将为用户帐户充值对应积分，确定已收到款项？',
                showCancelButton:   true,
                confirmButtonClass: 'btn btn-success btn-fill',
                cancelButtonClass:  'btn btn-danger btn-fill',
                buttonsStyling:     false,
                confirmButtonText:  "是的，我确定",
                cancelButtonText:   "取消"
            }).then(function (result) {
                app.postData(url, data);
            }, function () {
                /*取消*/
            })
        }

        if(type == 'refusal') {
            swal({
                title:              '请输入驳回原因',
                html:               '<div class="form-group">' +
                                    '<textarea id="refusal-description" type="text" class="form-control"></textarea>' +
                                    '</div>',
                showCancelButton:   true,
                confirmButtonClass: 'btn btn-success btn-fill',
                cancelButtonClass:  'btn btn-danger btn-fill',
                buttonsStyling:     false,
                confirmButtonText:  "确定",
                cancelButtonText:   "取消"
            }).then(function (result) {
                var description = $('#refusal-description').val();
                if(!description) {
                    app.alertError('请输入驳回原因');
                    return false;
                }
                $.ajax({
                    url:      url,
                    type:     'post',
                    dataType: 'json',
                    data:     {
                        'description': description,
                        type:       type,
                        payment_id: payment_id
                    },
                    success:  function (res) {
                        app.alertSuccess(res.message);
                        location.reload();
                    },
                    error:    function (o, type, msg) {
                        var message = (o.responseJSON && o.responseJSON.message && o.responseJSON.message !== "") ? o.responseJSON.message : msg;
                        app.alertError(message);
                    }
                });

            }, function () {
                /*取消*/
            })
        }
    },

    withdrawAgree: function (url) {
        swal({
            title: '确定通过吗',
            text: "这个操作将无法返回!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonClass: 'btn btn-success btn-fill',
            cancelButtonClass: 'btn btn-danger btn-fill',
            confirmButtonText: '是的',
            cancelButtonText: '取消',
            buttonsStyling: false
        }).then(function() {
            $.ajax({
                url: url,
                type: 'get',
                dataType: 'json',
                success: function (response) {
                    swal({
                        type:               'success',
                        title:              '成功',
                        text:               response.message,
                        confirmButtonClass: 'btn btn-success btn-fill',
                        buttonsStyling:     false
                    }).then(function () {
                        location.reload();
                    })
                },
                error: function (errors) {
                    var message = (errors.responseJSON && errors.responseJSON.message && errors.responseJSON.message !== "") ? errors.responseJSON.message : '用户信息错误~';
                    app.alertError(message);
                }
            })
        });
    },

    withdrawRefuse: function (url) {
        swal({
            title: '请输入驳回原因',
            html:               '<div class="form-group">' +
            '<textarea id="refusal-description" type="text" class="form-control"></textarea>' +
            '</div>',
            type: 'warning',
            showCancelButton: true,
            confirmButtonClass: 'btn btn-success btn-fill',
            cancelButtonClass: 'btn btn-danger btn-fill',
            confirmButtonText: '是的',
            cancelButtonText: '取消',
            buttonsStyling: false
        }).then(function() {
            var description = $('#refusal-description').val();
            if(!description){
                app.alertError('请输入驳回原因');
                return false;
            }
            $.ajax({
                url: url,
                type: 'post',
                data: {
                    description: description,
                },
                dataType: 'json',
                success: function (response) {
                    swal({
                        type:               'success',
                        title:              '成功',
                        text:               response.message,
                        confirmButtonClass: 'btn btn-success btn-fill',
                        buttonsStyling:     false
                    }).then(function () {
                        location.reload();
                    })
                },
                error: function (errors) {
                    var message = (errors.responseJSON && errors.responseJSON.message && errors.responseJSON.message !== "") ? errors.responseJSON.message : '用户信息错误~';
                    app.alertError(message);
                }
            })
        });
    }
};

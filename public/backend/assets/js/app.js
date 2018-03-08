type = ['', 'info', 'success', 'warning', 'danger'];
$().ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
});

app = {
    initFormExtendedDatetimepickers: function () {
        $('.datetimepicker').datetimepicker({
            icons:  {
                time:     "fa fa-clock-o",
                date:     "fa fa-calendar",
                up:       "fa fa-chevron-up",
                down:     "fa fa-chevron-down",
                previous: 'fa fa-chevron-left',
                next:     'fa fa-chevron-right',
                today:    'fa fa-screenshot',
                clear:    'fa fa-trash',
                close:    'fa fa-remove'
            },
            locale: 'zh_cn',
            format: 'YYYY-MM-DD HH:mm:ss'
        });

        $('.datepicker').datetimepicker({
            format: 'MM/DD/YYYY',    //use this format if you want the 12hours timpiecker with AM/PM toggle
            icons:  {
                time:     "fa fa-clock-o",
                date:     "fa fa-calendar",
                up:       "fa fa-chevron-up",
                down:     "fa fa-chevron-down",
                previous: 'fa fa-chevron-left',
                next:     'fa fa-chevron-right',
                today:    'fa fa-screenshot',
                clear:    'fa fa-trash',
                close:    'fa fa-remove'
            },
            locale: 'zh_cn'
        });

        $('.timepicker').datetimepicker({
//          format: 'H:mm',    // use this format if you want the 24hours timepicker
            format: 'h:mm A',    //use this format if you want the 12hours timpiecker with AM/PM toggle
            icons:  {
                time:     "fa fa-clock-o",
                date:     "fa fa-calendar",
                up:       "fa fa-chevron-up",
                down:     "fa fa-chevron-down",
                previous: 'fa fa-chevron-left',
                next:     'fa fa-chevron-right',
                today:    'fa fa-screenshot',
                clear:    'fa fa-trash',
                close:    'fa fa-remove'
            },
            locale: 'zh_cn'
        });
    },
    showSwal:                        function (type) {
        //锁定 / 解锁 积分
        if (type === 'lock_point' || type === 'unlock_point') {
            var tag = type === 'lock_point' ? '锁定' : '解锁';
            var url = type === 'lock_point' ? '/user/point-lock' : '/user/point-unlock';

            swal({
                title:              '请输入想要' + tag + '的积分',
                html:               '<div class="form-group">' +
                                    '<input id="lock-point-input" type="number" class="form-control" />' +
                                    '</div>',
                showCancelButton:   true,
                confirmButtonClass: 'btn btn-success btn-fill',
                cancelButtonClass:  'btn btn-danger btn-fill',
                buttonsStyling:     false,
                confirmButtonText:  "确定",
                cancelButtonText:   "取消"
            }).then(function (result) {
                var point = $('#lock-point-input').val();
                if (!(point > 0 && !isNaN(point))) {
                    app.alertError('积分栏请填写大于0的数字');
                    return false;
                }

                $.ajax({
                    url:      url,
                    type:     'post',
                    dataType: 'json',
                    data:     {
                        'point': point
                    },
                    success:  function (res) {
                        app.alertSuccess(
                            '成功' + tag + '积分: <strong>' +
                            point +
                            '</strong>'
                            , true, 'html')
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
    withdraw:                        function (min, url) {
        swal({
            title:              '申请提现',
            html:               '提现必须满' + min + '元，提交申请后将一次提出全部款项！ <br/> 提现前请确认您的收款账户已填写完整',
            showCancelButton:   true,
            confirmButtonClass: 'btn btn-success btn-fill',
            cancelButtonClass:  'btn btn-danger btn-fill',
            buttonsStyling:     false,
            confirmButtonText:  "确定",
            cancelButtonText:   "取消"
        }).then(function (result) {
            url = url ? url : '/developer/withdraw';
            $.ajax({
                url:      url,
                type:     'post',
                dataType: 'json',
                success:  function (res) {
                    app.alertSuccess(
                        '成功申请提现金额: ￥ <strong>' +
                        res.data.money +
                        '</strong>',
                        true,
                        'html'
                    )
                },
                error:    function (o, type, msg) {
                    var message = (o.responseJSON && o.responseJSON.message && o.responseJSON.message !== "") ? o.responseJSON.message : msg;
                    app.alertError(message);
                }
            });
        }, function () {

        });
    },
    bankPay:                         function (url) {
        var bank_number = $("input[name='bank_number']").val();
        var bank_money  = $("input[name='bank_money']").val();
        var bank_time   = $("input[name='bank_time']").val();

        if (!bank_number) {
            this.alertError('银行卡号不能为空！')
            return false;
        }

        if (!bank_money) {
            this.alertError('转帐金额不能为空！')
            return false;
        }

        if (!bank_time) {
            this.alertError('转帐时间不能为空！')
            return false;
        }

        var data = {
            bank_number: bank_number,
            bank_money:  bank_money,
            bank_time:   bank_time
        };
        $('#bank_pay_button').attr('disabled', true);

        app.postData(url, data, function () {
            $('#bank_pay_button').removeAttr('disabled');
        });
    },

    cardPay:             function (url) {
        var card = $("input[name='card']").val().trim();
        if (!card) {
            this.alertError('充值卡号不能为空！');
            return false;
        }

        var data = {
            card: card
        };
        app.postData(url, data);
    },
    aliPay:              function (url) {
        var money = $("input[name='alipay_money']").val();
        if (!money || money <= 0) {
            this.alertError('请填写正确的充值金额！');
            return false;
        }

        swal({
            title:              '支付',
            text:               '已支付成功？',
            showCancelButton:   true,
            confirmButtonClass: 'btn btn-success btn-fill',
            cancelButtonClass:  'btn btn-danger btn-fill',
            buttonsStyling:     false,
            confirmButtonText:  "确定",
            cancelButtonText:   "取消"
        }).then(function (result) {
            location.reload();
        }, function () {

        });

        window.open(url + '?money=' + money);
    },
    postData:            function (url, data, callback) {
        if (!url) {
            this.alertError('API地址错误，请联系管理员！！！');
            return false;
        }

        $.ajax({
            url:      url,
            type:     'post',
            dataType: 'json',
            data:     data,
            success:  function (res) {
                app.alertSuccess(res.message, true);
                if(typeof callback === "function") {
                    callback();
                }
            },
            error:    function (o, type, msg) {
                var message = (o.responseJSON && o.responseJSON.message && o.responseJSON.message !== "") ? o.responseJSON.message : msg;
                if (message && o && (o.responseJSON instanceof Object) && o.responseJSON.hasOwnProperty('errors')) {
                    app.alertValidatorError(o.responseJSON.errors, message)
                } else {
                    app.alertError(message)
                }

                if(typeof callback === "function") {
                    callback();
                }
            }
        });
    },
    alertError:          function (message) {
        message = message ? '原因：' + message : '';
        swal({
            type:               'error',
            title:              '提交失败',
            text:               message,
            confirmButtonClass: 'btn btn-success btn-fill',
            buttonsStyling:     false
        })
    },
    alertValidatorError: function (errors, message) {
        message         = message ? message : '错误原因：';
        var errors_html = '';
        $.each(errors, function (index, error) {
            if (error instanceof Array) {
                errors_html = error[0] + '<br/>'
            }
        });

        swal({
            type:               'error',
            title:              '提交失败',
            html:               message + '<br/>' + errors_html,
            confirmButtonClass: 'btn btn-success btn-fill',
            buttonsStyling:     false
        })
    },
    alertSuccess:        function (message, reload, text_or_html) {
        if (text_or_html === 'html') {
            swal({
                type:               'success',
                title:              '成功',
                html:               message,
                confirmButtonClass: 'btn btn-success btn-fill',
                buttonsStyling:     false
            }).then(function () {
                if (reload) {
                    location.reload();
                }
            })
        } else {
            swal({
                type:               'success',
                title:              '成功',
                text:               message,
                confirmButtonClass: 'btn btn-success btn-fill',
                buttonsStyling:     false
            }).then(function () {
                if (reload) {
                    location.reload();
                }
            })
        }
    },

};

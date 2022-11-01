define([
    'jquery',
    'uiComponent',
    'ko',
    'mage/url',
], function ($, Component, ko, urlBuilder) {
    'use strict';

    return Component.extend({

        defaults: {
            template: 'Wayne_ShowOrders/form'
        },

        dataOrder: ko.observable({}),
        initialize: function () {
            this._super();
            return this;
        },

        getOrder: function () {
            var self = this;
            var email = $('#customer_email').val();
            $.ajax({
                url: urlBuilder.build('request/orders/getorders'),
                type: "GET",
                dataType: 'json',
                data: {'customer_email': email},
                success: function (response) {
                    console.log(response);
                    self.dataOrder(response.items)
                },
                fail: function (response) {
                    console.log('Erro na requisição')
                }
            })
        },

        ShowTable: function () {
            var x = document.getElementById("users_data");
            if (x.style.display === "none") {
                x.style.display = "block";
            } else {
                x.style.display = "none";
            }

        },

        makeTableScroll: function () {
            let maxRows = 4;
            let table = document.getElementById('users_data');
            let wrapper = table.parentNode;
            let rowsInTable = table.rows.length;
            let height = 0;
            if (rowsInTable > maxRows) {
                for (let i = 0; i < maxRows; i++) {
                    height += table.rows[i].clientHeight;
                }
                wrapper.style.height = height + "px";
            }
        }
    });
})
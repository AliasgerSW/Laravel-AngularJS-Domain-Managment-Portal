$(function(){

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    initializeRenewal();
    initializePrice();

    var yearLimit = [
        {value: 0, text: 'None'},
        {value: 1, text: '1'},
        {value: 2, text: '2'},
        {value: 3, text: '3'},
        {value: 4, text: '4'},
        {value: 5, text: '5'},
        {value: 6, text: '6'},
        {value: 7, text: '7'},
        {value: 8, text: '8'},
        {value: 9, text: '9'},
        {value: 10, text: '10'},
        {value: 11, text: '11'},
        {value: 12, text: '12'},
        {value: 13, text: '13'},
        {value: 14, text: '14'},
        {value: 15, text: '15'},
        {value: 16, text: '16'},
        {value: 17, text: '17'},
        {value: 18, text: '18'},
        {value: 19, text: '19'},
        {value: 20, text: '20'},
    ];

    var statusData = [
        {value: 0, text: 'InActive'},
        {value: 1, text: 'Active'}
    ];

    $("#sugest-group").editable({
        url : '/domain/tld-other-details',
        source : [
            {value: 'none', text: 'None'},
            {value: 'promo', text: 'Promo'},
            {value: 'popular', text: 'Popular'},
            {value: 'both', text: 'Both'}
        ],
        name : 'suggest_group',
        success: function(data) {
            successMessage(data);
        }

    });

    $("#min-reg-year").editable({
        url : '/domain/tld-other-details',
        source : yearLimit,
        name : 'min_purchase_limit',
        success: function(data) {
           successMessage(data);
        }

    });

    $("#max-reg-year").editable({
        url : '/domain/tld-other-details',
        source : yearLimit,
        name : 'max_purchase_limit',
        success: function(data) {
            successMessage(data);
        }
    });

    $("#min-renewal-year").editable({
        url : '/domain/tld-other-details',
        source : yearLimit,
        name : 'min_renewal_limit',
        success: function(data) {
            successMessage(data);
        }
    });

    $("#max-renewal-year").editable({
        url : '/domain/tld-other-details',
        source : yearLimit,
        name : 'max_renewal_limit',
        success: function(data) {
            successMessage(data);
        }
    });
    //not using number type as there is error in console
    $("#max-cancel-day").editable({
        url : '/domain/tld-other-details',
        name : 'max_cancellation_days',
        validate: function(value) {
            var regex = /^[0-9]+$/;
            if(! regex.test(value)) {
                return 'numbers only!';
            }
        },
        success: function(data) {
            successMessage(data);
        }
    });

    $("#min-renewal-time").editable({
        url : '/domain/tld-other-details',
        name : 'min_renewal_time',
        validate: function(value) {
            var regex = /^[0-9]+$/;
            if(! regex.test(value)) {
                return 'numbers only!';
            }
        },
        success: function(data) {
            successMessage(data);
        }
    });

    $("#grace-period").editable({
        url : '/domain/tld-other-details',
        name : 'grace_period',
        validate: function(value) {
            var regex = /^[0-9]+$/;
            if(! regex.test(value)) {
                return 'numbers only!';
            }
        },
        success: function(data) {
            successMessage(data);
        }
    });


    $("#restore-period").editable({
        url : '/domain/tld-other-details',
        name : 'restore_period',
        validate: function(value) {
            var regex = /^[0-9]+$/;
            if(! regex.test(value)) {
                return 'numbers only!';
            }
        },
        success: function(data) {
            successMessage(data);
        }
    });

    $("#restore-price").editable({
        url : '/domain/tld-other-details',
        name : 'restore_price',
        success: function(data) {
            successMessage(data);
        }
    });

    $("#transfer-price").editable({
        url : '/domain/tld-other-details',
        name : 'transfer_price',
        success: function(data) {
            successMessage(data);
        }
    });

    $("#bulk-price-limit").editable({
        url : '/domain/tld-other-details',
        name : 'bulk_price_limit',
        success: function(data) {
            successMessage(data);
        }
    });

    $("#dns-status").editable({
        url : '/domain/tld-feature-service',
        name : 'is_dns_active',
        source : statusData,
        success: function(data) {
            successMessage(data);
        }

    });

    $("#dns-price").editable({
        url : '/domain/tld-feature-service',
        name : 'dns_price',
        success: function(data) {
            successMessage(data);
        }

    });

    $("#privacy-status").editable({
        url : '/domain/tld-feature-service',
        name : 'is_privacy_protection_active',
        source : statusData,
        success: function(data) {
            successMessage(data);
        }

    });

    $("#privacy-price").editable({
        url : '/domain/tld-feature-service',
        name : 'privacy_protection_price',
        success: function(data) {
            successMessage(data);
        }

    });

    $("#theft-protection-status").editable({
        url : '/domain/tld-feature-service',
        name : 'is_theft_protection_active',
        source : statusData,
        success: function(data) {
            successMessage(data);
        }

    });

    $("#theft-protection-price").editable({
        url : '/domain/tld-feature-service',
        name : 'theft_protection_price',
        success: function(data) {
            successMessage(data);
        }

    });

    $("#child-nameserver-status").editable({
        url : '/domain/tld-feature-service',
        name : 'is_child_nameserver_active',
        source : statusData,
        success: function(data) {
            successMessage(data);
        }

    });

    $("#child-nameserver-price").editable({
        url : '/domain/tld-feature-service',
        name : 'child_nameserver_price',
        success: function(data) {
            successMessage(data);
        }

    });

    $("#domain-secret-status").editable({
        url : '/domain/tld-feature-service',
        name : 'is_domain_secret_active',
        source : statusData,
        success: function(data) {
            successMessage(data);
        }

    });

    $("#domain-forward-status").editable({
        url : '/domain/tld-feature-service',
        name : 'is_domain_forwarding_active',
        source : statusData,
        success: function(data) {
            successMessage(data);
        }

    });

    $("#nameserver-status").editable({
        url : '/domain/tld-feature-service',
        name : 'is_nameserver_active',
        source : statusData,
        success: function(data) {
            successMessage(data);
        }

    });

    $("#min-nameserver-limit").editable({
        url : '/domain/tld-feature-service',
        name : 'min_nameserver_limit',
        validate: function(value) {
            var regex = /^[0-9]+$/;
            if(! regex.test(value)) {
                return 'numbers only!';
            }
        },
        success: function(data) {
            successMessage(data);
        }
    });

    $("#max-nameserver-limit").editable({
        url : '/domain/tld-feature-service',
        name : 'max_nameserver_limit',
        validate: function(value) {
            var regex = /^[0-9]+$/;
            if(! regex.test(value)) {
                return 'numbers only!';
            }
        },
        success: function(data) {
            successMessage(data);
        }
    });

    $("#wap-status").editable({
        url : '/domain/tld-feature-service',
        name : 'is_wap_active',
        source : statusData,
        success: function(data) {
            successMessage(data);
        }

    });

    $("#chat-status").editable({
        url : '/domain/tld-feature-service',
        name : 'is_chat_active',
        source : statusData,
        success: function(data) {
            successMessage(data);
        }

    });

    $("#free-email-status").editable({
        url : '/domain/tld-feature-service',
        name : 'is_free_email_active',
        source : statusData,
        success: function(data) {
            successMessage(data);
        }

    });

    $("#continent").editable({
        url : '/domain/save-continent',
        name : 'continents',
        source : '/domain/list-continents',
        success: function(data) {
            successMessage(data);
        }

    });

    $("#category-group").editable({
        url : '/domain/save-category',
        name : 'groups',
        source : '/domain/list-groups',
        success: function(data) {
            successMessage(data);
        }
    });

    $("#add-promo-price-btn").click(function(){
        var formData = $("#promo-price-form").serializeArray();
        console.log(formData);
        $.ajax({
            url : '/domain/tlds-prices',
            type : 'POST',
            data : formData,
            success : function(data) {
                if ($.isEmptyObject(data.error)) {
                    addPriceRow(data);
                    $("#add-price-modal").modal("toggle");
                    toastr["success"]("Successfully Saved", "Add Promo Price");

                } else {
                    toastr["error"](data.error, "Add Promo Price");
                }

            }
        });
    });

    $("#add-renewal-price-btn").click(function(){
        var formData = $("#renewal-price-form").serializeArray();
        $.ajax({
            url : '/domain/tlds-renewal-prices',
            type : 'POST',
            data : formData,
            success : function(data) {
                if ($.isEmptyObject(data.error)) {

                    addRenewalRow(data);
                    $("#add-renewal-modal").modal("toggle");
                    toastr["success"]("Successfully Saved", "Add Renewal Price");


                } else {
                    toastr["error"](data.error, "Add Renewal Price");
                }

            }
        });
    });

    function addRenewalRow(data)
    {
        var newRow = `
            <tr data-id="${data.tldsPrice.id}">
                <td>
                    <a href="#" id="renewal-year" data-type="text" data-pk="${data.tldsPrice.tld_id}" data-title="Please Enter Year" class="editable editable-click renewal-year">
                        ${data.tldsPrice.year}
                    </a>
                </td>
                <td>
                    <a href="#" id="renewal-price" data-type="text" data-pk="${data.tldsPrice.tld_id}" data-title="Please Enter Renewal Price" class="editable editable-click renewal-price">
                        ${data.tldsPrice.renewal_price}
                    </a>
                </td>
                <td>
                    <a href="#" id="renewal-promo-price" data-type="text" data-pk="${data.tldsPrice.tld_id}" data-title="Please Enter Promo Price" class="editable editable-click renewal-promo-price">
                        ${data.tldsPrice.promo_price}
                    </a>
                </td>
                <td>
                    <a href="#" id="renewal-promo-from" data-type="text" data-pk="${data.tldsPrice.tld_id}}" data-title="Please Select Starting Date of Promo Price" class="editable editable-click renewal-promo-from">
                        ${data.tldsPrice.promo_from}
                    </a>
                </td>
                <td>
                    <a href="#" id="renewal-promo-to" data-type="text" data-pk="${data.tldsPrice.tld_id}" data-title="Please Select Ending Date of Promo Price" class="editable editable-click renewal-promo-to">
                        ${data.tldsPrice.promo_to}
                    </a>
                </td>

                <td><a href="javascript:;" class="remove-renewal-price">Remove</a> </td>
            </tr>
        `;
        $("#renewal-body").append(newRow);
        initializeRenewal();
    }


    function addPriceRow(data)
    {
        var newRow = `
            <tr data-id="${data.tldsPrice.id}">
                <td>
                     <a href="#" id="year" data-type="text" data-pk="${data.tldsPrice.tld_id}" data-title="Please Enter Year" class="editable editable-click year">
                        ${data.tldsPrice.year}
                    </a>
                </td>
                <td>
                   <a href="#" id="promo-regular-price" data-type="text" data-pk="${data.tldsPrice.tld_id}" data-title="Please Enter Regular Price" class="promo-regular-price editable editable-click">
                        ${data.tldsPrice.regular_price}
                    </a>
                </td>
                <td>
                    <a href="#" id="promo-price" data-type="text" data-pk="${data.tldsPrice.tld_id}" data-title="Please Enter Promo Price" class="promo-price editable editable-click">
                        ${data.tldsPrice.promo_price}
                    </a>
                </td>
                <td>
                    <a href="#" id="promo-from" data-type="text" data-pk="${data.tldsPrice.tld_id}" data-title="Please Select Starting Date of Promo Price" class="promo-from editable editable-click">
                        ${data.tldsPrice.promo_from}
                    </a>
                </td>
                <td>
                    <a href="#" id="promo-to" data-type="text" data-pk="${data.tldsPrice.tld_id}" data-title="Please Select Ending Date of Promo Price" class="promo-to editable editable-click">
                        ${data.tldsPrice.promo_to}
                    </a>
                </td>
                <td>
                   <a href="#" id="bulk-price" data-type="text" data-pk="${data.tldsPrice.bulk_price}" data-title="Please Enter Bulk Price" class="bulk-price editable editable-click">
                        ${data.tldsPrice.bulk_price}
                    </a>
                </td>

                <a href="javascript:;" class="promo-remove-btn">Remove</a>
            </tr>
        `;
        $("#price-body").append(newRow);
        initializePrice();
    }




    // success Message
    function successMessage(data)
    {
        if (!($.isEmptyObject(data.success))) {
            //display toast success message
            toastr["success"]("Successfully Updated", "Update Detail");

        } else {
            //display toast error message
            toastr["error"](data.error,"Update Detail");
        }
    }

    function validateNumberOnly(value)
    {
        var regex = /^[0-9]+$/;
        if(! regex.test(value)) {
            return 'numbers only!';
        }
    }


    $('#promo_date_range').daterangepicker({
        timePicker: true,
        timePickerIncrement: 1,
        locale: {
            format: 'YYYY-MM-DD HH:mm:ss'
        }
    });

    $('#renewal_date_range').daterangepicker({
        timePicker: true,
        timePickerIncrement: 1,
        locale: {
            format: 'YYYY-MM-DD HH:mm:ss'
        }
    });

    //for promo price
    function initializePrice() {


        $(".year").editable({
            url: '/domain/update-tlds-prices',
            name: 'year',
            params: function(params) {
                var result = configureParam(params, $(this));
                return result;

            },
            success: function (data) {
                successMessage(data);
            }
        });

        $(".promo-regular-price").editable({
            url: '/domain/update-tlds-prices',
            name: 'regular_price',
            params: function(params) {
                var result = configureParam(params, $(this));
                return result;

            },
            success: function (data) {
                successMessage(data);
            }
        });

        $(".promo-price").editable({
            url: '/domain/update-tlds-prices',
            name: 'promo_price',
            params: function(params) {
                var result = configureParam(params, $(this));
                return result;

            },
            success: function (data) {
                successMessage(data);
            }
        });

        $(".promo-from").editable({
            url: '/domain/update-tlds-prices',
            name: 'promo_from',
            params: function(params) {
                var result = configureParam(params, $(this));
                return result;

            },
            success: function (data) {
                successMessage(data);
            }
        });

        $(".promo-to").editable({
            url: '/domain/update-tlds-prices',
            name: 'promo_to',
            params: function(params) {
                var result = configureParam(params, $(this));
                return result;

            },
            success: function (data) {
                successMessage(data);
            }
        });

        $(".bulk-price").editable({
            url: '/domain/update-tlds-prices',
            name: 'bulk_price',
            params: function(params) {
                var result = configureParam(params, $(this));
                return result;

            },
            success: function (data) {
                successMessage(data);
            }
        });
    }

    function configureParam(params, currentField)
    {
        var data = {};
        data.id = $(currentField).closest('tr').data('id');
        data.name = params.name;
        data.value = params.value;
        data.tld_id = params.pk;
        return data;
    }

    //for the renewal price
    function initializeRenewal() {

        $(".renewal-year").editable({
            url: '/domain/update-tlds-renewal-prices',
            name: 'year',
            params: function(params) {
                var result = configureParam(params, $(this));
                return result;

            },
            success: function (data) {
                successMessage(data);
            }
        });

        $(".renewal-price").editable({
            url: '/domain/update-tlds-renewal-prices',
            name: 'renewal_price',
            params: function(params) {
                var result = configureParam(params, $(this));
                return result;

            },
            success: function (data) {
                successMessage(data);
            }
        });

        $(".renewal-promo-price").editable({
            url: '/domain/update-tlds-renewal-prices',
            name: 'promo_price',
            params: function(params) {
                var result = configureParam(params, $(this));
                return result;

            },
            success: function (data) {
                successMessage(data);
            }
        });

        $(".renewal-promo-from").editable({
            url: '/domain/update-tlds-renewal-prices',
            name: 'promo_from',
            params: function(params) {
                var result = configureParam(params, $(this));
                return result;

            },
            success: function (data) {
                successMessage(data);
            }
        });

        $(".renewal-promo-to").editable({
            url: '/domain/update-tlds-renewal-prices',
            name: 'promo_to',
            params: function(params) {
                var result = configureParam(params, $(this));
                return result;

            },
            success: function (data) {
                successMessage(data);
            }
        });
    }

    $('.renewal-remove-btn').click(function(){
        var id = $(this).closest('tr').data('id');
        $('#confirmModal').data('type', 'tlds-renewal-prices');
        $('#confirmModal').data('id', id).modal('show');
    });

    $('.promo-remove-btn').click(function(){
        var id = $(this).closest('tr').data('id');
        $('#confirmModal').data('type', 'tlds-prices');
        $('#confirmModal').data('id', id).modal('show');
    });

    $("#confirm-modal-btn").click(function(e){
        var id = $('#confirmModal').data('id');
        var type = $('#confirmModal').data('type');
        $.ajax({
            url : '/domain/'+type+'/'+id,
            type : 'DELETE',
            success : function(data) {
                if ($.isEmptyObject(data.error)) {
                    //remove row
                    $('.'+type+'-'+id).remove();
                    toastr["success"]("Successfully Saved", "Add Promo Price");

                } else {
                    toastr["error"](data.error, "Add Promo Price");
                }

            }
        });
    });

});
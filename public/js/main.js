/**
 * Created by Alexey Teterin on 20.09.2015.
 */


(function ($) {
    $(function () {
        "use strict";
        var App = {
            status: {},
            options: {},

            /* Тут инициализируем все объекты, что нужны нам */
            initOnDocumentReady: function () {
                this.BrowserDetect.init();
                this.dataTable();
                this.inputMask();
                this.modal();
            },
            modal: function () {


                $('.edit-link').click(function () {
                    var
                        $link = $(this),
                        url = $link.attr('data-url'),
                        $modal = $('#editContact'),
                        $form = $modal.find('form'),
                        $modalContent = $modal.find('.modal-content'),
                        $modalContentOld = $modalContent
                        ;
                    $modalContent.html('Загрузка');
                    $.ajax({
                        url: url,
                        method: "get"
                    }).done(function( data ) {

                        $modalContentOld.html(data);

                        var
                            $link = $(this),
                            url = $link.attr('data-url'),
                            $modal = $('#editContact'),
                            $form = $modal.find('form'),
                            $modalContent = $modal.find('.modal-content')
                            ;
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $modal.find('meta[name="csrf-token"]').attr('content')
                            }
                        });

                        var options = {
                            //target:        '#output2',   // target element(s) to be updated with server response
                            //beforeSubmit:  showRequest,  // pre-submit callback
                            success: function( data ) {
                                alert('Модель сохранена');
                            }  // post-submit callback

                            // other available options:
                            //url:       url         // override for form's 'action' attribute
                            //type:      type        // 'get' or 'post', override for form's 'method' attribute
                            //dataType:  null        // 'xml', 'script', or 'json' (expected server response type)
                            //clearForm: true        // clear all form fields after successful submit
                            //resetForm: true        // reset the form after successful submit

                            // $.ajax options can be used here too, for example:
                            //timeout:   3000
                        };

                        $form.submit(function() {
                            // inside event callbacks 'this' is the DOM element so we first
                            // wrap it in a jQuery object and then invoke ajaxSubmit
                            $(this).ajaxSubmit(options);

                            // !!! Important !!!
                            // always return false to prevent standard browser submit and page navigation
                            return false;
                        });


                    });

                    $modal.modal('show');
                });


                $('#myModal').on('shown.bs.modal', function () {
                    alert(1);

                })
            },
            dataTable: function() {
                if ($("#example1").length > 0) {
                    $("#example1").DataTable( {
                        initComplete: function () {
                            this.api().columns().every( function () {
                                var column = this;
                                var select = $('<select style="width:50px"><option value=""></option></select>')
                                    .appendTo( $(column.header()).empty() )
                                    .on( 'change', function () {
                                        var val = $.fn.dataTable.util.escapeRegex(
                                            $(this).val()
                                        );

                                        column
                                            .search( val ? '^'+val+'$' : '', true, false )
                                            .draw();
                                    } );

                                column.data().unique().sort().each( function ( d, j ) {
                                    select.append( '<option value="'+d+'">'+d+'</option>' )
                                } );
                            } );
                        }
                    } );
                }

            },
            inputMask: function() {
                if ($("[data-mask]").length > 0) {
                    $("[data-mask]").inputmask();
                }
            },
            BrowserDetect: {
                init: function () {
                    this.browser = this.searchString(this.dataBrowser) || "Other";
                    this.version = this.searchVersion(navigator.userAgent) || this.searchVersion(navigator.appVersion) || "Unknown";
                    this.appendClass();
                },
                appendClass: function () {
                    if(this.browser == "Explorer") {
                        $('html').addClass('ie');
                    }
                },
                searchString: function (data) {
                    for (var i = 0; i < data.length; i++) {
                        var dataString = data[i].string;
                        this.versionSearchString = data[i].subString;

                        if (dataString.indexOf(data[i].subString) !== -1) {
                            return data[i].identity;
                        }
                    }
                },
                searchVersion: function (dataString) {
                    var index = dataString.indexOf(this.versionSearchString);
                    if (index === -1) {
                        return;
                    }

                    var rv = dataString.indexOf("rv:");
                    if (this.versionSearchString === "Trident" && rv !== -1) {
                        return parseFloat(dataString.substring(rv + 3));
                    } else {
                        return parseFloat(dataString.substring(index + this.versionSearchString.length + 1));
                    }
                },

                dataBrowser: [
                    {string: navigator.userAgent, subString: "Edge", identity: "MS Edge"},
                    {string: navigator.userAgent, subString: "Chrome", identity: "Chrome"},
                    {string: navigator.userAgent, subString: "MSIE", identity: "Explorer"},
                    {string: navigator.userAgent, subString: "Trident", identity: "Explorer"},
                    {string: navigator.userAgent, subString: "Firefox", identity: "Firefox"},
                    {string: navigator.userAgent, subString: "Safari", identity: "Safari"},
                    {string: navigator.userAgent, subString: "Opera", identity: "Opera"}
                ]

            }
        };

        $(document).ready(function () {
            App.initOnDocumentReady();
        });

    })
})(jQuery);
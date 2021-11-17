$.widget("custom.mywidget", {

    // default options
    options: {
        value: 0
    },
    _create: function() {

        //   $(this.element).val(this.options.myvalue);

        this._on(this.element, {
            "focus": function(event) {

                console.log(event);

                var input_position = $(event.target).offset();
                var targetHeight = $(event.target).height();
                var targetWidth = $(event.target).width();



                this.openwidget();




                $("#my-widget").css({ //widget move
                    'top': (input_position.top + targetHeight + 15) + 'px',
                    'left': (input_position.left) + 'px'

                });

                console.log("left " + input_position.left);
                console.log("top " + input_position.top);

                $("#my-widget").fadeIn();
                $("#my-widget .value").html(this.options.value);
            }
        });

        $(document).on("mousedown", this.hideWidget);

    },
    openwidget: function() {
        $("#my-widget").remove();
        $("body").append('<div class="box2" id="my-widget">' +
            '<button class="btn btn-success minus">-</button>' +
            '<p class="value"></p>' +
            '<button class="btn btn-success plus">+</button>' +
            '</div>'
        );
        var that = this;

        $("#my-widget .plus").on("click", function() {
            that.options.value++;
            $(that.element).val(that.options.value);
            $("#my-widget .value").html(that.options.value);
        });

        $("#my-widget .minus").on("click", function() {
            that.options.value--;
            $(that.element).val(that.options.value);

            $("#my-widget .value").html(that.options.value);
        });
    },
    hideWidget: function() {

        // console.log("hide event");

        var $target = $(event.target);
        console.log($target);
        if (!$target.closest("#my-widget").length && !$target.hasClass("my-widget-input")) {
            $("#my-widget").fadeOut();
        }
    },

});



$.widget("custom.mywidget", {

    // default options
    options: {
        value: 0
    },
    _create: function() {

        //   $(this.element).val(this.options.myvalue);

        this._on(this.element, {
            "focus": function(event) {

                console.log(event);

                var input_position = $(event.target).offset();
                var targetHeight = $(event.target).height();
                var targetWidth = $(event.target).width();



                this.openwidget();




                $("#my-widget").css({ //widget move
                    'top': (input_position.top + targetHeight + 15) + 'px',
                    'left': (input_position.left) + 'px'

                });

                console.log("left " + input_position.left);
                console.log("top " + input_position.top);

                $("#my-widget").fadeIn();
                $("#my-widget .value").html(this.options.value);
            }
        });

        $(document).on("mousedown", this.hideWidget);

    },
    openwidget: function() {
        $("#my-widget").remove();
        $("body").append('<div class="box2" id="my-widget">' +
            '<button class="btn minus">-</button>' +
            '<p class="value"></p>' +
            '<button class="btn plus">+</button>' +
            '</div>'
        );
        var that = this;

        $("#my-widget .plus").on("click", function() {
            that.options.value++;
            $(that.element).val(that.options.value);
            $("#my-widget .value").html(that.options.value);
        });

        $("#my-widget .minus").on("click", function() {
            that.options.value--;
            $(that.element).val(that.options.value);

            $("#my-widget .value").html(that.options.value);
        });
    },
    hideWidget: function() {

        // console.log("hide event");

        var $target = $(event.target);
        console.log($target);
        if (!$target.closest("#my-widget").length && !$target.hasClass("my-widget-input")) {
            $("#my-widget").fadeOut();
        }
    },

});
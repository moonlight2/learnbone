$(function() {



    var Controller = Backbone.Router.extend({
        routes: {
            "": "start",
            "!/": "start",
            "!/success": "success",
            "!/error": "error"
        },
        showPage: function(page) {
            $(".block").hide();
            $("#" + page).show();
        },
        start: function() {
            this.showPage("start");
        },
        success: function() {
            this.showPage("success");
        },
        error: function() {
            this.showPage("error");
        }
    });

    var controller = new Controller();

    Backbone.history.start();


    var Start = Backbone.View.extend({
        
        el: $('#start'),

        events: {
            "click input:button": "check"
        },
        check: function() {

            if (this.el.find("input:text").val() == "test") {
                controller.navigate("!/success", true);
            } else {
                controller.navigate("!/error", true);
            }
        }
    });

    var start = new Start();

});
    
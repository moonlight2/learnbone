$(function() {

    var AppState = Backbone.Model.extend({
        defaults: {
            username: "",
            state: "start"
        }
    });

    var appState = new AppState();

    var Family = ['moo', 'Lilya'];

    var Controller = Backbone.Router.extend({
        routes: {
            "": "start",
            "!/": "start",
            "!/success": "success",
            "!/error": "error"
        },
        start: function() {
            appState.set({state: 'start'});
        },
        success: function() {
            appState.set({state: 'success'});
            console.log(appState);
        },
        error: function() {
            appState.set({state: 'error'});
            console.log(appState);
        }
    });

    var controller = new Controller();

    var Block = Backbone.View.extend({
        el: $('#block'),
        templates: {
            "start": _.template($('#start').html()),
            "success": _.template($('#success').html()),
            "error": _.template($('#error').html())
        },
        events: {
            "click input:button": "check"
        },
        initialize: function() {
            this.model.bind("change", this.render, this);
        },
        check: function() {
            var username = this.el.find("input:text").val();
            var find = (_.detect(Family, function(elem) {
                return elem === username
            }));
            appState.set({// set state and username to model
                "state": find ? "success" : "error",
                "username": username
            });
        },
        render: function() {
            var state = this.model.get("state"); // get field 'state' from AppState
            $(this.el).html(this.templates[state](this.model.toJSON()));
            return this;
        }
    });

    var block = new Block({ model: appState });
    appState.trigger("change");

    // podpiska na smenu sostoyaniya u kontrollera
    appState.bind("change:state", function() {
        var state = this.get("state");
        if (state === "start") {
            controller.navigate("!/", false);
        } else {
            controller.navigate("!/" + state, false);
        }
    });

    Backbone.history.start();

});
    
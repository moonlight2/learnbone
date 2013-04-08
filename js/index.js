$(function() {


    /*---------------------------- Models ------------------------------------*/

    var AppState = Backbone.Model.extend({
        defaults: {
            username: "",
            state: "start"
        }
    });

    var appState = new AppState();

    var UserNameModel = Backbone.Model.extend({
        defaults: {
            "Name": ""
        }
    });

    /*---------------------------- Collections -------------------------------*/

    var Family = Backbone.Collection.extend({
        model: UserNameModel,
        checkUser: function(username) {
            var findResult = this.find(function(user) {
                return user.get("Name") === username
            })
            return findResult != null;
        }
    });

    var MyFamily = new Family([
        {Name: "moo1"},
        {Name: "boo"},
        {Name: "poo"},
    ]);


    /*---------------------------- Controller --------------------------------*/

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

    /*------------------------- View -----------------------------------------*/

    var Block = Backbone.View.extend({
        el: $('#block'),
        templates: {
            "start": _.template($('#start').html()),
            "success": _.template($('#success').html()),
            "error": _.template($('#error').html())
        },
        events: {
            "click input:button": "check",
            "click div": "al"
        },
        initialize: function() {
            this.model.bind("change", this.render, this);
        },
        al: function() {
            alert('My allll');
        },
        check: function() {
            var username = this.el.find("input:text").val();
            var find = MyFamily.checkUser(username);
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

    var block = new Block({model: appState});
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
    
$(function() {


    var AppState = {
        username: ""
    };

    var Views = {};

    var Controller = Backbone.Router.extend({
        routes: {
            "": "start",
            "!/": "start",
            "!/success": "success",
            "!/error": "error"
        },
        start: function() {
            if(View.start != null) {
                Views.start.render();
            }
        },
        success: function() {
            if(View.success != null) {
                Views.start.render();
            }
        },
        error: function() {
            if(View.error != null) {
                Views.start.render();
            }
        }
    });
    
    var controller = new Controller();

    var Start = Backbone.View.extend({
        
        el: $('#block'),
                
        template: _.template($('#start').html),
                
        events: {
            "click input:button" : "check"
        },
        check: function() {
    
            AppState.username = this.el.find("input:text").val();
            
            if (AppState.username == "test") {
                controller.navigate("success", true);
            } else {
                controller.navigate("error", true);
            }
        },
        
        render: function() {
            $(this.el).html(this.template())
        }
    });
    
    var Success = Backbone.View.extend({
        el: $("#block"),
        
        template: _.template($("#success").html()),
        
        render: function() {
            $(this.el).html(this.template(AppState));
        }
    });
    
    var Error = Backbone.View.extend({
        el: $("#block"),
        
        template: _.template($("#error").html()),
        
        render: function() {
            $(this.el).html(this.template(AppState));
        }
    });
    
    Views = {
        start: new Start(),
        success: new Success(),
        error: new Error()
    }
    
    var controller = new Controller();
//    var views = new Views();
   
    Backbone.history.start();


});
    
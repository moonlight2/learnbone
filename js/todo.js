
$(document).ready(function() {




    window.User = Backbone.Model.extend({
        url: 'save.php',
        defaults: {
            done: 0,
            name: ''
        },
        toggle: function() {
            this.save({done: !this.get('done')});
        }
    });


    var user = new User();
    user.set({name: "Bernard", done: 1});
    user.save(null, {success: function(model, response) {
        console.log(response);
        if (response.success == 0) {
            alert('Fail!');
        } else {
            alert('Okayyy!');
        }
//        var len = response.length;
//        for(var x =0; x < len; x++) {
//            console.log(response[x].name);
//        }
    }});





    window.TodoList = Backbone.Collection.extend({
        model: Todo,
    });

});


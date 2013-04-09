<!DOCTYPE html>
<html>
    <head>
        <title></title>
        <link type="text/css" rel="stylesheet" href="css/style.css" />
        <script type="text/javascript" src="js/jquery.js"></script>
        <script type="text/javascript" src="js/underscore.js"></script>
        <script type="text/javascript" src="js/backbone.js"></script>
        <script type="text/javascript" src="js/index.js"></script>
    </head>
    <body>


    <div id="myblock">
        
    </div>
    
        
    <script>
        
        Backbone.sync = function(method, model, options) {
//            console.log(method, model, options);
        }
        
        
        var User = Backbone.Model.extend({
            defaults: {
                name: ""
            },
            url: "save.php",
            validate: function(attr) {
                if(attr.name.length < 3) {
                    return 'Fail, the lenght is smaller that need';
                }
            },
        });

        var man = User();
        man.set({name: 'Ilia'});
        console.log(man);
        
        var Users = Backbone.Collection.extend({
            model: User,
            url: 'save.php'
        });
        var users = new Users();
        users.fetch();
        
        
        
        console.log(users);
        
//        
//        var users = new Users();
//        users.bind('add', function(user){
//            console.log('Whoa! ' + user.get('name'));
//        });
//        users.bind('remove', function(user){
//            console.log('Adios! ' + user.get('name'));
//        });
//        users.bind('change', function(rec){
//            console.log('This is new chanfe event');
//        });
//        
//        users.add({name: 'Iogann Bah'});
        

        
        
//        var user = new User();
//        user.bind('error', function(model, error){
//            alert(error);
//        });
//        user.save({name: 'Ilia'});
//
//        console.log(user.get('name'));

    </script>    
        
        
        
    </body>
</html>